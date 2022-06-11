@extends('user.layouts.master')
@section('title', 'Personel Departman Raporu | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Personel Departman Raporu</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row mb-5">
        <div class="col-xl-12 text-end">
            <button class="btn btn-sm btn-primary" id="DownloadExcelButton">Excel İndir</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="report"></div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.report.reports.employee.reports.jobDepartment.components.style')
@endsection

@section('customScripts')
    @include('user.modules.report.reports.employee.reports.jobDepartment.components.script')
@endsection
