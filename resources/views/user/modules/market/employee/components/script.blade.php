<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var keyword = $('#keyword');
    var selectedEmployees = [];

    var employeesRow = $('#employeesRow');
    var jobDepartmentFilterer = $('#jobDepartmentFilterer');

    var SelectAllEmployeesButton = $('#SelectAllEmployeesButton');
    var DeSelectAllEmployeesButton = $('#DeSelectAllEmployeesButton');
    var CreateMarketPaymentButton = $('#CreateMarketPaymentButton');

    function getEmployees() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getByCompanyIdsWithBalance') }}',
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
                                <div class="mb-5 text-center">
                                    <div class="symbol symbol-100px symbol-circle mb-7 employeeSelector" data-id="${employee.id}" data-guid="${employee.guid}">
                                        <img src="${avatar}" alt="image">
                                    </div>
                                    <br>
                                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">${employee.name}</a>
                                    <div class="fs-6 fw-bold text-muted mb-2 text-center" id="employee_${employee.id}_job_department_span">
                                        Bakiye: ${reformatNumberToMoney(employee.balance)} ₺
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

    function setSelectedEmployees() {
        var getSelectedEmployees = $('.selectedEmployee');
        selectedEmployees = [];
        $.each(getSelectedEmployees, function () {
            selectedEmployees.push({
                id: $(this).data('id'),
            });
        });
    }

    function transactions() {
        if (selectedEmployees.length > 0) {
            $('#TransactionsModal').modal('show');
        }
    }

    function createMarketPayment() {
        $('#create_market_payment_amount').val('');
        $('#TransactionsModal').modal('hide');
        $('#CreateMarketPaymentModal').modal('show');
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

    $(document).delegate('.employeeSelector', 'click', function () {
        $(this).toggleClass('selectedEmployee');
        setSelectedEmployees();
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

    $('body').on('contextmenu', function () {
        transactions();
        return false;
    });

    CreateMarketPaymentButton.click(function () {
        var employeeIds = $.map(selectedEmployees, function (employee) {
            return employee.id;
        });
        var amount = $('#create_market_payment_amount').val();

        if (employeeIds.length === 0) {
            toastr.warning('Hiç Personel Seçmediniz!');
        } else if (!amount) {
            toastr.warning('Yüklenecek Tutarı Girmediniz!');
        } else {
            CreateMarketPaymentButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.marketPayment.addBalanceEmployees') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    employeeIds: employeeIds,
                    amount: amount
                },
                success: function () {
                    toastr.success('Bakiyeler Başarıyla Yüklendi!');
                    CreateMarketPaymentButton.attr('disabled', false).html('Bakiye Yükle');
                    $('#CreateMarketPaymentModal').modal('hide');
                    getEmployees();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Bakiyeler Yüklenirken Serviste Bir Sorun Oluştu!');
                    CreateMarketPaymentButton.attr('disabled', false).html('Bakiye Yükle');
                }
            });
        }
    });

</script>
