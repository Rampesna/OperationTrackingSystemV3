<script src="{{ asset('assets/jqwidgets/jqxcore.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxbuttons.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxscrollbar.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxlistbox.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdropdownlist.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxmenu.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.selection.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.columnsreorder.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.columnsresize.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.filter.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.sort.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdata.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.pager.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxnumberinput.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxwindow.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdata.export.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.export.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxexport.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.grouping.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/globalization/globalize.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqgrid-localization.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jszip.min.js') }}"></script>

<script>

    function getProject() {
        var id = parseInt('{{ $id }}');
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.project.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#projectNameSpan').text(response.response.name);
                $('#projectStatusBadge').text(response.response.status ? response.response.status.name : '--').addClass(`badge-light-${response.response.status ? response.response.status.color : 'info'}`);
                $('#projectDescription').html(response.response.description ?? '');
                $('#projectEndDateSpan').text(response.response.end_date ? reformatDatetimeToDateForHuman(response.response.end_date) : '--');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                if (parseInt(error.status) === 404) {
                    toastr.error('Proje Bulunamadı!');
                } else {
                    toastr.error('Proje Bilgileri Alınırken Serviste Bir Sorun Oluştu!');
                }
                $('#loader').hide();
            }
        });
    }

    function getProjectSubTasks() {
        var projectId = parseInt('{{ $id }}');
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.project.getSubtasksByProjectId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                projectId: projectId,
            },
            success: function (response) {
                var waitingSubTasks = 0;
                $.each(response.response, function (i, subTask) {
                    if (parseInt(subTask.checked) === 0) {
                        waitingSubTasks++;
                    }
                });
                $('#projectWaitingTasksSpan').text(waitingSubTasks);
            },
            error: function (error) {
                console.log(error);
                if (parseInt(error.status) === 404) {
                    toastr.error('Proje Bulunamadı!');
                } else {
                    toastr.error('Proje Bilgileri Alınırken Serviste Bir Sorun Oluştu!');
                }
            }
        });
    }

    getProject();
    getProjectSubTasks();

</script>


<script>

    function controlMobile() {
        if (detectMobile()) {
            $('#ticketMessagesDrawer').attr('data-kt-drawer-width', '90%');
        } else {
            $('#ticketMessagesDrawer').attr('data-kt-drawer-width', '900px');
        }
    }

    controlMobile();

    var tickets = $('#tickets');
    var ticketMessagesRow = $('#ticketMessagesRow');
    var createTicketMessageArea = $('#createTicketMessageArea');
    var projectTicketsDiv = $('#projectTickets');

    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');
    var priorityIdFilter = $('#priorityId');
    var statusIdFilter = $('#statusId');

    var CreateTicketButton = $('#CreateTicketButton');
    var UpdateTicketButton = $('#UpdateTicketButton');
    var DeleteTicketButton = $('#DeleteTicketButton');
    var ticketMessagesDrawerButton = $('#ticketMessagesDrawerButton');
    var CreateTicketMessageButton = $('#CreateTicketMessageButton');
    var DownloadExcelButton = $('#DownloadExcelButton');

    var updateTicketRelationType = $('#update_ticket_relation_type');
    var updateTicketRelationId = $('#update_ticket_relation_id');
    var updateTicketPriorityId = $('#update_ticket_priority_id');
    var updateTicketStatusId = $('#update_ticket_status_id');

    var ticketMessagesTicketFiles = $('#ticket_messages_ticket_files');
    var ticketMessagesTicketTaskIdInput = $('#ticket_messages_ticket_task_id_input');
    var ticketMessagesTicketStatusIdInput = $('#ticket_messages_ticket_status_id_input');
    var ticketMessagesTicketTransactionStatusIdInput = $('#ticket_messages_ticket_transaction_status_id_input');

    function updateTicket() {
        $('#loader').show();
        $('#TransactionsModal').modal('hide');
        var ticketId = $('#selected_ticket_id').val();
        $('#update_ticket_id').val(ticketId);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.ticket.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: ticketId,
            },
            success: function (response) {
                updateTicketRelationType.val(response.response.relation_type);
                getRelationsForUpdate(response.response.relation_id);
                $('#update_ticket_title').val(response.response.title);
                $('#update_ticket_source').val(response.response.source);
                updateTicketPriorityId.val(response.response.priority_id).trigger('change');
                updateTicketStatusId.val(response.response.status_id).trigger('change');
                $('#update_ticket_requested_end_date').val(response.response.requested_end_date);
                $('#update_ticket_todo_end_date').val(response.response.todo_end_date);
                $('#update_ticket_description').val(response.response.description);
                $('#update_ticket_notes').val(response.response.notes);
                $('#UpdateTicketModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talebi Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function getTicketMessages(drawer = 0) {
        $('#loader').show();
        $('#TransactionsModal').modal('hide');
        var ticketId = $('#selected_ticket_id').val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.ticket.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: ticketId,
            },
            success: function (response) {
                createTicketMessageArea.show();
                var fileDownloadUrl = `{{ route('user.web.file.download') }}`;
                $('#create_ticket_message_ticket_id').val(response.response.id);
                $('#ticket_messages_ticket_title_input').val(response.response.title);
                $('#ticket_messages_ticket_creator_input').val(response.response.creator ? response.response.creator.name : '');
                $('#ticket_messages_ticket_source_input').val(response.response.source ?? '');
                $('#ticket_messages_ticket_description_input').val(response.response.description ?? '');
                $('#ticket_messages_ticket_notes_input').val(response.response.notes ?? '');
                $('#ticket_messages_ticket_created_at_input').val(reformatDatetimeForInput(response.response.created_at));
                $('#ticket_messages_ticket_requested_end_date_input').val(response.response.requested_end_date);
                $('#ticket_messages_ticket_todo_end_date_input').val(response.response.todo_end_date);
                ticketMessagesTicketTransactionStatusIdInput.val(response.response.ticket_transaction_status_id).select2();
                ticketMessagesTicketStatusIdInput.val(response.response.status_id).select2();
                ticketMessagesTicketTaskIdInput.val(response.response.task_id).select2();
                ticketMessagesTicketFiles.empty();
                $.each(response.response.files, function (i, file) {
                    ticketMessagesTicketFiles.append(`<a href="${fileDownloadUrl}/${file.id}" target="_blank" title="${file.name}" class="me-2"><i class="fa fa-lg fa-file"></i></a>`);
                });
                if (drawer === 0) ticketMessagesDrawerButton.click();
                $('#loader').hide();

                $.ajax({
                    type: 'get',
                    url: '{{ route('user.api.ticketMessage.getByTicketId') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        ticketId: ticketId,
                    },
                    success: function (response) {
                        var avatar = `{{ asset('assets/media/logos/avatar.png') }}`;
                        ticketMessagesRow.empty();
                        $.each(response.response, function (i, ticketMessage) {
                            var ticketMessageFiles = ``;
                            $.each(ticketMessage.files, function (i, ticketMessageFile) {
                                ticketMessageFiles += `<a href="${fileDownloadUrl}/${ticketMessageFile.id}" target="_blank" title="${ticketMessageFile.name}" class="me-2"><i class="fa fa-lg fa-file"></i></a>`;
                            });
                            ticketMessagesRow.append(`
                            <div class="d-flex flex-wrap gap-2 flex-stack mb-10">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50 me-4">
                                        <span class="symbol-label" style="background-image:url(${avatar});"></span>
                                    </div>
                                    <div class="pe-5">
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <a href="#" class="fw-bolder text-dark text-hover-primary">${ticketMessage.creator ? ticketMessage.creator.name : '--'}</a>
                                            <span class="svg-icon svg-icon-7 svg-icon-success mx-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                    <circle fill="#000000" cx="12" cy="12" r="8"></circle>
                                                </svg>
                                            </span>
                                            <span class="text-muted fw-bolder me-5">${reformatDatetimeToDatetimeForHuman(ticketMessage.created_at)}, </span>
                                            <span class="text-muted fw-bolder">${ticketMessageFiles}</span>
                                        </div>
                                        <div class="text-muted fw-bold mw-450px" data-kt-inbox-message="preview">${ticketMessage.message}</div>
                                    </div>
                                </div>
                            </div>
                            `);
                        });
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Destek Talebi Mesaj Geçmişi Alınırken Serviste Bir Sorun Oluştu!');
                    }
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talebi Detayları Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteTicket() {
        var ticketId = $('#selected_ticket_id').val();
        $('#delete_ticket_id').val(ticketId);
        $('#TransactionsModal').modal('hide');
        $('#DeleteTicketModal').modal('show');
    }

    function getTicketPriorities() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.ticketPriority.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                updateTicketPriorityId.empty();
                priorityIdFilter.empty();
                $.each(response.response, function (i, ticketPriority) {
                    updateTicketPriorityId.append($('<option>', {
                        value: ticketPriority.id,
                        text: ticketPriority.name
                    }));
                    priorityIdFilter.append($('<option>', {
                        value: ticketPriority.id,
                        text: ticketPriority.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talebi Öncelikleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getTicketTransactionStatuses() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.ticketTransactionStatus.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                ticketMessagesTicketTransactionStatusIdInput.empty();
                ticketMessagesTicketTransactionStatusIdInput.append($('<option>', {
                    value: null,
                    text: ' - Seçim Yok - '
                }));
                $.each(response.response, function (i, ticketMessagesTicketTransactionStatus) {
                    ticketMessagesTicketTransactionStatusIdInput.append($('<option>', {
                        value: ticketMessagesTicketTransactionStatus.id,
                        text: ticketMessagesTicketTransactionStatus.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talebi İşlem Durumları Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getAllTasks() {
        var projectId = parseInt(`{{ $id }}`);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.project.getAllTasks') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                projectId: projectId,
                management: 1
            },
            success: function (response) {
                ticketMessagesTicketTaskIdInput.empty();
                ticketMessagesTicketTaskIdInput.append($('<option>', {
                    value: null,
                    text: ' - Seçim Yok - '
                }));
                $.each(response.response, function (i, task) {
                    ticketMessagesTicketTaskIdInput.append($('<option>', {
                        value: task.id,
                        text: task.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Proje Görevleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getTicketStatuses() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.ticketStatus.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                updateTicketStatusId.empty();
                statusIdFilter.empty();
                $.each(response.response, function (i, ticketStatus) {
                    updateTicketStatusId.append($('<option>', {
                        value: ticketStatus.id,
                        text: ticketStatus.name
                    }));
                    statusIdFilter.append($('<option>', {
                        value: ticketStatus.id,
                        text: ticketStatus.name
                    }));
                    ticketMessagesTicketStatusIdInput.append($('<option>', {
                        value: ticketStatus.id,
                        text: ticketStatus.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talebi Durumları Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getTicketsByRelation() {
        tickets.html(`<tr><td colspan="9" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var relationType = 'App\\Models\\Eloquent\\Project';
        var relationId = parseInt(`{{ $id }}`);

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.ticket.getAllByRelation') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                relationType: relationType,
                relationId: relationId,
            },
            success: function (response) {

                let data = [];
                $.each(response.response, function (i, ticket) {
                    data.push({
                        id: ticket.id,
                        created_at: ticket.created_at,
                        creator: ticket.creator.name,
                        subject: ticket.subject ? ticket.subject.name : '',
                        title: ticket.title,
                        priority: ticket.priority.name,
                        status: ticket.status.name,
                        transactionStatus: ticket.subject ? ticket.transaction_status.name : '',
                        source: ticket.source,
                        requestedEndDate: ticket.requested_end_date ? reformatDatetimeToDatetimeForHuman(ticket.requested_end_date) : '',
                        todoEndDate: ticket.todo_end_date ? reformatDatetimeToDatetimeForHuman(ticket.todo_end_date) : '',
                    });
                });
                var source = {
                    localdata: data,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'id', type: 'integer'},
                            {name: 'created_at', type: 'string'},
                            {name: 'creator', type: 'string'},
                            {name: 'subject', type: 'string'},
                            {name: 'title', type: 'string'},
                            {name: 'priority', type: 'string'},
                            {name: 'status', type: 'string'},
                            {name: 'transactionStatus', type: 'string'},
                            {name: 'source', type: 'string'},
                            {name: 'requestedEndDate', type: 'string'},
                            {name: 'todoEndDate', type: 'string'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                projectTicketsDiv.jqxGrid({
                    width: '100%',
                    height: '600',
                    source: dataAdapter,
                    columnsresize: true,
                    groupable: true,
                    theme: jqxGridGlobalTheme,
                    filterable: true,
                    showfilterrow: true,
                    pageable: false,
                    sortable: true,
                    pagesizeoptions: ['10', '20', '50', '1000'],
                    localization: getLocalization('tr'),
                    columns: [
                        {
                            text: '#',
                            dataField: 'id',
                            columntype: 'textbox',
                            width: '3%'

                        },
                        {
                            text: 'Oluşturulma Tarihi',
                            dataField: 'created_at',
                            columntype: 'textbox',
                            width: '5%'
                        },
                        {
                            text: 'Talep Sahibi',
                            dataField: 'creator',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Konu',
                            dataField: 'subject',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Başlık',
                            dataField: 'title',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Öncelik',
                            dataField: 'priority',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Durum',
                            dataField: 'status',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Görev Durumu',
                            dataField: 'transactionStatus',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Talep Kaynağı',
                            dataField: 'source',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'İstenilen Temin Tarihi',
                            dataField: 'requestedEndDate',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Yapılacak Temin Tarihi',
                            dataField: 'todoEndDate',
                            columntype: 'textbox',
                            width: '10%'
                        }
                    ],
                });
                projectTicketsDiv.on('rowclick', function (event) {
                    projectTicketsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = projectTicketsDiv.jqxGrid('getselectedrowindex');
                    $('#selected_ticket_row_index').val(rowindex);
                    var dataRecord = projectTicketsDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_ticket_id').val(dataRecord.id);
                    return false;
                });
                projectTicketsDiv.jqxGrid('sortby', 'id', 'desc');

                if (response.response.totalCount <= (pageIndex + 1) * pageSize) {
                    pageUpButton.attr('disabled', true);
                } else {
                    pageUpButton.attr('disabled', false);
                }
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talepleri Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    function getRelationsForCreate() {
        var relationType = createTicketRelationType.val();
        if (relationType) {
            if (relationType === 'App\\Models\\Eloquent\\Project') {
                $.ajax({
                    type: 'get',
                    url: '{{ route('user.api.project.getByUserId') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {},
                    success: function (response) {
                        createTicketRelationId.empty();
                        $.each(response.response, function (i, project) {
                            createTicketRelationId.append($('<option>', {
                                value: project.id,
                                text: project.name
                            }));
                        });
                        createTicketRelationId.val('').trigger('change');
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Projeler Alınırken Serviste Bir Sorun Oluştu!');
                    }
                });
            } else {
                toastr.warning('Sistemde Mevcut Olmayan Bir Bağlantı Türü Seçtiniz!');
            }
        }
    }

    function getRelationsForUpdate(relationId) {
        var relationType = updateTicketRelationType.val();
        if (relationType === 'App\\Models\\Eloquent\\Project') {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.project.getByUserId') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {},
                success: function (response) {
                    updateTicketRelationId.empty();
                    $.each(response.response, function (i, project) {
                        updateTicketRelationId.append($('<option>', {
                            value: project.id,
                            text: project.name
                        }));
                    });
                    updateTicketRelationId.val(relationId).trigger('change');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Projeler Alınırken Serviste Bir Sorun Oluştu!');
                }
            });
        } else {
            toastr.warning('Sistemde Mevcut Olmayan Bir Bağlantı Türü Seçtiniz!');
        }
    }

    getTicketPriorities();
    getTicketTransactionStatuses();
    getAllTasks();
    getTicketStatuses();
    getTicketsByRelation();

    keywordFilter.on('keypress', function (e) {
        if (e.which === 13) {
            changePage(1);
        }
    });

    FilterButton.click(function () {
        changePage(1);
    });

    updateTicketRelationType.change(function () {
        getRelationsForUpdate();
    });

    ticketMessagesTicketTransactionStatusIdInput.change(function () {
        var ticketId = $('#create_ticket_message_ticket_id').val();
        var ticketTransactionStatusId = $(this).val();

        $.ajax({
            type: 'put',
            url: '{{ route('user.api.ticket.updateTransactionStatus') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                ticketId: ticketId,
                ticketTransactionStatusId: ticketTransactionStatusId
            },
            success: function () {
                changePage(page.html());
            },
            error: function (error) {
                console.log(error);
                toastr.error('Görev Durumu Güncellenirken Serviste Bir Sorun Oluştu!');
            }
        });
    });

    ticketMessagesTicketStatusIdInput.change(function () {
        var ticketId = $('#selected_ticket_id').val();
        var statusId = $(this).val();

        $.ajax({
            type: 'put',
            url: '{{ route('user.api.ticket.setStatus') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                ticketId: ticketId,
                statusId: statusId
            },
            success: function () {
                getTicketsByRelation();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Talep Durumu Güncellenirken Serviste Bir Sorun Oluştu!');
            }
        });
    });

    ticketMessagesTicketTaskIdInput.change(function () {
        var ticketId = $('#create_ticket_message_ticket_id').val();
        var taskId = $(this).val();

        $.ajax({
            type: 'put',
            url: '{{ route('user.api.ticket.updateTask') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                ticketId: ticketId,
                taskId: taskId
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bağlı Görev Güncellenirken Serviste Bir Sorun Oluştu!');
            }
        });
    });

    ClearFilterButton.click(function () {
        keywordFilter.val('');
        priorityIdFilter.val([]).trigger('change');
        statusIdFilter.val([]).trigger('change');
        changePage(1);
    });

    UpdateTicketButton.click(function () {
        var id = $('#update_ticket_id').val();
        var creatorType = 'App\\Models\\Eloquent\\User';
        var creatorId = parseInt(`{{ auth()->id() }}`);
        var relationType = updateTicketRelationType.val();
        var relationId = updateTicketRelationId.val();
        var priorityId = updateTicketPriorityId.val();
        var statusId = updateTicketStatusId.val();
        var title = $('#update_ticket_title').val();
        var source = $('#update_ticket_source').val();
        var description = $('#update_ticket_description').val();
        var notes = $('#update_ticket_notes').val();
        var requestedEndDate = $('#update_ticket_requested_end_date').val();
        var todoEndDate = $('#update_ticket_todo_end_date').val();

        if (!relationType) {
            toastr.warning('Bağlantı Türü Seçimi Zorunludur!');
        } else if (!relationId) {
            toastr.warning('Talep Bağlantısı Seçimi Zorunludur!');
        } else if (!title) {
            toastr.warning('Talep Başlığı Zorunludur!');
        } else if (!priorityId) {
            toastr.warning('Talep Önceliği Seçimi Zorunludur!');
        } else if (!statusId) {
            toastr.warning('Talep Durumu Seçimi Zorunludur!');
        } else {
            UpdateTicketButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.ticket.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    creatorType: creatorType,
                    creatorId: creatorId,
                    relationType: relationType,
                    relationId: relationId,
                    priorityId: priorityId,
                    statusId: statusId,
                    title: title,
                    source: source,
                    description: description,
                    notes: notes,
                    requestedEndDate: requestedEndDate,
                    todoEndDate: todoEndDate
                },
                success: function () {
                    toastr.success('Destek Talebi Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#UpdateTicketModal').modal('hide');
                    UpdateTicketButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Destek Talebi Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdateTicketButton.attr('disabled', false).html(`Oluştur`);
                }
            });
        }
    });

    DeleteTicketButton.click(function () {
        var id = $('#delete_ticket_id').val();
        DeleteTicketButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.ticket.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Destek Talebi Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#DeleteTicketModal').modal('hide');
                DeleteTicketButton.attr('disabled', false).html(`Sil`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talebi Silinirken Serviste Bir Sorun Oluştu!');
                DeleteTicketButton.attr('disabled', false).html(`Sil`);
            }
        });
    });

    CreateTicketMessageButton.click(function () {
        var ticketId = $('#create_ticket_message_ticket_id').val();
        var creatorType = 'App\\Models\\Eloquent\\User';
        var creatorId = parseInt(`{{ auth()->id() }}`);
        var message = $('#create_ticket_message_message').val();

        if (!message) {
            toastr.warning('Mesaj Girmediniz!');
        } else {
            CreateTicketMessageButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.ticketMessage.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    ticketId: ticketId,
                    creatorType: creatorType,
                    creatorId: creatorId,
                    message: message
                },
                success: function (response) {
                    /*
                    $.ajax({
                        type: 'put',
                        url: '{{ route('user.api.ticket.setStatus') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            ticketId: ticketId,
                            statusId: 2
                        },
                        error: function (error) {
                            console.log(error);
                            toastr.error('Destek Talebi Durumu Güncellenirken Serviste Bir Sorun Oluştu!');
                        }
                    });
                    */
                    toastr.success('Mesajınız Başarıyla Oluşturuldu.');
                    var createTicketMessageFilesCount = document.getElementById('create_ticket_message_files').files.length;
                    if (createTicketMessageFilesCount > 0) {
                        toastr.info('Mesajınıza Ait Dosyalarınız Yükleniyor, Lütfen Bekleyin!');
                        var data = new FormData();
                        data.append('relationType', 'App\\Models\\Eloquent\\TicketMessage');
                        data.append('relationId', response.response.id);
                        data.append('filePath', `uploads/ticket/${response.response.ticket_id}/ticketMessages/${response.response.id}/files/`);
                        for (var index = 0; index < createTicketMessageFilesCount; index++) {
                            data.append("files[]", document.getElementById('create_ticket_message_files').files[index]);
                        }
                        $.ajax({
                            contentType: false,
                            processData: false,
                            type: 'post',
                            url: '{{ route('user.api.file.uploadBatch') }}',
                            headers: {
                                'Accept': 'application/json',
                                'Authorization': token
                            },
                            data: data,
                            success: function () {
                                toastr.success('Mesajınıza Ait Dosyalarınız Başarıyla Yüklendi!');
                                getTicketMessages(1);
                                CreateTicketMessageButton.attr('disabled', false).html(`Cevapla`);
                            },
                            error: function (error) {
                                console.log(error);
                                toastr.error('Mesajınız Gönderildi Ancak Dosyalar Eklenirken Serviste Bir Sorun Oluştu!');
                                CreateTicketMessageButton.attr('disabled', false).html(`Cevapla`);
                            }
                        });
                    } else {
                        getTicketMessages(1);
                        CreateTicketMessageButton.attr('disabled', false).html(`Cevapla`);
                    }
                    $('#create_ticket_message_message').val('');
                    $('#create_ticket_message_files').val('');
                    changePage(parseInt(page.html()));
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Mesaj Gönderilirken Serviste Bir Sorun Oluştu!');
                    CreateTicketMessageButton.attr('disabled', true).html(`Cevapla`);
                }
            });
        }
    });

    DownloadExcelButton.click(function () {
        projectTicketsDiv.jqxGrid('exportdata', 'xlsx', 'Talepler');
    });

    function transactions() {
        $('#TransactionsModal').modal('show');
    }

    $('body').on('contextmenu', function () {
        var ticketId = $('#selected_ticket_id').val();
        if (ticketId) {
            transactions();
        } else {
            toastr.warning('İşlem yapabilmek için lütfen bir ticket seçin!');
        }
        return false;
    });

</script>
