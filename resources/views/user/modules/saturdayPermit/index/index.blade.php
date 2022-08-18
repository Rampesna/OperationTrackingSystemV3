@extends('user.layouts.master')
@section('title', 'Cumartesi İzinleri | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.dashboard.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Cumartesi İzinleri</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.saturdayPermit.index.modals.cancelSaturdayPermit')

    <div class="row">
        <div class="col-xl-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <input id="keyword" type="text" class="form-control form-control-solid" placeholder="Personel Arayın..." aria-hidden="true" aria-label="Personel Arayın...">
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="form-group">
                                <select id="jobDepartmentIds" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Departman" aria-label="Departman" disabled multiple></select>
                            </div>
                        </div>
                        <div class="col-xl-3 d-grid mb-5">
                            <button class="btn btn-primary mt-1" id="FilterButton">Filtrele</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    @include('user.modules.saturdayPermit.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.saturdayPermit.index.components.script')
@endsection
