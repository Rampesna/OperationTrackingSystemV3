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
                            <label class="mb-0 mr-5 mt-2 font-weight-bold cursor-pointer">Toplam Ceza Puanı</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px" id="totalPenaltySpan">--</h4>
                        </a>
                        <a class="col border-right pb-4 pt-4 text-dark-75 cursor-pointer" id="successCard">
                            <i class="fa fa-check-circle fa-2x text-success"></i><br>
                            <label class="mb-0 mr-5 mt-2 font-weight-bold cursor-pointer">Toplam Kazanılan Başarı Puanı</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px" id="totalSuccessSpan">--</h4>
                        </a>
                        <a class="col border-right pb-4 pt-4 text-dark-75 cursor-pointer">
                            <i class="fas fa-sort-amount-down fa-2x text-primary"></i><br>
                            <label class="mb-0 mr-5 mt-2 font-weight-bold cursor-pointer">Şuanki Başarı Sıranız</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px" id="nowSort">--</h4>
                        </a>
                        <a class="col border-right pb-4 pt-4 text-dark-75 cursor-pointer" id="nowCard">
                            <i class="far fa-star fa-2x text-primary"></i><br>
                            <label class="mb-0 mr-5 mt-2 font-weight-bold cursor-pointer">Yapılan İş Puanınız</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px" id="nowPoint">--</h4>
                        </a>
                        <a class="col pb-4 pt-4 text-dark-75 cursor-pointer">
                            <i class="fa fa-plane fa-2x text-info"></i><br>
                            <label class="mb-0 mr-5 mt-2 font-weight-bold cursor-pointer">Haftasonu İzni Aday Durumu</label>
                            <h4 class="font-30 font-weight-bold text-col-blue" style="font-size: 30px" id="saturdayPermitStatusSpan">--</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('employee.modules.performance.status.components.style')
@endsection

@section('customScripts')
    @include('employee.modules.performance.status.components.script')
@endsection
