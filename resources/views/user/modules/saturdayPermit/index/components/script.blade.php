<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/locales-all-min.js') }}"></script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var keywordFilter = $('#keyword');
    var jobDepartmentIdsFilter = $('#jobDepartmentIds');

    var cancelSaturdayPermitShiftGroupId = $('#cancel_saturday_permit_shift_group_id');
    var cancelSaturdayPermitReasonId = $('#cancel_saturday_permit_reason_id');

    var CancelSaturdayPermitButton = $('#CancelSaturdayPermitButton');
    var FilterButton = $('#FilterButton');

    function getShiftGroupsByCompanyIds() {
        var companyIds = SelectedCompanies.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.shiftGroup.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: 0,
                pageSize: 1000
            },
            success: function (response) {
                cancelSaturdayPermitShiftGroupId.empty();
                $.each(response.response.shiftGroups, function (i, shiftGroup) {
                    cancelSaturdayPermitShiftGroupId.append($('<option>', {
                        value: shiftGroup.id,
                        text: shiftGroup.name
                    }));
                });
                cancelSaturdayPermitShiftGroupId.trigger('change');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Vardiya Grupları Alınırken Serviste Bir Hata Oluştu. Lütfen Yazılım Ekibi İle İletişime Geçin!');
            }
        });
    }

    function getJobDepartments() {
        var companyIds = SelectedCompanies.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.jobDepartment.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: 0,
                pageSize: 1000
            },
            success: function (response) {
                jobDepartmentIdsFilter.attr('disabled', false);
                jobDepartmentIdsFilter.empty();
                $.each(response.response.jobDepartments, function (index, jobDepartment) {
                    jobDepartmentIdsFilter.append(`
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

    getShiftGroupsByCompanyIds();
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
        now: TODAY + "T{{ date('H:i:s') }}",

        initialView: "dayGridMonth",
        initialDate: TODAY,

        editable: false,
        dayMaxEvents: true,
        navLinks: true,

        dateClick: function (info) {

        },

        eventClick: function (info) {
            if (info.event._def.extendedProps.status === 'off') {
                $('#cancel_saturday_permit_id').val(info.event._def.extendedProps._id);
                cancelSaturdayPermitShiftGroupId.val('').trigger('change');
                cancelSaturdayPermitReasonId.val('').trigger('change');
                $('#CancelSaturdayPermitModal').modal('show');
            }
        },

        events: function (info, successCallback) {
            $('#loader').show();
            var companyIds = SelectedCompanies.val();
            var startDate = info.startStr.valueOf();
            var endDate = info.endStr.valueOf();
            var keyword = keywordFilter.val();
            var jobDepartmentIds = jobDepartmentIdsFilter.val();
            $.ajax({
                url: '{{ route('user.api.saturdayPermit.getDateBetween') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyIds: companyIds,
                    startDate: startDate,
                    endDate: endDate,
                    keyword: keyword,
                    jobDepartmentIds: jobDepartmentIds,
                },
                success: function (response) {
                    var events = [];
                    $.each(response.response, function (i, saturdayPermit) {
                        events.push({
                            _id: saturdayPermit.id,
                            id: saturdayPermit.id,
                            title: `${saturdayPermit.employee ? saturdayPermit.employee.name : ''} (${saturdayPermit.status === 'on' ? `Çalışıyor` : `İzinli`})`,
                            start: reformatDateForCalendar(saturdayPermit.date),
                            end: reformatDateForCalendar(saturdayPermit.date),
                            status: saturdayPermit.status,
                            type: 'saturdayPermit',
                            classNames: `bg-${saturdayPermit.status === 'on' ? `warning` : `success`} text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            saturday_permit_id: `${saturdayPermit.id}`
                        });
                    });
                    successCallback(events);
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Cumartesi İzinleri Alınırken Serviste Bir sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        },
    });

    calendar.render();

    CancelSaturdayPermitButton.click(function () {
        var id = $('#cancel_saturday_permit_id').val();
        var shiftGroupId = cancelSaturdayPermitShiftGroupId.val();
        var cancelReasonId = cancelSaturdayPermitReasonId.val();

        if (!shiftGroupId) {
            toastr.warning('Lütfen Vardiya Grubunu Seçiniz!');
        } else if (!cancelReasonId) {
            toastr.warning('Lütfen İzin İptal Sebebini Seçiniz!');
        } else {
            CancelSaturdayPermitButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.saturdayPermit.cancel') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    shiftGroupId: shiftGroupId,
                    cancelReasonId: cancelReasonId
                },
                success: function () {
                    toastr.success('Cumartesi İzni Başarıyla İptal Edildi!');
                    $('#CancelSaturdayPermitModal').modal('hide');
                    calendar.refetchEvents();
                    CancelSaturdayPermitButton.attr('disabled', false).html('İptal Et');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Cumartesi İzni İptal Edilirken Serviste Bir Sorun Oluştu!');
                    CancelSaturdayPermitButton.attr('disabled', false).html('İptal Et');
                }
            });
        }
    });

    FilterButton.click(function () {
        calendar.refetchEvents();
    });

    keywordFilter.on('keypress', function (e) {
        if (parseInt(e.which) === 13) {
            calendar.refetchEvents();
        }
    });

</script>
