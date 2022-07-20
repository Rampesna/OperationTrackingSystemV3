<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/locales-all-min.js') }}"></script>

<script>

    var allShiftGroups = [];

    var keywordFilter = $('#keyword');
    var jobDepartmentFilter = $('#jobDepartment');
    var shiftGroupFilter = $('#shiftGroup');

    var robotCompanyId = $('#robot_company_id');
    var setStaffParameterCompanyIds = $('#set_staff_parameter_company_ids');
    var deleteMultipleCompanyIds = $('#delete_multiple_company_ids');
    var updateShiftShiftGroupId = $('#update_shift_shift_group_id');

    var FilterButton = $('#FilterButton');
    var RobotButton = $('#RobotButton');
    var SetStaffParameterButton = $('#SetStaffParameterButton');
    var DeleteMultipleButton = $('#DeleteMultipleButton');

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
                jobDepartmentFilter.attr('disabled', false);
                jobDepartmentFilter.empty();
                $.each(response.response.jobDepartments, function (index, jobDepartment) {
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

    function getShiftGroups() {
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
                allShiftGroups = response.response.shiftGroups;
                shiftGroupFilter.attr('disabled', false);
                shiftGroupFilter.empty();
                $.each(response.response.shiftGroups, function (index, shiftGroup) {
                    shiftGroupFilter.append(`
                    <option value="${shiftGroup.id}">${shiftGroup.name}</option>
                    `);
                    updateShiftShiftGroupId.append(`
                    <option value="${shiftGroup.id}">${shiftGroup.name}</option>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Vardiya Grupları Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getCompanies() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.getCompanies') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                robotCompanyId.empty();
                setStaffParameterCompanyIds.empty();
                deleteMultipleCompanyIds.empty();
                $.each(response.response, function (i, company) {
                    robotCompanyId.append(`<option value="${company.id}">${company.title}</option>`);
                    setStaffParameterCompanyIds.append(`<option value="${company.id}">${company.title}</option>`);
                    deleteMultipleCompanyIds.append(`<option value="${company.id}">${company.title}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Firma Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function transactions() {
        $('#TransactionsModal').modal('show');
    }

    function robot() {
        $('#TransactionsModal').modal('hide');
        robotCompanyId.val('');
        $('#robot_month').val('');
        $('#RobotModal').modal('show');
    }

    function setStaffParameter() {
        $('#TransactionsModal').modal('hide');
        setStaffParameterCompanyIds.val([]);
        $('#set_staff_parameter_month').val('');
        $('#SetStaffParameterModal').modal('show');
    }

    function deleteMultiple() {
        $('#TransactionsModal').modal('hide');
        deleteMultipleCompanyIds.val([]);
        $('#delete_multiple_month').val('');
        $('#DeleteMultipleModal').modal('show');
    }

    function swapShiftEmployee() {
        $('#ShowModal').modal('hide');
        $('#SwapShiftEmployeeModal').modal('show');
    }

    function updateShift() {
        var shiftId = $('#update_shift_id').val();
        $('#ShowModal').modal('hide');
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.operation.getStaffParameterEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                shiftId: shiftId,
            },
            success: function (response) {
                $('#update_shift_food_break_start').val(response.response.yemekBaslangicSaatiStr.split(' ')[1]);
                $('#update_shift_food_break_end').val(response.response.yemekBitisSaatiStr.split(' ')[1]);
                $('#update_shift_get_break_while_food_time').val(response.response.yemekMolasindaIhtiyacMolasi);
                $('#update_shift_get_food_break_without_food_time').val(response.response.yemekMolasiDisindaYemekMolasi);
                $('#update_shift_single_break_duration').val(response.response.birMolaHakkiDakikasi);
                $('#update_shift_get_first_break_after_shift_start').val(response.response.vardiyaBasiIlkMolaHakkiDakikasi);
                $('#update_shift_get_last_break_before_shift_end').val(response.response.vardiyaSonuMolaYasagiDakikasi);
                $('#update_shift_get_break_after_last_break').val(response.response.sonMoladanSonraMolaMusadesiDakikasi);
                $('#update_shift_daily_food_break_amount').val(response.response.gunlukYemekMolasiHakkiSayisi);
                $('#update_shift_daily_break_duration').val(response.response.gunlukToplamMolaDakikasi);
                $('#update_shift_daily_food_break_duration').val(response.response.gunlukYemekMolasiDakikasi);
                $('#update_shift_daily_break_break_duration').val(response.response.gunlukIhtiyacMolasiDakikasi);
                $('#update_shift_momentary_food_break_duration').val(response.response.anlikYemekMolasiDakikasi);
                $('#update_shift_momentary_break_break_duration').val(response.response.anlikIhtiyacMolasiDakikasi);
                $('#update_shift_suspend_break_using').val(response.response.molaKullanimKisitlamasiVarMi);
                $('#UpdateShiftModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Vardiya Bilgileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteShift() {
        $('#ShowModal').modal('hide');
        $('#DeleteShiftModal').modal('show');
    }

    getJobDepartments();
    getShiftGroups();
    getCompanies();

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
            console.log(info);
            toastr.info(info.dateStr);
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
                    $('#update_shift_id').val(response.response.id);
                    $('#update_shift_employee_name_span').text(`${response.response.employee.name} - Vardiya Güncelle`);
                    updateShiftShiftGroupId.val(response.response.shift_group_id).trigger('change');
                    $('#update_shift_date').val(response.response.start_date);
                    $('#update_shift_start_date').val(reformatDatetimeForInput(response.response.start_date));
                    $('#update_shift_end_date').val(reformatDatetimeForInput(response.response.end_date));
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
            var companyIds = SelectedCompanies.val();
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
                    jobDepartmentIds: jobDepartmentFilter.val(),
                    shiftGroupIds: shiftGroupFilter.val(),
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

    keywordFilter.on('keypress', function (e) {
        if (e.which === 13) {
            FilterButton.click();
        }
    });

    FilterButton.click(function () {
        calendar.refetchEvents();
    });

    RobotButton.click(function () {
        var companyId = robotCompanyId.val();
        var month = $('#robot_month').val();

        if (!companyId) {
            toastr.warning('Firma Seçimi Zorunludur!');
        } else if (!month) {
            toastr.warning('Ay Seçimi Zorunludur!');
        } else {
            $('#loader').show();
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.shift.robot') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyId: parseInt(companyId),
                    month: month
                },
                success: function () {
                    $('#loader').hide();
                    $('#RobotModal').modal('hide');
                    toastr.success('Vardiyalar Oluşturuldu!');
                    calendar.refetchEvents();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vardiyalar Oluşturulurken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    SetStaffParameterButton.click(function () {
        var companyIds = setStaffParameterCompanyIds.val();
        var startDate = $('#set_staff_parameter_start_date').val();
        var endDate = $('#set_staff_parameter_end_date').val();

        if (companyIds.length === 0) {
            toastr.warning('En Az Bir Firma Seçmelisiniz!');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Zorunludur!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Zorunludur!');
        } else {
            $('#loader').show();
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.shift.getByCompanyIds') }}',
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
                    var staffParameters = [];
                    $.each(response.response, function (i, shift) {
                        staffParameters.push({
                            vardiyaId: shift.id,
                            kullanicilarId: shift.employee.guid,
                            tarih: reformatDatetimeTo_YYYY_MM_DD(shift.start_date),
                            yemekBaslangicSaati: `${reformatDatetimeTo_YYYY_MM_DD(shift.start_date)} ${shift.shift_group.food_break_start}`,
                            yemekBitisSaati: `${reformatDatetimeTo_YYYY_MM_DD(shift.end_date)} ${shift.shift_group.food_break_end}`,
                            yemekMolasindaIhtiyacMolasi: shift.shift_group.get_break_while_food_time,
                            yemekMolasiDisindaYemekMolasi: shift.shift_group.get_food_break_without_food_time,
                            birMolaHakkiDakikasi: shift.shift_group.single_break_duration,
                            vardiyaBasiIlkMolaHakkiDakikasi: shift.shift_group.get_first_break_after_shift_start,
                            vardiyaSonuMolaYasagiDakikasi: shift.shift_group.get_last_break_before_shift_end,
                            sonMoladanSonraMolaMusadesiDakikasi: shift.shift_group.get_break_after_last_break,
                            gunlukYemekMolasiHakkiSayisi: shift.shift_group.daily_food_break_amount,
                            gunlukToplamMolaDakikasi: getWeekDayOfDate(reformatDatetimeTo_YYYY_MM_DD(shift.start_date)) === 5 ? shift.shift_group.daily_break_duration + shift.shift_group.friday_additional_break_duration : shift.shift_group.daily_break_duration,
                            gunlukYemekMolasiDakikasi: shift.shift_group.daily_food_break_duration,
                            gunlukIhtiyacMolasiDakikasi: getWeekDayOfDate(reformatDatetimeTo_YYYY_MM_DD(shift.start_date)) === 5 ? shift.shift_group.daily_break_break_duration + shift.shift_group.friday_additional_break_duration : shift.shift_group.daily_break_break_duration,
                            anlikYemekMolasiDakikasi: shift.shift_group.momentary_food_break_duration,
                            anlikIhtiyacMolasiDakikasi: shift.shift_group.momentary_break_break_duration,
                            molaKullanimKisitlamasiVarMi: shift.shift_group.suspend_break_using,
                        });
                    });
                    $.ajax({
                        type: 'post',
                        url: '{{ route('user.api.operationApi.operation.setStaffParameter') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            staffParameters: staffParameters,
                        },
                        success: function () {
                            toastr.success('Vardiyalar Başarıyla Aktarıldı.');
                            $('#SetStaffParameterModal').modal('hide');
                            $('#loader').hide();
                        },
                        error: function (error) {
                            console.log(error);
                            toastr.error('Vardiyalar Aktarılırken Serviste Bir Sorun Oluştu!');
                            $('#loader').hide();
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vardiyalar Alınırken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteMultipleButton.click(function () {
        var companyIds = deleteMultipleCompanyIds.val();
        var startDate = $('#delete_multiple_start_date').val();
        var endDate = $('#delete_multiple_end_date').val();

        if (companyIds.length === 0) {
            toastr.warning('En Az Bir Firma Seçmelisiniz!');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Zorunludur!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Zorunludur!');
        } else {
            $('#loader').show();
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.shift.getByCompanyIds') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyIds: companyIds,
                    startDate: startDate + ' 00:00:00',
                    endDate: endDate + ' 23:59:59',
                },
                success: function (response) {
                    var shiftIds = [];
                    $.each(response.response, function (i, shift) {
                        shiftIds.push(parseInt(shift.id));
                    });
                    $.ajax({
                        type: 'delete',
                        url: '{{ route('user.api.shift.deleteByIds') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            shiftIds: shiftIds,
                        },
                        success: function () {
                            toastr.success('Vardiyalar Başarıyla Silindi.');
                            $('#DeleteMultipleModal').modal('hide');
                            calendar.refetchEvents();
                        },
                        error: function (error) {
                            console.log(error);
                            toastr.error('Vardiyalar Silinirken Serviste Bir Sorun Oluştu!');
                            $('#loader').hide();
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vardiyalar Alınırken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    updateShiftShiftGroupId.change(function () {
        var shiftGroup = allShiftGroups.find(shiftGroup => shiftGroup.id === parseInt(updateShiftShiftGroupId.val()));
        var selectedShiftStartDateForJquery = new Date($('#update_shift_date').val());
        var date = reformatDatetimeTo_YYYY_MM_DD(selectedShiftStartDateForJquery);
        var startTimeVariable = `day${selectedShiftStartDateForJquery.getDay()}_start_time`;
        var endTimeVariable = `day${selectedShiftStartDateForJquery.getDay()}_end_time`;

        $('#update_shift_start_date').val(`${date}T${shiftGroup[startTimeVariable]}`);
        $('#update_shift_end_date').val(`${date}T${shiftGroup[endTimeVariable]}`);
        $('#update_shift_food_break_start').val(shiftGroup.food_break_start);
        $('#update_shift_food_break_end').val(shiftGroup.food_break_end);
        $('#update_shift_get_break_while_food_time').val(shiftGroup.get_break_while_food_time);
        $('#update_shift_get_food_break_without_food_time').val(shiftGroup.get_food_break_without_food_time);
        $('#update_shift_single_break_duration').val(shiftGroup.single_break_duration);
        $('#update_shift_get_first_break_after_shift_start').val(shiftGroup.get_first_break_after_shift_start);
        $('#update_shift_get_last_break_before_shift_end').val(shiftGroup.get_last_break_before_shift_end);
        $('#update_shift_get_break_after_last_break').val(shiftGroup.get_break_after_last_break);
        $('#update_shift_daily_food_break_amount').val(shiftGroup.daily_food_break_amount);
        $('#update_shift_daily_break_duration').val(shiftGroup.daily_break_duration);
        $('#update_shift_daily_food_break_duration').val(shiftGroup.daily_food_break_duration);
        $('#update_shift_daily_break_break_duration').val(shiftGroup.daily_break_break_duration);
        $('#update_shift_momentary_food_break_duration').val(shiftGroup.momentary_food_break_duration);
        $('#update_shift_momentary_break_break_duration').val(shiftGroup.momentary_break_break_duration);
        $('#update_shift_suspend_break_using').val(shiftGroup.suspend_break_using);
    });

    SelectedCompanies.change(function () {
        getJobDepartments();
        calendar.refetchEvents();
    });

    $('body').on('contextmenu', function () {
        transactions();
        return false;
    });

</script>
