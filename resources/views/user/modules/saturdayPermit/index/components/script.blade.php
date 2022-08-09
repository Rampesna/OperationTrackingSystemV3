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

        events: function (info, successCallback) {

        },
    });

    calendar.render();

</script>
