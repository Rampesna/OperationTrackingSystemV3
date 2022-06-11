<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/locales-all-min.js') }}"></script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var FilterButton = $('#FilterButton');
    var keywordFilter = $('#keyword');
    var jobDepartmentFilter = $('#jobDepartment');

    function getJobDepartments() {
        var companyId = SelectedCompany.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.jobDepartment.getByCompanyId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyId: companyId
            },
            success: function (response) {
                jobDepartmentFilter.empty();
                $.each(response.response, function (index, jobDepartment) {
                    jobDepartmentFilter.append(`
                    <option value="${jobDepartment.id}">${jobDepartment.name}</option>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Departman Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getJobDepartments();

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
        now: TODAY + "T09:25:00",

        initialView: "dayGridMonth",
        initialDate: TODAY,

        editable: false,
        dayMaxEvents: true,
        navLinks: true,

        dateClick: function (info) {
            console.log(info);
            toastr.info(info.dateStr);
        },

        eventClick: function (info) {
            console.log(info);
            toastr.info(info.event.title);
        },

        events: function (info, successCallback, failureCallback) {
            var companyIds = parseInt(SelectedCompany.val()) === 1 || parseInt(SelectedCompany.val()) === 2 ? [1, 2] : [parseInt(SelectedCompany.val())];
            $.ajax({
                url: '{{ route('user.api.shift.getByCompanyIds') }}',
                dataType: 'json',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    startDate: info.startStr.valueOf(),
                    endDate: info.endStr.valueOf(),
                    companyIds: companyIds,
                    keyword: keywordFilter.val(),
                    jobDepartmentIds: jobDepartmentFilter.val()
                },
                success: function (response) {

                    console.log(response);

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
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vardiyalar Alınırken Serviste Bir sorun Oluştu!');
                }
            });
        },
    });

    calendar.render();

    keywordFilter.on('keypress', function (e) {
        if (e.which === 13) {
            FilterButton.click();
        }
    });

    FilterButton.click(function () {
        calendar.refetchEvents();
    });

</script>
