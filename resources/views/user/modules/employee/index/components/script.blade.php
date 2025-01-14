<script src="{{ asset('assets/jqwidgets/jqxcore.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxbuttons.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxscrollbar.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxlistbox.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdropdownlist.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxmenu.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.selection.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.columnsreorder.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.columnsresize.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.filter.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.sort.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdata.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.pager.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxnumberinput.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxwindow.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdata.export.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.export.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxexport.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.grouping.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/globalization/globalize.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqgrid-localization.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jszip.min.js') }}"></script>

<script>

    var updateEmployeePermission = `{{ checkUserPermission(19, $userPermissions) ? 'true' : 'false' }}`;
    var updateEmployeeQueuesPermission = `{{ checkUserPermission(20, $userPermissions) ? 'true' : 'false' }}`;
    var updateEmployeeCompetencesPermission = `{{ checkUserPermission(21, $userPermissions) ? 'true' : 'false' }}`;
    var updateEmployeeTasksPermission = `{{ checkUserPermission(22, $userPermissions) ? 'true' : 'false' }}`;
    var updateEmployeeWorkTasksPermission = `{{ checkUserPermission(23, $userPermissions) ? 'true' : 'false' }}`;
    var updateEmployeeGroupsPermission = `{{ checkUserPermission(24, $userPermissions) ? 'true' : 'false' }}`;
    var updateEmployeeJobDepartmentPermission = `{{ checkUserPermission(25, $userPermissions) ? 'true' : 'false' }}`;
    var leaveEmployeePermission = `{{ checkUserPermission(202, $userPermissions) ? 'true' : 'false' }}`;

    /////////////////////////////////////////////////////////////////////////////////

    var DownloadExcelEmployeeReportButton = $('#DownloadExcelEmployeeReportButton');

    var UpdateEmployeeButton = $('#UpdateEmployeeButton');

    var UpdateEmployeeQueuesRow = $('#UpdateEmployeeQueuesRow');
    var UpdateEmployeeQueuesButton = $('#UpdateEmployeeQueuesButton');

    var UpdateEmployeeCompetencesRow = $('#UpdateEmployeeCompetencesRow');
    var UpdateEmployeeCompetencesButton = $('#UpdateEmployeeCompetencesButton');

    var UpdateEmployeeTasksRow = $('#UpdateEmployeeTasksRow');
    var UpdateEmployeeTasksButton = $('#UpdateEmployeeTasksButton');

    var UpdateEmployeeWorkTasksRow = $('#UpdateEmployeeWorkTasksRow');
    var UpdateEmployeeWorkTasksButton = $('#UpdateEmployeeWorkTasksButton');

    var UpdateEmployeeGroupTasksRow = $('#UpdateEmployeeGroupTasksRow');
    var UpdateEmployeeGroupTasksButton = $('#UpdateEmployeeGroupTasksButton');

    var SelectAllEmployeesButton = $('#SelectAllEmployeesButton');
    var DeSelectAllEmployeesButton = $('#DeSelectAllEmployeesButton');

    var updateEmployeeJobDepartmentJobDepartmentId = $('#update_employee_job_department_job_department_id');
    var UpdateEmployeeJobDepartmentButton = $('#UpdateEmployeeJobDepartmentButton');

    var setEmployeeScriptScriptCode = $('#set_employee_script_script_code');
    var SetEmployeeScriptButton = $('#SetEmployeeScriptButton');

    var setEmployeeDataScanningDataScanningCode = $('#set_employee_data_scanning_data_scanning_code');
    var SetEmployeeDataScanningButton = $('#SetEmployeeDataScanningButton');

    var setEmployeeOtsLockTypeInput = $('#set_employee_ots_lock_type');
    var SetEmployeeOtsLockTypeButton = $('#SetEmployeeOtsLockTypeButton');

    var setEmployeeWorkToDoTypeJobCodeInput = $('#set_employee_work_to_do_type_job_code');
    var SetEmployeeWorkToDoTypeButton = $('#SetEmployeeWorkToDoTypeButton');

    var leaveEmployeeLeavingReasonId = $('#leave_employee_leaving_reason_id');
    var LeaveEmployeeButton = $('#LeaveEmployeeButton');

    var keyword = $('#keyword');
    var selectedEmployees = [];

    var employeesRow = $('#employeesRow');
    var jobDepartmentFilterer = $('#jobDepartmentFilterer');

    var createEmployeeCompanyId = $('#create_employee_company_id');
    var updateEmployeeCompanyId = $('#update_employee_company_id');
    var createEmployeeTasksRow = $('#createEmployeeTasks');
    var createEmployeeWorkTasksRow = $('#createEmployeeWorkTasks');
    var createEmployeeGroupTasksRow = $('#createEmployeeGroupTasks');
    var createEmployeeShiftGroups = $('#create_employee_shift_groups');
    var createEmployeeShiftGroupId = $('#create_employee_shift_group_id');
    var createEmployeeJobDepartmentId = $('#create_employee_job_department_id');

    var CreateEmployeeButton = $('#CreateEmployeeButton');

    var employeesGridDiv = $('#employeesGrid');

    function filterEmployees() {
        var employees = $('.employeeCard');
        $.each(employees, function (i, employeeCard) {
            var employeeName = $(employeeCard).data('name');
            var filterStatus = false;
            var employeeJobDepartment = $(employeeCard).attr('data-job-department');
            var jobDepartmentsFromFilterer = jobDepartmentFilterer.val();

            if (jobDepartmentsFromFilterer.length > 0) {
                $.each(jobDepartmentsFromFilterer, function (i, jobDepartmentFromFilterer) {
                    if (parseInt(employeeJobDepartment) === parseInt(jobDepartmentFromFilterer)) {
                        filterStatus = true;
                    }
                });
            } else {
                filterStatus = true;
            }

            if (
                employeeName.toLowerCase().includes(keyword.val().toLowerCase()) && filterStatus
            ) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        });
    }

    function setSelectedEmployees() {
        var getSelectedEmployees = $('.selectedEmployee');
        selectedEmployees = [];
        $.each(getSelectedEmployees, function () {
            selectedEmployees.push({
                id: $(this).data('id'),
                guid: $(this).data('guid')
            });
        });
    }

    function SortByName(a, b) {
        var aName = a.name.toLowerCase();
        var bName = b.name.toLowerCase();
        return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
    }

    // Operations

    function operations() {
        if (selectedEmployees.length > 0) {
            $('#operationsBatchActions').show();
        } else {
            $('#operationsBatchActions').hide();
        }
        $('#OperationsModal').modal('show');
    }

    function createEmployee() {
        createEmployeeCompanyId.val('');
        $('#create_employee_name').val('');
        $('#create_employee_email').val('');
        createEmployeeJobDepartmentId.val('');
        $('#create_employee_santral_code').val('');
        $('#create_employee_web_crm_user_id').val('');
        $('#create_employee_web_crm_username').val('');
        $('#create_employee_web_crm_password').val('');
        $('#create_employee_progress_crm_username').val('');
        $('#create_employee_progress_crm_password').val('');
        $('#create_employee_uyum_satis_api_crm_username').val('');
        $('#create_employee_uyum_satis_api_crm_user_password').val('');
        $('.createEmployeeTaskCheckbox').prop('checked', false);
        $('.createEmployeeWorkTaskCheckbox').prop('checked', false);
        $('.createEmployeeGroupTaskCheckbox').prop('checked', false);
        createEmployeeShiftGroupId.val('');
        CreateEmployeeWizardStepper.goFirst();
        $('#CreateEmployeeModal').modal('show');
    }

    function getEmployeeReport() {
        $('#GetEmployeeReportModal').modal('show');
    }

    function setEmployeeScript() {
        $('#SetEmployeeScriptModal').modal('show');
    }

    function setEmployeeDataScanning() {
        $('#SetEmployeeDataScanningModal').modal('show');
    }

    function setEmployeeOtsLockType() {
        $('#SetEmployeeOtsLockTypeModal').modal('show');
    }

    function setEmployeeWorkToDoType() {
        $('#SetEmployeeWorkToDoTypeModal').modal('show');
    }

    // Update Methods

    function updateEmployee(id) {
        $('#update_employee_id').val(id);
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#update_employee_company_id').val(response.response.company_id);
                $('#update_employee_name').val(response.response.name);
                $('#update_employee_email').val(response.response.email);
                $('#update_employee_phone').val(response.response.phone);
                $('#update_employee_identity').val(response.response.identity);
                $('#update_employee_santral_code').val(response.response.santral_code);
                $('#update_employee_saturday_permit_exemption').val(response.response.saturday_permit_exemption).trigger('change');
                $.ajax({
                    type: 'get',
                    url: '{{ route('user.api.operationApi.operation.getEmployeeEdit') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        guid: response.response.guid,
                    },
                    success: function (response) {
                        // console.log(response);
                        $('#update_employee_guid').val(response.response[0].id);
                        $('#update_employee_ots_status').val(response.response[0].rol).trigger('change');
                        $('#update_employee_web_crm_user_id').val(response.response[0].uyumCrmUserId);
                        $('#update_employee_web_crm_username').val(response.response[0].uyumCrmUserName);
                        $('#update_employee_web_crm_password').val(response.response[0].uyumCrmUserPassword);
                        $('#update_employee_progress_crm_username').val(response.response[0].uyumProgressUserName);
                        $('#update_employee_progress_crm_password').val(response.response[0].uyumProgressUserPassword);
                        $('#update_employee_marketing_crm_username').val(response.response[0].uyumPlatformKullaniciAdi);
                        $('#update_employee_marketing_crm_password').val(response.response[0].uyumPlatformKullaniciSifre);
                        $('#update_employee_team_code').val(response.response[0].takimKodu);
                        $('#update_employee_group_code').val(response.response[0].grupKodu);
                        $('#update_employee_call_scan_code').val(response.response[0].cagriTaramaKodu);
                        $('#update_employee_uyum_satis_api_crm_username').val(response.response[0].uyumCrmApiUserName);
                        $('#update_employee_uyum_satis_api_crm_user_password').val(response.response[0].uyumCrmApiUserPassword);
                        $('#UpdateEmployeeModal').modal('show');
                        $('#loader').hide();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('OTS Personel Verileri Alınırken Serviste Bir Hata Oluştu!');
                        $('#loader').hide();
                    }
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Verileri Alınırken Serviste Bir Hata Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function skillInventory(id) {
        window.open(`{{ route('user.web.employee.skillInventory') }}/${id}`, '_blank');
    }

    function updateEmployeeQueues(employeeId, employeeName) {
        $('#loader').show();
        $('#update_employee_queues_employee_id').val(employeeId);
        $('#update_employee_queues_employee_name_span').html(employeeName + ' - Çağrı Kuyruklarını Düzenle');
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employeeQueue.getEmployeeQueues') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: employeeId
            },
            success: function (response) {
                var updateEmployeeQueueCheckboxes = $('.updateEmployeeQueueCheckbox');
                updateEmployeeQueueCheckboxes.prop('checked', false);
                $.each(response.response, function (i, employeeQueue) {
                    $.each(updateEmployeeQueueCheckboxes, function (j, updateEmployeeQueueCheckbox) {
                        if (parseInt(employeeQueue.id) === parseInt($(updateEmployeeQueueCheckbox).data('queue-id'))) {
                            $(updateEmployeeQueueCheckbox).prop('checked', true);
                        }
                    });
                });
                $('#UpdateEmployeeQueuesModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Çağrı Kuyrukları Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    }

    function updateEmployeeCompetences(employeeId, employeeName) {
        $('#loader').show();
        $('#update_employee_competences_employee_id').val(employeeId);
        $('#update_employee_competences_employee_name_span').html(employeeName + ' - Yetkinlikleri Düzenle');
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.competenceEmployee.getEmployeeCompetences') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: employeeId
            },
            success: function (response) {
                var updateEmployeeCompetenceCheckboxes = $('.updateEmployeeCompetenceCheckbox');
                updateEmployeeCompetenceCheckboxes.prop('checked', false);
                $.each(response.response, function (i, employeeCompetence) {
                    $.each(updateEmployeeCompetenceCheckboxes, function (j, updateEmployeeCompetenceCheckbox) {
                        if (parseInt(employeeCompetence.id) === parseInt($(updateEmployeeCompetenceCheckbox).data('competence-id'))) {
                            $(updateEmployeeCompetenceCheckbox).prop('checked', true);
                        }
                    });
                });
                $('#UpdateEmployeeCompetencesModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Yetkinlik Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    }

    function updateEmployeeTasks(employeeGuid, employeeName) {
        $('#loader').show();
        $('#update_employee_tasks_employee_guid').val(employeeGuid);
        $('#update_employee_tasks_employee_name_span').html(employeeName + ' - Kuyruk Görevleri Düzenle');
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.operation.getEmployeeTasksEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                guid: employeeGuid
            },
            success: function (response) {
                var updateEmployeeTaskCheckboxes = $('.updateEmployeeTaskCheckbox');
                updateEmployeeTaskCheckboxes.prop('checked', false);
                $.each(response.response, function (i, employeeTask) {
                    $.each(updateEmployeeTaskCheckboxes, function (j, updateEmployeeTaskCheckbox) {
                        if (parseInt(employeeTask.gorevKodu) === parseInt($(updateEmployeeTaskCheckbox).val())) {
                            $(updateEmployeeTaskCheckbox).prop('checked', true);
                        }
                    });
                });
                $('#UpdateEmployeeTasksModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Kuyruk Görevleri Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    }

    function updateEmployeeWorkTasks(employeeGuid, employeeName) {
        $('#loader').show();
        $('#update_employee_work_tasks_employee_guid').val(employeeGuid);
        $('#update_employee_work_tasks_employee_name_span').html(employeeName + ' - İş Görevleri Düzenle');
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.operation.getEmployeeWorkTasksEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                guid: employeeGuid
            },
            success: function (response) {
                var updateEmployeeWorkTaskCheckboxes = $('.updateEmployeeWorkTaskCheckbox');
                updateEmployeeWorkTaskCheckboxes.prop('checked', false);
                $.each(response.response, function (i, employeeWorkTask) {
                    $.each(updateEmployeeWorkTaskCheckboxes, function (j, updateEmployeeWorkTaskCheckbox) {
                        if (parseInt(employeeWorkTask.gorevKodu) === parseInt($(updateEmployeeWorkTaskCheckbox).val())) {
                            $(updateEmployeeWorkTaskCheckbox).prop('checked', true);
                        }
                    });
                });
                $('#UpdateEmployeeWorkTasksModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Kuyruk Görevleri Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    }

    function updateEmployeeGroupTasks(employeeGuid, employeeName) {
        $('#loader').show();
        $('#update_employee_group_tasks_employee_guid').val(employeeGuid);
        $('#update_employee_group_tasks_employee_name_span').html(employeeName + ' - Grupları Düzenle');
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.operation.getEmployeeGroupTasksEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                guid: employeeGuid
            },
            success: function (response) {
                console.log(response);
                var updateEmployeeGroupTaskCheckboxes = $('.updateEmployeeGroupTaskCheckbox');
                updateEmployeeGroupTaskCheckboxes.prop('checked', false);
                $.each(response.response, function (i, employeeGroupTask) {
                    $.each(updateEmployeeGroupTaskCheckboxes, function (j, updateEmployeeGroupTaskCheckbox) {
                        if (parseInt(employeeGroupTask.uyumCrmGrupId) === parseInt($(updateEmployeeGroupTaskCheckbox).val())) {
                            $(updateEmployeeGroupTaskCheckbox).prop('checked', true);
                        }
                    });
                });
                $('#UpdateEmployeeGroupTasksModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Grupları Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    }

    function updateEmployeeJobDepartment(employeeId, employeeName) {
        $('#loader').show();
        $('#update_employee_job_department_employee_id').val(employeeId);
        $('#update_employee_job_department_employee_name_span').html(employeeName + ' - Departman Düzenle');
        updateEmployeeJobDepartmentJobDepartmentId.val($(`#${employeeId}_employeeCard`).attr('data-job-department'));
        $('#UpdateEmployeeJobDepartmentModal').modal('show');
        setTimeout(function () {
            $('#loader').hide();
        }, 500);
    }

    function updateEarthquakeInformation(employeeId, employeeGuid, employeeName) {
        window.open(`{{ route('user.web.employee.specialInformation') }}/${employeeId}`, '_blank');
    }

    function leaveEmployee(employeeId, employeeGuid, employeeName) {
        $('#leave_employee_employee_id').val(employeeId);
        $('#leave_employee_employee_guid').val(employeeGuid);
        $('#leave_employee_employee_name_span').text(`${employeeName} - İşten Çıkar`);
        $('#leave_employee_leaving_date').val('');
        leaveEmployeeLeavingReasonId.val('').trigger('change');
        $('#LeaveEmployeeModal').modal('show');
    }

    // Get Methods

    function getEmployees() {
        $('#loader').show();
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
                pageSize: 10000,
                leave: 0
            },
            success: function (response) {
                var employeeInfoRoute = '{{ route('user.web.employee.info.stats') }}';
                var employees = response.response.employees;
                var operationEmployees = [];

                $.each(companyIds, function (i, companyId) {
                    $.ajax({
                        async: false,
                        type: 'get',
                        url: '{{ route('user.api.operationApi.operation.getUserList') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            companyId: companyId
                        },
                        success: function (response) {
                            $.each(response.response, function (i, operationEmployee) {
                                operationEmployees.push(operationEmployee);
                            });
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });

                $.each(employees, function (i, employee) {
                    $.each(operationEmployees, function (j, operationEmployee) {
                        if (parseInt(operationEmployee.id) === parseInt(employee.guid)) {
                            employee.operationEmployee = operationEmployee;
                            return false;
                        }
                    });
                });

                employees.sort(SortByName);
                employeesForJqxGrid = [];

                var avatar = '{{ asset('assets/media/logos/avatar.png') }}';
                employeesRow.empty();
                $.each(employees, function (i, employee) {
                    employeesForJqxGrid.push({
                        name: employee.name,
                        company: employee.company ? employee.company.title : '',
                        job_department: employee.job_department ? employee.job_department.name : '',
                        identity: employee.identity,
                        email: employee.email,
                        santral_code: employee.santral_code,
                    });

                    var eBadge = 'warning';
                    var gBadge = 'warning';
                    var tBadge = 'warning';
                    var yBadge = 'warning';

                    if (employee.image) {
                        avatar = employee.image;
                    }
                    if (employee.operationEmployee) {
                        if (parseInt(employee.operationEmployee.yetkiEgitim) === 1) {
                            eBadge = 'success';
                        }
                        if (parseInt(employee.operationEmployee.yetkiGorevlendirme) === 1) {
                            gBadge = 'success';
                        }
                        if (parseInt(employee.operationEmployee.takimLideri) === 1) {
                            tBadge = 'success';
                        }
                        if (parseInt(employee.operationEmployee.takimLideriYardimcisi) === 1) {
                            yBadge = 'success';
                        }
                    }

                    employeesRow.append(`
                    <div class="col-xl-3 col-12 employeeCard" id="${employee.id}_employeeCard" data-id="${employee.id}" data-guid="${employee.guid}" data-name="${employee.name}" data-job-department="${employee.job_department ? employee.job_department.id : 0}">
                        <div class="card mb-5 mb-xl-8">
                            <div class="card-header border-0 py-0 mt-n4 mb-n7">
                                <div class="card-toolbar">
                                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" id="${employee.id}_dropdown_menu" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"></rect>
                                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                                </g>
                                            </svg>
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-250px" aria-labelledby="${employee.id}_dropdown_menu">
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Düzenle</div>
                                        </div>
                                        <div class="separator mb-3 opacity-75"></div>
                                         ${updateEmployeePermission === 'true' ? `
                                         <div class="menu-item px-3">
                                             <a onclick="updateEmployee(${employee.id})" class="menu-link px-3">Personeli Düzenle</a>
                                         </div>
                                         <hr>
                                         ` : ``}
                                         <div class="menu-item px-3">
                                             <a onclick="skillInventory(${employee.id})" class="menu-link px-3">Beceri Envanteri</a>
                                         </div>
                                         <hr>
                                         ${updateEmployeeQueuesPermission === 'true' ? `
                                         <div class="menu-item px-3">
                                             <a onclick="updateEmployeeQueues(${employee.id}, '${employee.name}')" class="menu-link px-3">Çağrı Kuyrukları</a>
                                         </div>
                                         ` : ``}
                                         ${updateEmployeeCompetencesPermission === 'true' ? `
                                         <div class="menu-item px-3">
                                             <a onclick="updateEmployeeCompetences(${employee.id}, '${employee.name}')" class="menu-link px-3">Yetkinlikler</a>
                                         </div>
                                         ` : ``}
                                         ${updateEmployeeTasksPermission === 'true' ? `
                                         <div class="menu-item px-3">
                                             <a onclick="updateEmployeeTasks(${employee.guid}, '${employee.name}')" class="menu-link px-3">Kuyruk Görevleri</a>
                                         </div>
                                         ` : ``}
                                         ${updateEmployeeWorkTasksPermission === 'true' ? `
                                         <div class="menu-item px-3">
                                             <a onclick="updateEmployeeWorkTasks(${employee.guid}, '${employee.name}')" class="menu-link px-3">İş Görevleri</a>
                                         </div>
                                         ` : ``}
                                         ${updateEmployeeGroupsPermission === 'true' ? `
                                         <div class="menu-item px-3">
                                             <a onclick="updateEmployeeGroupTasks(${employee.guid}, '${employee.name}')" class="menu-link px-3">Gruplar</a>
                                         </div>
                                         ` : ``}
                                         ${updateEmployeeJobDepartmentPermission === 'true' ? `
                                         <div class="menu-item px-3 pb-3">
                                             <a onclick="updateEmployeeJobDepartment(${employee.id}, '${employee.name}')" class="menu-link px-3">Departman</a>
                                         </div>
                                         ` : ``}
                                         <hr>
                                         <div class="menu-item px-3">
                                             <a onclick="updateEarthquakeInformation(${employee.id}, ${employee.guid}, '${employee.name}')" class="menu-link px-3">Özel Bilgiler</a>
                                         </div>
                                         ${leaveEmployeePermission === 'true' ? `
                                         <hr>
                                         <div class="menu-item px-3 pb-3">
                                             <a onclick="leaveEmployee(${employee.id}, ${employee.guid}, '${employee.name}')" class="menu-link px-3">İşten Çıkar</a>
                                         </div>
                                         ` : ``}
                                      </ul>
                                </div>
                                <div class="card-toolbar">
                                    <a href="${employeeInfoRoute}/${employee.id}" target="_blank" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M17.7 5.59999C16.7 5.19999 15.5 5.50003 14.8 6.20003L10.2 10.8C9.5 11.5 8.4 11.8 7.5 11.5L5.10001 10.8V18.9H20.1V6.40004L17.7 5.59999Z" fill="black"/>
                                                <path d="M21 18H6V3C6 2.4 5.6 2 5 2C4.4 2 4 2.4 4 3V18H3C2.4 18 2 18.4 2 19C2 19.6 2.4 20 3 20H4V21C4 21.6 4.4 22 5 22C5.6 22 6 21.6 6 21V20H21C21.6 20 22 19.6 22 19C22 18.4 21.6 18 21 18Z" fill="black"/>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-5 text-center">
                                    <div class="symbol symbol-100px symbol-circle mb-7 employeeSelector" data-id="${employee.id}" data-guid="${employee.guid}">
                                        <img src="${avatar}" alt="image">
                                    </div>
                                    <br>
                                    <a class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1 cursor-pointer">${employee.name}</a>
                                    <div class="fs-6 fw-bold text-muted mb-2 text-center" id="employee_${employee.id}_job_department_span">
                                        ${employee.job_department ? employee.job_department.name : ''}
                                    </div>
                                    <div class="fs-6 fw-bold text-muted">
                                        <i class="fas fa-headset"></i><span class="ms-3">${employee.santral_code ?? '--'}</span>
                                    </div>
                                    <div class="fs-6 fw-bold text-muted">
                                        <span class="fw-bolder">Yapılacak İş Kodu: </span><span>${employee.operationEmployee ? `${employee.operationEmployee.yapilacakIslerKodu ?? ``}` : ``}</span>
                                    </div>
                                </div>
                                <div class="separator separator-dashed my-5"></div>
                                <div class="d-flex flex-center">
                                    <div id="${employee.guid}_eBadge" class="badge badge-${eBadge} badge-circle cursor-pointer eBadge badgeTooltip" data-employee-id="${employee.id}" data-employee-guid="${employee.guid}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eğitim Yetkisini Güncellemek İçin Tıklayın">E</div>
                                    <div id="${employee.guid}_gBadge" class="badge badge-${gBadge} badge-circle cursor-pointer gBadge ms-2 badgeTooltip" data-employee-id="${employee.id}" data-employee-guid="${employee.guid}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Görevlendirme Yetkisini Güncellemek İçin Tıklayın">G</div>
                                    <div id="${employee.guid}_tBadge" class="badge badge-${tBadge} badge-circle cursor-pointer tBadge ms-2 badgeTooltip" data-employee-id="${employee.id}" data-employee-guid="${employee.guid}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Takım Lideri Yetkisini Güncellemek İçin Tıklayın">T</div>
                                    <div id="${employee.guid}_yBadge" class="badge badge-${yBadge} badge-circle cursor-pointer yBadge ms-2 badgeTooltip" data-employee-id="${employee.id}" data-employee-guid="${employee.guid}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Takım Lider Yardımcısı Yetkisini Güncellemek İçin Tıklayın">Y</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });

                var badgeTooltips = $('.badgeTooltip');
                $.each(badgeTooltips, function () {
                    $(this).tooltip();
                });

                var employeesSource = {
                    localdata: employeesForJqxGrid,
                    datatype: "array",
                    datafields: [
                        {name: 'name', type: 'string'},
                        {name: 'company', type: 'string'},
                        {name: 'job_department', type: 'string'},
                        {name: 'identity', type: 'string'},
                        {name: 'email', type: 'string'},
                        {name: 'santral_code', type: 'string'},
                    ]
                };
                var employeesDataAdapter = new $.jqx.dataAdapter(employeesSource);
                employeesGridDiv.jqxGrid({
                    width: '100%',
                    height: '500',
                    source: employeesDataAdapter,
                    columnsresize: true,
                    groupable: true,
                    theme: jqxGridGlobalTheme,
                    filterable: true,
                    showfilterrow: true,
                    localization: getLocalization('tr'),
                    columns: [
                        {
                            text: 'Personel',
                            dataField: 'name',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Şirket',
                            dataField: 'company',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Departman',
                            dataField: 'job_department',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Kimlik Numarası',
                            dataField: 'identity',
                            columntype: 'textbox',
                        },
                        {
                            text: 'E-posta Adresi',
                            dataField: 'email',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Santral Dahilisi',
                            dataField: 'santral_code',
                            columntype: 'textbox',
                        }
                    ]
                });
                employeesGridDiv.on('contextmenu', function () {
                    return false;
                });
                employeesGridDiv.on('rowclick', function (event) {
                    if (event.args.rightclick) {
                        $("#employeesGrid").jqxGrid('selectrow', event.args.rowindex);
                        var scrollTop = $(window).scrollTop();
                        var scrollLeft = $(window).scrollLeft();
                        contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                        return false;
                    }
                });
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
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
                jobDepartmentFilterer.empty();
                updateEmployeeJobDepartmentJobDepartmentId.empty();
                $.each(response.response.jobDepartments, function (index, jobDepartment) {
                    jobDepartmentFilterer.append(`
                    <option value="${jobDepartment.id}">${jobDepartment.name}</option>
                    `);
                    updateEmployeeJobDepartmentJobDepartmentId.append(`
                    <option value="${jobDepartment.id}">${jobDepartment.name}</option>
                    `);
                    createEmployeeJobDepartmentId.append(`
                    <option value="${jobDepartment.id}">${jobDepartment.name}</option>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
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
                createEmployeeCompanyId.empty();
                updateEmployeeCompanyId.empty();
                $.each(response.response, function (i, company) {
                    createEmployeeCompanyId.append(`<option value="${company.id}">${company.title}</option>`);
                    updateEmployeeCompanyId.append(`<option value="${company.id}">${company.title}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Firma Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getQueues() {
        var companyIds = SelectedCompanies.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.queue.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: 0,
                pageSize: 1000,
            },
            success: function (response) {
                UpdateEmployeeQueuesRow.empty();
                $.each(response.response.queues, function (i, queue) {
                    UpdateEmployeeQueuesRow.append(`
                    <div class="col-xl-6 mb-5">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input updateEmployeeQueueCheckbox" type="checkbox" data-queue-id="${queue.id}" value="${queue.id}" id="updateEmployeeQueueCheckbox_${queue.id}">
                            <label class="form-check-label" for="updateEmployeeQueueCheckbox_${queue.id}">${queue.name}</label>
                        </div>
                    </div>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Çağrı Kuyruğu Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getCompetences() {
        var companyIds = SelectedCompanies.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.competence.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: 0,
                pageSize: 1000,
            },
            success: function (response) {
                UpdateEmployeeCompetencesRow.empty();
                $.each(response.response.competences, function (i, competence) {
                    UpdateEmployeeCompetencesRow.append(`
                    <div class="col-xl-6 mb-5">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input updateEmployeeCompetenceCheckbox" type="checkbox" data-competence-id="${competence.id}" value="${competence.id}" id="updateEmployeeCompetenceCheckbox_${competence.id}">
                            <label class="form-check-label" for="updateEmployeeCompetenceCheckbox_${competence.id}">${competence.name}</label>
                        </div>
                    </div>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Yetkinlik Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
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
                createEmployeeShiftGroups.empty();
                createEmployeeShiftGroupId.empty();
                $.each(response.response.shiftGroups, function (i, shiftGroup) {
                    createEmployeeShiftGroups.append(`<option value="${shiftGroup.id}">${shiftGroup.name}</option>`);
                    createEmployeeShiftGroupId.append(`<option value="${shiftGroup.id}">${shiftGroup.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Vardiya Grubu Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getEmployeeTasks() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.operation.getEmployeeTasks') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                UpdateEmployeeTasksRow.empty();
                $.each(response.response, function (i, employeeTask) {
                    UpdateEmployeeTasksRow.append(`
                    <div class="col-xl-6 mb-5">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input updateEmployeeTaskCheckbox" type="checkbox" data-crm-group-code="${employeeTask.uyumCrmGrupKodu}" data-crm-lost-group-code="${employeeTask.uyumCrmKayipGrupKodu}" value="${employeeTask.kodu}" id="updateEmployeeTaskCheckbox_${employeeTask.kodu}">
                            <label class="form-check-label" for="updateEmployeeTaskCheckbox_${employeeTask.kodu}">${employeeTask.adi}</label>
                        </div>
                    </div>
                    `);
                    createEmployeeTasksRow.append(`
                    <div class="col-xl-6 mb-5">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input createEmployeeTaskCheckbox" type="checkbox" data-crm-group-code="${employeeTask.uyumCrmGrupKodu}" data-crm-lost-group-code="${employeeTask.uyumCrmKayipGrupKodu}" value="${employeeTask.kodu}" id="createEmployeeTaskCheckbox_${employeeTask.kodu}">
                            <label class="form-check-label" for="createEmployeeTaskCheckbox_${employeeTask.kodu}">${employeeTask.adi}</label>
                        </div>
                    </div>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kuyruk Görevleri Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getEmployeeWorkTasks() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.operation.getEmployeeWorkTasks') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                UpdateEmployeeWorkTasksRow.empty();
                $.each(response.response, function (i, employeeWorkTask) {
                    UpdateEmployeeWorkTasksRow.append(`
                    <div class="col-xl-6 mb-5">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input updateEmployeeWorkTaskCheckbox" type="checkbox" value="${employeeWorkTask.kodu}" id="updateEmployeeWorkTaskCheckbox_${employeeWorkTask.kodu}">
                            <label class="form-check-label" for="updateEmployeeWorkTaskCheckbox_${employeeWorkTask.kodu}">${employeeWorkTask.adi}</label>
                        </div>
                    </div>
                    `);
                    createEmployeeWorkTasksRow.append(`
                    <div class="col-xl-6 mb-5">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input createEmployeeWorkTaskCheckbox" type="checkbox" value="${employeeWorkTask.kodu}" id="createEmployeeWorkTaskCheckbox_${employeeWorkTask.kodu}">
                            <label class="form-check-label" for="createEmployeeWorkTaskCheckbox_${employeeWorkTask.kodu}">${employeeWorkTask.adi}</label>
                        </div>
                    </div>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('İş Görevleri Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getEmployeeGroupTasks() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.operation.getEmployeeGroupTasks') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                UpdateEmployeeGroupTasksRow.empty();
                $.each(response.response, function (i, employeeGroupTask) {
                    UpdateEmployeeGroupTasksRow.append(`
                    <div class="col-xl-6 mb-5">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input updateEmployeeGroupTaskCheckbox" type="checkbox" value="${employeeGroupTask.kodu}" id="updateEmployeeGroupTaskCheckbox_${employeeGroupTask.kodu}">
                            <label class="form-check-label" for="updateEmployeeGroupTaskCheckbox_${employeeGroupTask.kodu}">${employeeGroupTask.adi}</label>
                        </div>
                    </div>
                    `);
                    createEmployeeGroupTasksRow.append(`
                    <div class="col-xl-6 mb-5">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input createEmployeeGroupTaskCheckbox" type="checkbox" value="${employeeGroupTask.kodu}" id="createEmployeeGroupTaskCheckbox_${employeeGroupTask.kodu}">
                            <label class="form-check-label" for="createEmployeeGroupTaskCheckbox_${employeeGroupTask.kodu}">${employeeGroupTask.adi}</label>
                        </div>
                    </div>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Gruplar Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getLeavingReasons() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.leavingReason.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                leaveEmployeeLeavingReasonId.empty();
                $.each(response.response, function (i, leavingReason) {
                    leaveEmployeeLeavingReasonId.append(`
                    <option value="${leavingReason.id}">${leavingReason.id} - ${leavingReason.name}</option>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşten Çıkarma Nedenleri Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    // Get Operation Methods

    function getScripts() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                var scripts = response.response;
                scripts.sort((a, b) => b.id - a.id);
                setEmployeeScriptScriptCode.empty();
                $.each(scripts, function (i, survey) {
                    setEmployeeScriptScriptCode.append(`<option value="${survey.kodu}">(${survey.kodu}) - ${survey.adi}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Script Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getDataScannings() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.personSystem.getPersonDataScanList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                setEmployeeDataScanningDataScanningCode.empty();
                $.each(response.response, function (i, dataScanning) {
                    setEmployeeDataScanningDataScanningCode.append(`<option value="${dataScanning.grupKodu}">${dataScanning.grupAdi}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Data Tarama Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getCompanies();
    getQueues();
    getCompetences();
    getShiftGroups();
    getEmployeeTasks();
    getEmployeeWorkTasks();
    getEmployeeGroupTasks();
    getLeavingReasons();
    getScripts();
    getDataScannings();
    getEmployees();
    getJobDepartments();

    SelectedCompanies.change(function () {
        getQueues();
        getCompetences();
        getEmployeeTasks();
        getEmployeeWorkTasks();
        getEmployeeGroupTasks();
        getEmployees();
        getJobDepartments();
    });

    $(document).delegate('.employeeSelector', 'click', function () {
        $(this).toggleClass('selectedEmployee');
        setSelectedEmployees();
    });

    keyword.keyup(function () {
        filterEmployees();
    });

    jobDepartmentFilterer.change(function () {
        filterEmployees();
    });

    $(document).delegate('.eBadge', 'click', function () {
        var badge = $(this);
        var guid = badge.data('employee-guid');
        var guids = [guid];
        var education = badge.hasClass('badge-success') ? 0 : 1;
        var assignment = $(`#${guid}_gBadge`).hasClass('badge-success') ? 1 : 0;
        var teamLead = $(`#${guid}_tBadge`).hasClass('badge-success') ? 1 : 0;
        var teamLeadAssistant = $(`#${guid}_yBadge`).hasClass('badge-success') ? 1 : 0;
        badge.html(`<i class="fa fa-spinner fa-spin"></i>`);
        toastr.info('Eğitim Yetkisi Güncelleniyor, Lütfen Bekleyiniz...');
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.personSystem.setPersonAuthority') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                guids: guids,
                education: education,
                assignment: assignment,
                teamLead: teamLead,
                teamLeadAssistant: teamLeadAssistant
            },
            success: function () {
                badge.html('E');
                education === 0 ? badge.removeClass('badge-success').addClass('badge-warning') : badge.removeClass('badge-warning').addClass('badge-success');
            },
            error: function (error) {
                console.log(error);
                badge.html('E');
                toastr.error('Personel Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    });

    $(document).delegate('.gBadge', 'click', function () {
        var badge = $(this);
        var guid = badge.data('employee-guid');
        var guids = [guid];
        var education = $(`#${guid}_eBadge`).hasClass('badge-success') ? 1 : 0;
        var assignment = badge.hasClass('badge-success') ? 0 : 1;
        var teamLead = $(`#${guid}_tBadge`).hasClass('badge-success') ? 1 : 0;
        var teamLeadAssistant = $(`#${guid}_yBadge`).hasClass('badge-success') ? 1 : 0;
        badge.html(`<i class="fa fa-spinner fa-spin"></i>`);
        toastr.info('Görevlendirme Yetkisi Güncelleniyor, Lütfen Bekleyiniz...');
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.personSystem.setPersonAuthority') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                guids: guids,
                education: education,
                assignment: assignment,
                teamLead: teamLead,
                teamLeadAssistant: teamLeadAssistant
            },
            success: function () {
                badge.html('G');
                assignment === 0 ? badge.removeClass('badge-success').addClass('badge-warning') : badge.removeClass('badge-warning').addClass('badge-success');
            },
            error: function (error) {
                console.log(error);
                badge.html('G');
                toastr.error('Personel Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    });

    $(document).delegate('.tBadge', 'click', function () {
        var badge = $(this);
        var guid = badge.data('employee-guid');
        var guids = [guid];
        var education = $(`#${guid}_eBadge`).hasClass('badge-success') ? 1 : 0;
        var assignment = $(`#${guid}_gBadge`).hasClass('badge-success') ? 1 : 0;
        var teamLead = badge.hasClass('badge-success') ? 0 : 1;
        var teamLeadAssistant = $(`#${guid}_yBadge`).hasClass('badge-success') ? 1 : 0;
        badge.html(`<i class="fa fa-spinner fa-spin"></i>`);
        toastr.info('Takım Lideri Yetkisi Güncelleniyor, Lütfen Bekleyiniz...');
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.personSystem.setPersonAuthority') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                guids: guids,
                education: education,
                assignment: assignment,
                teamLead: teamLead,
                teamLeadAssistant: teamLeadAssistant
            },
            success: function () {
                badge.html('T');
                teamLead === 0 ? badge.removeClass('badge-success').addClass('badge-warning') : badge.removeClass('badge-warning').addClass('badge-success');
            },
            error: function (error) {
                console.log(error);
                badge.html('T');
                toastr.error('Personel Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    });

    $(document).delegate('.yBadge', 'click', function () {
        var badge = $(this);
        var guid = badge.data('employee-guid');
        var guids = [guid];
        var education = $(`#${guid}_eBadge`).hasClass('badge-success') ? 1 : 0;
        var assignment = $(`#${guid}_gBadge`).hasClass('badge-success') ? 1 : 0;
        var teamLead = $(`#${guid}_tBadge`).hasClass('badge-success') ? 1 : 0;
        var teamLeadAssistant = badge.hasClass('badge-success') ? 0 : 1;
        badge.html(`<i class="fa fa-spinner fa-spin"></i>`);
        toastr.info('Takım Lideri Yardımcısı Yetkisi Güncelleniyor, Lütfen Bekleyiniz...');
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.personSystem.setPersonAuthority') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                guids: guids,
                education: education,
                assignment: assignment,
                teamLead: teamLead,
                teamLeadAssistant: teamLeadAssistant
            },
            success: function () {
                badge.html('Y');
                teamLeadAssistant === 0 ? badge.removeClass('badge-success').addClass('badge-warning') : badge.removeClass('badge-warning').addClass('badge-success');
            },
            error: function (error) {
                console.log(error);
                badge.html('Y');
                toastr.error('Personel Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    });

    SelectAllEmployeesButton.click(function () {
        var employees = $('.employeeCard');
        $.each(employees, function () {
            if (!$(this).hasClass('d-none')) {
                $(this).find('.employeeSelector').addClass('selectedEmployee');
            }
        });
        setSelectedEmployees();
    });

    DeSelectAllEmployeesButton.click(function () {
        var employees = $('.employeeCard');
        $.each(employees, function () {
            if (!$(this).hasClass('d-none')) {
                $(this).find('.employeeSelector').removeClass('selectedEmployee');
            }
        });
        setSelectedEmployees();
    });

    UpdateEmployeeButton.click(function () {
        var id = $('#update_employee_id').val();
        var guid = $('#update_employee_guid').val();
        var companyId = $('#update_employee_company_id').val();
        var name = $('#update_employee_name').val();
        var email = $('#update_employee_email').val();
        var phone = $('#update_employee_phone').val();
        var identity = $('#update_employee_identity').val();
        var santralCode = $('#update_employee_santral_code').val();
        var saturdayPermitExemption = $('#update_employee_saturday_permit_exemption').val();
        var otsStatus = $('#update_employee_ots_status').val();
        var webCrmUserId = $('#update_employee_web_crm_user_id').val();
        var webCrmUsername = $('#update_employee_web_crm_username').val();
        var webCrmUserPassword = $('#update_employee_web_crm_password').val();
        var progressCrmUsername = $('#update_employee_progress_crm_username').val();
        var progressCrmPassword = $('#update_employee_progress_crm_password').val();
        var marketingCrmUsername = $('#update_employee_marketing_crm_username').val();
        var marketingCrmPassword = $('#update_employee_marketing_crm_password').val();
        var teamCode = $('#update_employee_team_code').val();
        var groupCode = $('#update_employee_group_code').val();
        var callScanCode = $('#update_employee_call_scan_code').val();
        var uyumSatisApiCrmUserName = $('#update_employee_uyum_satis_api_crm_username').val();
        var uyumSatisApiCrmUserPassword = $('#update_employee_uyum_satis_api_crm_user_password').val();

        if (!id || !guid || !companyId) {
            toastr.warning('Personel Seçiminde Bir Sorun Var. Ekranı Yenileyip Tekrar Deneyin.');
        } else if (!name) {
            toastr.warning('Personel Adı Boş Olamaz.');
        } else if (!email) {
            toastr.warning('Personel E-Posta Boş Olamaz.');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.employee.getByEmail') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    email: email,
                },
                success: function (response) {
                    if (response.response != null && parseInt(response.response.id) !== parseInt(id)) {
                        toastr.warning('Bu E-Posta Adresi Kullanılamaz!');
                    } else {
                        if (!otsStatus) {
                            toastr.warning('OTS Durumu Boş Olamaz.');
                        } else if (!webCrmUserId) {
                            toastr.warning('Web CRM Kullanıcı ID Boş Olamaz.');
                        } else if (!webCrmUsername) {
                            toastr.warning('Web CRM Kullanıcı Adı Boş Olamaz.');
                        } else if (!webCrmUserPassword) {
                            toastr.warning('Web CRM Şifresi Boş Olamaz.');
                        } else if (!progressCrmUsername) {
                            toastr.warning('Progress CRM Kullanıcı Adı Boş Olamaz.');
                        } else if (!progressCrmPassword) {
                            toastr.warning('Progress CRM Şifresi Boş Olamaz.');
                        } else if (!marketingCrmUsername) {
                            toastr.warning('Satış CRM Kullanıcı Adı Boş Olamaz.');
                        } else if (!marketingCrmPassword) {
                            toastr.warning('Satış CRM Şifre Boş Olamaz.');
                        } else if (!teamCode) {
                            toastr.warning('Takım Kodu Boş Olamaz.');
                        } else if (!groupCode) {
                            toastr.warning('Grup Kodu Boş Olamaz.');
                        } else if (!callScanCode) {
                            toastr.warning('Çağrı Tara Kodu Boş Olamaz.');
                        } else {
                            UpdateEmployeeButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
                            $.ajax({
                                type: 'post',
                                url: '{{ route('user.api.operationApi.operation.setEmployee') }}',
                                headers: {
                                    'Accept': 'application/json',
                                    'Authorization': token
                                },
                                data: {
                                    id: guid,
                                    companyId: companyId,
                                    name: name,
                                    email: email,
                                    santralCode: santralCode,
                                    role: otsStatus,
                                    webCrmUserId: webCrmUserId,
                                    webCrmUsername: webCrmUsername,
                                    webCrmUserPassword: webCrmUserPassword,
                                    progressCrmUsername: progressCrmUsername,
                                    progressCrmPassword: progressCrmPassword,
                                    marketingCrmUsername: marketingCrmUsername,
                                    marketingCrmPassword: marketingCrmPassword,
                                    teamCode: teamCode,
                                    groupCode: groupCode,
                                    callScanCode: callScanCode,
                                    uyumSatisApiCrmUserName: uyumSatisApiCrmUserName,
                                    uyumSatisApiCrmUserPassword: uyumSatisApiCrmUserPassword
                                },
                                success: function (response) {
                                    console.log(response);
                                    $.ajax({
                                        type: 'put',
                                        url: '{{ route('user.api.employee.update') }}',
                                        headers: {
                                            'Accept': 'application/json',
                                            'Authorization': token
                                        },
                                        data: {
                                            id: id,
                                            name: name,
                                            email: email,
                                            phone: phone,
                                            identity: identity,
                                            santralCode: santralCode,
                                            saturdayPermitExemption: saturdayPermitExemption,
                                        },
                                        success: function () {
                                            toastr.success('Personel Başarıyla Güncellendi.');
                                            UpdateEmployeeButton.prop('disabled', false).html('Güncelle');
                                            $('#UpdateEmployeeModal').modal('hide');
                                        },
                                        error: function (error) {
                                            console.log(error);
                                            toastr.error('Personel Güncellenirken Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                                            UpdateEmployeeButton.prop('disabled', false).html('Güncelle');
                                        }
                                    });
                                },
                                error: function (error) {
                                    console.log(error);
                                    toastr.error('Personel Güncellenirken OTS Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                                    UpdateEmployeeButton.prop('disabled', false).html('Güncelle');
                                }
                            });
                        }
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.warning('E-posta Kontrol Servisinde Bir Hata Var. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                }
            });
        }
    });

    UpdateEmployeeQueuesButton.click(function () {
        $('#loader').show();
        var employeeId = $('#update_employee_queues_employee_id').val();
        var queueIds = [];
        var updateEmployeeQueueCheckboxes = $('.updateEmployeeQueueCheckbox');
        $.each(updateEmployeeQueueCheckboxes, function () {
            if ($(this).is(':checked')) {
                queueIds.push(parseInt($(this).val()));
            }
        });
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.employeeQueue.setEmployeeQueues') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: employeeId,
                queueIds: queueIds
            },
            success: function () {
                toastr.success('Personel Çağrı Kuyrukları Başarıyla Güncellendi.');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Çağrı Kuyrukları Güncellenirken Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    });

    UpdateEmployeeCompetencesButton.click(function () {
        $('#loader').show();
        var employeeId = $('#update_employee_competences_employee_id').val();
        var competenceIds = [];
        var updateEmployeeCompetenceCheckboxes = $('.updateEmployeeCompetenceCheckbox');
        $.each(updateEmployeeCompetenceCheckboxes, function () {
            if ($(this).is(':checked')) {
                competenceIds.push(parseInt($(this).val()));
            }
        });
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.competenceEmployee.setEmployeeCompetences') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: employeeId,
                competenceIds: competenceIds
            },
            success: function () {
                toastr.success('Personel Yetkinlikleri Başarıyla Güncellendi.');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Yetkinlikleri Güncellenirken Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    });

    UpdateEmployeeTasksButton.click(function () {
        $('#loader').show();
        var guid = $('#update_employee_tasks_employee_guid').val();
        var tasks = [];
        var updateEmployeeTaskCheckboxes = $('.updateEmployeeTaskCheckbox');
        $.each(updateEmployeeTaskCheckboxes, function () {
            if ($(this).is(':checked')) {
                tasks.push(parseInt($(this).val()));
            }
        });

        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.operation.setEmployeeTasksInsert') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                guid: guid,
                tasks: tasks
            },
            success: function () {
                toastr.success('Personel Kuyruk Görevleri Başarıyla Güncellendi.');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Kuyruk Görevleri Güncellenirken Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    });

    UpdateEmployeeWorkTasksButton.click(function () {
        $('#loader').show();
        var guid = $('#update_employee_work_tasks_employee_guid').val();
        var workTasks = [];
        var updateEmployeeWorkTaskCheckboxes = $('.updateEmployeeWorkTaskCheckbox');
        $.each(updateEmployeeWorkTaskCheckboxes, function () {
            if ($(this).is(':checked')) {
                workTasks.push(parseInt($(this).val()));
            }
        });

        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.operation.setEmployeeWorkTasksInsert') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                guid: guid,
                workTasks: workTasks
            },
            success: function () {
                toastr.success('Personel İş Görevleri Başarıyla Güncellendi.');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel İş Görevleri Güncellenirken Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    });

    UpdateEmployeeGroupTasksButton.click(function () {
        $('#loader').show();
        var guid = $('#update_employee_group_tasks_employee_guid').val();
        var groupTasks = [];
        var updateEmployeeGroupTaskCheckboxes = $('.updateEmployeeGroupTaskCheckbox');
        $.each(updateEmployeeGroupTaskCheckboxes, function () {
            if ($(this).is(':checked')) {
                groupTasks.push(parseInt($(this).val()));
            }
        });

        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.operation.setEmployeeGroupTasksInsert') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                guid: guid,
                groupTasks: groupTasks
            },
            success: function () {
                toastr.success('Personel Grupları Başarıyla Güncellendi.');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Grupları Güncellenirken Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    });

    UpdateEmployeeJobDepartmentButton.click(function () {
        $('#loader').show();
        var employeeId = $('#update_employee_job_department_employee_id').val();
        var jobDepartmentId = updateEmployeeJobDepartmentJobDepartmentId.val();
        var jobDepartmentName = updateEmployeeJobDepartmentJobDepartmentId.find('option:selected').text();

        $.ajax({
            type: 'post',
            url: '{{ route('user.api.employee.updateJobDepartment') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: employeeId,
                jobDepartmentId: jobDepartmentId
            },
            success: function () {
                toastr.success('Personel Departmanı Başarıyla Güncellendi.');
                $(`#employee_${employeeId}_job_department_span`).html(jobDepartmentName);
                $(`#${employeeId}_employeeCard`).attr('data-job-department', jobDepartmentId);
                filterEmployees();
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Departmanı Güncellenirken Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    });

    SetEmployeeScriptButton.click(function () {
        $('#loader').show();
        var surveyCode = setEmployeeScriptScriptCode.val();
        var guids = [];
        $.each(selectedEmployees, function (i, selectedEmployee) {
            guids.push(selectedEmployee.guid);
        });
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.surveySystem.setSurveyPersonConnect') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                surveyCode: surveyCode,
                guids: guids
            },
            success: function () {
                toastr.success('Personel Scripti Başarıyla Güncellendi.');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Scripti Güncellenirken Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    });

    SetEmployeeDataScanningButton.click(function () {
        $('#loader').show();
        var groupCode = setEmployeeDataScanningDataScanningCode.val();
        var guids = [];
        $.each(selectedEmployees, function (i, selectedEmployee) {
            guids.push(selectedEmployee.guid);
        });
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.personSystem.setPersonDataScan') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                groupCode: groupCode,
                guids: guids
            },
            success: function () {
                toastr.success('Personel Data Taraması Başarıyla Güncellendi.');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Data Taraması Güncellenirken Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    });

    SetEmployeeOtsLockTypeButton.click(function () {
        $('#loader').show();
        var otsLockType = setEmployeeOtsLockTypeInput.val();
        var guids = [];
        $.each(selectedEmployees, function (i, selectedEmployee) {
            guids.push(selectedEmployee.guid);
        });
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.personSystem.setPersonDisplayType') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                otsLockType: otsLockType,
                guids: guids
            },
            success: function () {
                toastr.success('Personel Kilit Ekranı Türü Başarıyla Güncellendi.');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Kilit Ekranı Türü Güncellenirken Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    });

    SetEmployeeWorkToDoTypeButton.click(function () {
        $('#loader').show();
        var jobCode = setEmployeeWorkToDoTypeJobCodeInput.val();
        var guids = [];
        $.each(selectedEmployees, function (i, selectedEmployee) {
            guids.push(selectedEmployee.guid);
        });
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.personSystem.setPersonWorkToDoType') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                jobCode: jobCode,
                guids: guids
            },
            success: function () {
                toastr.success('Personel Yapılacak İşler Başarıyla Atandı.');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Yapılacak İşler Atanırken Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                $('#loader').hide();
            }
        });
    });

    LeaveEmployeeButton.click(function () {
        var employeeId = $('#leave_employee_employee_id').val();
        var employeeGuid = $('#leave_employee_employee_guid').val();
        var date = $('#leave_employee_leaving_date').val();
        var leavingReasonId = leaveEmployeeLeavingReasonId.val();

        if (!date) {
            toastr.warning('Lütfen Personelin Ayrılacağı Tarihi Seçin.');
        } else if (!leavingReasonId) {
            toastr.warning('Lütfen Personelin Ayrılma Nedenini Seçin.');
        } else {
            LeaveEmployeeButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.employee.leave') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    employeeId: employeeId,
                    employeeGuid: employeeGuid,
                    date: date,
                    leavingReasonId: leavingReasonId
                },
                success: function () {
                    toastr.success('Personel Başarıyla İşten Çıkarıldı.');
                    $('#LeaveEmployeeModal').modal('hide');
                    LeaveEmployeeButton.attr('disabled', false).html('İşten Çıkar');
                    $(`#${employeeId}_employeeCard`).remove();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Personel İşten Çıkarılırken Serviste Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
                    LeaveEmployeeButton.attr('disabled', false).html('İşten Çıkar');
                }
            });
        }
    });

    $('body').on('contextmenu', function (e) {
        if (detectMobile()) {
            return false;
        } else {
            if (selectedEmployees.length > 0) {
                $('#batchActions').show();
            } else {
                $('#batchActions').hide();
            }

            var top = e.pageY - 10;
            var left = e.pageX - 10;

            $("#context-menu").css({
                display: "block",
                top: top,
                left: left
            });

            return false;
        }
    }).on("click", function () {
        $("#context-menu").hide();
    }).on('focusout', function () {
        $("#context-menu").hide();
    });

    // Wizard

    CreateEmployeeWizardStepperSelector = document.querySelector("#CreateEmployeeWizardStepper");

    CreateEmployeeWizardStepper = new KTStepper(CreateEmployeeWizardStepperSelector);

    CreateEmployeeWizardStepper.on("kt.stepper.next", (function (e) {
        e.goNext();
    }));

    CreateEmployeeWizardStepper.on("kt.stepper.previous", (function (e) {
        e.goPrevious();
    }));

    CreateEmployeeWizardStepper.on("kt.stepper.click", function (stepper) {
        stepper.goTo(stepper.getClickedStepIndex());
    });

    CreateEmployeeButton.click(function () {
        // var guid = null;
        var roleId = 1;
        var companyId = createEmployeeCompanyId.val();
        var name = $('#create_employee_name').val();
        var email = $('#create_employee_email').val();
        var phone = null;
        var jobDepartmentId = createEmployeeJobDepartmentId.val();
        var username = email.split('@')[0];
        var santralCode = $('#create_employee_santral_code').val();
        var password = '123456';
        var webCrmUserId = $('#create_employee_web_crm_user_id').val();
        var webCrmUsername = $('#create_employee_web_crm_username').val();
        var webCrmPassword = $('#create_employee_web_crm_password').val();
        var progressCrmUsername = $('#create_employee_progress_crm_username').val();
        var progressCrmPassword = $('#create_employee_progress_crm_password').val();
        var marketingCrmUsername = $('#create_employee_marketing_crm_username').val();
        var marketingCrmPassword = $('#create_employee_marketing_crm_password').val();
        var teamCode = $('#create_employee_team_code').val();
        var groupCode = $('#create_employee_group_code').val();
        var callScanCode = $('#create_employee_call_scan_code').val();
        var uyumSatisApiCrmUserName = $('#create_employee_uyum_satis_api_crm_username').val();
        var uyumSatisApiCrmUserPassword = $('#create_employee_uyum_satis_api_crm_user_password').val();

        var tasks = [];
        var createEmployeeTaskCheckboxes = $('.createEmployeeTaskCheckbox:checked');
        $.each(createEmployeeTaskCheckboxes, function (i, task) {
            var gorevKodu = $(task).val();
            var UyumCrmGrupKodu = $(task).data('crm-group-code');
            var UyumCrmKayipGrupKodu = $(task).data('crm-lost-group-code');
            tasks.push({
                gorevKodu: gorevKodu,
                UyumCrmGrupKodu: UyumCrmGrupKodu,
                UyumCrmKayipGrupKodu: UyumCrmKayipGrupKodu
            });
        });

        var workTasks = [];
        var createEmployeeWorkTaskCheckboxes = $('.createEmployeeWorkTaskCheckbox:checked');
        $.each(createEmployeeWorkTaskCheckboxes, function (i, workTask) {
            workTasks.push({
                gorevKodu: $(workTask).val(),
            });
        });

        var groupTasks = [];
        var createEmployeeGroupTaskCheckboxes = $('.createEmployeeGroupTaskCheckbox:checked');
        $.each(createEmployeeGroupTaskCheckboxes, function () {
            groupTasks.push($(this).val());
        });

        var shiftGroupIds = $('#create_employee_shift_groups').val();
        var shiftGroupId = $('#create_employee_shift_group_id').val();

        if (!companyId) {
            toastr.warning('Şirket Seçimi Zorunludur.');
            CreateEmployeeWizardStepper.goTo(1);
        } else if (!name) {
            toastr.warning('Ad Soyad Zorunludur.');
            CreateEmployeeWizardStepper.goTo(1);
        } else if (!email) {
            toastr.warning('E-Posta Zorunludur.');
            CreateEmployeeWizardStepper.goTo(1);
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.employee.getByEmail') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    email: email
                },
                success: function (response) {
                    if (response.response !== null) {
                        toastr.warning('Bu E-posta Adresi Zaten Kayıtlı.');
                        CreateEmployeeWizardStepper.goTo(1);
                    } else if (!jobDepartmentId) {
                        toastr.warning('Departman Seçimi Zorunludur.');
                        CreateEmployeeWizardStepper.goTo(1);
                    } else if (!webCrmUserId) {
                        toastr.warning('Web CRM Kullanıcı ID Boş Olamaz');
                        CreateEmployeeWizardStepper.goTo(2);
                    } else if (!webCrmUsername) {
                        toastr.warning('Web CRM Kullanıcı Adı Boş Olamaz');
                        CreateEmployeeWizardStepper.goTo(2);
                    } else if (!webCrmPassword) {
                        toastr.warning('Web CRM Şifresi Boş Olamaz');
                        CreateEmployeeWizardStepper.goTo(2);
                    } else if (!progressCrmUsername) {
                        toastr.warning('Progress CRM Kullanıcı Adı Boş Olamaz');
                        CreateEmployeeWizardStepper.goTo(2);
                    } else if (!progressCrmPassword) {
                        toastr.warning('Progress CRM Şifresi Boş Olamaz');
                        CreateEmployeeWizardStepper.goTo(2);
                    } else if (!marketingCrmUsername) {
                        toastr.warning('Satış CRM Kullanıcı Adı Boş Olamaz');
                        CreateEmployeeWizardStepper.goTo(2);
                    } else if (!marketingCrmPassword) {
                        toastr.warning('Satış CRM Şifresi Boş Olamaz');
                        CreateEmployeeWizardStepper.goTo(2);
                    } else if (!teamCode) {
                        toastr.warning('Takım Kodu Boş Olamaz');
                        CreateEmployeeWizardStepper.goTo(2);
                    } else if (!groupCode) {
                        toastr.warning('Grup Kodu Boş Olamaz');
                        CreateEmployeeWizardStepper.goTo(2);
                    } else if (!callScanCode) {
                        toastr.warning('Çağrı Tarama Kodu Boş Olamaz');
                        CreateEmployeeWizardStepper.goTo(2);
                    } else if (!shiftGroupId) {
                        toastr.warning('İlk Vardiya Seçimi Zorunludur.');
                        CreateEmployeeWizardStepper.goTo(6);
                    } else {
                        $('#loader').show();
                        $.ajax({
                            type: 'post',
                            url: '{{ route('user.api.operationApi.operation.setEmployee') }}',
                            headers: {
                                'Accept': 'application/json',
                                'Authorization': token
                            },
                            data: {
                                id: null,
                                companyId: companyId,
                                email: email,
                                username: username,
                                password: password,
                                name: name,
                                assignment: 0,
                                education: 0,
                                webCrmUserId: webCrmUserId,
                                webCrmUserPassword: webCrmPassword,
                                webCrmUsername: webCrmUsername,
                                progressCrmUsername: progressCrmUsername,
                                progressCrmPassword: progressCrmPassword,
                                marketingCrmUsername: marketingCrmUsername,
                                marketingCrmPassword: marketingCrmPassword,
                                activeJobDescription: ' ',
                                role: 1,
                                groupCode: groupCode,
                                teamCode: teamCode,
                                teamLead: 0,
                                teamLeadAssistant: 0,
                                callScanCode: callScanCode,
                                santralCode: santralCode,
                                tasks: tasks,
                                workTasks: workTasks,
                                uyumSatisApiCrmUserName: uyumSatisApiCrmUserName,
                                uyumSatisApiCrmUserPassword: uyumSatisApiCrmUserPassword,
                            },
                            success: function (response) {
                                $.ajax({
                                    type: 'post',
                                    url: '{{ route('user.api.employee.create') }}',
                                    headers: {
                                        'Accept': 'application/json',
                                        'Authorization': token
                                    },
                                    data: {
                                        guid: response.response.guid,
                                        companyId: companyId,
                                        roleId: roleId,
                                        jobDepartmentId: jobDepartmentId,
                                        name: name,
                                        email: email,
                                        phone: phone,
                                        santralCode: santralCode,
                                        password: password,
                                    },
                                    success: function (response) {
                                        var employee = response.response;
                                        $.ajax({
                                            type: 'post',
                                            url: '{{ route('user.api.saturdayPermit.robot') }}',
                                            headers: {
                                                'Accept': 'application/json',
                                                'Authorization': token
                                            },
                                            data: {
                                                month: reformatDatetimeTo_YYYY_MM(new Date()),
                                                companyId: companyId,
                                            },
                                            success: function () {
                                                $.ajax({
                                                    type: 'post',
                                                    url: '{{ route('user.api.shift.createEmployeeFirstShifts') }}',
                                                    headers: {
                                                        'Accept': 'application/json',
                                                        'Authorization': token
                                                    },
                                                    data: {
                                                        employeeId: employee.id,
                                                        shiftGroupId: shiftGroupId,
                                                        month: reformatDatetimeTo_YYYY_MM(new Date()),
                                                    },
                                                    error: function (error) {
                                                        console.log(error);
                                                        toastr.error(error.responseJSON.message);
                                                    }
                                                });
                                            },
                                            error: function (error) {
                                                console.log(error);
                                                toastr.error(error.responseJSON.message);
                                            }
                                        });
                                        $.ajax({
                                            type: 'post',
                                            url: '{{ route('user.api.operationApi.operation.setEmployeeGroupTasksInsert') }}',
                                            headers: {
                                                'Accept': 'application/json',
                                                'Authorization': token
                                            },
                                            data: {
                                                guid: employee.guid,
                                                groupTasks: groupTasks,
                                            },
                                            error: function (error) {
                                                console.log(error);
                                                toastr.error(error.responseJSON.message);
                                            }
                                        });
                                        $.ajax({
                                            type: 'post',
                                            url: '{{ route('user.api.employeeShiftGroup.setEmployeeShiftGroups') }}',
                                            headers: {
                                                'Accept': 'application/json',
                                                'Authorization': token
                                            },
                                            data: {
                                                employeeId: employee.id,
                                                shiftGroupIds: shiftGroupIds,
                                            },
                                            success: function () {
                                                $('#CreateEmployeeModal').modal('hide');
                                                getEmployees();
                                                toastr.success('Personel Başarıyla Oluşturuldu.');
                                            },
                                            error: function (error) {
                                                console.log(error);
                                                $('#loader').hide();
                                                toastr.error(error.responseJSON.message);
                                            }
                                        });
                                    },
                                    error: function (error) {
                                        $('#loader').hide();
                                        console.log(error);
                                        if (error.status === 422) {
                                            var errors = error.responseJSON.response;
                                            $.each(errors, function (key, value) {
                                                if (key === 'email') {
                                                    if (value[0] === 'The email has already been taken.') {
                                                        toastr.error('Bu E-posta Adresi Zaten Kayıtlı.');
                                                    }
                                                }
                                            });
                                        } else {
                                            toastr.error(error.responseJSON.message);
                                        }
                                    }
                                });
                            },
                            error: function (error) {
                                console.log(error);
                                toastr.error(error.responseJSON.message);
                                $('#loader').hide();
                            }
                        });
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error(error.responseJSON.message);
                }
            });
        }
    });

    DownloadExcelEmployeeReportButton.click(function () {
        employeesGridDiv.jqxGrid('exportdata', 'xlsx', `Personel Raporu`);
    });

</script>
