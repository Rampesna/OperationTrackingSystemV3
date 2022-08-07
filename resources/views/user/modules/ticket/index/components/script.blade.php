<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var tickets = $('#tickets');

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

    var createTicketRelationType = $('#create_ticket_relation_type');
    var createTicketRelationId = $('#create_ticket_relation_id');
    var createTicketPriorityId = $('#create_ticket_priority_id');

    var updateTicketRelationType = $('#update_ticket_relation_type');
    var updateTicketRelationId = $('#update_ticket_relation_id');
    var updateTicketPriorityId = $('#update_ticket_priority_id');

    function controlMobile() {
        if (detectMobile()) {
            $('#ticketMessagesDrawer').attr('data-kt-drawer-width', '90%');
        } else {
            $('#ticketMessagesDrawer').attr('data-kt-drawer-width', '900px');
        }
    }

    controlMobile();

    function createTicket() {
        createTicketRelationType.val('');
        $('#create_ticket_title').val('');
        $('#create_ticket_source').val('');
        createTicketPriorityId.val('').trigger('change');
        $('#create_ticket_requested_end_date').val('');
        $('#create_ticket_description').val('');
        $('#create_ticket_notes').val('');
        $('#CreateTicketModal').modal('show');
    }

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
                $('#update_ticket_status_id').val(response.response.status_id);
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

    function getTicketMessages(ticketId) {
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
                $('#ticket_messages_ticket_title_input').val(response.response.title);
                $('#ticket_messages_ticket_creator_input').val(response.response.creator ? response.response.creator.name : '');
                $('#ticket_messages_ticket_source_input').val(response.response.source ?? '');
                $('#ticket_messages_ticket_description_input').val(response.response.description ?? '');
                $('#ticket_messages_ticket_notes_input').val(response.response.notes ?? '');
                $('#ticket_messages_ticket_created_at_input').val(reformatDatetimeForInput(response.response.created_at));
                $('#ticket_messages_ticket_requested_end_date_input').val(response.response.requested_end_date ? response.response.requested_end_date : '');
                $('#ticket_messages_ticket_todo_end_date_input').val(response.response.todo_end_date ? response.response.todo_end_date : '');
                ticketMessagesDrawerButton.click();
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
                        console.log(response);
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
                createTicketPriorityId.empty();
                updateTicketPriorityId.empty();
                priorityIdFilter.empty();
                $.each(response.response, function (i, ticketPriority) {
                    createTicketPriorityId.append($('<option>', {
                        value: ticketPriority.id,
                        text: ticketPriority.name
                    }));
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
                statusIdFilter.empty();
                $.each(response.response, function (i, ticketStatus) {
                    statusIdFilter.append($('<option>', {
                        value: ticketStatus.id,
                        text: ticketStatus.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talebi Öncelikleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getTicketsByCreator() {
        tickets.html(`<tr><td colspan="7" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var creatorType = 'App\\Models\\Eloquent\\User';
        var creatorId = parseInt(`{{ auth()->id() }}`);
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();
        var priorityIds = priorityIdFilter.val();
        var statusIds = statusIdFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.ticket.getByCreator') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                creatorType: creatorType,
                creatorId: creatorId,
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
                priorityIds: priorityIds,
                statusIds: statusIds,
            },
            success: function (response) {
                console.log(response);
                tickets.empty();
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
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="getTicketMessages(${ticket.id})" title="Mesajlar"><i class="fas fa-envelope me-2 text-info"></i> <span class="text-dark">Mesajlar</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteTicket(${ticket.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${ticket.relation_type === 'App\\Models\\Eloquent\\Project' ? 'Proje' : ''}
                        </td>
                        <td>
                            ${ticket.relation ? (ticket.relation.name ? ticket.relation.name : '') : ''}
                        </td>
                        <td>
                            ${ticket.title ?? ''}
                        </td>
                        <td>
                            <span class="badge badge-${ticket.priority ? ticket.priority.color : 'secondary'}">${ticket.priority ? ticket.priority.name : ''}</span>
                        </td>
                        <td>
                            <span class="badge badge-${ticket.status ? ticket.status.color : 'secondary'}">${ticket.status ? ticket.status.name : ''}</span>
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
    getTicketStatuses();
    getTicketsByCreator();

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
        getTicketsByCreator();
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

    createTicketRelationType.change(function () {
        getRelationsForCreate();
    });

    updateTicketRelationType.change(function () {
        getRelationsForUpdate();
    });

    ClearFilterButton.click(function () {
        keywordFilter.val('');
        priorityIdFilter.val([]).trigger('change');
        statusIdFilter.val([]).trigger('change');
        changePage(1);
    });

    CreateTicketButton.click(function () {
        var creatorType = 'App\\Models\\Eloquent\\User';
        var creatorId = parseInt(`{{ auth()->id() }}`);
        var relationType = createTicketRelationType.val();
        var relationId = createTicketRelationId.val();
        var priorityId = createTicketPriorityId.val();
        var statusId = 1;
        var title = $('#create_ticket_title').val();
        var source = $('#create_ticket_source').val();
        var description = $('#create_ticket_description').val();
        var notes = $('#create_ticket_notes').val();
        var requestedEndDate = $('#create_ticket_requested_end_date').val();
        var todoEndDate = null;

        if (!relationType) {
            toastr.warning('Bağlantı Türü Seçimi Zorunludur!');
        } else if (!relationId) {
            toastr.warning('Talep Bağlantısı Seçimi Zorunludur!');
        } else if (!title) {
            toastr.warning('Talep Başlığı Zorunludur!');
        } else if (!priorityId) {
            toastr.warning('Talep Önceliği Seçimi Zorunludur!');
        } else {
            CreateTicketButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.ticket.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
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
                    toastr.success('Destek Talebi Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#CreateTicketModal').modal('hide');
                    CreateTicketButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Destek Talebi Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateTicketButton.attr('disabled', false).html(`Oluştur`);
                }
            });
        }
    });

    UpdateTicketButton.click(function () {
        var id = $('#update_ticket_id').val();
        var creatorType = 'App\\Models\\Eloquent\\User';
        var creatorId = parseInt(`{{ auth()->id() }}`);
        var relationType = updateTicketRelationType.val();
        var relationId = updateTicketRelationId.val();
        var priorityId = updateTicketPriorityId.val();
        var statusId = $('#update_ticket_status_id').val();
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
                    changePage(1);
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

</script>
