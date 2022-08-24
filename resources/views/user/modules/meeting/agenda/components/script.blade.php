<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var meetingId = parseInt(`{{ $meetingId }}`);

    var meetingAgendas = $('#meetingAgendas');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');

    var CreateMeetingAgendaButton = $('#CreateMeetingAgendaButton');
    var UpdateMeetingAgendaButton = $('#UpdateMeetingAgendaButton');
    var DeleteMeetingAgendaButton = $('#DeleteMeetingAgendaButton');

    function getMeeting() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.meeting.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: meetingId,
            },
            success: function (response) {
                $('#meetingNameSpan').text(response.response.name);
                $('#meetingTypeSpan').text(response.response.type ? response.response.type.name : '');
                $('#meetingStartDateSpan').text(response.response.start_date ? reformatDatetimeToDatetimeForHuman(response.response.start_date) : '');
                $('#meetingEndDateSpan').text(response.response.end_date ? reformatDatetimeToDatetimeForHuman(response.response.end_date) : '');
                var meetingUsers = ``;
                $.each(response.response.users, function (i, user) {
                    meetingUsers += `<span class="badge badge-light-primary me-2">${user.name}</span>`;
                });
                $('#meetingUsersSpan').html(meetingUsers);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Toplantı Verileri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getMeetingAgendas() {
        meetingAgendas.html(`<tr><td colspan="2" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.meetingAgenda.index') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                pageIndex: pageIndex,
                pageSize: pageSize,
                meetingId: meetingId,
                keyword: keyword
            },
            success: function (response) {
                meetingAgendas.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.meetingAgendas, function (i, meetingAgenda) {
                    meetingAgendas.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${meetingAgenda.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${meetingAgenda.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateMeetingAgenda(${meetingAgenda.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteMeetingAgenda(${meetingAgenda.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${meetingAgenda.subject ?? ''}
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
                toastr.error('Toplantı Gündemleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getMeeting();
    getMeetingAgendas();

    function createMeetingAgenda() {
        $('#create_meeting_agenda_subject').val('');
        $('#CreateMeetingAgendaModal').modal('show');
    }

    function updateMeetingAgenda(id) {
        $('#loader').show();
        $('#update_meeting_agenda_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.meetingAgenda.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#loader').hide();
                $('#update_meeting_agenda_subject').val(response.response.subject);
                $('#update_meeting_agenda_discussions').val(response.response.discussions);
                $('#update_meeting_agenda_result').val(response.response.result);
                $('#UpdateMeetingAgendaModal').modal('show');
            },
            error: function (error) {
                $('#loader').hide();
                console.log(error);
                toastr.error('Gündem Verileri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function deleteMeetingAgenda(id) {
        $('#delete_meeting_agenda_id').val(id);
        $('#DeleteMeetingAgendaModal').modal('show');
    }

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
        getMeetingAgendas();
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

    ClearFilterButton.click(function () {
        keywordFilter.val('');
        changePage(1);
    });

    CreateMeetingAgendaButton.click(function () {
        var subject = $('#create_meeting_agenda_subject').val();

        if (!subject) {
            toastr.warning('Gündem Konusu Boş Olamaz!');
        } else {
            CreateMeetingAgendaButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.meetingAgenda.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    meetingId: meetingId,
                    subject: subject,
                },
                success: function () {
                    toastr.success('Gündem Başarıyla Oluşturuldu!');
                    $('#CreateMeetingAgendaModal').modal('hide');
                    CreateMeetingAgendaButton.attr('disabled', false).html('Oluştur');
                    changePage(1);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Gündem Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateMeetingAgendaButton.attr('disabled', false).html('Oluştur');
                }
            });
        }
    });

    UpdateMeetingAgendaButton.click(function () {
        var id = $('#update_meeting_agenda_id').val();
        var subject = $('#update_meeting_agenda_subject').val();
        var discussions = $('#update_meeting_agenda_discussions').val();
        var result = $('#update_meeting_agenda_result').val();

        if (!subject) {
            toastr.warning('Gündem Konusu Boş Olamaz!');
        } else {
            UpdateMeetingAgendaButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.meetingAgenda.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    meetingId: meetingId,
                    subject: subject,
                    discussions: discussions,
                    result: result,
                },
                success: function () {
                    toastr.success('Gündem Başarıyla Güncellendi!');
                    $('#UpdateMeetingAgendaModal').modal('hide');
                    UpdateMeetingAgendaButton.attr('disabled', false).html('Güncelle');
                    changePage(parseInt(page.html()));
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Gündem Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdateMeetingAgendaButton.attr('disabled', false).html('Güncelle');
                }
            });
        }
    });

    DeleteMeetingAgendaButton.click(function () {
        var id = $('#delete_meeting_agenda_id').val();
        DeleteMeetingAgendaButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.meetingAgenda.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Gündem Başarıyla Silindi!');
                $('#DeleteMeetingAgendaModal').modal('hide');
                DeleteMeetingAgendaButton.attr('disabled', false).html('Sil');
                changePage(parseInt(page.html()));
            },
            error: function (error) {
                console.log(error);
                toastr.error('Gündem Silinirken Serviste Bir Sorun Oluştu!');
                DeleteMeetingAgendaButton.attr('disabled', false).html('Sil');
            }
        });
    });

</script>
