@extends('user.layouts.master')
@section('title', 'Raporlar / İş Raporları / Telefon Bulma Özet Raporu | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.report.job.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Raporlar / İş Raporları / Telefon Bulma Özet Raporu</h1>
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
                <input id="startDate" type="datetime-local" class="form-control" aria-hidden="true" value="{{ date('Y-m-d') . 'T00:00' }}">
            </div>
        </div>
        <div class="col-xl-2 mb-5">
            <div class="form-group">
                <label for="endDate" class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">Bitiş Tarihi</span>
                </label>
                <input id="endDate" type="datetime-local" class="form-control" aria-hidden="true" value="{{ date('Y-m-d') . 'T' . date('H:i') }}">
            </div>
        </div>
        <div class="col-xl-2 mb-5">
            <div class="form-group d-grid">
                <button class="btn btn-primary mt-8" type="button" id="ReportButton">Raporla</button>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div class="row" id="reportRow" style="display: none">
        <div class="col-xl-12 mb-5">
            <div id="report"></div>
        </div>
        <div class="col-xl-12 text-end">
            <button class="btn btn-sm btn-primary" id="DownloadExcelButton">Excel İndir</button>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.report.reports.job.reports.callFindDetail.components.style')
@endsection

@section('customScripts')
    @include('user.modules.report.reports.job.reports.callFindDetail.components.script')
@endsection
