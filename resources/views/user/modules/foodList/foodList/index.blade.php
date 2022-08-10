@extends('user.layouts.master')
@section('title', 'Yemek Yönetimi / Yemek Listesi | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Yemek Yönetimi / Yemek Listesi</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.foodList.foodList.modals.createFoodList')
    @include('user.modules.foodList.foodList.modals.updateFoodList')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.foodList.foodList.components.style')
@endsection

@section('customScripts')
    @include('user.modules.foodList.foodList.components.script')
@endsection
