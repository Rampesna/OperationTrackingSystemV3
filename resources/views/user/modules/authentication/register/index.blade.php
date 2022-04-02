@extends('user.layouts.auth')
@section('title', 'Kayıt Ol | ')

@section('content')

    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <a href="#" class="mb-12">
            <img alt="Logo" src="{{ asset('assets/media/logos/bien.png') }}" class="h-40px" />
        </a>
        <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <form class="form w-100">
                <div class="mb-10 text-center">
                    <div class="text-gray-400 fw-bold fs-4">Zaten hesabınız var mı?
                        <a href="{{ route('web.user.authentication.login') }}" class="link-primary fw-bolder">Giriş Yapın</a></div>
                </div>
                <hr class="mb-10 text-muted">
                <div class="row fv-row mb-7">
                    <div class="col-xl-6">
                        <label for="name" class="form-label fw-bolder text-dark fs-6">Adınız</label>
                        <input id="name" class="form-control form-control-lg form-control-solid" type="text" placeholder="" autocomplete="off" />
                    </div>
                    <div class="col-xl-6">
                        <label for="surname" class="form-label fw-bolder text-dark fs-6">Soyadınız</label>
                        <input id="surname" class="form-control form-control-lg form-control-solid" type="text" placeholder="" autocomplete="off" />
                    </div>
                </div>
                <div class="fv-row mb-7">
                    <label for="email" class="form-label fw-bolder text-dark fs-6">E-posta Adresiniz</label>
                    <input id="email" class="form-control form-control-lg form-control-solid emailMask" type="text" autocomplete="off" />
                </div>
                <div class="mb-10 fv-row" data-kt-password-meter="true">
                    <div class="mb-1">
                        <label for="password" class="form-label fw-bolder text-dark fs-6">Şifreniz</label>
                        <div class="position-relative mb-3">
                            <input id="password" class="form-control form-control-lg form-control-solid" type="password" placeholder="" autocomplete="off" />
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>
                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                        </div>
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary rounded h-5px me-2" id="passwordStrength1"></div>
                            <div class="flex-grow-1 bg-secondary rounded h-5px me-2" id="passwordStrength2"></div>
                            <div class="flex-grow-1 bg-secondary rounded h-5px me-2" id="passwordStrength3"></div>
                            <div class="flex-grow-1 bg-secondary rounded h-5px" id="passwordStrength4"></div>
                        </div>
                    </div>
                    <div class="text-muted">Harf, sayı ve simge içeren 8 veya daha fazla karakter kullanın.</div>
                </div>
                <div class="fv-row mb-5">
                    <label for="password_confirmation" class="form-label fw-bolder text-dark fs-6">Şifrenizi Tekrar Girin</label>
                    <input id="password_confirmation" class="form-control form-control-lg form-control-solid" type="password" placeholder="" autocomplete="off" />
                </div>
                <div class="fv-row mb-10">
                    <label class="form-check form-check-custom form-check-solid form-check-inline">
                        <input id="terms_and_conditions" class="form-check-input" type="checkbox" value="1" />
                        <span class="form-check-label fw-bold text-gray-700 fs-6">
                            <a href="#" class="ms-1 link-primary">Kullanım Koşullarını</a> kabul ediyorum.
                        </span>
                    </label>
                </div>
                <div class="text-center">
                    <button type="button" id="RegisterButton" class="btn btn-lg btn-primary">Kayıt Ol</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.auth.register.components.style')
@endsection

@section('customScripts')
    @include('user.modules.auth.register.components.script')
@endsection
