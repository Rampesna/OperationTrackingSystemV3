<script>

    var shiftGroups = $('#shiftGroups');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');

    // Create Variables

    var createShiftGroupCompanyId = $('#create_shift_group_company_id');
    var createShiftGroupAddType = $('#create_shift_group_add_type');
    var createShiftGroupEmployees = $('#create_shift_group_employees');
    var createShiftGroupGetBreakWhileFoodTime = $('#create_shift_group_get_break_while_food_time');
    var createShiftGroupGetFoodBreakWithoutFoodTime = $('#create_shift_group_get_food_break_without_food_time');
    var createShiftGroupSuspendBreakUsing = $('#create_shift_group_suspend_break_using');
    var createShiftGroupNumberOfWeekPermitDay = $('#create_shift_group_number_of_week_permit_day');
    var createShiftGroupSundayEmployeeFromShiftGroupId = $('#create_shift_group_sunday_employee_from_shift_group_id');

    var CreateShiftGroupSelectAllEmployeesButton = $('#CreateShiftGroupSelectAllEmployeesButton');
    var CreateShiftGroupUnSelectAllEmployeesButton = $('#CreateShiftGroupUnSelectAllEmployeesButton');

    CreateShiftGroupSelectAllEmployeesButton.click(function () {
        createShiftGroupEmployees.selectpicker('selectAll');
    });

    CreateShiftGroupUnSelectAllEmployeesButton.click(function () {
        createShiftGroupEmployees.selectpicker('deselectAll');
    });

    createShiftGroupAddType.change(function () {
        if (parseInt($(this).val()) === 1) {
            $('#create_shift_group_per_day').attr('disabled', true).val('');
        } else {
            $('#create_shift_group_per_day').attr('disabled', false);
        }
    });

    // Update Variables

    var updateShiftGroupCompanyId = $('#update_shift_group_company_id');
    var updateShiftGroupAddType = $('#update_shift_group_add_type');
    var updateShiftGroupEmployees = $('#update_shift_group_employees');
    var updateShiftGroupGetBreakWhileFoodTime = $('#update_shift_group_get_break_while_food_time');
    var updateShiftGroupGetFoodBreakWithoutFoodTime = $('#update_shift_group_get_food_break_without_food_time');
    var updateShiftGroupSuspendBreakUsing = $('#update_shift_group_suspend_break_using');
    var updateShiftGroupNumberOfWeekPermitDay = $('#update_shift_group_number_of_week_permit_day');
    var updateShiftGroupSundayEmployeeFromShiftGroupId = $('#update_shift_group_sunday_employee_from_shift_group_id');

    var UpdateShiftGroupSelectAllEmployeesButton = $('#UpdateShiftGroupSelectAllEmployeesButton');
    var UpdateShiftGroupUnSelectAllEmployeesButton = $('#UpdateShiftGroupUnSelectAllEmployeesButton');

    UpdateShiftGroupSelectAllEmployeesButton.click(function () {
        updateShiftGroupEmployees.selectpicker('selectAll');
    });

    UpdateShiftGroupUnSelectAllEmployeesButton.click(function () {
        updateShiftGroupEmployees.selectpicker('deselectAll');
    });

    updateShiftGroupAddType.change(function () {
        if (parseInt($(this).val()) === 1) {
            $('#update_shift_group_per_day').attr('disabled', true).val('');
        } else {
            $('#update_shift_group_per_day').attr('disabled', false);
        }
    });

    var CreateShiftGroupButton = $('#CreateShiftGroupButton');
    var UpdateShiftGroupButton = $('#UpdateShiftGroupButton');
    var DeleteShiftGroupButton = $('#DeleteShiftGroupButton');

    function createShiftGroup() {
        createShiftGroupCompanyId.val('');
        $('#create_shift_group_order').val('');
        $('#create_shift_group_name').val('');
        createShiftGroupAddType.val('1');
        $('#create_shift_group_per_day').attr('disabled', true).val('');
        createShiftGroupEmployees.val([]).selectpicker('refresh');
        $('#create_shift_group_day1').prop('checked', true);
        $('#create_shift_group_day1_start_time').val('09:00');
        $('#create_shift_group_day1_end_time').val('18:00');
        $('#create_shift_group_day2').prop('checked', true);
        $('#create_shift_group_day2_start_time').val('09:00');
        $('#create_shift_group_day2_end_time').val('18:00');
        $('#create_shift_group_day3').prop('checked', true);
        $('#create_shift_group_day3_start_time').val('09:00');
        $('#create_shift_group_day3_end_time').val('18:00');
        $('#create_shift_group_day4').prop('checked', true);
        $('#create_shift_group_day4_start_time').val('09:00');
        $('#create_shift_group_day4_end_time').val('18:00');
        $('#create_shift_group_day5').prop('checked', true);
        $('#create_shift_group_day5_start_time').val('09:00');
        $('#create_shift_group_day5_end_time').val('18:00');
        $('#create_shift_group_day6').prop('checked', true);
        $('#create_shift_group_day6_start_time').val('09:00');
        $('#create_shift_group_day6_end_time').val('18:00');
        $('#create_shift_group_day0').prop('checked', false);
        $('#create_shift_group_day0_start_time').val('09:00');
        $('#create_shift_group_day0_end_time').val('18:00');
        $('#create_shift_group_food_break_start').val('');
        $('#create_shift_group_food_break_end').val('');
        createShiftGroupGetBreakWhileFoodTime.val('0');
        createShiftGroupGetFoodBreakWithoutFoodTime.val('0');
        $('#create_shift_group_single_break_duration').val('');
        $('#create_shift_group_get_first_break_after_shift_start').val('');
        $('#create_shift_group_get_last_break_before_shift_end').val('');
        $('#create_shift_group_get_break_after_last_break').val('');
        $('#create_shift_group_daily_food_break_amount').val('');
        $('#create_shift_group_daily_break_duration').val('');
        $('#create_shift_group_daily_food_break_duration').val('');
        $('#create_shift_group_daily_break_break_duration').val('');
        $('#create_shift_group_momentary_food_break_duration').val('');
        $('#create_shift_group_momentary_break_break_duration').val('');
        $('#create_shift_group_friday_additional_break_duration').val('');
        createShiftGroupSuspendBreakUsing.val('1');
        $('#create_shift_group_delete_if_exist').prop('checked', true);
        $('#create_shift_group_week_permit').prop('checked', false);
        createShiftGroupNumberOfWeekPermitDay.val('1');
        $('#create_shift_group_set_group_weekly').prop('checked', false);
        $('#create_shift_group_sunday_employee_from_shift_group').prop('checked', false);
        createShiftGroupSundayEmployeeFromShiftGroupId.val('');
        CreateShiftGroupWizardStepper.goTo(1);
        $('#CreateShiftGroupModal').modal('show');
    }

    function updateShiftGroup(id) {
        $('#loader').show();
        $('#update_shift_group_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.shiftGroup.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateShiftGroupCompanyId.val(response.response.company_id);
                $('#update_shift_group_order').val(response.response.order);
                $('#update_shift_group_name').val(response.response.name);
                updateShiftGroupAddType.val(response.response.add_type);
                $('#update_shift_group_per_day').val(response.response.per_day).attr('disabled', parseInt(response.response.add_type) === 1);
                updateShiftGroupEmployees.selectpicker('val', $.map(response.response.employees, function (item) {
                    return `${item.id}`;
                }));
                $('#update_shift_group_day1').prop('checked', parseInt(response.response.day1) === 1);
                $('#update_shift_group_day1_start_time').val(response.response.day1_start_time);
                $('#update_shift_group_day1_end_time').val(response.response.day1_end_time);
                $('#update_shift_group_day2').prop('checked', parseInt(response.response.day2) === 1);
                $('#update_shift_group_day2_start_time').val(response.response.day2_start_time);
                $('#update_shift_group_day2_end_time').val(response.response.day2_end_time);
                $('#update_shift_group_day3').prop('checked', parseInt(response.response.day3) === 1);
                $('#update_shift_group_day3_start_time').val(response.response.day3_start_time);
                $('#update_shift_group_day3_end_time').val(response.response.day3_end_time);
                $('#update_shift_group_day4').prop('checked', parseInt(response.response.day4) === 1);
                $('#update_shift_group_day4_start_time').val(response.response.day4_start_time);
                $('#update_shift_group_day4_end_time').val(response.response.day4_end_time);
                $('#update_shift_group_day5').prop('checked', parseInt(response.response.day5) === 1);
                $('#update_shift_group_day5_start_time').val(response.response.day5_start_time);
                $('#update_shift_group_day5_end_time').val(response.response.day5_end_time);
                $('#update_shift_group_day6').prop('checked', parseInt(response.response.day6) === 1);
                $('#update_shift_group_day6_start_time').val(response.response.day6_start_time);
                $('#update_shift_group_day6_end_time').val(response.response.day6_end_time);
                $('#update_shift_group_day0').prop('checked', parseInt(response.response.day0) === 1);
                $('#update_shift_group_day0_start_time').val(response.response.day0_start_time);
                $('#update_shift_group_day0_end_time').val(response.response.day0_end_time);
                $('#update_shift_group_food_break_start').val(response.response.food_break_start);
                $('#update_shift_group_food_break_end').val(response.response.food_break_end);
                updateShiftGroupGetBreakWhileFoodTime.val(response.response.get_break_while_food_time);
                updateShiftGroupGetFoodBreakWithoutFoodTime.val(response.response.get_food_break_without_food_time);
                $('#update_shift_group_single_break_duration').val(response.response.single_break_duration);
                $('#update_shift_group_get_first_break_after_shift_start').val(response.response.get_first_break_after_shift_start);
                $('#update_shift_group_get_last_break_before_shift_end').val(response.response.get_last_break_before_shift_end);
                $('#update_shift_group_get_break_after_last_break').val(response.response.get_break_after_last_break);
                $('#update_shift_group_daily_food_break_amount').val(response.response.daily_food_break_amount);
                $('#update_shift_group_daily_break_duration').val(response.response.daily_break_duration);
                $('#update_shift_group_daily_food_break_duration').val(response.response.daily_food_break_duration);
                $('#update_shift_group_daily_break_break_duration').val(response.response.daily_break_break_duration);
                $('#update_shift_group_momentary_food_break_duration').val(response.response.momentary_food_break_duration);
                $('#update_shift_group_momentary_break_break_duration').val(response.response.momentary_break_break_duration);
                $('#update_shift_group_friday_additional_break_duration').val(response.response.friday_additional_break_duration);
                updateShiftGroupSuspendBreakUsing.val(response.response.suspend_break_using);
                $('#update_shift_group_delete_if_exist').prop('checked', parseInt(response.response.delete_if_exist) === 1);
                $('#update_shift_group_week_permit').prop('checked', parseInt(response.response.week_permit) === 1);
                updateShiftGroupNumberOfWeekPermitDay.val(response.response.number_of_week_permit_day);
                $('#update_shift_group_set_group_weekly').prop('checked', parseInt(response.response.set_group_weekly) === 1);
                $('#update_shift_group_sunday_employee_from_shift_group').prop('checked', parseInt(response.response.sunday_employee_from_shift_group) === 1);
                updateShiftGroupSundayEmployeeFromShiftGroupId.val(response.response.sunday_employee_from_shift_group_id);
                UpdateShiftGroupWizardStepper.goTo(1);
                $('#UpdateShiftGroupModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Vardiya Grubu Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteShiftGroup(id) {
        $('#delete_shift_group_id').val(id);
        $('#DeleteShiftGroupModal').modal('show');
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
                createShiftGroupCompanyId.empty();
                updateShiftGroupCompanyId.empty();
                $.each(response.response, function (i, company) {
                    createShiftGroupCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                    updateShiftGroupCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Şirketler Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getShiftGroups() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.shiftGroup.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
            },
            success: function (response) {
                shiftGroups.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.shiftGroups, function (i, shiftGroup) {
                    createShiftGroupSundayEmployeeFromShiftGroupId.append($('<option>', {
                        value: shiftGroup.id,
                        text: shiftGroup.name
                    }));
                    updateShiftGroupSundayEmployeeFromShiftGroupId.append($('<option>', {
                        value: shiftGroup.id,
                        text: shiftGroup.name
                    }));
                    shiftGroups.append(`
                    <tr>
                        <td>
                            ${shiftGroup.order}
                        </td>
                        <td>
                            ${shiftGroup.company ? shiftGroup.company.title : ''}
                        </td>
                        <td>
                            ${shiftGroup.name}
                        </td>
                        <td>
                            ${shiftGroup.employees_count}
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${shiftGroup.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${shiftGroup.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateShiftGroup(${shiftGroup.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteShiftGroup(${shiftGroup.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    `);
                });

                if (response.response.totalCount <= (pageIndex + 1) * pageSize) {
                    pageUpButton.attr('disabled', true);
                } else {
                    pageUpButton.attr('disabled', false);
                }

                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Vardiya Grupları Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    function getEmployeesByCompanies() {
        var companyIds = SelectedCompanies.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: 0,
                pageSize: 1000,
                leave: 0
            },
            success: function (response) {
                createShiftGroupEmployees.empty();
                updateShiftGroupEmployees.empty();
                $.each(response.response.employees, function (i, employee) {
                    createShiftGroupEmployees.append(`
                    <option value="${employee.id}">${employee.name}${employee.job_department ? ` (${employee.job_department.name})` : ``}</option>
                    `);
                    updateShiftGroupEmployees.append(`
                    <option value="${employee.id}">${employee.name}${employee.job_department ? ` (${employee.job_department.name})` : ``}</option>
                    `);
                });
                createShiftGroupEmployees.selectpicker('refresh');
                updateShiftGroupEmployees.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Listesi Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }


    getCompanies();
    getShiftGroups();
    getEmployeesByCompanies();

    SelectedCompanies.change(function () {
        getShiftGroups();
        getEmployeesByCompanies();
    });

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
        getShiftGroups();
    }

    // Create Shift Group Wizard Stepper

    CreateShiftGroupWizardStepperSelector = document.querySelector("#CreateShiftGroupWizardStepper");

    CreateShiftGroupWizardStepper = new KTStepper(CreateShiftGroupWizardStepperSelector);

    CreateShiftGroupWizardStepper.on("kt.stepper.next", (function (e) {
        if (e.getCurrentStepIndex() === 1) {
            e.goNext();
        } else if (e.getCurrentStepIndex() === 2) {
            e.goNext();
        } else {
            e.goNext();
        }
    }));

    CreateShiftGroupWizardStepper.on("kt.stepper.previous", (function (e) {
        e.goPrevious();
    }));

    CreateShiftGroupWizardStepper.on("kt.stepper.click", function (stepper) {
        stepper.goTo(stepper.getClickedStepIndex());
    });

    // Update Shift Group Wizard Stepper

    UpdateShiftGroupWizardStepperSelector = document.querySelector("#UpdateShiftGroupWizardStepper");

    UpdateShiftGroupWizardStepper = new KTStepper(UpdateShiftGroupWizardStepperSelector);

    UpdateShiftGroupWizardStepper.on("kt.stepper.next", (function (e) {
        if (e.getCurrentStepIndex() === 1) {
            e.goNext();
        } else if (e.getCurrentStepIndex() === 2) {
            e.goNext();
        } else {
            e.goNext();
        }
    }));

    UpdateShiftGroupWizardStepper.on("kt.stepper.previous", (function (e) {
        e.goPrevious();
    }));

    UpdateShiftGroupWizardStepper.on("kt.stepper.click", function (stepper) {
        stepper.goTo(stepper.getClickedStepIndex());
    });

    CreateShiftGroupButton.click(function () {
        var companyId = createShiftGroupCompanyId.val();
        var order = $('#create_shift_group_order').val();
        var name = $('#create_shift_group_name').val();
        var addType = createShiftGroupAddType.val();
        var perDay = $('#create_shift_group_per_day').val();
        var employees = createShiftGroupEmployees.val();
        var day0 = $('#create_shift_group_day0').is(':checked') ? 1 : 0;
        var day0StartTime = $('#create_shift_group_day0_start_time').val();
        var day0EndTime = $('#create_shift_group_day0_end_time').val();
        var day1 = $('#create_shift_group_day1').is(':checked') ? 1 : 0;
        var day1StartTime = $('#create_shift_group_day1_start_time').val();
        var day1EndTime = $('#create_shift_group_day1_end_time').val();
        var day2 = $('#create_shift_group_day2').is(':checked') ? 1 : 0;
        var day2StartTime = $('#create_shift_group_day2_start_time').val();
        var day2EndTime = $('#create_shift_group_day2_end_time').val();
        var day3 = $('#create_shift_group_day3').is(':checked') ? 1 : 0;
        var day3StartTime = $('#create_shift_group_day3_start_time').val();
        var day3EndTime = $('#create_shift_group_day3_end_time').val();
        var day4 = $('#create_shift_group_day4').is(':checked') ? 1 : 0;
        var day4StartTime = $('#create_shift_group_day4_start_time').val();
        var day4EndTime = $('#create_shift_group_day4_end_time').val();
        var day5 = $('#create_shift_group_day5').is(':checked') ? 1 : 0;
        var day5StartTime = $('#create_shift_group_day5_start_time').val();
        var day5EndTime = $('#create_shift_group_day5_end_time').val();
        var day6 = $('#create_shift_group_day6').is(':checked') ? 1 : 0;
        var day6StartTime = $('#create_shift_group_day6_start_time').val();
        var day6EndTime = $('#create_shift_group_day6_end_time').val();
        var foodBreakStart = $('#create_shift_group_food_break_start').val();
        var foodBreakEnd = $('#create_shift_group_food_break_end').val();
        var getBreakWhileFoodTime = createShiftGroupGetBreakWhileFoodTime.val();
        var getFoodBreakWithoutFoodTime = createShiftGroupGetFoodBreakWithoutFoodTime.val();
        var singleBreakDuration = $('#create_shift_group_single_break_duration').val();
        var getFirstBreakAfterShiftStart = $('#create_shift_group_get_first_break_after_shift_start').val();
        var getLastBreakBeforeShiftEnd = $('#create_shift_group_get_last_break_before_shift_end').val();
        var getBreakAfterLastBreak = $('#create_shift_group_get_break_after_last_break').val();
        var dailyFoodBreakAmount = $('#create_shift_group_daily_food_break_amount').val();
        var dailyBreakDuration = $('#create_shift_group_daily_break_duration').val();
        var dailyFoodBreakDuration = $('#create_shift_group_daily_food_break_duration').val();
        var dailyBreakBreakDuration = $('#create_shift_group_daily_break_break_duration').val();
        var momentaryFoodBreakDuration = $('#create_shift_group_momentary_food_break_duration').val();
        var momentaryBreakBreakDuration = $('#create_shift_group_momentary_break_break_duration').val();
        var fridayAdditionalBreakDuration = $('#create_shift_group_friday_additional_break_duration').val();
        var suspendBreakUsing = createShiftGroupSuspendBreakUsing.val();
        var deleteIfExist = $('#create_shift_group_delete_if_exist').is(':checked') ? 1 : 0;
        var weekPermit = $('#create_shift_group_week_permit').is(':checked') ? 1 : 0;
        var numberOfWeekPermitDay = createShiftGroupNumberOfWeekPermitDay.val();
        var setGroupWeekly = $('#create_shift_group_set_group_weekly').is(':checked') ? 1 : 0;
        var sundayEmployeeFromShiftGroup = $('#create_shift_group_sunday_employee_from_shift_group').is(':checked') ? 1 : 0;
        var sundayEmployeeFromShiftGroupId = createShiftGroupSundayEmployeeFromShiftGroupId.val();

        if (!companyId) {
            toastr.warning('Firma Seçilmedi');
            CreateShiftGroupWizardStepper.goTo(1);
        } else if (!order) {
            toastr.warning('Sıra Girilmedi');
            CreateShiftGroupWizardStepper.goTo(1);
        } else if (!name) {
            toastr.warning('Grup Adı Girilmedi');
            CreateShiftGroupWizardStepper.goTo(1);
        } else if (!addType) {
            toastr.warning('Eklenme Türü Seçilmedi');
            CreateShiftGroupWizardStepper.goTo(1);
        } else if (parseInt(addType) === 0 && !perDay) {
            toastr.warning('Her Güne Eklenecek Kisi Sayısı Girilmedi');
            CreateShiftGroupWizardStepper.goTo(1);
        } else if (parseInt(addType) === 0 && perDay && employees.length < perDay) {
            toastr.warning('Her Güne Eklenecek Kişi Sayısı Seçilen Personel Sayısından Büyük Olamaz');
            CreateShiftGroupWizardStepper.goTo(1);
        } else if (!day1StartTime) {
            toastr.warning('Pazartesi Başlangıç Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!day1EndTime) {
            toastr.warning('Pazartesi Bitiş Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!day2StartTime) {
            toastr.warning('Salı Başlangıç Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!day2EndTime) {
            toastr.warning('Salı Bitiş Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!day3StartTime) {
            toastr.warning('Çarşamba Başlangıç Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!day3EndTime) {
            toastr.warning('Çarşamba Bitiş Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!day4StartTime) {
            toastr.warning('Perşembe Başlangıç Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!day4EndTime) {
            toastr.warning('Perşembe Bitiş Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!day5StartTime) {
            toastr.warning('Cuma Başlangıç Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!day5EndTime) {
            toastr.warning('Cuma Bitiş Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!day6StartTime) {
            toastr.warning('Cumartesi Başlangıç Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!day6EndTime) {
            toastr.warning('Cumartesi Bitiş Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!day0StartTime) {
            toastr.warning('Pazartesi Başlangıç Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!day0EndTime) {
            toastr.warning('Pazartesi Bitiş Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(2);
        } else if (!foodBreakStart) {
            toastr.warning('Yemek Molası Başlangıç Saati Girilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!getBreakWhileFoodTime) {
            toastr.warning('Yemek Molasındayken Mola Alabilmek Seçilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!getFoodBreakWithoutFoodTime) {
            toastr.warning('Yemek Zamanı Dışında Yemek Molası Alabilmek Seçilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!singleBreakDuration) {
            toastr.warning('Kaç Dakikada Bir Mola Hakkı Kazanılır Girilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!getFirstBreakAfterShiftStart) {
            toastr.warning('İlk Mola Kaç Dakika Sonra Kullanılabilir Girilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!getLastBreakBeforeShiftEnd) {
            toastr.warning('Vardiya Bitimine Kaç Dakika Kala Mola Alınamaz Girilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!getBreakAfterLastBreak) {
            toastr.warning('Son Moladan Kaç Dakika Sonra Tekrar Mola Alınabilir Girilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!dailyFoodBreakAmount) {
            toastr.warning('Günlük Yemek Molası Hakkı Sayısı Girilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!dailyBreakDuration) {
            toastr.warning('Günlük Toplam Mola Süresi Girilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!dailyFoodBreakDuration) {
            toastr.warning('Günlük Toplam Yemek Molası Süresi Girilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!dailyBreakBreakDuration) {
            toastr.warning('Günlük Toplam İhtiyaç Molası Süresi Girilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!momentaryFoodBreakDuration) {
            toastr.warning('Anlık Yemek Molası Süresi Girilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!momentaryBreakBreakDuration) {
            toastr.warning('Anlık İhtiyaç Molası Süresi Girilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!fridayAdditionalBreakDuration) {
            toastr.warning('Cuma Günü Ek Mola Süresi Girilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (!suspendBreakUsing) {
            toastr.warning('Mola Kısıtlaması Seçilmedi');
            CreateShiftGroupWizardStepper.goTo(3);
        } else if (weekPermit === 1 && !numberOfWeekPermitDay) {
            toastr.warning('Pazar Vardiyası Olan Personele Hangi Gün Vardiya Ekleneceği Seçilmedi');
            CreateShiftGroupWizardStepper.goTo(4);
        } else if (sundayEmployeeFromShiftGroup === 1 && !sundayEmployeeFromShiftGroupId) {
            toastr.warning('Pazar Günü Vardiyası Hangi Vardiya Grubuna Ait Personellerden Seçilecek?');
            CreateShiftGroupWizardStepper.goTo(4);
        } else {
            $('#loader').show();
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.shiftGroup.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyId: companyId,
                    order: order,
                    name: name,
                    description: '',
                    addType: addType,
                    perDay: perDay,
                    deleteIfExist: deleteIfExist,
                    weekPermit: weekPermit,
                    numberOfWeekPermitDay: numberOfWeekPermitDay,
                    setGroupWeekly: setGroupWeekly,
                    sundayEmployeeFromShiftGroup: sundayEmployeeFromShiftGroup,
                    sundayEmployeeFromShiftGroupId: sundayEmployeeFromShiftGroupId,
                    day0: day0,
                    day0StartTime: day0StartTime,
                    day0EndTime: day0EndTime,
                    day1: day1,
                    day1StartTime: day1StartTime,
                    day1EndTime: day1EndTime,
                    day2: day2,
                    day2StartTime: day2StartTime,
                    day2EndTime: day2EndTime,
                    day3: day3,
                    day3StartTime: day3StartTime,
                    day3EndTime: day3EndTime,
                    day4: day4,
                    day4StartTime: day4StartTime,
                    day4EndTime: day4EndTime,
                    day5: day5,
                    day5StartTime: day5StartTime,
                    day5EndTime: day5EndTime,
                    day6: day6,
                    day6StartTime: day6StartTime,
                    day6EndTime: day6EndTime,
                    foodBreakStart: foodBreakStart,
                    foodBreakEnd: foodBreakEnd,
                    getBreakWhileFoodTime: getBreakWhileFoodTime,
                    getFoodBreakWithoutFoodTime: getFoodBreakWithoutFoodTime,
                    singleBreakDuration: singleBreakDuration,
                    getFirstBreakAfterShiftStart: getFirstBreakAfterShiftStart,
                    getLastBreakBeforeShiftEnd: getLastBreakBeforeShiftEnd,
                    getBreakAfterLastBreak: getBreakAfterLastBreak,
                    dailyFoodBreakAmount: dailyFoodBreakAmount,
                    dailyBreakDuration: dailyBreakDuration,
                    dailyFoodBreakDuration: dailyFoodBreakDuration,
                    dailyBreakBreakDuration: dailyBreakBreakDuration,
                    momentaryFoodBreakDuration: momentaryFoodBreakDuration,
                    momentaryBreakBreakDuration: momentaryBreakBreakDuration,
                    fridayAdditionalBreakDuration: fridayAdditionalBreakDuration,
                    suspendBreakUsing: suspendBreakUsing,
                },
                success: function (response) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('user.api.employeeShiftGroup.setShiftGroupEmployees') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            shiftGroupId: response.response.id,
                            employeeIds: employees,
                        },
                        success: function () {
                            changePage(1);
                            toastr.success('Vardiya Grubu Başarıyla Oluşturuldu');
                            $('#CreateShiftGroupModal').modal('hide');
                            $('#loader').hide();
                        },
                        error: function (error) {
                            console.log(error);
                            changePage(1);
                            toastr.success('Vardiya Grubu Başarıyla Oluşturuldu');
                            toastr.error('Vardiya Grubuna Personelleri Eşleştirilirken Serviste Hata Oluştu!');
                            $('#CreateShiftGroupModal').modal('hide');
                            $('#loader').hide();
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vardiya Grubu Oluşturulurken Serviste Bir Hata Oluştu');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateShiftGroupButton.click(function () {
        var id = $('#update_shift_group_id').val();
        var companyId = updateShiftGroupCompanyId.val();
        var order = $('#update_shift_group_order').val();
        var name = $('#update_shift_group_name').val();
        var addType = updateShiftGroupAddType.val();
        var perDay = $('#update_shift_group_per_day').val();
        var employees = updateShiftGroupEmployees.val();
        var day0 = $('#update_shift_group_day0').is(':checked') ? 1 : 0;
        var day0StartTime = $('#update_shift_group_day0_start_time').val();
        var day0EndTime = $('#update_shift_group_day0_end_time').val();
        var day1 = $('#update_shift_group_day1').is(':checked') ? 1 : 0;
        var day1StartTime = $('#update_shift_group_day1_start_time').val();
        var day1EndTime = $('#update_shift_group_day1_end_time').val();
        var day2 = $('#update_shift_group_day2').is(':checked') ? 1 : 0;
        var day2StartTime = $('#update_shift_group_day2_start_time').val();
        var day2EndTime = $('#update_shift_group_day2_end_time').val();
        var day3 = $('#update_shift_group_day3').is(':checked') ? 1 : 0;
        var day3StartTime = $('#update_shift_group_day3_start_time').val();
        var day3EndTime = $('#update_shift_group_day3_end_time').val();
        var day4 = $('#update_shift_group_day4').is(':checked') ? 1 : 0;
        var day4StartTime = $('#update_shift_group_day4_start_time').val();
        var day4EndTime = $('#update_shift_group_day4_end_time').val();
        var day5 = $('#update_shift_group_day5').is(':checked') ? 1 : 0;
        var day5StartTime = $('#update_shift_group_day5_start_time').val();
        var day5EndTime = $('#update_shift_group_day5_end_time').val();
        var day6 = $('#update_shift_group_day6').is(':checked') ? 1 : 0;
        var day6StartTime = $('#update_shift_group_day6_start_time').val();
        var day6EndTime = $('#update_shift_group_day6_end_time').val();
        var foodBreakStart = $('#update_shift_group_food_break_start').val();
        var foodBreakEnd = $('#update_shift_group_food_break_end').val();
        var getBreakWhileFoodTime = updateShiftGroupGetBreakWhileFoodTime.val();
        var getFoodBreakWithoutFoodTime = updateShiftGroupGetFoodBreakWithoutFoodTime.val();
        var singleBreakDuration = $('#update_shift_group_single_break_duration').val();
        var getFirstBreakAfterShiftStart = $('#update_shift_group_get_first_break_after_shift_start').val();
        var getLastBreakBeforeShiftEnd = $('#update_shift_group_get_last_break_before_shift_end').val();
        var getBreakAfterLastBreak = $('#update_shift_group_get_break_after_last_break').val();
        var dailyFoodBreakAmount = $('#update_shift_group_daily_food_break_amount').val();
        var dailyBreakDuration = $('#update_shift_group_daily_break_duration').val();
        var dailyFoodBreakDuration = $('#update_shift_group_daily_food_break_duration').val();
        var dailyBreakBreakDuration = $('#update_shift_group_daily_break_break_duration').val();
        var momentaryFoodBreakDuration = $('#update_shift_group_momentary_food_break_duration').val();
        var momentaryBreakBreakDuration = $('#update_shift_group_momentary_break_break_duration').val();
        var fridayAdditionalBreakDuration = $('#update_shift_group_friday_additional_break_duration').val();
        var suspendBreakUsing = updateShiftGroupSuspendBreakUsing.val();
        var deleteIfExist = $('#update_shift_group_delete_if_exist').is(':checked') ? 1 : 0;
        var weekPermit = $('#update_shift_group_week_permit').is(':checked') ? 1 : 0;
        var numberOfWeekPermitDay = updateShiftGroupNumberOfWeekPermitDay.val();
        var setGroupWeekly = $('#update_shift_group_set_group_weekly').is(':checked') ? 1 : 0;
        var sundayEmployeeFromShiftGroup = $('#update_shift_group_sunday_employee_from_shift_group').is(':checked') ? 1 : 0;
        var sundayEmployeeFromShiftGroupId = updateShiftGroupSundayEmployeeFromShiftGroupId.val();

        if (!companyId) {
            toastr.warning('Firma Seçilmedi');
            UpdateShiftGroupWizardStepper.goTo(1);
        } else if (!order) {
            toastr.warning('Sıra Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(1);
        } else if (!name) {
            toastr.warning('Grup Adı Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(1);
        } else if (!addType) {
            toastr.warning('Eklenme Türü Seçilmedi');
            UpdateShiftGroupWizardStepper.goTo(1);
        } else if (parseInt(addType) === 0 && !perDay) {
            toastr.warning('Her Güne Eklenecek Kisi Sayısı Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(1);
        } else if (parseInt(addType) === 0 && perDay && employees.length < perDay) {
            toastr.warning('Her Güne Eklenecek Kişi Sayısı Seçilen Personel Sayısından Büyük Olamaz');
            UpdateShiftGroupWizardStepper.goTo(1);
        } else if (!day1StartTime) {
            toastr.warning('Pazartesi Başlangıç Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!day1EndTime) {
            toastr.warning('Pazartesi Bitiş Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!day2StartTime) {
            toastr.warning('Salı Başlangıç Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!day2EndTime) {
            toastr.warning('Salı Bitiş Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!day3StartTime) {
            toastr.warning('Çarşamba Başlangıç Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!day3EndTime) {
            toastr.warning('Çarşamba Bitiş Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!day4StartTime) {
            toastr.warning('Perşembe Başlangıç Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!day4EndTime) {
            toastr.warning('Perşembe Bitiş Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!day5StartTime) {
            toastr.warning('Cuma Başlangıç Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!day5EndTime) {
            toastr.warning('Cuma Bitiş Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!day6StartTime) {
            toastr.warning('Cumartesi Başlangıç Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!day6EndTime) {
            toastr.warning('Cumartesi Bitiş Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!day0StartTime) {
            toastr.warning('Pazartesi Başlangıç Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!day0EndTime) {
            toastr.warning('Pazartesi Bitiş Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(2);
        } else if (!foodBreakStart) {
            toastr.warning('Yemek Molası Başlangıç Saati Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!getBreakWhileFoodTime) {
            toastr.warning('Yemek Molasındayken Mola Alabilmek Seçilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!getFoodBreakWithoutFoodTime) {
            toastr.warning('Yemek Zamanı Dışında Yemek Molası Alabilmek Seçilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!singleBreakDuration) {
            toastr.warning('Kaç Dakikada Bir Mola Hakkı Kazanılır Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!getFirstBreakAfterShiftStart) {
            toastr.warning('İlk Mola Kaç Dakika Sonra Kullanılabilir Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!getLastBreakBeforeShiftEnd) {
            toastr.warning('Vardiya Bitimine Kaç Dakika Kala Mola Alınamaz Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!getBreakAfterLastBreak) {
            toastr.warning('Son Moladan Kaç Dakika Sonra Tekrar Mola Alınabilir Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!dailyFoodBreakAmount) {
            toastr.warning('Günlük Yemek Molası Hakkı Sayısı Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!dailyBreakDuration) {
            toastr.warning('Günlük Toplam Mola Süresi Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!dailyFoodBreakDuration) {
            toastr.warning('Günlük Toplam Yemek Molası Süresi Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!dailyBreakBreakDuration) {
            toastr.warning('Günlük Toplam İhtiyaç Molası Süresi Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!momentaryFoodBreakDuration) {
            toastr.warning('Anlık Yemek Molası Süresi Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!momentaryBreakBreakDuration) {
            toastr.warning('Anlık İhtiyaç Molası Süresi Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!fridayAdditionalBreakDuration) {
            toastr.warning('Cuma Günü Ek Mola Süresi Girilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (!suspendBreakUsing) {
            toastr.warning('Mola Kısıtlaması Seçilmedi');
            UpdateShiftGroupWizardStepper.goTo(3);
        } else if (weekPermit === 1 && !numberOfWeekPermitDay) {
            toastr.warning('Pazar Vardiyası Olan Personele Hangi Gün Vardiya Ekleneceği Seçilmedi');
            UpdateShiftGroupWizardStepper.goTo(4);
        } else if (sundayEmployeeFromShiftGroup === 1 && !sundayEmployeeFromShiftGroupId) {
            toastr.warning('Pazar Günü Vardiyası Hangi Vardiya Grubuna Ait Personellerden Seçilecek?');
            UpdateShiftGroupWizardStepper.goTo(4);
        } else {
            $('#loader').show();
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.shiftGroup.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    companyId: companyId,
                    order: order,
                    name: name,
                    description: '',
                    addType: addType,
                    perDay: perDay,
                    deleteIfExist: deleteIfExist,
                    weekPermit: weekPermit,
                    numberOfWeekPermitDay: numberOfWeekPermitDay,
                    setGroupWeekly: setGroupWeekly,
                    sundayEmployeeFromShiftGroup: sundayEmployeeFromShiftGroup,
                    sundayEmployeeFromShiftGroupId: sundayEmployeeFromShiftGroupId,
                    day0: day0,
                    day0StartTime: day0StartTime,
                    day0EndTime: day0EndTime,
                    day1: day1,
                    day1StartTime: day1StartTime,
                    day1EndTime: day1EndTime,
                    day2: day2,
                    day2StartTime: day2StartTime,
                    day2EndTime: day2EndTime,
                    day3: day3,
                    day3StartTime: day3StartTime,
                    day3EndTime: day3EndTime,
                    day4: day4,
                    day4StartTime: day4StartTime,
                    day4EndTime: day4EndTime,
                    day5: day5,
                    day5StartTime: day5StartTime,
                    day5EndTime: day5EndTime,
                    day6: day6,
                    day6StartTime: day6StartTime,
                    day6EndTime: day6EndTime,
                    foodBreakStart: foodBreakStart,
                    foodBreakEnd: foodBreakEnd,
                    getBreakWhileFoodTime: getBreakWhileFoodTime,
                    getFoodBreakWithoutFoodTime: getFoodBreakWithoutFoodTime,
                    singleBreakDuration: singleBreakDuration,
                    getFirstBreakAfterShiftStart: getFirstBreakAfterShiftStart,
                    getLastBreakBeforeShiftEnd: getLastBreakBeforeShiftEnd,
                    getBreakAfterLastBreak: getBreakAfterLastBreak,
                    dailyFoodBreakAmount: dailyFoodBreakAmount,
                    dailyBreakDuration: dailyBreakDuration,
                    dailyFoodBreakDuration: dailyFoodBreakDuration,
                    dailyBreakBreakDuration: dailyBreakBreakDuration,
                    momentaryFoodBreakDuration: momentaryFoodBreakDuration,
                    momentaryBreakBreakDuration: momentaryBreakBreakDuration,
                    fridayAdditionalBreakDuration: fridayAdditionalBreakDuration,
                    suspendBreakUsing: suspendBreakUsing,
                },
                success: function (response) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('user.api.employeeShiftGroup.setShiftGroupEmployees') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            shiftGroupId: response.response.id,
                            employeeIds: employees,
                        },
                        success: function () {
                            changePage(1);
                            toastr.success('Vardiya Grubu Başarıyla Güncellendi');
                            $('#UpdateShiftGroupModal').modal('hide');
                            $('#loader').hide();
                        },
                        error: function (error) {
                            console.log(error);
                            changePage(1);
                            toastr.success('Vardiya Grubu Başarıyla Güncellendi');
                            toastr.error('Vardiya Grubuna Personelleri Eşleştirilirken Serviste Hata Oluştu!');
                            $('#UpdateShiftGroupModal').modal('hide');
                            $('#loader').hide();
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Vardiya Grubu Güncellenirken Serviste Bir Hata Oluştu');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteShiftGroupButton.click(function () {
        $('#loader').show();
        var id = $('#delete_shift_group_id').val();
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.shiftGroup.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                changePage(1);
                $('#DeleteShiftGroupModal').modal('hide');
                toastr.success('Vardiya Grubu Başarıyla Silindi.');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Vardiya Grubu Silinirken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    });

    pageUpButton.click(function () {
        changePage(parseInt(page.html()) + 1);
    });

    pageDownButton.click(function () {
        changePage(parseInt(page.html()) - 1);
    });

    pageSizeSelector.change(function () {
        changePage(1);
    });

</script>
