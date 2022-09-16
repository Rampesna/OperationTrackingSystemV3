@extends('user.layouts.master')
@section('title', 'Görev Takibi | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.project.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Görev Takibi</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 mb-5">
                            <div class="form-group">
                                <label for="startDate">Başlangıç Tarihi</label>
                                <input id="startDate" type="datetime-local" class="form-control form-control-solid">
                            </div>
                        </div>
                        <div class="col-xl-2 mb-5">
                            <div class="form-group">
                                <label for="endDate">Bitiş Tarihi</label>
                                <input id="endDate" type="datetime-local" class="form-control form-control-solid">
                            </div>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group d-grid">
                                        <button class="btn btn-primary mt-6" id="GetTimesheetsButton">Görevleri Getir</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-flush h-xl-100">
                <div class="card-header pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">Görevler</span>
                    </h3>
                </div>
                <div class="card-body pb-0">
                    <div id="activeTimesheets" class="vis-timeline-custom min-w-700px"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.project.timesheet.components.style')
@endsection

@section('customScripts')
    @include('user.modules.project.timesheet.components.script')
@endsection

