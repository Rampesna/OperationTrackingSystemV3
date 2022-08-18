@extends('user.layouts.master')
@section('title', 'SMS Servisi | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.dashboard.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">SMS Servisi</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="">
                                <label for="send_batch_sms_to_employees_employee_ids">Personeller</label>
                                <div class="input-group input-group-solid flex-nowrap">
                                    <button class="btn btn-icon btn-success" id="SelectAllEmployeesButton"><i class="fa fa-check-circle"></i></button>
                                    <button class="btn btn-icon btn-danger" id="UnSelectAllEmployeesButton"><i class="fa fa-times-circle"></i></button>
                                    <select id="send_batch_sms_to_employees_employee_ids" class="form-control form-control-solid selectpicker" title="Personeller" data-live-search="true" multiple></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="">
                                <label for="send_batch_sms_to_employees_message">SMS</label>
                                <textarea id="send_batch_sms_to_employees_message" rows="4" class="form-control form-control-solid"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="row">
                        <div class="col-xl-12 text-end">
                            <button class="btn btn-success" id="SendBatchSmsToEmployeesButton">SMS Gönder</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="">
                                <label for="send_batch_sms_to_numbers_numbers">Telefon Numaraları <small class="required">(5XXXXXXXXX)</small></label>
                                <input id="send_batch_sms_to_numbers_numbers" class="form-control form-control-solid onlyNumber">
                            </div>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="">
                                <label for="send_batch_sms_to_numbers_message">SMS</label>
                                <textarea id="send_batch_sms_to_numbers_message" rows="4" class="form-control form-control-solid" required></textarea>
                            </div>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="row">
                        <div class="col-xl-12 text-end">
                            <button class="btn btn-success" id="SendBatchSmsToNumbersButton">SMS Gönder</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.batchSms.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.batchSms.index.components.script')
@endsection
