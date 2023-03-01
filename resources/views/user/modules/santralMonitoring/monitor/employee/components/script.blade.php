<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var employeesRow = $('#employeesRow');

    var totalEmployeeCountCard = $('#totalEmployeeCountCard');
    var totalEmployeeCountSpan = $('#totalEmployeeCountSpan');
    var activeEmployeeCountCard = $('#activeEmployeeCountCard');
    var activeEmployeeCountSpan = $('#activeEmployeeCountSpan');
    var requirementBreakEmployeeCountCard = $('#requirementBreakEmployeeCountCard');
    var requirementBreakEmployeeCountSpan = $('#requirementBreakEmployeeCountSpan');
    var lunchBreakEmployeeCountCard = $('#lunchBreakEmployeeCountCard');
    var lunchBreakEmployeeCountSpan = $('#lunchBreakEmployeeCountSpan');
    var assignmentBreakEmployeeCountCard = $('#assignmentBreakEmployeeCountCard');
    var assignmentBreakEmployeeCountSpan = $('#assignmentBreakEmployeeCountSpan');
    var endOfWorkEmployeeCountCard = $('#endOfWorkEmployeeCountCard');
    var endOfWorkEmployeeCountSpan = $('#endOfWorkEmployeeCountSpan');

    function getStaffList() {
        var typeId = parseInt('{{ $employeeMonitoringType }}');
        var companyIdsString = '{{ $employeeMonitoringCompanyIds }}';
        var companyIds = companyIdsString.split(',').map(function (companyId) {
            return parseInt(companyId);
        });
        var jobDepartmentTypeIdsString = '{{ $employeeMonitoringJobDepartmentTypeIds }}';
        var jobDepartmentTypeIds = jobDepartmentTypeIdsString.split(',').map(function (employeeMonitoringJobDepartmentTypeId) {
            return parseInt(employeeMonitoringJobDepartmentTypeId);
        });

        if (typeId === 1) {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.operationApi.tvScreen.getStaffStatusList') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyIds: companyIds,
                },
                success: function (response) {
                    setEmployees(response.response);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        } else if (typeId === 2) {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.employee.getByJobDepartmentTypeIds') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    jobDepartmentTypeIds: jobDepartmentTypeIds,
                },
                success: function (response) {
                    var employeeGuids = $.map(response.response, function (employee) {
                        return parseInt(employee.guid);
                    });
                    $.ajax({
                        type: 'get',
                        url: '{{ route('user.api.operationApi.tvScreen.getStaffStatusUserList') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            employeeGuids: employeeGuids
                        },
                        success: function (response) {
                            setEmployees(response.response);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });
        } else {
            toastr.error('Personel Listesi Türü Geçersiz!');
        }
    }

    function setEmployees(employees) {
        console.log(employees)
        var totalEmployeeCount = 0;
        var activeEmployeeCount = 0;
        var requirementBreakEmployee = 0;
        var lunchBreakEmployeeCount = 0;
        var assignmentBreakEmployeeCount = 0;
        var endOfWorkEmployeeCount = 0;

        employeesRow.empty();

        $.each(employees, function (i, employee) {
            totalEmployeeCount++;

            var bgColor = 'darkgreen';
            var statusName = '';

            if (parseInt(employee.durumAdi) === 1) {
                bgColor = 'darkgreen';
                statusName = 'Çalışıyor';
                activeEmployeeCount++;
            } else if (parseInt(employee.durumAdi) === 2) {
                bgColor = 'dodgerblue';
                statusName = 'Molada';
                requirementBreakEmployee++;
            } else if (parseInt(employee.durumAdi) === 3) {
                bgColor = 'rebeccapurple';
                statusName = 'Molada';
                lunchBreakEmployeeCount++;
            } else if (parseInt(employee.durumAdi) === 4) {
                bgColor = 'orangered';
                statusName = 'Molada';
                assignmentBreakEmployeeCount++;
            } else if (parseInt(employee.durumAdi) === 5) {
                bgColor = 'orangered';
                statusName = 'Molada';
                assignmentBreakEmployeeCount++;
            } else if (parseInt(employee.durumAdi) === 6) {
                bgColor = 'gray';
                statusName = 'İş Sonu';
                endOfWorkEmployeeCount++;
            } else if (parseInt(employee.durumAdi) === 7) {
                bgColor = 'orangered';
                statusName = 'Molada';
                assignmentBreakEmployeeCount++;
            } else if (parseInt(employee.durumAdi) === 8) {
                bgColor = 'orangered';
                statusName = 'Molada';
                assignmentBreakEmployeeCount++;
            } else {
                bgColor = 'red';
            }

            var employeeName = employee.kullaniciAdSoyad;
            if (employeeName.length >= 18) {
                employeeName = employeeName.substring(0, 16) + '...';
            }

            employeesRow.append(`
            <div class="col-7">
                <div class="d-flex align-items-center rounded p-5 mb-7" style="background-color: ${bgColor}">
                    <div class="flex-grow-1 me-2">
                        <span class="text-white fw-bolder fs-3">${employeeName}</span>
                        <span class="text-white fw-bold d-block">${statusName} (${employee.gorev})</span>
                    </div>
                    <span class="fw-bolder text-white py-1">${employee.molaSuresi ?? '--'}</span>
                </div>
            </div>
            `);
        });

        $('#totalEmployeeCountSpan').text(totalEmployeeCount);
        $('#activeEmployeeCountSpan').text(activeEmployeeCount);
        $('#requirementBreakEmployeeCountSpan').text(requirementBreakEmployee);
        $('#lunchBreakEmployeeCountSpan').text(lunchBreakEmployeeCount);
        $('#assignmentBreakEmployeeCountSpan').text(assignmentBreakEmployeeCount);
        $('#endOfWorkEmployeeCountSpan').text(endOfWorkEmployeeCount);
    }

    getStaffList();

    setInterval(function () {
        getStaffList();
    }, 15000);

</script>
