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

    var tickets = $('#tickets');
    var ticketMessagesRow = $('#ticketMessagesRow');
    var createTicketMessageArea = $('#createTicketMessageArea');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
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

    var updateTicketRelationType = $('#update_ticket_relation_type');
    var updateTicketRelationId = $('#update_ticket_relation_id');
    var updateTicketPriorityId = $('#update_ticket_priority_id');
    var updateTicketStatusId = $('#update_ticket_status_id');

    var ticketMessagesTicketFiles = $('#ticket_messages_ticket_files');
    var ticketMessagesTicketTaskIdInput = $('#ticket_messages_ticket_task_id_input');
    var ticketMessagesTicketTransactionStatusIdInput = $('#ticket_messages_ticket_transaction_status_id_input');

    function controlMobile() {
        if (detectMobile()) {
            $('#ticketMessagesDrawer').attr('data-kt-drawer-width', '90%');
        } else {
            $('#ticketMessagesDrawer').attr('data-kt-drawer-width', '900px');
        }
    }

    controlMobile();

    function updateTicket(id) {
        $('#loader').show();
        $('#update_ticket_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.ticket.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
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

    function getTicketMessages(ticketId, drawer = 0) {
        $('#loader').show();
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

    function deleteTicket(id) {
        $('#delete_ticket_id').val(id);
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
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();
        var priorityIds = priorityIdFilter.val();
        var statusIds = statusIdFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.ticket.getByRelation') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                relationType: relationType,
                relationId: relationId,
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
                priorityIds: priorityIds,
                statusIds: statusIds,
            },
            success: function (response) {
                tickets.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.tickets, function (i, ticket) {
                    tickets.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${ticket.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${ticket.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateTicket(${ticket.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="getTicketMessages(${ticket.id})" title="İncele"><i class="fas fa-eye me-2 text-info"></i> <span class="text-dark">İncele</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteTicket(${ticket.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            #${ticket.id}
                        </td>
                        <td>
                            ${reformatDatetimeTo_DD_MM_YYYY_HH_ii_WithDot(ticket.created_at)}
                        </td>
                        <td>
                            ${ticket.title ?? ''}
                        </td>
                        <td>
                            <span class="badge badge-${ticket.priority ? ticket.priority.color : 'secondary'}">${ticket.priority ? ticket.priority.name : ''}</span>
                        </td>
                        <td>
                            <span class="badge badge-${ticket.status ? ticket.status.color : 'secondary'}">${ticket.status ? ticket.status.name : '--'}</span>
                        </td>
                        <td>
                            <span class="badge badge-secondary">${ticket.transaction_status ? ticket.transaction_status.name : ''}</span>
                        </td>
                        <td class="hideIfMobile">
                            ${ticket.source ?? ''}
                        </td>
                        <td class="hideIfMobile">
                            ${ticket.requested_end_date ? reformatDatetimeToDateForHuman(ticket.requested_end_date) : ''}
                        </td>
                        <td class="hideIfMobile">
                            ${ticket.todo_end_date ? reformatDatetimeToDateForHuman(ticket.todo_end_date) : ''}
                        </td>
                    </tr>
                    `);
                });

                checkScreen();

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

    function changePage(newPage) {
        if (newPage === 1) {
            pageDownButton.attr('disabled', true);
        } else {
            pageDownButton.attr('disabled', false);
        }

        page.html(newPage);
        getTicketsByRelation();
    }

    pageUpButton.click(function () {
        changePage(parseInt(page.html()) + 1);
    });

    pageDownButton.click(function () {
        changePage(parseInt(page.html()) - 1);
    });

    pageSizeSelector.change(function () {
        changePage(1);
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
                                getTicketMessages(ticketId, 1);
                                CreateTicketMessageButton.attr('disabled', false).html(`Cevapla`);
                            },
                            error: function (error) {
                                console.log(error);
                                toastr.error('Mesajınız Gönderildi Ancak Dosyalar Eklenirken Serviste Bir Sorun Oluştu!');
                                CreateTicketMessageButton.attr('disabled', false).html(`Cevapla`);
                            }
                        });
                    } else {
                        getTicketMessages(ticketId, 1);
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

</script>
