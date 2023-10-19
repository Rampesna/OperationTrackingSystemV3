<script>

    var employee = null;

    var employeeId = `{{ $id }}`;

    var reActivateEmployeeButton = $('#reActivateEmployeeButton');

    var employeeImageSpan = $('#employeeImageSpan');
    var employeeNameSpan = $('#employeeNameSpan');
    var employeeIdentitySpan = $('#employeeIdentitySpan');
    var employeeEmailSpan = $('#employeeEmailSpan');
    var employeePhoneSpan = $('#employeePhoneSpan');

    function getEmployeeById() {
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
                employee = response.response;
                if (employee.leave === 1) reActivateEmployeeButton.show();
                if (employee.image) employeeImageSpan.attr('src', `${baseAssetUrl}${employee.image}`);
                employeeNameSpan.html(employee.name);
                employeeIdentitySpan.html(`<i class="far fa-user-circle me-4"></i><span class="mt-n1">${employee.identity}</span>`);
                employeeEmailSpan.html(`<i class="far fa-envelope me-4"></i><span class="mt-n1">${employee.email}</span>`);
                employeePhoneSpan.html(`<i class="fas fa-phone-square-alt me-4"></i><span class="mt-n1">${employee.phone}</span>`);
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                $('#loader').hide();
                toastr.error('Personel Bilgileri Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    getEmployeeById();

</script>

<script>

    var UpdatePersonalInformationButton = $('#UpdatePersonalInformationButton');

    function getEmployeePersonalInformation() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employeePersonalInformation.getByEmployeeId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: employeeId,
            },
            success: function (response) {
                $('#employee_personal_information_id').val(response.response.id);
                $('#identity').val(response.response.identity);
                $('#birth_date').val(response.response.birth_date);
                $('#gender').val(response.response.gender).trigger('change');
                $('#nationality').val(response.response.nationality);
                $('#civil_status').val(response.response.civil_status).trigger('change');
                $('#wife_working_status').val(response.response.wife_working_status).trigger('change');
                $('#number_of_child').val(response.response.number_of_child);
                $('#blood_group').val(response.response.blood_group).trigger('change');
                $('#education_status').val(response.response.education_status).trigger('change');
                $('#education').val(response.response.education).trigger('change');
                $('#last_completed_school').val(response.response.last_completed_school);
                $('#degree_of_obstacle').val(response.response.degree_of_obstacle).trigger('change');
                $('#city').val(response.response.city);
                $('#postal_code').val(response.response.postal_code);
                $('#home_phone_number').val(response.response.home_phone_number);
                $('#address').val(response.response.address);
                $('#bank_name').val(response.response.bank_name);
                $('#bank_account_type').val(response.response.bank_account_type).trigger('change');
                $('#account_number').val(response.response.account_number);
                $('#iban').val(response.response.iban);
                $('#emergency_person').val(response.response.emergency_person);
                $('#emergency_person_degree').val(response.response.emergency_person_degree);
                $('#emergency_person_phone_number').val(response.response.emergency_person_phone_number);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Kişisel Bilgileri Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    getEmployeePersonalInformation();

    UpdatePersonalInformationButton.click(function () {
        var id = $('#employee_personal_information_id').val();
        var identity = $('#identity').val();
        var birthDate = $('#birth_date').val();
        var gender = $('#gender').val();
        var nationality = $('#nationality').val();
        var civilStatus = $('#civil_status').val();
        var wifeWorkingStatus = $('#wife_working_status').val();
        var numberOfChild = $('#number_of_child').val();
        var bloodGroup = $('#blood_group').val();
        var educationStatus = $('#education_status').val();
        var education = $('#education').val();
        var lastCompletedSchool = $('#last_completed_school').val();
        var degreeOfObstacle = $('#degree_of_obstacle').val();
        var city = $('#city').val();
        var postalCode = $('#postal_code').val();
        var homePhoneNumber = $('#home_phone_number').val();
        var address = $('#address').val();
        var bankName = $('#bank_name').val();
        var bankAccountType = $('#bank_account_type').val();
        var accountNumber = $('#account_number').val();
        var iban = $('#iban').val();
        var emergencyPerson = $('#emergency_person').val();
        var emergencyPersonDegree = $('#emergency_person_degree').val();
        var emergencyPersonPhoneNumber = $('#emergency_person_phone_number').val();

        UpdatePersonalInformationButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            type: 'put',
            url: '{{ route('user.api.employeePersonalInformation.update') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
                identity: identity,
                birthDate: birthDate,
                gender: gender,
                nationality: nationality,
                civilStatus: civilStatus,
                wifeWorkingStatus: wifeWorkingStatus,
                numberOfChild: numberOfChild,
                bloodGroup: bloodGroup,
                educationStatus: educationStatus,
                education: education,
                lastCompletedSchool: lastCompletedSchool,
                degreeOfObstacle: degreeOfObstacle,
                city: city,
                postalCode: postalCode,
                homePhoneNumber: homePhoneNumber,
                address: address,
                bankName: bankName,
                bankAccountType: bankAccountType,
                accountNumber: accountNumber,
                iban: iban,
                emergencyPerson: emergencyPerson,
                emergencyPersonDegree: emergencyPersonDegree,
                emergencyPersonPhoneNumber: emergencyPersonPhoneNumber,
            },
            success: function () {
                toastr.success('Personel Kişisel Bilgileri Güncellendi.');
                UpdatePersonalInformationButton.attr('disabled', false).html('Güncelle');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Kişisel Bilgileri Güncellenirken Serviste Bir Sorun Oluştu.');
                UpdatePersonalInformationButton.attr('disabled', false).html('Güncelle');
            }
        });
    });

    reActivateEmployeeButton.click(function () {
        $.ajax({
        	type: 'post',
        	url: '{{ route('user.api.employee.reActivate') }}',
        	headers: {
        		'Accept': 'application/json',
        		'Authorization': token
        	},
        	data: {
                employeeId: employeeId,
            },
        	success: function (response) {
                console.log(response);
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
    });

</script>
