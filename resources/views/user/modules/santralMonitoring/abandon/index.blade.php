@extends('user.layouts.master')
@section('title', 'Santral Takibi / Kayıp Çağrılar | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.dashboard.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Santral Takibi / Kayıp Çağrılar</h1>
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
                        <div class="col-xl-9 mb-5">
                            <div class="form-group">
                                <label for="queue_id_filter">Kuyruk Seçimi</label>
                                <select id="queue_id_filter" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Kuyruk Seçimi"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="form-group d-grid">
                                <button class="btn btn-primary mt-6" id="GetAbandonsButton">Kayıp Çağrıları Getir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="text-muted">
    <div class="row">
        <div class="col-xl-12">
            <div id="abandons"></div>
        </div>
    </div>
    <div class="row mb-5" id="DownloadExcelArea" style="display: none">
        <hr class="text-muted">
        <div class="col-xl-9"></div>
        <div class="col-xl-3 d-grid">
            <button class="btn btn-primary" id="DownloadExcelButton">Excel İndir</button>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.santralMonitoring.abandon.components.style')
@endsection

@section('customScripts')
    @include('user.modules.santralMonitoring.abandon.components.script')
@endsection
