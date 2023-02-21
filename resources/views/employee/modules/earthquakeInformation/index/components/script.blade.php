<script>

    $(document).ready(function () {

    });

    var UpdateEarthquakeInformationButton = $('#UpdateEarthquakeInformationButton');

    function getEarthquakeInformationByEmployeeId() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.earthquakeInformation.getByEmployeeId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            success: function (response) {
                $('#city').val(response.response.city).select2();
                $('#address').val(response.response.address);
                $('#home_status').val(response.response.home_status).select2();
                $('#family_health_status').val(response.response.family_health_status).select2();
                $('#working_status').val(response.response.working_status).select2();
                $('#working_address').val(response.response.working_address);
                $('#working_department').val(response.response.working_department);
                $('#workable_date').val(response.response.workable_date);
                $('#computer_status').val(response.response.computer_status).select2();
                $('#internet_status').val(response.response.internet_status).select2();
                $('#headphone_status').val(response.response.headphone_status).select2();
                $('#general_notes').val(response.response.general_notes);
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

    getEarthquakeInformationByEmployeeId();

    UpdateEarthquakeInformationButton.click(function () {
        var city = $('#city').val();
        var address = $('#address').val();
        var homeStatus = $('#home_status').val();
        var familyHealthStatus = $('#family_health_status').val();
        var workingStatus = $('#working_status').val();
        var workingAddress = $('#working_address').val();
        var workingDepartment = $('#working_department').val();
        var workableDate = $('#workable_date').val();
        var computerStatus = $('#computer_status').val();
        var internetStatus = $('#internet_status').val();
        var headphoneStatus = $('#headphone_status').val();
        var generalNotes = $('#general_notes').val();

        UpdateEarthquakeInformationButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);

        $.ajax({
            type: 'put',
            url: '{{ route('employee.api.earthquakeInformation.update') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                city: city,
                address: address,
                homeStatus: homeStatus,
                familyHealthStatus: familyHealthStatus,
                workingStatus: workingStatus,
                workingAddress: workingAddress,
                workingDepartment: workingDepartment,
                workableDate: workableDate,
                computerStatus: computerStatus,
                internetStatus: internetStatus,
                headphoneStatus: headphoneStatus,
                generalNotes: generalNotes
            },
            success: function () {
                UpdateEarthquakeInformationButton.attr('disabled', false).html('Güncelle');
                toastr.success('Bilgileriniz başarıyla güncellendi.');
            },
            error: function (error) {
                console.log(error);
                UpdateEarthquakeInformationButton.attr('disabled', false).html('Güncelle');
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
