@extends('user.layouts.master')
@section('title', 'İnsan Kaynakları / Raporlar / Yaş & Cinsiyet Raporu | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">İnsan Kaynakları / Raporlar / Yaş & Cinsiyet Raporu</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row mb-5">
        <div class="col-xl-9"></div>
        <div class="col-xl-3 d-grid">
            <button class="btn btn-primary" id="DownloadExcelButton">Excel İndir</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="ageAndGenderReport">
                <div class="text-center">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.humanResources.report.ageAndGender.components.style')
@endsection

@section('customScripts')
    @include('user.modules.humanResources.report.ageAndGender.components.script')
@endsection
