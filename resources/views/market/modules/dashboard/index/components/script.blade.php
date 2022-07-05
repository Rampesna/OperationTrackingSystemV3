<script src="{{ asset('assets/plugins/custom/qrcode/reader.js') }}"></script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    function setMarketPaymentCompleted() {
        $('#SetMarketPaymentCompletedModal').modal('show');
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        'reader',
        {
            fps: 30,
            qrbox: 250,
        }
    );

    function onScanSuccess(decodedText, decodedResult) {
        console.log({
            decodedText,
            decodedResult,
        });
    }

    html5QrcodeScanner.render(onScanSuccess);

    $(document).ready(function () {
        $('#reader').css('width', '100%');
    });

</script>
