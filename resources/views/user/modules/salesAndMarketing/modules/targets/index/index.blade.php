@extends('user.layouts.master')
@section('title', 'Satış Pazarlama | Hedefler | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.salesAndMarketing.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Satış Pazarlama / Hedefler</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')
@include('user.modules.salesAndMarketing.modules.targets.index.modals.addTarget')
    <div class="row">
        <div class="col-xl-3 col-12 mb-5">
            <label style="width: 100%">
                <input id="keyword" type="text" class="form-control" placeholder="Arayın...">
            </label>
        </div>
        <div class="col-xl-3 col-12 mb-5">
            <label style="width: 100%">
                <select id="jobDepartmentFilterer" class="form-select select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Departman" aria-hidden="true" multiple>

                </select>
            </label>
        </div>

    </div>
    <hr class="text-muted">
    <div class="row mb-5" id="employeesRow"></div>

@endsection

@section('customStyles')
    @include('user.modules.salesAndMarketing.modules.targets.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.salesAndMarketing.modules.targets.index.components.script')
@endsection
