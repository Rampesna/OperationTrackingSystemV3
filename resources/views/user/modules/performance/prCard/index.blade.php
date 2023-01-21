@extends('user.layouts.master')
@section('title', 'Performans Sistemi / Performans Kartları | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.performance.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Performans Sistemi / Performans Kartları</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <div class="form-group mb-5">
                                <select id="jobDepartments" class="form-select form-select-solid" data-control="select2" data-placeholder="Departman Seçimi" data-minimum-results-for-search="Infinity" aria-label="Çalışma Durumu">

                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="row">
                                <div class="col-xl-6 mb-5">
                                    <div class="form-group d-grid">
                                        <button class="btn btn-primary" id="GetPrCardsButton" disabled>Kartları Getir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="row">
                                <div class="col-xl-6"></div>
                                <div class="col-xl-6 mb-5">
                                    <div class="form-group d-grid">
                                        <button class="btn btn-success" onclick="createPrCard()">Yeni Kart Oluştur</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xl-12">
            <div id="prCardsDiv"></div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.performance.prCard.components.style')
@endsection

@section('customScripts')
    @include('user.modules.performance.prCard.components.script')
@endsection
