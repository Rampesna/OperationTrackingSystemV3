<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/locales-all-min.js') }}"></script>

<script>

    var employee = null;

    var employeeId = `{{ $id }}`;

    var employeeImageSpan = $('#employeeImageSpan');
    var employeeNameSpan = $('#employeeNameSpan');
    var employeeIdentitySpan = $('#employeeIdentitySpan');
    var employeeEmailSpan = $('#employeeEmailSpan');
    var employeePhoneSpan = $('#employeePhoneSpan');

    function getEmployeeById() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: employeeId,
            },
            success: function (response) {
                employee = response;
                if (response.response.image) employeeImageSpan.attr('src', `${baseAssetUrl}${response.response.image}`);
                employeeNameSpan.html(response.response.name);
                employeeIdentitySpan.html(`<i class="far fa-user-circle me-4"></i><span class="mt-n1">${response.response.identity}</span>`);
                employeeEmailSpan.html(`<i class="far fa-envelope me-4"></i><span class="mt-n1">${response.response.email}</span>`);
                employeePhoneSpan.html(`<i class="fas fa-phone-square-alt me-4"></i><span class="mt-n1">${response.response.phone}</span>`);
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                $('#loader').hide();
                toastr.error('Personel Bilgileri Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    getEmployeeById();

</script>

<script>

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
            $('#create_shift_clicked_date').val(info.dateStr);
            createShift();
        },

        eventClick: function (info) {
            $('#loader').show();
            $('.fc-popover-close').click();
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.shift.getById') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: info.event.id
                },
                success: function (response) {
                    $('#show_shift_employee_name').text(response.response.employee.name);
                    $('#show_shift_start_date').text(reformatDatetimeToDatetimeForHuman(response.response.start_date));
                    $('#show_shift_end_date').text(reformatDatetimeToDatetimeForHuman(response.response.end_date));
                    $('#ShowModal').modal('show');
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vardiya Bilgisi Alınırken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        },

        events: function (info, successCallback) {
            $('#loader').show();
            var employeeId = parseInt(`{{ $id }}`);
            $.ajax({
                url: '{{ route('user.api.shift.getByEmployeeId') }}',
                dataType: 'json',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    startDate: info.startStr.valueOf(),
                    endDate: info.endStr.valueOf(),
                    employeeId: employeeId,
                },
                success: function (response) {
                    var events = [];
                    $.each(response.response, function (i, shift) {
                        events.push({
                            _id: shift.id,
                            id: shift.id,
                            title: `${shift.employee ? shift.employee.name : ''}`,
                            start: reformatDateForCalendar(shift.start_date),
                            end: reformatDateForCalendar(shift.end_date),
                            type: 'shift',
                            classNames: 'bg-primary text-white cursor-pointer ms-1 me-1',
                            backgroundColor: 'white',
                            shift_id: `${shift.id}`
                        });
                    });
                    successCallback(events);
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vardiyalar Alınırken Serviste Bir sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        },
    });

    calendar.render();

</script>
