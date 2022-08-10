<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    function getProfile() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.getProfile') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                if (response.response.image) $('#imageSelector').attr('src', `${baseAssetUrl}${response.response.image}`);
                $('#nameSpan').html(response.response.name);
                $('#emailSpan').html(response.response.email);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Profil Bilgileri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getPositions() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.getPositions') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                $('#companySpan').html(response.response[0].company.title);
                $('#titleSpan').html(response.response[0].title.name);
                $('#salarySpan').html(response.response[0].salary ? `${reformatNumberToMoney(response.response[0].salary)} ₺` : `0.00 ₺`);
                $('#bountySpan').html(response.response[0].bounty ? `${reformatNumberToMoney(response.response[0].bounty)} ₺` : `0.00 ₺`);
                $('#roadTollSpan').html(response.response[0].road_toll ? `${reformatNumberToMoney(response.response[0].road_toll)} ₺` : `0.00 ₺`);
                $('#totalEarnSpan').html(`${reformatNumberToMoney(response.response[0].salary + response.response[0].bounty + response.response[0].road_toll)} ₺`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Kariyer Bilgileri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getProfile();
    getPositions();

</script>
