<script>

    var UpdateEmployeeQueuesRow = $('#UpdateEmployeeQueuesRow');
    var UpdateEmployeeQueuesButton = $('#UpdateEmployeeQueuesButton');

    var UpdateEmployeeCompetencesRow = $('#UpdateEmployeeCompetencesRow');
    var UpdateEmployeeCompetencesButton = $('#UpdateEmployeeCompetencesButton');

    var UpdateEmployeeTasksRow = $('#UpdateEmployeeTasksRow');
    var UpdateEmployeeTasksButton = $('#UpdateEmployeeTasksButton');

    var SelectAllEmployeesButton = $('#SelectAllEmployeesButton');
    var DeSelectAllEmployeesButton = $('#DeSelectAllEmployeesButton');

    var keyword = $('#keyword');
    var selectedEmployees = [];

    var employeesRow = $('#employeesRow');
    var jobDepartmentFilterer = $('#jobDepartmentFilterer');

    function filterEmployees() {
        var employees = $('.employeeCard');
        $.each(employees, function (i, employeeCard) {
            var employeeName = $(employeeCard).data('name');
            var filterStatus = false;
            var employeeJobDepartments = $(employeeCard).data('job-departments').toString().split(',');
            var jobDepartmentsFromFilterer = jobDepartmentFilterer.val();

            if (jobDepartmentsFromFilterer.length > 0) {
                $.each(employeeJobDepartments, function (i, employeeJobDepartment) {
                    $.each(jobDepartmentsFromFilterer, function (i, jobDepartmentFromFilterer) {
                        if (parseInt(employeeJobDepartment) === parseInt(jobDepartmentFromFilterer)) {
                            filterStatus = true;
                        }
                    });
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

    // Update Methods

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

    function updateEmployeeTasks() {
        $('#UpdateEmployeeTasksModal').modal('show');
    }

    function updateEmployeeWorkTasks() {

    }

    function updateEmployeeGroupTasks() {

    }

    function updateEmployeeJobDepartments() {

    }

    // Get Methods

    function getEmployees() {
        $('#loader').show();
        var companyId = SelectedCompany.val();
        var companyIds = [];

        if (parseInt(companyId) === 1 || parseInt(companyId) === 2) {
            companyIds = [1, 2];
        } else {
            companyIds.push(companyId);
        }

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getByCompanies') }}',
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
                var employees = response.response;
                var operationEmployees = [];
                if (parseInt(companyId) === 1 || parseInt(companyId) === 2) {
                    $.ajax({
                        async: false,
                        type: 'get',
                        url: '{{ route('user.api.operation.getUserList') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            companyId: 1
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
                    $.ajax({
                        async: false,
                        type: 'get',
                        url: '{{ route('user.api.operation.getUserList') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            companyId: 2
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
                } else {
                    $.ajax({
                        async: false,
                        type: 'get',
                        url: '{{ route('user.api.operation.getUserList') }}',
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
                }

                $.each(employees, function (i, employee) {
                    $.each(operationEmployees, function (j, operationEmployee) {
                        if (parseInt(operationEmployee.id) === parseInt(employee.guid)) {
                            employee.operationEmployee = operationEmployee;
                            return false;
                        }
                    });
                });

                employees.sort(SortByName);

                var avatar = '{{ asset('assets/media/logos/avatar.png') }}';
                employeesRow.empty();
                $.each(employees, function (i, employee) {
                    var eBadge = 'warning';
                    var gBadge = 'warning';
                    var tBadge = 'warning';
                    var yBadge = 'warning';

                    var jobDepartments = '';
                    var jobDepartmentsData = [];
                    $.each(employee.job_departments, function (i, jobDepartment) {
                        if (i !== 0) jobDepartments += ', ';
                        jobDepartments += jobDepartment.name;
                        jobDepartmentsData.push(jobDepartment.id);
                    });

                    if (employee.image) {
                        avatar = '{{ asset('') }}' + employee.image;
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
                    <div class="col-xl-3 col-12 employeeCard" data-id="${employee.id}" data-guid="${employee.guid}" data-name="${employee.name}" data-job-departments="${jobDepartmentsData}">
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
                                         <div class="menu-item px-3">
                                             <a onclick="updateEmployeeQueues(${employee.id}, '${employee.name}')" class="menu-link px-3">Çağrı Kuyrukları</a>
                                         </div>
                                         <div class="menu-item px-3">
                                             <a onclick="updateEmployeeCompetences(${employee.id}, '${employee.name}')" class="menu-link px-3">Yetkinlikler</a>
                                         </div>
                                         <div class="menu-item px-3">
                                             <a onclick="updateEmployeeTasks(${employee.id}, '${employee.name}')" class="menu-link px-3">Kuyruk Görevleri</a>
                                         </div>
                                         <div class="menu-item px-3">
                                             <a onclick="updateEmployeeWorkTasks(${employee.id}, '${employee.name}')" class="menu-link px-3">İş Görevleri</a>
                                         </div>
                                         <div class="menu-item px-3">
                                             <a onclick="updateEmployeeGroupTasks(${employee.id}, '${employee.name}')" class="menu-link px-3">Gruplar</a>
                                         </div>
                                         <div class="menu-item px-3 pb-3">
                                             <a onclick="updateEmployeeJobDepartments(${employee.id}, '${employee.name}')" class="menu-link px-3">Departmanlar</a>
                                         </div>
                                      </ul>
                                </div>
                                <div class="card-toolbar">
                                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M17.7 5.59999C16.7 5.19999 15.5 5.50003 14.8 6.20003L10.2 10.8C9.5 11.5 8.4 11.8 7.5 11.5L5.10001 10.8V18.9H20.1V6.40004L17.7 5.59999Z" fill="black"/>
                                                <path d="M21 18H6V3C6 2.4 5.6 2 5 2C4.4 2 4 2.4 4 3V18H3C2.4 18 2 18.4 2 19C2 19.6 2.4 20 3 20H4V21C4 21.6 4.4 22 5 22C5.6 22 6 21.6 6 21V20H21C21.6 20 22 19.6 22 19C22 18.4 21.6 18 21 18Z" fill="black"/>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-5 text-center">
                                    <div class="symbol symbol-100px symbol-circle mb-7 employeeSelector" data-id="${employee.id}" data-guid="${employee.guid}">
                                        <img src="${avatar}" alt="image">
                                    </div>
                                    <br>
                                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">${employee.name}</a>
                                    <div class="fs-6 fw-bold text-muted mb-2 text-center">
                                        ${jobDepartments}
                                    </div>
                                    <div class="fs-6 fw-bold text-muted">
                                        <i class="fas fa-headset"></i><span class="ms-3">${employee.santral_code ?? '--'}</span>
                                    </div>
                                </div>
                                <div class="separator separator-dashed my-5"></div>
                                <div class="d-flex flex-center">
                                    <div id="${employee.guid}_eBadge" class="badge badge-${eBadge} badge-circle cursor-pointer eBadge" data-employee-id="${employee.id}" data-employee-guid="${employee.guid}">E</div>
                                    <div id="${employee.guid}_gBadge" class="badge badge-${gBadge} badge-circle cursor-pointer gBadge ms-2" data-employee-id="${employee.id}" data-employee-guid="${employee.guid}">G</div>
                                    <div id="${employee.guid}_tBadge" class="badge badge-${tBadge} badge-circle cursor-pointer tBadge ms-2" data-employee-id="${employee.id}" data-employee-guid="${employee.guid}">T</div>
                                    <div id="${employee.guid}_yBadge" class="badge badge-${yBadge} badge-circle cursor-pointer yBadge ms-2" data-employee-id="${employee.id}" data-employee-guid="${employee.guid}">Y</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
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
                jobDepartmentFilterer.empty();
                $.each(response.response, function (index, jobDepartment) {
                    jobDepartmentFilterer.append(`
                    <option value="${jobDepartment.id}">${jobDepartment.name}</option>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function getQueues() {
        var companyId = SelectedCompany.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.queue.getByCompanyId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyId: companyId
            },
            success: function (response) {
                UpdateEmployeeQueuesRow.empty();
                $.each(response.response, function (i, queue) {
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
        var companyId = SelectedCompany.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.competence.getByCompanyId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyId: companyId
            },
            success: function (response) {
                UpdateEmployeeCompetencesRow.empty();
                $.each(response.response, function (i, competence) {
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

    function getEmployeeTasks() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operation.getEmployeeTasks') }}',
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
            url: '{{ route('user.api.operation.getEmployeeWorkTasks') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                console.log(response);
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
            url: '{{ route('user.api.operation.getEmployeeGroupTasks') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Gruplar Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    getQueues();
    getCompetences();
    getEmployeeTasks();
    getEmployeeWorkTasks();
    getEmployeeGroupTasks();
    getEmployees();
    getJobDepartments();

    SelectedCompany.change(function () {
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

        $.ajax({
            type: 'post',
            url: '{{ route('user.api.personSystem.setPersonAuthority') }}',
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
                education === 0 ? badge.removeClass('badge-success').addClass('badge-warning') : badge.removeClass('badge-warning').addClass('badge-success');
            },
            error: function (error) {
                console.log(error);
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

        $.ajax({
            type: 'post',
            url: '{{ route('user.api.personSystem.setPersonAuthority') }}',
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
                assignment === 0 ? badge.removeClass('badge-success').addClass('badge-warning') : badge.removeClass('badge-warning').addClass('badge-success');
            },
            error: function (error) {
                console.log(error);
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

        $.ajax({
            type: 'post',
            url: '{{ route('user.api.personSystem.setPersonAuthority') }}',
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
                teamLead === 0 ? badge.removeClass('badge-success').addClass('badge-warning') : badge.removeClass('badge-warning').addClass('badge-success');
            },
            error: function (error) {
                console.log(error);
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

        $.ajax({
            type: 'post',
            url: '{{ route('user.api.personSystem.setPersonAuthority') }}',
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
                teamLeadAssistant === 0 ? badge.removeClass('badge-success').addClass('badge-warning') : badge.removeClass('badge-warning').addClass('badge-success');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Servisinde Bir Hata Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    });

    SelectAllEmployeesButton.click(function () {
        var employees = $('.employeeCard');
        $.each(employees, function (i, employee) {
            if (!$(this).hasClass('d-none')) {
                $(this).find('.employeeSelector').addClass('selectedEmployee');
            }
        });
        setSelectedEmployees();
    });

    DeSelectAllEmployeesButton.click(function () {
        var employees = $('.employeeCard');
        $.each(employees, function (i, employee) {
            if (!$(this).hasClass('d-none')) {
                $(this).find('.employeeSelector').removeClass('selectedEmployee');
            }
        });
        setSelectedEmployees();
    });

    UpdateEmployeeQueuesButton.click(function () {
        $('#loader').show();
        var employeeId = $('#update_employee_queues_employee_id').val();
        var queueIds = [];
        var updateEmployeeQueueCheckboxes = $('.updateEmployeeQueueCheckbox');
        $.each(updateEmployeeQueueCheckboxes, function (i, checkbox) {
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
        $.each(updateEmployeeCompetenceCheckboxes, function (i, checkbox) {
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

</script>
