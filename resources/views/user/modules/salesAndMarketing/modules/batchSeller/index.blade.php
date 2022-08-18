@extends('user.layouts.master')
@section('title', 'Satış Pazarlama / Satıcılar / Toplu Satıcı Oluştur | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.salesAndMarketing.modules.seller.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Satış Pazarlama / Satıcılar / Toplu Satıcı Oluştur</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.salesAndMarketing.modules.batchSeller.modals.createBatchSeller')

    <div class="row">
        <div class="col-xl-12">
            <div class="form-group">
                <button class="btn btn-sm btn-primary" onclick="createBatchSeller()">Seçilileri Oluştur</button>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-4">
            <div id="sellers" class="text-center">
                <i class="fa fa-lg fa-spinner fa-spin mt-20"></i>
            </div>
        </div>
        <div class="col-xl-4">
            <div id="scripts" class="text-center">
                <i class="fa fa-lg fa-spinner fa-spin mt-20"></i>
            </div>
        </div>
        <div class="col-xl-4">
            <div id="products" class="text-center">
                <i class="fa fa-lg fa-spinner fa-spin mt-20"></i>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.salesAndMarketing.modules.batchSeller.components.style')
@endsection

@section('customScripts')
    @include('user.modules.salesAndMarketing.modules.batchSeller.components.script')
@endsection
