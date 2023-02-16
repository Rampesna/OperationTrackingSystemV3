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
                $('#city_id').val(response.response.city_id).select2();
                $('#address').val(response.response.address);
                $('#home_status').val(response.response.home_status).select2();
                $('#family_health_status').val(response.response.family_health_status).select2();
                $('#work_status').val(response.response.work_status).select2();
                $('#computer_status').val(response.response.computer_status).select2();
                $('#internet_status').val(response.response.internet_status).select2();
                $('#headphone_status').val(response.response.headphone_status).select2();
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
        var cityId = $('#city_id').val();
        var address = $('#address').val();
        var homeStatus = $('#home_status').val();
        var familyHealthStatus = $('#family_health_status').val();
        var workStatus = $('#work_status').val();
        var computerStatus = $('#computer_status').val();
        var internetStatus = $('#internet_status').val();
        var headphoneStatus = $('#headphone_status').val();

        UpdateEarthquakeInformationButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);

        $.ajax({
            type: 'put',
            url: '{{ route('employee.api.earthquakeInformation.update') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                cityId: cityId,
                address: address,
                homeStatus: homeStatus,
                familyHealthStatus: familyHealthStatus,
                workStatus: workStatus,
                computerStatus: computerStatus,
                internetStatus: internetStatus,
                headphoneStatus: headphoneStatus
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
