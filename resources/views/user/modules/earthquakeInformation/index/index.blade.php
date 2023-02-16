@extends('user.layouts.master')
@section('title', 'Deprem Bilgileri | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-5 my-1">Deprem Bilgileri</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div id="earthquakeInformations"></div>
        </div>
    </div>
    <hr>
    <div class="row" id="DownloadExcelButtonArea" style="display: none">
        <div class="col-xl-12">
            <div class="text-end">
                <button class="btn btn-success" id="DownloadExcelButton">Excel İndir</button>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.earthquakeInformation.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.earthquakeInformation.index.components.script')
@endsection
