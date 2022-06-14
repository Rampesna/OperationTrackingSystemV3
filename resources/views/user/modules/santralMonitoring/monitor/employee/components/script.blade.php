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

            if (parseInt(employee.durumKodu) === 1) {
                bgColor = 'darkgreen';
                activeEmployeeCount++;
            } else if (parseInt(employee.durumKodu) === 2) {
                bgColor = 'dodgerblue';
                requirementBreakEmployee++;
            } else if (parseInt(employee.durumKodu) === 3) {
                bgColor = 'rebeccapurple';
                lunchBreakEmployeeCount++;
            } else if (parseInt(employee.durumKodu) === 4) {
                bgColor = 'orangered';
                assignmentBreakEmployeeCount++;
            } else if (parseInt(employee.durumKodu) === 5) {
                bgColor = 'orangered';
                assignmentBreakEmployeeCount++;
            } else if (parseInt(employee.durumKodu) === 6) {
                bgColor = 'gray';
                endOfWorkEmployeeCount++;
            } else if (parseInt(employee.durumKodu) === 7) {
                bgColor = 'orangered';
                assignmentBreakEmployeeCount++;
            } else if (parseInt(employee.durumKodu) === 8) {
                bgColor = 'orangered';
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
                        <span class="text-white fw-bold d-block">${employee.durumAdi}</span>
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
