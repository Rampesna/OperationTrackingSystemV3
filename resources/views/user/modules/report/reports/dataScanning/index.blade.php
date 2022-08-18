@extends('user.layouts.master')
@section('title', 'Raporlar / Data Tarama Raporu | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.report.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Raporlar / Data Tarama Raporu</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-2 mb-5">
            <div class="form-group">
                <label for="startDate" class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">Başlangıç Tarihi</span>
                </label>
                <input id="startDate" type="date" class="form-control" aria-hidden="true">
            </div>
        </div>
        <div class="col-xl-2 mb-5">
            <div class="form-group">
                <label for="endDate" class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">Bitiş Tarihi</span>
                </label>
                <input id="endDate" type="date" class="form-control" aria-hidden="true">
            </div>
        </div>
        <div class="col-xl-4 mb-5">
            <div class="form-group">
                <label for="reportType" class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">Rapor Türü</span>
                </label>
                <select id="reportType" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Rapor Türü">
                    <option value="1">Personel Bazlı Data Tarama Adeti Raporu</option>
                    <option value="2">Data Tarama Durumu</option>
                </select>
            </div>
        </div>
        <div class="col-xl-4 mb-5">
            <div class="form-group d-grid">
                <button class="btn btn-primary mt-8" type="button" id="ReportButton">Raporla</button>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div class="row">
        <div class="col-xl-12">
            <div id="employeeReport"></div>
            <div id="statusReport"></div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.report.reports.dataScanning.components.style')
@endsection

@section('customScripts')
    @include('user.modules.report.reports.dataScanning.components.script')
@endsection
