@extends('user.layouts.master')
@section('title', 'Kayıt Yapmayan Personeller | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-5 my-1">Kayıt Yapmayan Personeller</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12 col-12 mb-5">
            <label style="width: 100%">
                <input id="keyword" type="text" class="form-control" placeholder="Arayın...">
            </label>
        </div>
    </div>
    <hr class="text-muted">
    <div class="row mb-5" id="employeesRow"></div>

@endsection

@section('customStyles')
    @include('user.modules.earthquakeInformation.employee.components.style')
@endsection

@section('customScripts')
    @include('user.modules.earthquakeInformation.employee.components.script')
@endsection
