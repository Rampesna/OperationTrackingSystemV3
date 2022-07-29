<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var employeesRow = $('#employees');

    var keyword = $('#keyword');
    var jobDepartmentFilterer = $('#jobDepartmentFilterer');

    function getEmployeesByCompanyIds() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getByCompanyIdsWithDevices') }}',
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
                console.log(response);
                employeesRow.empty();
                $.each(response.response.employees, function (i, employee) {
                    var devices = ``;
                    if (employee.devices.length > 0) {
                        $.each(employee.devices, function (j, device) {
                            devices += `
                        <div class="col-xl-12 mb-3">
                            <div class="row">
                                <div class="col-xl-1">
                                    <span class="badge badge-sm badge-${device.status ? device.status.color : 'secondary'} badge-circle"></span>
                                </div>
                                <div class="col-xl-11 d-grid">
                                    <span class="badge badge-secondary fw-bolder text-start pt-2 pb-2">${device.name}</span>
                                </div>
                            </div>
                        </div>
                        `;
                        });
                    } else {
                        devices = `Hiç Cihaz Yok`;
                    }
                    employeesRow.append(`
                    <div class="col-xl-3 col-12 employeeCard" id="${employee.id}_employeeCard" data-id="${employee.id}" data-guid="${employee.guid}" data-name="${employee.name}" data-job-department="${employee.job_department ? employee.job_department.id : 0}">
                        <div class="card mb-5 mb-xl-8">
                            <div class="card-body">
                                <div class="mb-5 text-center">
                                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1 toggleEmployeeDevices" data-employee-id="${employee.id}">${employee.name}</a>
                                </div>
                                <div class="separator separator-dashed my-5"></div>
                                <div id="employee${employee.id}Devices" style="display: none">
                                    <div class="row">
                                        ${devices}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Listesi Alınırken Sistemsel Bir Sorun Oluştu!');
            }
        });
    }

    function filterEmployees() {
        var employees = $('.employeeCard');
        $.each(employees, function (i, employeeCard) {
            var employeeName = $(employeeCard).data('name');
            if (employeeName.toLowerCase().includes(keyword.val().toLowerCase())) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        });
    }

    getEmployeesByCompanyIds();

    $(document).delegate('.toggleEmployeeDevices', 'click', function () {
        $(`#employee${$(this).data('employee-id')}Devices`).slideToggle();
    });

    keyword.keyup(function () {
        filterEmployees();
    });

    jobDepartmentFilterer.change(function () {
        filterEmployees();
    });

</script>
