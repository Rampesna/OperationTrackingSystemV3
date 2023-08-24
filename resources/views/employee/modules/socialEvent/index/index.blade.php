@extends('employee.layouts.master')
@section('title', 'Etkinlikler | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-5 my-1">Etkinlikler</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="card">
        <div class="card-header card-header-stretch">
            <div class="card-title d-flex align-items-center">
                <h3 class="fw-bold m-0 text-gray-800">Etkinlikler</h3>
            </div>
        </div>

        <div class="card-body">
            <div class="timeline">
                <div class="row" id="timelineBody">

                </div>
            </div>

        </div>
    </div>

@endsection

@section('customStyles')
    @include('employee.modules.socialEvent.index.components.style')
@endsection

@section('customScripts')
    @include('employee.modules.socialEvent.index.components.script')
@endsection
