<script src="{{ asset('assets/js/custom.js') }}"></script>

<script>

    var RegisterButton = $('#RegisterButton');

    var password = $('#password');

    var passwordStrength1 = $('#passwordStrength1');
    var passwordStrength2 = $('#passwordStrength2');
    var passwordStrength3 = $('#passwordStrength3');
    var passwordStrength4 = $('#passwordStrength4');

    function checkStrength(password) {
        var strength = 0;
        if (password.length < 8) {
            passwordStrength1.removeClass().addClass('flex-grow-1 bg-secondary rounded h-5px me-2');
            passwordStrength2.removeClass().addClass('flex-grow-1 bg-secondary rounded h-5px me-2');
            passwordStrength3.removeClass().addClass('flex-grow-1 bg-secondary rounded h-5px me-2');
            passwordStrength4.removeClass().addClass('flex-grow-1 bg-secondary rounded h-5px me-2');
            return false;
        }

        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 2
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 2
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 2
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 2
        if (strength <= 2) {
            passwordStrength1.removeClass().addClass('flex-grow-1 bg-danger rounded h-5px me-2');
            passwordStrength2.removeClass().addClass('flex-grow-1 bg-secondary rounded h-5px me-2');
            passwordStrength3.removeClass().addClass('flex-grow-1 bg-secondary rounded h-5px me-2');
            passwordStrength4.removeClass().addClass('flex-grow-1 bg-secondary rounded h-5px me-2');
        } else if (strength <= 4) {
            passwordStrength1.removeClass().addClass('flex-grow-1 bg-warning rounded h-5px me-2');
            passwordStrength2.removeClass().addClass('flex-grow-1 bg-warning rounded h-5px me-2');
            passwordStrength3.removeClass().addClass('flex-grow-1 bg-secondary rounded h-5px me-2');
            passwordStrength4.removeClass().addClass('flex-grow-1 bg-secondary rounded h-5px me-2');
        } else if (strength <= 6) {
            passwordStrength1.removeClass().addClass('flex-grow-1 bg-info rounded h-5px me-2');
            passwordStrength2.removeClass().addClass('flex-grow-1 bg-info rounded h-5px me-2');
            passwordStrength3.removeClass().addClass('flex-grow-1 bg-info rounded h-5px me-2');
            passwordStrength4.removeClass().addClass('flex-grow-1 bg-secondary rounded h-5px me-2');
        } else {
            passwordStrength1.removeClass().addClass('flex-grow-1 bg-success rounded h-5px me-2');
            passwordStrength2.removeClass().addClass('flex-grow-1 bg-success rounded h-5px me-2');
            passwordStrength3.removeClass().addClass('flex-grow-1 bg-success rounded h-5px me-2');
            passwordStrength4.removeClass().addClass('flex-grow-1 bg-success rounded h-5px me-2');
        }
    }

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    password.keyup(function () {
        checkStrength(password.val())
    });

    RegisterButton.click(function () {
        $(this).attr('disabled', 'disabled');
        toastr.info('Hesabınız Oluşturuluyor...');
        var name = $('#name').val();
        var surname = $('#surname').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();
        var terms_and_conditions = $('#terms_and_conditions').is(':checked') ? 1 : 0;

        if (!name) {
            toastr.warning('Ad Boş Olamaz');
        } else if (!surname) {
            toastr.warning('Soyad Boş Olamaz');
        } else if (!email) {
            toastr.warning('E-Posta Boş Olamaz');
        } else if (!isEmail(email)) {
            toastr.warning('Geçerli Bir E-Posta Adresi Giriniz');
        } else if (!password) {
            toastr.warning('Şifre Boş Olamaz');
        } else if (!password_confirmation) {
            toastr.warning('Şifre Doğrulama Boş Olamaz');
        } else if (password.length < 8) {
            toastr.warning('Şifreniz En Az 8 Karakter Olmalıdır');
        } else if (password !== password_confirmation) {
            toastr.warning('Şifreler Eşleşmiyor');
        } else if (!terms_and_conditions) {
            toastr.warning('Kullanım Koşullarını Kabul Etmediniz');
        } else {
            $.ajax({
                type: 'post',
                url: '{{ route('api.user.customer.create') }}',
                data: {
                    title: `${name} ${surname}`,
                    email: email,
                },
                success: function (response) {
                    var customerId = response.response.id;
                    $.ajax({
                        type: 'post',
                        url: '{{ route('api.user.create') }}',
                        data: {
                            customerId: customerId,
                            name: name,
                            surname: surname,
                            email: email,
                            password: password
                        },
                        success: function () {
                            toastr.success('Kaydınız Başarıyla Oluşturuldu!');
                            window.location.href = '{{ route('web.user.authentication.login') }}';
                        },
                        error: function (error) {
                            console.log(error);
                            toastr.error('Kullanıcı Kaydı Oluşturulurken Sistemsel Bir Sorun Oluştu!');
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Firma Kaydı Yapılırken Sistemsel Bir Sorun Oluştu!');
                }
            });
        }
    });

</script>
