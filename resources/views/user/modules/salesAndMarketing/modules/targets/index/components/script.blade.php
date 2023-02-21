<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var keyword = $('#keyword');

    var employeesRow = $('#employeesRow');
    var jobDepartmentFilterer = $('#jobDepartmentFilterer');
    var addTargetBtn = $('#addTargetBtn');
    var AddTargetModal = $('#AddTargetModal');
    var TargetTypeInput = $('#target_type');
    var TargetStatusInput = $('#target_status');
    var TargetInput = $('#target');
    var StartDateInput = $('#start_date');
    var EndDateInput = $('#end_date');
    var SelectedEmployeId = null;
    var AddTargetButton = $('#AddTargetButton');


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
                leave: 0,
            },
            success: function (response) {
                var avatar = `{{ asset('assets/media/logos/avatar.png') }}`;
                employeesRow.empty();
                $.each(response.response.employees, function (i, employee) {
                    employeesRow.append(`
                    <div class="col-xl-3 col-12 employeeCard" id="${employee.id}_employeeCard" data-id="${employee.id}" data-guid="${employee.guid}" data-name="${employee.name}" data-job-department="${employee.job_department ? employee.job_department.id : 0}">
                        <div class="card mb-5 mb-xl-8">
                            <div class="card-body">
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
                                            <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">İşlemler</div>
                                        </div>
                                        <div class="separator mb-3 opacity-75"></div>
                                        <div class="menu-item px-3">
                                            <a onclick="showAddTargetModal(${employee.id})" class="menu-link px-3">Hedef Ekle</a>
                                        </div>
                                        <hr class="text-muted">
                                        <div class="menu-item px-3 mb-3">
                                            <a class="menu-link px-3">Hedefleri Görüntüle</a>
                                        </div>
                                    </ul>
                                </div>
                                <div class="mb-5 text-center">
                                    <div class="symbol symbol-100px symbol-circle mb-7 employeeSelector" data-id="${employee.id}" data-guid="${employee.guid}">
                                        <img src="${avatar}" alt="image">
                                    </div>
                                    <br>
                                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">${employee.name}</a>
                                    <div class="fs-6 fw-bold text-muted mb-2 text-center" id="employee_${employee.id}_job_department_span">
                                        ${employee.job_department ? employee.job_department.name : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });
            },
            error: function () {

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
                $.each(response.response.jobDepartments, function (index, jobDepartment) {
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


    getEmployees();
    getJobDepartments();

    SelectedCompanies.change(function () {
        getEmployees();
        getJobDepartments();
    });

    keyword.keyup(function () {
        filterEmployees();
    });

    jobDepartmentFilterer.change(function () {
        filterEmployees();
    });

    function showAddTargetModal(employeeId) {
        SelectedEmployeId = employeeId;
        AddTargetModal.modal('show');
    }

    function getTargetType() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.targets.types.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {

            },
            success: function (response) {

                TargetTypeInput.empty();
                $.each(response.response, function (i, type) {
                    TargetTypeInput.append(`
                    <option value="${type.id}">${type.name}</option>
                    `);
                });
            },
            error: function () {

            }
        });
    }

    function getTargetStatus() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.targets.status.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {

            },
            success: function (response) {
                console.log(response)
                TargetStatusInput.empty();
                $.each(response.response, function (i, item) {
                    TargetStatusInput.append(`
                    <option value="${item.id}">${item.name}</option>
                    `);
                });
            },
            error: function () {

            }
        });
    }

    getTargetType();
    getTargetStatus();


    AddTargetButton.click(function () {
        var data = {
            employee_id: SelectedEmployeId,
            target_type_id: TargetTypeInput.val(),
            target_status_id: TargetStatusInput.val(),
            target: TargetInput.val(),
            star_date: StartDateInput.val(),
            end_date: EndDateInput.val()
        };

        console.log(data);
    });







</script>
