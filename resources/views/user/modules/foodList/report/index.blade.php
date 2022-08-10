@extends('user.layouts.master')
@section('title', 'Yemek Yönetimi / Rapor | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Yemek Yönetimi / Rapor</h1>
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
                        <div class="col-xl-2 mb-5">
                            <div class="form-group">
                                <label for="startDate">Başlangıç Tarihi</label>
                                <input id="startDate" type="date" class="form-control form-control-solid filterInput">
                            </div>
                        </div>
                        <div class="col-xl-2 mb-5">
                            <div class="form-group">
                                <label for="endDate">Bitiş Tarihi</label>
                                <input id="endDate" type="date" class="form-control form-control-solid filterInput">
                            </div>
                        </div>
                        <div class="col-xl-2 mb-5">
                            <div class="form-group d-grid">
                                <button class="btn btn-primary mt-6" id="ReportButton">Raporla</button>
                            </div>
                        </div>
                        <div class="col-xl-2 mb-5"></div>
                        <div class="col-xl-2 mb-5"></div>
                        <div class="col-xl-2 mb-5">
                            <div class="form-group d-grid">
                                <button class="btn btn-primary mt-6" id="DownloadExcelButton" style="display: none">Excel İndir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="text-muted">
    <div id="report"></div>

@endsection

@section('customStyles')
    @include('user.modules.foodList.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.foodList.index.components.script')
@endsection
