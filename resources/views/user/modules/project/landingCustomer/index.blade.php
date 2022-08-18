@extends('user.layouts.master')
@section('title', 'Projeler / Ürün Kullanıcıları | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.project.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Projeler / Ürün Kullanıcıları</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.project.layouts.overview')

    <div class="row">
        <div class="col-xl-8 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-9 mb-5">
                            <div class="form-group">
                                <label for="landing_customer_ids">Ürün Kullanıcı Listesi</label>
                                <select id="landing_customer_ids" class="form-select form-select-solid" data-control="select2" data-placeholder="Ürün Kullanıcı Listesi" multiple></select>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="form-group d-grid">
                                <button class="btn btn-primary mt-6" id="UpdateLandingCustomersButton">Güncelle</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.project.landingCustomer.components.style')
@endsection

@section('customScripts')
    @include('user.modules.project.landingCustomer.components.script')
@endsection

