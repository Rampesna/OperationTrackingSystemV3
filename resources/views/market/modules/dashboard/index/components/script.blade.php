<script src="{{ asset('assets/plugins/custom/qrcode/reader.js') }}"></script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
        $('#reader').css('width', '100%');
    });

    function setMarketPaymentCompleted() {
        var html5QrcodeScanner = new Html5QrcodeScanner(
            'reader',
            {
                fps: 30,
                qrbox: 250,
            }
        );

        html5QrcodeScanner.render(function (decodedText, decodedResult) {
            html5QrcodeScanner.clear();
            $.ajax({
                type: 'post',
                url: '{{ route('market.api.marketPayment.setCompleted') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    code: decodedText,
                },
                success: function () {
                    toastr.success('Ödeme Başarıyla Tamamlandı!');
                    $('#SetMarketPaymentCompletedModal').modal('hide');
                },
                error: function (error) {
                    console.log(error);
                    $('#SetMarketPaymentCompletedModal').modal('hide');
                    if (parseInt(error.status) === 404) {
                        toastr.error('Geçersiz QR Kodu!');
                    } else if (parseInt(error.status) === 406) {
                        toastr.error('Yetersiz Bakiye!');
                    } else {
                        toastr.error('Ödeme Servisinde Bilinmeyen Bir Hata Oluştu!');
                    }
                }
            });
        });

        $('#SetMarketPaymentCompletedModal').modal('show');
    }


</script>
