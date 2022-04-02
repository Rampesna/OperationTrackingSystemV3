<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
</head>
<body id="kt_body" class="bg-dark">
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url({{ asset('assets/media/illustrations/sigma-1/14-dark.png') }}">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <a href="#" class="mb-12">
                <img alt="Logo" src="{{ asset('assets/media/logos/logo-2.svg') }}" class="h-40px" />
            </a>
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <div class="form w-100">
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Yönetim</h1>
                    </div>
                    <div class="fv-row mb-10">
                        <label for="email" class="form-label fs-6 fw-bolder text-dark">E-posta Adresi</label>
                        <input class="form-control form-control-lg form-control-solid emailMask" type="text" id="email" autocomplete="off" />
                    </div>
                    <div class="fv-row mb-10">
                        <div class="d-flex flex-stack mb-2">
                            <label for="password" class="form-label fw-bolder text-dark fs-6 mb-0">Şifre</label>
                            <a href="#" class="link-primary fs-6 fw-bolder">Şifremi Unuttum</a>
                        </div>
                        <input class="form-control form-control-lg form-control-solid" type="password" id="password" autocomplete="off" />
                    </div>
                    <div class="text-center">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">Giriş Yap</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>
</html>
