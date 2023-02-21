<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var keyword = $('#keyword');

    var employeesRow = $('#employeesRow');

    function SortByName(a, b) {
        var aName = a.name.toLowerCase();
        var bName = b.name.toLowerCase();
        return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
    }

    function filterEmployees() {
        var employees = $('.employeeCard');
        $.each(employees, function (i, employeeCard) {
            var employeeName = $(employeeCard).data('name');

            if (
                employeeName.toLowerCase().includes(keyword.val().toLowerCase())
            ) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        });
    }

    function getEmployees() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.earthquakeInformation.getUnregisteredByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds
            },
            success: function (response) {
                var employees = response.response;

                employees.sort(SortByName);
                employeesForJqxGrid = [];

                var avatar = '{{ asset('assets/media/logos/avatar.png') }}';
                employeesRow.empty();
                $.each(employees, function (i, employee) {
                    employeesRow.append(`
                    <div class="col-xl-3 col-12 employeeCard" id="${employee.id}_employeeCard" data-id="${employee.id}" data-guid="${employee.guid}" data-name="${employee.name}" data-job-department="${employee.job_department ? employee.job_department.id : 0}">
                        <div class="card mb-5 mb-xl-8">
                            <div class="card-body">
                                <div class="mb-5 text-center">
                                    <div class="symbol symbol-100px symbol-circle mb-7 employeeSelector" data-id="${employee.id}" data-guid="${employee.guid}">
                                        <img src="${avatar}" alt="image">
                                    </div>
                                    <br>
                                    <a class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1 cursor-pointer">${employee.name}</a>
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

    getEmployees();

    keyword.keyup(function () {
        filterEmployees();
    });

</script>
