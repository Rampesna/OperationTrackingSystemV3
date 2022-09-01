<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/locales-all-min.js') }}"></script>

<script>

    var createShiftPermission = `{{ checkUserPermission(83, $userPermissions) ? 'true' : 'false' }}`;

    var allShiftGroups = [];

    var keywordFilter = $('#keyword');
    var jobDepartmentFilter = $('#jobDepartment');
    var shiftGroupFilter = $('#shiftGroup');

    var robotCompanyId = $('#robot_company_id');
    var setStaffParameterCompanyIds = $('#set_staff_parameter_company_ids');
    var deleteMultipleCompanyIds = $('#delete_multiple_company_ids');
    var createShiftShiftGroupId = $('#create_shift_shift_group_id');
    var updateShiftShiftGroupId = $('#update_shift_shift_group_id');
    var createShiftEmployees = $('#create_shift_employees');
    var updateShiftBatchEmployeeIds = $('#update_shift_batch_employee_ids');
    var swapShiftShiftId = $('#swap_shift_shift_id');

    var FilterButton = $('#FilterButton');
    var RobotButton = $('#RobotButton');
    var SetStaffParameterButton = $('#SetStaffParameterButton');
    var CreateShiftButton = $('#CreateShiftButton');
    var UpdateShiftButton = $('#UpdateShiftButton');
    var UpdateShiftBatchButton = $('#UpdateShiftBatchButton');
    var DeleteShiftButton = $('#DeleteShiftButton');
    var DeleteMultipleButton = $('#DeleteMultipleButton');
    var SwapShiftButton = $('#SwapShiftButton');

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
                    createShiftShiftGroupId.append(`
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

    function getEmployees() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: SelectedCompanies.val(),
                pageIndex: 0,
                pageSize: 1000,
                leave: 0
            },
            success: function (response) {
                createShiftEmployees.empty();
                updateShiftBatchEmployeeIds.empty();
                $.each(response.response.employees, function (i, employee) {
                    createShiftEmployees.append(`
                    <option value="${employee.id}" data-guid="${employee.guid}">${employee.name}</option>
                    `);
                    updateShiftBatchEmployeeIds.append(`<option value="${employee.id}">${employee.name}</option>`);
                });
                updateShiftBatchEmployeeIds.trigger('change');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personeller Alınırken Serviste Bir Sorun Oluştu!');
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

    function updateShiftBatch() {
        $('#TransactionsModal').modal('hide');
        updateShiftBatchEmployeeIds.val([]).trigger('change');
        $('#update_shift_batch_date').val('');
        $('#update_shift_batch_start_time').val('');
        $('#update_shift_batch_end_time').val('');
        $('#UpdateShiftBatchModal').modal('show');
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

    function createShift() {
        createShiftShiftGroupId.val('');
        $('#create_shift_start_date').val('');
        $('#create_shift_end_date').val('');
        $('#create_shift_food_break_start').val('');
        $('#create_shift_food_break_end').val('');
        $('#create_shift_get_break_while_food_time').val('');
        $('#create_shift_get_food_break_without_food_time').val('');
        $('#create_shift_single_break_duration').val('');
        $('#create_shift_get_first_break_after_shift_start').val('');
        $('#create_shift_get_last_break_before_shift_end').val('');
        $('#create_shift_get_break_after_last_break').val('');
        $('#create_shift_daily_food_break_amount').val('');
        $('#create_shift_daily_break_duration').val('');
        $('#create_shift_daily_food_break_duration').val('');
        $('#create_shift_daily_break_break_duration').val('');
        $('#create_shift_momentary_food_break_duration').val('');
        $('#create_shift_momentary_break_break_duration').val('');
        $('#create_shift_friday_additional_break_duration').val('');
        $('#create_shift_suspend_break_using').val('');
        $('#CreateShiftModal').modal('show');
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
                var shiftDate = $('#update_shift_date').val();
                $('#update_shift_food_break_start').val(response.response.yemekBaslangicSaatiStr.split(' ')[1]);
                $('#update_shift_food_break_end').val(response.response.yemekBitisSaatiStr.split(' ')[1]);
                $('#update_shift_get_break_while_food_time').val(response.response.yemekMolasindaIhtiyacMolasi);
                $('#update_shift_get_food_break_without_food_time').val(response.response.yemekMolasiDisindaYemekMolasi);
                $('#update_shift_single_break_duration').val(response.response.birMolaHakkiDakikasi);
                $('#update_shift_get_first_break_after_shift_start').val(response.response.vardiyaBasiIlkMolaHakkiDakikasi);
                $('#update_shift_get_last_break_before_shift_end').val(response.response.vardiyaSonuMolaYasagiDakikasi);
                $('#update_shift_get_break_after_last_break').val(response.response.sonMoladanSonraMolaMusadesiDakikasi);
                $('#update_shift_daily_food_break_amount').val(response.response.gunlukYemekMolasiHakkiSayisi);
                $('#update_shift_daily_break_duration').val(getWeekDayOfDate(shiftDate) === 5 ? parseInt(response.response.gunlukToplamMolaDakikasi) - parseInt(allShiftGroups.find(shiftGroup => parseInt(shiftGroup.id) === parseInt(updateShiftShiftGroupId.val())).friday_additional_break_duration) : response.response.gunlukToplamMolaDakikasi);
                $('#update_shift_daily_food_break_duration').val(response.response.gunlukYemekMolasiDakikasi);
                $('#update_shift_daily_break_break_duration').val(getWeekDayOfDate(shiftDate) === 5 ? parseInt(response.response.gunlukIhtiyacMolasiDakikasi) - parseInt(allShiftGroups.find(shiftGroup => parseInt(shiftGroup.id) === parseInt(updateShiftShiftGroupId.val())).friday_additional_break_duration) : response.response.gunlukIhtiyacMolasiDakikasi);
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

    function swapShift() {
        var shiftId = $('#swap_shift_id').val();
        var companyIds = SelectedCompanies.val();
        var date = $('#swap_shift_date').val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.shift.getByDateAndCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                date: date
            },
            success: function (response) {
                swapShiftShiftId.empty();
                $.each(response.response, function (i, shift) {
                    if (parseInt(shiftId) !== parseInt(shift.id)) {
                        swapShiftShiftId.append($('<option>', {
                            value: shift.id,
                            text: `${shift.employee.name} - ${moment(new Date(shift.start_date)).format('HH:mm')} - ${moment(new Date(shift.end_date)).format('HH:mm')}`
                        }));
                    }
                });
                swapShiftShiftId.val('').trigger('change');
                $('#ShowModal').modal('hide');
                $('#SwapShiftModal').modal('show');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Seçilen Tarihteki Diğer Vardiyalar Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function deleteShift() {
        $('#delete_shift_id').val($('#update_shift_id').val());
        $('#DeleteShiftModal').modal('show');
    }

    getJobDepartments();
    getShiftGroups();
    getEmployees();
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
            if (createShiftPermission === 'true') {
                $('#create_shift_clicked_date').val(info.dateStr);
                createShift();
            }
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
                    $('#update_shift_employee_id').val(response.response.employee_id);
                    $('#update_shift_employee_name_span').text(`${response.response.employee.name} - Vardiya Güncelle`);
                    updateShiftShiftGroupId.val(response.response.shift_group_id).trigger('change');
                    $('#update_shift_date').val(response.response.start_date);
                    $('#update_shift_start_date').val(reformatDatetimeForInput(response.response.start_date));
                    $('#update_shift_end_date').val(reformatDatetimeForInput(response.response.end_date));
                    $('#update_shift_friday_additional_break_duration').val(allShiftGroups.find(shiftGroup => parseInt(shiftGroup.id) === parseInt(response.response.shift_group_id)).friday_additional_break_duration);

                    $('#swap_shift_id').val(response.response.id);
                    $('#swap_shift_date').val(reformatDatetimeTo_YYYY_MM_DD(response.response.start_date));

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
                            classNames: `bg-${parseInt(shift.shift_group_id) === 1 ? `primary` : `danger`} text-white cursor-pointer ms-1 me-1`,
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
                success: function (response) {
                    console.log(response);
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

    SwapShiftButton.click(function () {
        var shiftId = $('#swap_shift_id').val();
        var swapShiftId = swapShiftShiftId.val();

        if (!swapShiftId) {
            toastr.warning('Değiştirilecek Vardiyayı Seçmelisiniz!');
        } else {
            SwapShiftButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.shift.swapShift') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    shiftId: shiftId,
                    swapShiftId: swapShiftId,
                },
                success: function (response) {
                    toastr.success('Vardiyalar Başarıyla Değiştirildi.');
                    $('#SwapShiftModal').modal('hide');
                    SwapShiftButton.attr('disabled', false).html('Değiştir');
                    calendar.refetchEvents();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vardiyalar Değiştirilirken Serviste Bir Sorun Oluştu!');
                    SwapShiftButton.attr('disabled', false).html('Değiştir');
                }
            });
        }
    });

    createShiftShiftGroupId.change(function () {
        var shiftGroup = allShiftGroups.find(shiftGroup => shiftGroup.id === parseInt(createShiftShiftGroupId.val()));
        var selectedShiftStartDateForJquery = new Date($('#create_shift_clicked_date').val());
        var date = reformatDatetimeTo_YYYY_MM_DD(selectedShiftStartDateForJquery);
        var startTimeVariable = `day${selectedShiftStartDateForJquery.getDay()}_start_time`;
        var endTimeVariable = `day${selectedShiftStartDateForJquery.getDay()}_end_time`;

        $('#create_shift_start_date').val(`${date}T${shiftGroup[startTimeVariable]}`);
        $('#create_shift_end_date').val(`${date}T${shiftGroup[endTimeVariable]}`);
        $('#create_shift_food_break_start').val(shiftGroup.food_break_start);
        $('#create_shift_food_break_end').val(shiftGroup.food_break_end);
        $('#create_shift_get_break_while_food_time').val(shiftGroup.get_break_while_food_time);
        $('#create_shift_get_food_break_without_food_time').val(shiftGroup.get_food_break_without_food_time);
        $('#create_shift_single_break_duration').val(shiftGroup.single_break_duration);
        $('#create_shift_get_first_break_after_shift_start').val(shiftGroup.get_first_break_after_shift_start);
        $('#create_shift_get_last_break_before_shift_end').val(shiftGroup.get_last_break_before_shift_end);
        $('#create_shift_get_break_after_last_break').val(shiftGroup.get_break_after_last_break);
        $('#create_shift_daily_food_break_amount').val(shiftGroup.daily_food_break_amount);
        $('#create_shift_daily_break_duration').val(shiftGroup.daily_break_duration);
        $('#create_shift_daily_food_break_duration').val(shiftGroup.daily_food_break_duration);
        $('#create_shift_daily_break_break_duration').val(shiftGroup.daily_break_break_duration);
        $('#create_shift_momentary_food_break_duration').val(shiftGroup.momentary_food_break_duration);
        $('#create_shift_momentary_break_break_duration').val(shiftGroup.momentary_break_break_duration);
        $('#create_shift_friday_additional_break_duration').val(shiftGroup.friday_additional_break_duration);
        $('#create_shift_suspend_break_using').val(shiftGroup.suspend_break_using);
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
        $('#update_shift_friday_additional_break_duration').val(shiftGroup.friday_additional_break_duration);
        $('#update_shift_suspend_break_using').val(shiftGroup.suspend_break_using);
    });

    CreateShiftButton.click(function () {
        var shifts = [];
        var staffParameters = [];
        var shiftGroupId = createShiftShiftGroupId.val();
        var startDate = $('#create_shift_start_date').val();
        var endDate = $('#create_shift_end_date').val();
        var foodBreakStart = $('#create_shift_food_break_start').val();
        var foodBreakEnd = $('#create_shift_food_break_end').val();
        var getBreakWhileFoodTime = $('#create_shift_get_break_while_food_time').val();
        var getFoodBreakWithoutFoodTime = $('#create_shift_get_food_break_without_food_time').val();
        var singleBreakDuration = $('#create_shift_single_break_duration').val();
        var getFirstBreakAfterShiftStart = $('#create_shift_get_first_break_after_shift_start').val();
        var getLastBreakBeforeShiftEnd = $('#create_shift_get_last_break_before_shift_end').val();
        var getBreakAfterLastBreak = $('#create_shift_get_break_after_last_break').val();
        var dailyFoodBreakAmount = $('#create_shift_daily_food_break_amount').val();
        var dailyBreakDuration = $('#create_shift_daily_break_duration').val();
        var dailyFoodBreakDuration = $('#create_shift_daily_food_break_duration').val();
        var dailyBreakBreakDuration = $('#create_shift_daily_break_break_duration').val();
        var momentaryFoodBreakDuration = $('#create_shift_momentary_food_break_duration').val();
        var momentaryBreakBreakDuration = $('#create_shift_momentary_break_break_duration').val();
        var fridayAdditionalBreakDuration = $('#create_shift_friday_additional_break_duration').val();
        var suspendBreakUsing = $('#create_shift_suspend_break_using').val();

        if (createShiftEmployees.val().length === 0) {
            toastr.warning('Hiç Personel Seçmediniz!');
        } else if (!shiftGroupId) {
            toastr.warning('Vardiya Grubu Seçmedinid!');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Girmediniz!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Girmediniz!');
        } else if (!foodBreakStart) {
            toastr.warning('Yemek Molası Başlangıç Saati Zorunludur!');
        } else if (!foodBreakEnd) {
            toastr.warning('Yemek Molası Bitiş Saati Zorunludur!');
        } else if (!getBreakWhileFoodTime) {
            toastr.warning('Yemek Molası Saatlerinde İhtiyaç Molası Alabilmek Seçilmedi!');
        } else if (!getFoodBreakWithoutFoodTime) {
            toastr.warning('Yemek Saatleri Dışında Yemek Molası Alabilmek Seçilmedi!');
        } else if (!singleBreakDuration) {
            toastr.warning('Kaç Dakikada Bir Mola Hakkı Kazanılır Girilmedi!');
        } else if (!getFirstBreakAfterShiftStart) {
            toastr.warning('İlk Mola Vardiya Başlangıcından Kaç Dakika Sonra Kullanılabilir Girilmedi!');
        } else if (!getLastBreakBeforeShiftEnd) {
            toastr.warning('Vardiya Bitimine Kaç Dakika Kala Mola Alınamaz Girilmedi!');
        } else if (!getBreakAfterLastBreak) {
            toastr.warning('Son Moladan Kaç Dakika Sonra Tekrar Mola Alınabilir Girilmedi!');
        } else if (!dailyFoodBreakAmount) {
            toastr.warning('Günlük Yemek Molası Hakkı Sayısı Girilmedi!');
        } else if (!dailyBreakDuration) {
            toastr.warning('Günlük Toplam Mola Süresi Girilmedi!');
        } else if (!dailyFoodBreakDuration) {
            toastr.warning('Günlük Yemek Molası Süresi Girilmedi!');
        } else if (!dailyBreakBreakDuration) {
            toastr.warning('Günlük İhtiyaç Molası Süresi Girilmedi!');
        } else if (!momentaryFoodBreakDuration) {
            toastr.warning('Anlık Yemek Molası Süresi Girilmedi!');
        } else if (!momentaryBreakBreakDuration) {
            toastr.warning('Anlık İhtiyaç Molası Süresi Girilmedi!');
        } else if (!fridayAdditionalBreakDuration) {
            toastr.warning('Cuma Günü Ek Mola Süresi Girilmedi!');
        } else if (!suspendBreakUsing) {
            toastr.warning('Mola Kullanım Kuralları Aktif Mi Seçilmedi!');
        } else {
            $('#loader').show();
            $('#CreateShiftModal').modal('hide');
            var shiftDate = reformatDatetimeTo_YYYY_MM_DD(startDate);
            $.each(createShiftEmployees.find(':selected'), function () {
                shifts.push({
                    employeeId: $(this).val(),
                    shiftGroupId: shiftGroupId,
                    startDate: startDate,
                    endDate: endDate,
                });
                staffParameters.push({
                    vardiyaId: null,
                    kullanicilarId: $(this).data('guid'),
                    tarih: shiftDate,
                    yemekBaslangicSaati: `${shiftDate} ${foodBreakStart}`,
                    yemekBitisSaati: `${shiftDate} ${foodBreakEnd}`,
                    yemekMolasindaIhtiyacMolasi: getBreakWhileFoodTime,
                    yemekMolasiDisindaYemekMolasi: getFoodBreakWithoutFoodTime,
                    birMolaHakkiDakikasi: singleBreakDuration,
                    vardiyaBasiIlkMolaHakkiDakikasi: getFirstBreakAfterShiftStart,
                    vardiyaSonuMolaYasagiDakikasi: getLastBreakBeforeShiftEnd,
                    sonMoladanSonraMolaMusadesiDakikasi: getBreakAfterLastBreak,
                    gunlukYemekMolasiHakkiSayisi: dailyFoodBreakAmount,
                    gunlukToplamMolaDakikasi: getWeekDayOfDate(shiftDate) === 5 ? parseInt(dailyBreakDuration) + parseInt(fridayAdditionalBreakDuration) : dailyBreakDuration,
                    gunlukYemekMolasiDakikasi: dailyFoodBreakDuration,
                    gunlukIhtiyacMolasiDakikasi: getWeekDayOfDate(shiftDate) === 5 ? parseInt(dailyBreakBreakDuration) + parseInt(fridayAdditionalBreakDuration) : dailyBreakBreakDuration,
                    anlikYemekMolasiDakikasi: momentaryFoodBreakDuration,
                    anlikIhtiyacMolasiDakikasi: momentaryBreakBreakDuration,
                    molaKullanimKisitlamasiVarMi: suspendBreakUsing,
                });
            });
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.shift.createBatch') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    shifts: shifts,
                },
                success: function () {
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
                            toastr.success('Vardiyalar Başarıyla Oluşturuldu!');
                            calendar.refetchEvents();
                        },
                        error: function (error) {
                            console.log(error);
                            toastr.error('Oluşturulan Vardiyalar OTS Aktarılırken Serviste Hata Oluştu!');
                            $('#loader').hide();
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vardiyalar Oluşturulurken Serviste Hata Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateShiftButton.click(function () {
        var id = $('#update_shift_id').val();
        var shiftGroupId = updateShiftShiftGroupId.val();
        var startDate = $('#update_shift_start_date').val();
        var endDate = $('#update_shift_end_date').val();
        var foodBreakStart = $('#update_shift_food_break_start').val();
        var foodBreakEnd = $('#update_shift_food_break_end').val();
        var getBreakWhileFoodTime = $('#update_shift_get_break_while_food_time').val();
        var getFoodBreakWithoutFoodTime = $('#update_shift_get_food_break_without_food_time').val();
        var singleBreakDuration = $('#update_shift_single_break_duration').val();
        var getFirstBreakAfterShiftStart = $('#update_shift_get_first_break_after_shift_start').val();
        var getLastBreakBeforeShiftEnd = $('#update_shift_get_last_break_before_shift_end').val();
        var getBreakAfterLastBreak = $('#update_shift_get_break_after_last_break').val();
        var dailyFoodBreakAmount = $('#update_shift_daily_food_break_amount').val();
        var dailyBreakDuration = $('#update_shift_daily_break_duration').val();
        var dailyFoodBreakDuration = $('#update_shift_daily_food_break_duration').val();
        var dailyBreakBreakDuration = $('#update_shift_daily_break_break_duration').val();
        var momentaryFoodBreakDuration = $('#update_shift_momentary_food_break_duration').val();
        var momentaryBreakBreakDuration = $('#update_shift_momentary_break_break_duration').val();
        var fridayAdditionalBreakDuration = $('#update_shift_friday_additional_break_duration').val();
        var suspendBreakUsing = $('#update_shift_suspend_break_using').val();

        if (!shiftGroupId) {
            toastr.warning('Vardiya Grubu Seçmediniz!');
        } else if (!startDate) {
            toastr.warning('Vardiya Başlangıcı Zorunludur!');
        } else if (!endDate) {
            toastr.warning('Vardiya Bitişi Zorunludur!');
        } else if (!foodBreakStart) {
            toastr.warning('Yemek Molası Başlangıç Saati Zorunludur!');
        } else if (!foodBreakEnd) {
            toastr.warning('Yemek Molası Bitiş Saati Zorunludur!');
        } else if (!getBreakWhileFoodTime) {
            toastr.warning('Yemek Molası Saatlerinde İhtiyaç Molası Alabilmek Seçilmedi!');
        } else if (!getFoodBreakWithoutFoodTime) {
            toastr.warning('Yemek Saatleri Dışında Yemek Molası Alabilmek Seçilmedi!');
        } else if (!singleBreakDuration) {
            toastr.warning('Kaç Dakikada Bir Mola Hakkı Kazanılır Girilmedi!');
        } else if (!getFirstBreakAfterShiftStart) {
            toastr.warning('İlk Mola Vardiya Başlangıcından Kaç Dakika Sonra Kullanılabilir Girilmedi!');
        } else if (!getLastBreakBeforeShiftEnd) {
            toastr.warning('Vardiya Bitimine Kaç Dakika Kala Mola Alınamaz Girilmedi!');
        } else if (!getBreakAfterLastBreak) {
            toastr.warning('Son Moladan Kaç Dakika Sonra Tekrar Mola Alınabilir Girilmedi!');
        } else if (!dailyFoodBreakAmount) {
            toastr.warning('Günlük Yemek Molası Hakkı Sayısı Girilmedi!');
        } else if (!dailyBreakDuration) {
            toastr.warning('Günlük Toplam Mola Süresi Girilmedi!');
        } else if (!dailyFoodBreakDuration) {
            toastr.warning('Günlük Yemek Molası Süresi Girilmedi!');
        } else if (!dailyBreakBreakDuration) {
            toastr.warning('Günlük İhtiyaç Molası Süresi Girilmedi!');
        } else if (!momentaryFoodBreakDuration) {
            toastr.warning('Anlık Yemek Molası Süresi Girilmedi!');
        } else if (!momentaryBreakBreakDuration) {
            toastr.warning('Anlık İhtiyaç Molası Süresi Girilmedi!');
        } else if (!fridayAdditionalBreakDuration) {
            toastr.warning('Cuma Günü Ek Mola Süresi Girilmedi!');
        } else if (!suspendBreakUsing) {
            toastr.warning('Mola Kullanım Kuralları Aktif Mi Seçilmedi!');
        } else {
            $('#loader').show();
            $('#UpdateShiftModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.shift.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    shiftGroupId: shiftGroupId,
                    startDate: startDate,
                    endDate: endDate,
                },
                success: function () {
                    var employeeId = $('#update_shift_employee_id').val();
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
                            var shiftDate = reformatDatetimeTo_YYYY_MM_DD($('#update_shift_start_date').val());
                            var staffParameters = [
                                {
                                    vardiyaId: id,
                                    kullanicilarId: response.response.guid,
                                    tarih: shiftDate,
                                    yemekBaslangicSaati: `${shiftDate} ${foodBreakStart}`,
                                    yemekBitisSaati: `${shiftDate} ${foodBreakEnd}`,
                                    yemekMolasindaIhtiyacMolasi: getBreakWhileFoodTime,
                                    yemekMolasiDisindaYemekMolasi: getFoodBreakWithoutFoodTime,
                                    birMolaHakkiDakikasi: singleBreakDuration,
                                    vardiyaBasiIlkMolaHakkiDakikasi: getFirstBreakAfterShiftStart,
                                    vardiyaSonuMolaYasagiDakikasi: getLastBreakBeforeShiftEnd,
                                    sonMoladanSonraMolaMusadesiDakikasi: getBreakAfterLastBreak,
                                    gunlukYemekMolasiHakkiSayisi: dailyFoodBreakAmount,
                                    gunlukToplamMolaDakikasi: getWeekDayOfDate(shiftDate) === 5 ? parseInt(dailyBreakDuration) + parseInt(fridayAdditionalBreakDuration) : dailyBreakDuration,
                                    gunlukYemekMolasiDakikasi: dailyFoodBreakDuration,
                                    gunlukIhtiyacMolasiDakikasi: getWeekDayOfDate(shiftDate) === 5 ? parseInt(dailyBreakBreakDuration) + parseInt(fridayAdditionalBreakDuration) : dailyBreakBreakDuration,
                                    anlikYemekMolasiDakikasi: momentaryFoodBreakDuration,
                                    anlikIhtiyacMolasiDakikasi: momentaryBreakBreakDuration,
                                    molaKullanimKisitlamasiVarMi: suspendBreakUsing,
                                }
                            ];
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
                                    toastr.success('Vardiya Başarıyla Güncellendi!');
                                    calendar.refetchEvents();
                                },
                                error: function (error) {
                                    console.log(error);
                                    toastr.error('Güncellenen Vardiya Verileri OTS Sistemine Gönderilemedi!');
                                    $('#loader').hide();
                                }
                            });

                        },
                        error: function (error) {
                            console.log(error);
                            toastr.error('Güncellenen Vardiyaya Ait Personel Verisi Alınamadığı İçin Veriler OTS Sistemine Gönderilemedi!');
                            $('#loader').hide();
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vardiya Güncellenirken Serviste Bir Hata Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateShiftBatchButton.click(function () {
        var employeeIds = updateShiftBatchEmployeeIds.val();
        var date = $('#update_shift_batch_date').val();
        var startTime = $('#update_shift_batch_start_time').val();
        var endTime = $('#update_shift_batch_end_time').val();

        if (employeeIds.length === 0) {
            toastr.warning('Hiç Personel Seçmediniz!');
        } else if (!date) {
            toastr.warning('Vardiya Tarihi Seçmediniz!');
        } else if (!startTime) {
            toastr.warning('Vardiya Başlangıç Saati Seçmediniz!');
        } else if (!endTime) {
            toastr.warning('Vardiya Bitiş Saati Seçmediniz!');
        } else {
            UpdateShiftBatchButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.shift.updateBatch') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    employeeIds: employeeIds,
                    date: date,
                    startTime: startTime,
                    endTime: endTime,
                },
                success: function () {
                    toastr.success('Vardiya Başarıyla Güncellendi!');
                    calendar.refetchEvents();
                    $('#UpdateShiftBatchModal').modal('hide');
                    UpdateShiftBatchButton.attr('disabled', false).html('Güncelle');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vardiyalar Güncellenirken Serviste Bir Sorun Oluştu. Lütfen Yazılım Ekibiyle İrtibata Geçin!');
                    UpdateShiftBatchButton.attr('disabled', false).html('Güncelle');
                }
            });
        }
    });

    DeleteShiftButton.click(function () {
        DeleteShiftButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);
        var id = $('#delete_shift_id').val();
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.shift.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                $.ajax({
                    type: 'post',
                    url: '{{ route('user.api.operationApi.operation.setStaffParameterDelete') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        shiftId: id,
                    },
                    success: function () {
                        $('#ShowModal').modal('hide');
                        $('#DeleteShiftModal').modal('hide');
                        toastr.success('Vardiya Başarıyla Silindi!');
                        calendar.refetchEvents();
                        DeleteShiftButton.attr('disabled', false).html(`Sil`);
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Vardiya OTS Sisteminden Silinirken Serviste Bir Hata Oluştu!');
                        DeleteShiftButton.attr('disabled', false).html(`Sil`);
                    }
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Vardiya Silinirken Serviste Bir Hata Oluştu!');
                DeleteShiftButton.attr('disabled', false).html(`Sil`);
            }
        });
    });

    SelectedCompanies.change(function () {
        getJobDepartments();
        getShiftGroups();
        getEmployees();
        calendar.refetchEvents();
    });

    $('body').on('contextmenu', function () {
        transactions();
        return false;
    });

</script>
