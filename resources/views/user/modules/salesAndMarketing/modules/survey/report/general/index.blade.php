@extends('user.layouts.master')
@section('title', 'Script Genel Raporu | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Script Genel Raporu</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <span class="fw-bolder">Script Kodu:</span><span class="ms-2" id="surveyCodeSpan"></span>
            <span class="ms-5 fw-bolder">Uyum CRM Liste Kodu:</span><span class="ms-2" id="surveyListCodeSpan"></span>
            <span class="ms-5 fw-bolder">Script Adı:</span><span class="ms-2" id="surveyNameSpan"></span>
        </div>
    </div>
    <hr class="text-muted">
    <div class="row">
        <div class="col-xl-2 mb-5">
            <div class="form-group">
                <label for="startDate">Başlangıç Tarihi</label>
                <input id="startDate" type="datetime-local" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-xl-2 mb-5">
            <div class="form-group">
                <label for="endDate">Bitiş Tarihi</label>
                <input id="endDate" type="datetime-local" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-xl-2 mb-5">
            <div class="form-group d-grid">
                <button type="button" class="btn btn-sm btn-primary mt-6" id="ReportButton">Raporla</button>
            </div>
        </div>
        <div class="col-xl-6 text-end mb-5">
            <div class="form-group">
                <button type="button" class="btn btn-sm btn-info mt-6" id="ReportSelectedStatusesButton" style="display: none">Seçili Durumları Listeie</button>
            </div>
        </div>
    </div>
    <hr class="text-muted">
    <div class="row" id="reportCards">

    </div>
    <div id="reportsSection" style="display: none">
        <hr class="text-muted">
        <div class="row mb-5" id="reportsRow">

        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="wantedReports"></div>
            <div id="remainingReports"></div>
            <div id="statusReports"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-9"></div>
        <div class="col-xl-3">
            <div class="form-group d-grid">
                @if($id == 288)
                    @if(auth()->id() == 1)
                        <button type="button" class="btn btn-sm btn-primary mt-6" id="DownloadExcelButton" style="display: none">Excel İndir</button>
                    @endif
                @else
                    <button type="button" class="btn btn-sm btn-primary mt-6" id="DownloadExcelButton" style="display: none">Excel İndir</button>
                @endif
            </div>
        </div>
    </div>


@endsection

@section('customStyles')
    @include('user.modules.salesAndMarketing.modules.survey.report.general.components.style')
@endsection

@section('customScripts')
    @include('user.modules.salesAndMarketing.modules.survey.report.general.components.script')
@endsection
