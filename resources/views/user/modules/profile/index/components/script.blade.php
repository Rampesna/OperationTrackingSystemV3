<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var UpdateButton = $('#UpdateButton');

    UpdateButton.click(function () {
        var oldPassword = $('#old_password').val();
        var newPassword = $('#new_password').val();
        var confirmPassword = $('#confirm_password').val();

        if (!oldPassword) {
            toastr.warning('Eski Şifrenizi Giriniz.');
        } else if (!newPassword) {
            toastr.warning('Yeni Şifrenizi Giriniz.');
        } else if (!confirmPassword) {
            toastr.warning('Yeni Şifrenizi Tekrar Giriniz.');
        } else if (newPassword !== confirmPassword) {
            toastr.warning('Yeni Şifreler Uyuşmuyor.');
        } else {
            UpdateButton.attr('disabled', true).html('<i class="fa fa-spin fa-spinner"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.updatePassword') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    oldPassword: oldPassword,
                    newPassword: newPassword,
                },
                success: function () {
                    toastr.success('Şifreniz Güncellendi.');
                    $('#old_password').val('');
                    $('#new_password').val('');
                    $('#confirm_password').val('');
                    UpdateButton.attr('disabled', false).html('Güncelle');
                },
                error: function (error) {
                    console.log(error);
                    if (parseInt(error.status) === 401) {
                        toastr.error('Eski Şifrenizi Yanlış Girdiniz.');
                    } else {
                        toastr.error('Şifreniz Güncellenemedi.');
                        UpdateButton.attr('disabled', false).html('Güncelle');
                    }
                }
            });
        }
    });

</script>
