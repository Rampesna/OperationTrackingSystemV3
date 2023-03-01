<script>

    $(document).ready(function () {

    });

    var UpdateSpecialInformationButton = $('#UpdateSpecialInformationButton');

    function getSpecialInformationByEmployeeId() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.specialInformation.getByEmployeeId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            success: function (response) {
                $('#city').val(response.response.city).select2();
                $('#current_office').val(response.response.current_office).select2();
                $('#address').val(response.response.address);
                $('#working_status').val(response.response.working_status).select2();
                $('#general_status').val(response.response.general_status).select2();
                $('#general_equipment_status').val(response.response.general_equipment_status).select2();
                $('#computer_status').val(response.response.computer_status).select2();
                $('#internet_status').val(response.response.internet_status).select2();
                $('#headphone_status').val(response.response.headphone_status).select2();
                $('#workable_date').val(response.response.workable_date);
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

    getSpecialInformationByEmployeeId();

    UpdateSpecialInformationButton.click(function () {
        var city = $('#city').val();
        var currentOffice = $('#current_office').val();
        var address = $('#address').val();
        var workingStatus = $('#working_status').val();
        var generalStatus = $('#general_status').val();
        var generalEquipmentStatus = $('#general_equipment_status').val();
        var computerStatus = $('#computer_status').val();
        var internetStatus = $('#internet_status').val();
        var headphoneStatus = $('#headphone_status').val();
        var workableDate = $('#workable_date').val();
        var generalNotes = $('#general_notes').val();

        UpdateSpecialInformationButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);

        $.ajax({
            type: 'put',
            url: '{{ route('employee.api.specialInformation.update') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                city: city,
                currentOffice: currentOffice,
                address: address,
                workingStatus: workingStatus,
                generalStatus: generalStatus,
                generalEquipmentStatus: generalEquipmentStatus,
                computerStatus: computerStatus,
                internetStatus: internetStatus,
                headphoneStatus: headphoneStatus,
                workableDate: workableDate,
                generalNotes: generalNotes,
            },
            success: function () {
                UpdateSpecialInformationButton.attr('disabled', false).html('Güncelle');
                toastr.success('Bilgileriniz başarıyla güncellendi.');
            },
            error: function (error) {
                console.log(error);
                UpdateSpecialInformationButton.attr('disabled', false).html('Güncelle');
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
