<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/locales-all-min.js') }}"></script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

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

        },

        eventClick: function (info) {

        },

        datesSet: function (info) {
            getPermits();
            getOvertimes();
            getPayments();
        },

        events: [],
    });

    calendar.render();

    function getPermits() {
        var companyIds = SelectedCompanies.val();
        var startDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.start);
        var endDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.end);

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.permit.getDateBetweenAndCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                startDate: startDate,
                endDate: endDate,
            },
            success: function (response) {
                $.each(calendar.getEvents(), function (i, event) {
                    if (event._def.extendedProps.type === 'permit') {
                        event.remove();
                    }
                });
                calendar.addEventSource({
                    events: $.map(response.response, function (permit) {
                        return {
                            _id: permit.id,
                            id: permit.id,
                            title: `İzin${permit.employee ? ` - ${permit.employee.name}` : ``}`,
                            start: reformatDateForCalendar(permit.start_date),
                            end: reformatDateForCalendar(permit.end_date),
                            type: 'permit',
                            classNames: `bg-${permit.status.color} text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            permit_id: `${permit.id}`
                        };
                    }),
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('İzin Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getOvertimes() {
        var companyIds = SelectedCompanies.val();
        var startDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.start);
        var endDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.end);

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.overtime.getDateBetweenAndCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                startDate: startDate,
                endDate: endDate,
            },
            success: function (response) {
                $.each(calendar.getEvents(), function (i, event) {
                    if (event._def.extendedProps.type === 'overtime') {
                        event.remove();
                    }
                });
                calendar.addEventSource({
                    events: $.map(response.response, function (overtime) {
                        return {
                            _id: overtime.id,
                            id: overtime.id,
                            title: `Mesai${overtime.employee ? ` - ${overtime.employee.name}` : ``}`,
                            start: reformatDateForCalendar(overtime.start_date),
                            end: reformatDateForCalendar(overtime.end_date),
                            type: 'overtime',
                            classNames: `bg-${overtime.status.color} text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            overtime_id: `${overtime.id}`
                        };
                    }),
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Mesai Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getPayments() {
        var companyIds = SelectedCompanies.val();
        var startDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.start);
        var endDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.end);

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.payment.getDateBetweenAndCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                startDate: startDate,
                endDate: endDate,
            },
            success: function (response) {
                $.each(calendar.getEvents(), function (i, event) {
                    if (event._def.extendedProps.type === 'payment') {
                        event.remove();
                    }
                });
                calendar.addEventSource({
                    events: $.map(response.response, function (payment) {
                        return {
                            _id: payment.id,
                            id: payment.id,
                            title: `Ödeme${payment.employee ? ` - ${payment.employee.name}` : ``}`,
                            start: reformatDateForCalendar(payment.date),
                            end: reformatDateForCalendar(payment.date),
                            type: 'payment',
                            classNames: `bg-${payment.status.color} text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            payment_id: `${payment.id}`
                        };
                    }),
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ödeme Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }



</script>
