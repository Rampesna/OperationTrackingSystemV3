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
                console.log(response);
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
                console.log(response);
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
