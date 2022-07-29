<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/locales-all-min.js') }}"></script>

<script>

    var authId = parseInt(`{{ auth()->id() }}`);

    $(document).ready(function () {
        $('#loader').hide();
    });

    var createMeetingUsers = $('#create_meeting_users');
    var updateMeetingUsers = $('#update_meeting_users');

    var createMeetingTypeId = $('#create_meeting_type_id');
    var updateMeetingTypeId = $('#update_meeting_type_id');

    var CreateMeetingButton = $('#CreateMeetingButton');
    var UpdateMeetingButton = $('#UpdateMeetingButton');
    var EditMeetingButton = $('#EditMeetingButton');

    function getMeetingTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.meetingType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createMeetingTypeId.empty();
                updateMeetingTypeId.empty();
                $.each(response.response, function (i, meetingType) {
                    createMeetingTypeId.append($('<option>', {
                        value: meetingType.id,
                        text: meetingType.name
                    }));
                    updateMeetingTypeId.append($('<option>', {
                        value: meetingType.id,
                        text: meetingType.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Toplantı Türleri Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    function getUsersByCompanyIds() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.user.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: SelectedCompanies.val(),
                pageIndex: 0,
                pageSize: 1000,
                leave: 0,
            },
            success: function (response) {
                createMeetingUsers.empty();
                updateMeetingUsers.empty();
                $.each(response.response, function (i, user) {
                    createMeetingUsers.append($('<option>', {
                        value: user.id,
                        text: user.name
                    }));
                    updateMeetingUsers.append($('<option>', {
                        value: user.id,
                        text: user.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Listesi Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    getMeetingTypes();
    getUsersByCompanyIds();

    function transactions() {
        $('#TransactionsModal').modal('show');
    }

    function createMeeting(date = null) {
        $('#TransactionsModal').modal('hide');
        createMeetingUsers.val([]);
        $('#create_meeting_name').val('');
        $('#create_meeting_start_date').val(date ? `${moment(new Date(date)).format('YYYY-MM-DD')}T12:00` : '');
        $('#create_meeting_end_date').val(date ? `${moment(new Date(date)).format('YYYY-MM-DD')}T13:00` : '');
        createMeetingTypeId.val('');
        $('#create_meeting_location').val('');
        $('#create_meeting_description').val('');
        $('#CreateMeetingModal').modal('show');
    }

    function updateMeeting() {

    }

    const element = document.getElementById("calendar");

    var todayDate = moment().startOf("day");
    var YM = todayDate.format("YYYY-MM");
    var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
    var TODAY = todayDate.format("YYYY-MM-DD");
    var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");

    var calendarEl = document.getElementById("calendar");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'tr',
        themeSystem: 'bootstrap5',
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        },

        nowIndicator: true,
        now: TODAY + "T{{ date('H:i:s') }}",

        initialView: "dayGridMonth",
        initialDate: TODAY,

        editable: false,
        dayMaxEvents: true,
        navLinks: true,

        dateClick: function (info) {
            createMeeting(info.dateStr.valueOf());
        },

        eventClick: function (info) {
            $('#loader').show();
            var meetingId = info.event._def.extendedProps._id;
            $('#update_meeting_id').val(meetingId);
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
                    $('#ShowModal').modal('show');
                    updateMeetingUsers.val([]).trigger('change');
                    $('#update_meeting_name').val(response.response.name);
                    $('#update_meeting_start_date').val(reformatDatetimeForInput(response.response.start_date));
                    $('#update_meeting_end_date').val(reformatDatetimeForInput(response.response.end_date));
                    updateMeetingTypeId.val(response.response.type_id).trigger('change');
                    $('#update_meeting_location').val(response.response.location);
                    $('#update_meeting_description').val(response.response.description);
                    parseInt(response.response.creator_id) === authId ? EditMeetingButton.show() : EditMeetingButton.hide();
                    $('#ShowMeetingModal').modal('show');
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Toplantı Verileri Alınırken Serviste Bir Hata Oluştu.');
                    $('#loader').hide();
                }
            });
        },

        events: function (info, successCallback) {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.meeting.getDateBetweenByUserId') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    startDate: info.startStr.valueOf(),
                    endDate: info.endStr.valueOf()
                },
                success: function (response) {
                    var meetings = [];
                    $.each(response.response, function (i, meeting) {
                        meetings.push({
                            _id: meeting.id,
                            id: meeting.id,
                            title: `${meeting.name}`,
                            start: reformatDateForCalendar(meeting.start_date),
                            end: reformatDateForCalendar(meeting.end_date),
                            type: 'meeting',
                            classNames: 'bg-primary text-white cursor-pointer ms-1 me-1',
                            backgroundColor: 'white',
                            meeting_id: `${meeting.id}`
                        });
                    });
                    successCallback(meetings);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        },
    });

    calendar.render();

    CreateMeetingButton.click(function () {
        var userIds = createMeetingUsers.val();
        var name = $('#create_meeting_name').val();
        var startDate = $('#create_meeting_start_date').val();
        var endDate = $('#create_meeting_end_date').val();
        var typeId = createMeetingTypeId.val();
        var location = $('#create_meeting_location').val();
        var description = $('#create_meeting_description').val();

        if (userIds.length === 0) {
            toastr.warning('Hiç Katılımcı Seçilmedi!');
        } else if (!name) {
            toastr.warning('Toplantı Konusu Girilmedi!');
        } else if (!startDate) {
            toastr.warning('Toplantı Başlangıcı Girilmedi!');
        } else if (!endDate) {
            toastr.warning('Toplantı Bitişi Girilmedi!');
        } else if (!typeId) {
            toastr.warning('Toplantı Türü Girilmedi!');
        } else if (!location) {
            toastr.warning('Toplantı Adresi Girilmedi!');
        } else {
            CreateMeetingButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.meeting.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    name: name,
                    startDate: startDate,
                    endDate: endDate,
                    typeId: typeId,
                    location: location,
                    description: description
                },
                success: function (response) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('user.api.meetingUser.setMeetingUsers') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            meetingId: response.response.id,
                            userIds: userIds
                        },
                        success: function () {
                            toastr.success('Toplantı Başarıyla Oluşturuldu!');
                            $('#CreateMeetingModal').modal('hide');
                            CreateMeetingButton.attr('disabled', false).html('Oluştur');
                            calendar.refetchEvents();
                        },
                        error: function (error) {
                            console.log(error);
                            toastr.error('Toplantı Oluşturuldı Ancak, Katılımcılar Kaydedilirken Serviste Bir Hata Oluştu.');
                            $('#CreateMeetingModal').modal('hide');
                            CreateMeetingButton.attr('disabled', false).html('Oluştur');
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Toplantı Oluşturulurken Serviste Bir Hata Oluştu.');
                    CreateMeetingButton.attr('disabled', false).html('Oluştur');
                }
            });
        }
    });

    $('body').on('contextmenu', function () {
        transactions();
        return false;
    });

    SelectedCompanies.change(function () {
        getUsersByCompanyIds();
        calendar.refetchEvents();
    });

</script>
