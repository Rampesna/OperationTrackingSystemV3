<script>

    var employeeId = parseInt(`{{ $employeeId }}`);

    $(document).ready(function () {

    });

    var languagesInput = document.querySelector("#languages");
    var languagesTagify = new Tagify(languagesInput);

    var certificatesInput = document.querySelector("#certificates");
    var certificatesTagify = new Tagify(certificatesInput);

    var productsInput = document.querySelector("#products");
    var productsTagify = new Tagify(productsInput);

    var hobbiesInput = document.querySelector("#hobbies");
    var hobbiesTagify = new Tagify(hobbiesInput);

    var oldWorkCompaniesInput = document.querySelector("#old_work_companies");
    var oldWorkCompaniesTagify = new Tagify(oldWorkCompaniesInput);

    var oldWorkPositionsInput = document.querySelector("#old_work_positions");
    var oldWorkPositionsTagify = new Tagify(oldWorkPositionsInput);

    var futureWorksTaken = document.querySelector("#future_works_taken");
    var futureWorksTakenTagify = new Tagify(futureWorksTaken);

    function getEmployee() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: employeeId,
            },
            success: function (response) {
                $('#employeeNameSpan').text(response.response.name);
            },
            error: function (error) {
                console.log(error);
                if (parseInt(error.status) === 422) {
                    $.each(error.responseJSON.response, function (i, error) {
                        toastr.error(error[0]);
                    });
                } else {
                    toastr.error(error.responseJSON.message);
                }
            }
        });
    }

    getEmployee();

    var UpdateEmployeeSkillInventoryButton = $('#UpdateEmployeeSkillInventoryButton');

    function getEmployeeSkillInventoryByEmployeeId() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employeeSkillInventory.getByEmployeeId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: employeeId,
            },
            success: function (response) {
                $('#central_code').val(response.response.central_code);
                $('#department').val(response.response.department);
                $('#education_level').val(response.response.education_level).select2();
                languagesTagify.addTags(response.response.languages ? response.response.languages.split(',') : []);
                certificatesTagify.addTags(response.response.certificates ? response.response.certificates.split(',') : []);
                $('#job_start_date').val(response.response.job_start_date);
                productsTagify.addTags(response.response.products ? response.response.products.split(',') : []);
                $('#total_work_experience').val(response.response.total_work_experience);
                $('#age').val(response.response.age);
                $('#gender').val(response.response.gender).select2();
                hobbiesTagify.addTags(response.response.hobbies ? response.response.hobbies.split(',') : []);
                oldWorkCompaniesTagify.addTags(response.response.old_work_companies ? response.response.old_work_companies.split(',') : []);
                oldWorkPositionsTagify.addTags(response.response.old_work_positions ? response.response.old_work_positions.split(',') : []);
                futureWorksTakenTagify.addTags(response.response.future_works_taken ? response.response.future_works_taken.split(',') : []);
                $('#notes').val(response.response.notes);
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                if (parseInt(error.status) === 422) {
                    $.each(error.responseJSON.response, function (i, error) {
                        toastr.error(error[0]);
                    });
                } else {
                    toastr.error(error.responseJSON.message);
                }
            }
        });
    }

    getEmployeeSkillInventoryByEmployeeId();

    UpdateEmployeeSkillInventoryButton.click(function () {
        var centralCode = $('#central_code').val();
        var department = $('#department').val();
        var educationLevel = $('#education_level').val();
        var languages = languagesTagify.value.map(
            function (item) {
                return item.value;
            }
        );
        var certificates = certificatesTagify.value.map(
            function (item) {
                return item.value;
            }
        );
        var jobStartDate = $('#job_start_date').val();
        var products = productsTagify.value.map(
            function (item) {
                return item.value;
            }
        );
        var totalWorkExperience = $('#total_work_experience').val();
        var age = $('#age').val();
        var gender = $('#gender').val();
        var hobbies = hobbiesTagify.value.map(
            function (item) {
                return item.value;
            }
        );
        var oldWorkCompanies = oldWorkCompaniesTagify.value.map(
            function (item) {
                return item.value;
            }
        );
        var oldWorkPositions = oldWorkPositionsTagify.value.map(
            function (item) {
                return item.value;
            }
        );
        var futureWorksTaken = futureWorksTakenTagify.value.map(
            function (item) {
                return item.value;
            }
        );
        var notes = $('#notes').val();

        UpdateEmployeeSkillInventoryButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);

        $.ajax({
            type: 'put',
            url: '{{ route('user.api.employeeSkillInventory.update') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: employeeId,
                centralCode: centralCode,
                department: department,
                educationLevel: educationLevel,
                languages: languages.join(','),
                certificates: certificates.join(','),
                jobStartDate: jobStartDate,
                products: products.join(','),
                totalWorkExperience: totalWorkExperience,
                age: age,
                gender: gender,
                hobbies: hobbies.join(','),
                oldWorkCompanies: oldWorkCompanies.join(','),
                oldWorkPositions: oldWorkPositions.join(','),
                futureWorksTaken: futureWorksTaken.join(','),
                notes: notes,
            },
            success: function () {
                UpdateEmployeeSkillInventoryButton.attr('disabled', false).html('Güncelle');
                toastr.success('Bilgiler başarıyla güncellendi.');
            },
            error: function (error) {
                console.log(error);
                UpdateEmployeeSkillInventoryButton.attr('disabled', false).html('Güncelle');
                if (parseInt(error.status) === 422) {
                    $.each(error.responseJSON.response, function (i, error) {
                        toastr.error(error[0]);
                    });
                } else {
                    toastr.error(error.responseJSON.message);
                }
            }
        });
    });

</script>
