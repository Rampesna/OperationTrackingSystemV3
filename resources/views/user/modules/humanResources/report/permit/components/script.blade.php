<script>

    $(document).ready(function () {
        $('#loader').hide();

        var dates = getDatesInRange(new Date('2022-07-01'), new Date('2022-07-05'));
        $.each(dates, function (i, date) {
            console.log(date.getDate());
        });
    });

    var employeeIdsSelector = $('#employeeIds');
    var typeIdsSelector = $('#typeIds');

    var SelectAllEmployeesButton = $('#SelectAllEmployeesButton');
    var UnSelectAllEmployeesButton = $('#UnSelectAllEmployeesButton');

    var ReportButton = $('#ReportButton');

    function getEmployeesByCompanyIds() {
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
                employeeIdsSelector.empty();
                $.each(response.response, function (i, employee) {
                    employeeIdsSelector.append(`<option value="${employee.id}">${employee.name}</option>`);
                });
                employeeIdsSelector.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Listesi Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    function getPermitTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.permitType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                typeIdsSelector.empty();
                $.each(response.response, function (i, permitType) {
                    typeIdsSelector.append(`<option value="${permitType.id}">${permitType.name}</option>`);
                });
                typeIdsSelector.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('İzin Türleri Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    function getPermitsDateBetweenByEmployeeIds() {
        var employeeIds = employeeIdsSelector.val();
        var typeIds = typeIdsSelector.val();
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        if (employeeIds.length === 0) {
            toastr.warning('Hiç Personel Seçmediniz.');
        } else if (typeIds.length === 0) {
            toastr.warning('Hiç İzin Türü Seçmediniz.');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçilmedi.');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçilmedi.');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.permit.getDateBetweenByEmployeeIdsAndTypeIds') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    employeeIds: employeeIds,
                    typeIds: typeIds,
                    startDate: startDate,
                    endDate: endDate,
                },
                success: function (response) {
                    var employees = [];
                    var employeePermits = groupBy(response.response, 'employee_id');
                    $.each(employeePermits, function (i, permits) {
                        var minutes = 0;
                        $.each(permits, function (j, permit) {
                            minutes += getMinutesBetweenTwoDates(permit.start_date, permit.end_date);
                        });
                        employees.push({
                            name: permits[0].name,
                            duration: minutesToString(minutes),
                        });
                    });

                    console.log(employees);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İzinler Alınırken Serviste Bir Hata Oluştu.');
                }
            });
        }
    }

    getEmployeesByCompanyIds();
    getPermitTypes();

    SelectAllEmployeesButton.click(function () {
        employeeIdsSelector.selectpicker('selectAll');
    });

    UnSelectAllEmployeesButton.click(function () {
        employeeIdsSelector.selectpicker('deselectAll');
    });

    ReportButton.click(function () {
        getPermitsDateBetweenByEmployeeIds();
    });

    SelectedCompanies.change(function () {
        getEmployeesByCompanyIds();
    });

</script>
