@extends('user.layouts.master')
@section('title', 'Performans Sistemi / Performans Sonuçları | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.performance.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Performans Sistemi / Performans Sonuçları</h1>
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

                        <div class="col-xl-3 mb-5 mt-6">
                            <div class="form-group mb-5">
                                <select id="prDepartmens" class="form-select form-select-solid" data-control="select2" data-placeholder="Departman Seçimi" data-minimum-results-for-search="Infinity" aria-label="Departman Seçimi">
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-3 mb-5 mt-6">
                            <div class="form-group mb-5">
                                <select id="prCards" class="form-select form-select-solid" data-control="select2" data-placeholder="Kart Seçimi" data-minimum-results-for-search="Infinity" aria-label="Kart Seçimi">
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <label for="prMonth">Performans Dönemi</label>
                            <div class="form-group mb-5">
                                <input type="month" class="form-control" id="prMonth">
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5 mt-6">
                            <div class="row">
                                <div class="col-xl-6"></div>
                                <div class="col-xl-6 mb-5">
                                    <div class="form-group d-grid">
                                        <button class="btn btn-success" id="getResultsButton" disabled>Sonuçları Getir</button>
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
            <div id="prResultDiv"></div>
        </div>
    </div>
@endsection

@section('customStyles')
    @include('user.modules.performance.prResult.components.style')
@endsection

@section('customScripts')
    @include('user.modules.performance.prResult.components.script')
@endsection
