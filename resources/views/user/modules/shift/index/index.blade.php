@extends('user.layouts.master')
@section('title', 'Vardiya | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Vardiya</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-3">
            <div class="form-group">
                <label style="width: 100%">
                    <input id="keyword" type="text" class="form-control" placeholder="Personel Arayın..." aria-hidden="true">
                </label>
            </div>
        </div>
        <div class="col-xl-3 mb-5">
            <div class="form-group">
                <label style="width: 100%">
                    <select id="jobDepartment" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Departman" multiple></select>
                </label>
            </div>
        </div>
        <div class="col-xl-3 mb-5">
            <div class="form-group">
                <button class="btn btn-sm btn-primary mt-1" id="FilterButton">Filtrele</button>
            </div>
        </div>
    </div>
    <hr class="text-muted">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">Vardiyalar</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.shift.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.shift.index.components.script')
@endsection
