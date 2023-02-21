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

    @include('user.modules.earthquakeInformation.index.modals.createEarthquakeInformation')
    @include('user.modules.earthquakeInformation.index.modals.updateEarthquakeInformation')

    <input type="hidden" id="selected_employee_row_index">
    <input type="hidden" id="selected_employee_id">
    <div class="row">
        <div class="col-xl-6">
            <button class="btn btn-warning" onclick="goToUnRegistereds()">Kayıt Yapmayanlar</button>
        </div>
        <div class="col-xl-6 text-end">
            <button class="btn btn-success" onclick="createEarthquakeInformation()">Yeni Kayıt Ekle</button>
        </div>
    </div>
{{--    <hr class="text-muted">--}}
{{--    <div class="row" id="cards">--}}
{{--        <div class="col-xl-3 col-6 mb-5">--}}
{{--            <div class="card h-lg-100">--}}
{{--                <div class="card-body d-flex justify-content-between align-items-center flex-column">--}}
{{--                    <div class="m-0 fs-2hx" id="">--}}
{{--                        <i class="fa fa-spinner fa-spin"></i>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-column mt-2">--}}
{{--                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Şuanda Çalışanlar</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-3 col-6 mb-5">--}}
{{--            <div class="card h-lg-100">--}}
{{--                <div class="card-body d-flex justify-content-between align-items-center flex-column">--}}
{{--                    <div class="m-0 fs-2hx" id="">--}}
{{--                        <i class="fa fa-spinner fa-spin"></i>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-column mt-2">--}}
{{--                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Bilgisayarı Olanlar</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-3 col-6 mb-5">--}}
{{--            <div class="card h-lg-100">--}}
{{--                <div class="card-body d-flex justify-content-between align-items-center flex-column">--}}
{{--                    <div class="m-0 fs-2hx" id="">--}}
{{--                        <i class="fa fa-spinner fa-spin"></i>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-column mt-2">--}}
{{--                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">İnterneti Olanlar</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-3 col-6 mb-5">--}}
{{--            <div class="card h-lg-100">--}}
{{--                <div class="card-body d-flex justify-content-between align-items-center flex-column">--}}
{{--                    <div class="m-0 fs-2hx" id="">--}}
{{--                        <i class="fa fa-spinner fa-spin"></i>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex flex-column mt-2">--}}
{{--                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Kulaklığı Olanlar</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <hr class="text-muted">
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
