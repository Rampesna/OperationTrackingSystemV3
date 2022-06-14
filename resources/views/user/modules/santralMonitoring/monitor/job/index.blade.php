@extends('user.layouts.masterBlank')
@section('title', 'İş Takibi | ')

@section('subheader')

@endsection

@section('content')

    <div class="row" style="margin-top: -120px">
        <div class="col-xl-4">
            <label style="width: 100%">
                <select id="SelectedCompanies" class="form-control selectpicker" data-placeholder="Firma Seçimi" multiple>

                </select>
            </label>
        </div>
        <div class="col-xl-4">

        </div>
        <div class="col-xl-4 text-right">
            <a href="#" id="ReloadPage"><i class="ki ki-reload"></i></a>
        </div>
    </div>
    <hr class="text-muted">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-xl-12 text-center">
                            <h1>Kuyruklar</h1>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="row mb-5">
                        <div class="col-xl-12">
                            <div class="card text-center bg-secondary" id="totalWaitingCallsCard">
                                <div class="card-header border-0 py-10">
                                    <h1 class="fs-2x">Toplam:</h1>
                                    <h1 class="fs-2x" id="totalWaitingCalls">
                                        <i class="fas fa-spinner fa-spin fa-sm"></i>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="waitingCalls"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-xl-12 text-center">
                            <h1>Kayıplar</h1>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="row mb-5">
                        <div class="col-xl-12">
                            <div class="card text-center bg-secondary" id="totalMissedCallsCard">
                                <div class="card-header border-0 py-10">
                                    <h1 class="fs-2x">Toplam:</h1>
                                    <h1 class="fs-2x" id="totalMissedCalls">
                                        <i class="fas fa-spinner fa-spin fa-sm"></i>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="missedCalls"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-xl-12 text-center">
                            <h1>Bekleyen İşler</h1>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="row mb-5">
                        <div class="col-xl-12">
                            <div class="card text-center bg-secondary" id="totalWaitingJobsCard">
                                <div class="card-header border-0 py-10">
                                    <h1 class="fs-2x">Toplam:</h1>
                                    <h1 class="fs-2x" id="totalWaitingJobs">
                                        <i class="fas fa-spinner fa-spin fa-sm"></i>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="waitingJobs"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.santralMonitoring.monitor.job.components.style')
@endsection

@section('customScripts')
    @include('user.modules.santralMonitoring.monitor.job.components.script')
@endsection
