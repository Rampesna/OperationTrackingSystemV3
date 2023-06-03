@extends('user.layouts.master')
@section('title', 'Profilim | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Profilim</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')


    <div class="row">
        <div class="col-xl-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <label for="old_password">Eski Şifreniz</label>
                            <input id="old_password" type="password" class="form-control form-control-solid">
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label for="new_password">Yeni Şifreniz</label>
                            <input id="new_password" type="password" class="form-control form-control-solid">
                        </div>
                        <div class="col-xl-12 mb-5">
                            <label for="confirm_password">Yeni Şifre Tekrarı</label>
                            <input id="confirm_password" type="password" class="form-control form-control-solid">
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="row">
                        <div class="col-xl-12 text-end">
                            <button class="btn btn-success" id="UpdateButton">Güncelle</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.profile.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.profile.index.components.script')
@endsection
