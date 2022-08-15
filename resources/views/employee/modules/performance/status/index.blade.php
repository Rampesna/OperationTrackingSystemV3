@extends('employee.layouts.master')
@section('title', 'Performans Analizi / Personel Durumum | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-5 my-1">Performans Analizi / Personel Durumum</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card card-custom card-stretch gutter-b" style="height: 200px">
                <div class="card-body mt-10">
                    <div class="row text-center">
                        <a class="col border-right pb-4 pt-4 text-dark-75 cursor-pointer" id="penaltyCard">
                            <i class="fa fa-info-circle fa-2x text-danger"></i><br>
                            <label class="mb-0 mr-5 mt-2 fw-bold cursor-pointer">Toplam Ceza Puanı</label>
                            <h4 class="font-30 fw-bold mt-4" style="font-size: 26px" id="totalPenaltySpan">
                                <i class="fa fa-sm fa-spinner fa-spin"></i>
                            </h4>
                        </a>
                        <a class="col border-right pb-4 pt-4 text-dark-75" id="successCard">
                            <i class="fa fa-check-circle fa-2x text-success"></i><br>
                            <label class="mb-0 mr-5 mt-2 fw-bold">Toplam Kazanılan Başarı Puanı</label>
                            <h4 class="font-30 fw-bold mt-4" style="font-size: 26px" id="totalSuccessSpan">
                                <i class="fa fa-sm fa-spinner fa-spin"></i>
                            </h4>
                        </a>
                        <a class="col border-right pb-4 pt-4 text-dark-75">
                            <i class="fas fa-sort-amount-down fa-2x text-primary"></i><br>
                            <label class="mb-0 mr-5 mt-2 fw-bold">Şuanki Başarı Sıranız</label>
                            <h4 class="font-30 fw-bold mt-4" style="font-size: 26px" id="nowSort">
                                <i class="fa fa-sm fa-spinner fa-spin"></i>
                            </h4>
                        </a>
                        <a class="col border-right pb-4 pt-4 text-dark-75" id="nowCard">
                            <i class="far fa-star fa-2x text-primary"></i><br>
                            <label class="mb-0 mr-5 mt-2 fw-bold">Yapılan İş Puanınız</label>
                            <h4 class="font-30 fw-bold mt-4" style="font-size: 26px" id="nowPoint">
                                <i class="fa fa-sm fa-spinner fa-spin"></i>
                            </h4>
                        </a>
                        <a class="col pb-4 pt-4 text-dark-75">
                            <i class="fa fa-plane fa-2x text-info"></i><br>
                            <label class="mb-0 mr-5 mt-2 fw-bold">Gelecek Cumartesi Durumu</label>
                            <h4 class="font-30 fw-bold mt-4" style="font-size: 26px" id="saturdayPermitStatusSpan">
                                <i class="fa fa-sm fa-spinner fa-spin"></i>
                            </h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="text-muted">
    <div id="report"></div>

@endsection

@section('customStyles')
    @include('employee.modules.performance.status.components.style')
@endsection

@section('customScripts')
    @include('employee.modules.performance.status.components.script')
@endsection
