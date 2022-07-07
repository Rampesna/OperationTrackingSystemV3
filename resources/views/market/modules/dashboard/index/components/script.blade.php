<script src="{{ asset('assets/plugins/custom/qrcode/reader.js') }}"></script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
        $('#reader').css('width', '100%');
    });

    var SetMarketPaymentCompletedButton = $('#SetMarketPaymentCompletedButton');

    function getMarketPayments() {
        $('#marketBalanceSpan').html(`<i class="fa fa-spinner fa-spin fa-lg"></i>`);
        $.ajax({
            type: 'get',
            url: '{{ route('market.api.getMarketPayments') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                var income = 0;
                var expense = 0;

                $.each(response.response, function (i, marketPayment) {
                    if (parseInt(marketPayment.direction) === 1 && parseInt(marketPayment.completed) === 1) {
                        income += parseInt(marketPayment.amount);
                    } else if (parseInt(marketPayment.direction) === 0) {
                        expense += parseInt(marketPayment.amount);
                    }
                });

                $('#marketBalanceSpan').text(`${reformatNumberToMoney(income - expense)} ₺`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bakiye Bilgisi Alınırken Hata Oluştu. Lütfen Yazılım Ekibi İle İletişime Geçin.');
            }
        });
    }

    getMarketPayments();

    function setMarketPaymentCompleted() {
        var html5QrcodeScanner = new Html5QrcodeScanner(
            'reader',
            {
                fps: 30,
                qrbox: 250,
            }
        );

        html5QrcodeScanner.render(function (decodedText, decodedResult) {
            $('#SetMarketPaymentCompletedModal').modal('hide');
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
                    getMarketPayments();
                },
                error: function (error) {
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

    SetMarketPaymentCompletedButton.click(function () {
        var code = $('#pinCode').val();
        if (!code) {
            toastr.warning('Pin Kodu Boş Olamaz!');
        } else {
            SetMarketPaymentCompletedButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin fa-lg"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('market.api.marketPayment.setCompleted') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    code: code,
                },
                success: function () {
                    SetMarketPaymentCompletedButton.attr('disabled', false).html(`Ödeme Al`);
                    $('#SetMarketPaymentCompletedModal').modal('hide');
                    toastr.success('Ödeme Başarıyla Tamamlandı!');
                    getMarketPayments();
                },
                error: function (error) {
                    SetMarketPaymentCompletedButton.attr('disabled', false).html(`Ödeme Al`);
                    if (parseInt(error.status) === 404) {
                        toastr.error('Geçersiz QR Kodu!');
                    } else if (parseInt(error.status) === 406) {
                        toastr.error('Yetersiz Bakiye!');
                    } else {
                        toastr.error('Ödeme Servisinde Bilinmeyen Bir Hata Oluştu!');
                    }
                }
            });
        }
    });

</script>
