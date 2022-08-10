<script>

    $(document).ready(function () {
        $('#loader').hide();
    });


    function getPersonPenalties() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.operationApi.personReport.getPersonPenalties') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                $.each(response.response, function (i, data) {
                    if (data.tur === 'Başarı') {
                        $('#totalSuccessSpan').html(data.puan);
                    } else if (data.tur === 'Ceza') {
                        $('#totalPenaltySpan').html(data.puan);
                    }
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Başarı/Ceza Verileri Alınırken Serviste Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin!');
            }
        });
    }

    getPersonPenalties();

</script>
