@extends('user.layouts.master')
@section('title', 'İşe Alım Yönetimi / İşe Alım Listesi / İlerleme | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">İşe Alım Yönetimi / İşe Alım Listesi / İlerleme</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.recruiting.wizard.modals.sendSms')

    @include('user.modules.recruiting.wizard.drawers.recruitingEvaluationParameters')

    <button id="recruitingEvaluationParametersDrawerButton" style="display: none"></button>

    <div class="card mb-6 mb-xl-9">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                    <img class="w-100 h-100" src="{{ asset('assets/media/logos/avatar.png') }}" alt="image" id="employeeImageSpan">
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-4 mt-2">
                                <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3" id="nameSpan">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </a>
                            </div>
                            <div class="d-flex flex-wrap fw-bold mb-1 fs-6 text-gray-400" id="identitySpan">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                            <div class="d-flex flex-wrap fw-bold mb-1 fs-6 text-gray-400" id="emailSpan">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                            <div class="d-flex flex-wrap fw-bold mb-1 fs-6 text-gray-400" id="phoneNumberSpan">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                        </div>
                        <div class="d-flex mb-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row" id="wizard">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-9 mt-3">
                            <h5>Aşama</h5>
                        </div>
                        <div class="col-xl-3 text-end">
                            <button class="btn btn-sm btn-icon btn-secondary">
                                <i class="fa fa-th"></i>
                            </button>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="row pt-3">
                        <div class="col-xl-12 mb-5">
                            <i class="cursor-pointer fa fa-lg fa-check-circle text-success"></i><span class="taskTitle ms-2">Alt Aşama</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.recruiting.wizard.components.style')
@endsection

@section('customScripts')
    @include('user.modules.recruiting.wizard.components.script')
@endsection
