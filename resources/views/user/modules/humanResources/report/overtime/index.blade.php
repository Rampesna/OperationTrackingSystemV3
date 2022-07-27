@extends('user.layouts.master')
@section('title', 'İnsan Kaynakları / Raporlar / Mesai Raporu | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">İnsan Kaynakları / Raporlar / Mesai Raporu</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row mb-5">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-8 mb-5">
                            <label for="employeeIds">Personeller</label>
                            <div class="input-group input-group-solid flex-nowrap">
                                <button class="btn btn-icon btn-success" id="SelectAllEmployeesButton"><i class="fa fa-check-circle"></i></button>
                                <button class="btn btn-icon btn-danger" id="UnSelectAllEmployeesButton"><i class="fa fa-times-circle"></i></button>
                                <select id="employeeIds" class="form-control form-control-solid selectpicker" title="Personeller" multiple></select>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <label for="employeeIds">Mesai Türleri</label>
                            <select id="typeIds" class="form-control form-control-solid selectpicker" title="Mesai Türleri" multiple></select>
                        </div>
                        <div class="col-xl-2 mb-5">
                            <label for="startDate">Başlangıç Tarihi</label>
                            <input id="startDate" type="date" class="form-control form-control-solid">
                        </div>
                        <div class="col-xl-2 mb-5">
                            <label for="endDate">Bitiş Tarihi</label>
                            <input id="endDate" type="date" class="form-control form-control-solid">
                        </div>
                        <div class="col-xl-2 mb-5 d-grid">
                            <button class="btn btn-primary mt-5" id="ReportButton">Raporla</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-xl-12">
            <div id="overtimeReport"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-9"></div>
        <div class="col-xl-3 d-grid">
            <button class="btn btn-primary" id="DownloadExcelButton" style="display: none">Excel İndir</button>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.humanResources.report.overtime.components.style')
@endsection

@section('customScripts')
    @include('user.modules.humanResources.report.overtime.components.script')
@endsection
