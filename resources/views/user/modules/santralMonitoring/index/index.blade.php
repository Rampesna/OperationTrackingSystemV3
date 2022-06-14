@extends('user.layouts.master')
@section('title', 'Santral Takibi | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Santral Takibi</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">

        <a href="{{ route('user.web.santralMonitoring.monitor.job') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M13.625 22H9.625V3C9.625 2.4 10.025 2 10.625 2H12.625C13.225 2 13.625 2.4 13.625 3V22Z" fill="black"/>
                            <path d="M19.625 10H12.625V4H19.625L21.025 6.09998C21.325 6.59998 21.325 7.30005 21.025 7.80005L19.625 10Z" fill="black"/>
                            <path d="M3.62499 16H10.625V10H3.62499L2.225 12.1001C1.925 12.6001 1.925 13.3 2.225 13.8L3.62499 16Z" fill="black"/>
                        </svg>
                    </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">İş Takibi</span>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('user.web.santralMonitoring.monitor.employee') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z" fill="black"/>
                            <rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="black"/>
                            <path d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z" fill="black"/>
                            <rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="black"/>
                        </svg>
                    </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Personel Takibi</span>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('user.web.santralMonitoring.monitor.achievement') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M11 11H13C13.6 11 14 11.4 14 12V21H10V12C10 11.4 10.4 11 11 11ZM16 3V21H20V3C20 2.4 19.6 2 19 2H17C16.4 2 16 2.4 16 3Z" fill="black"/>
                            <path d="M21 20H8V16C8 15.4 7.6 15 7 15H5C4.4 15 4 15.4 4 16V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z" fill="black"/>
                        </svg>
                    </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Sıralamalar</span>
                    </div>
                </div>
            </div>
        </a>

    </div>

@endsection

@section('customStyles')
    @include('user.modules.santralMonitoring.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.santralMonitoring.index.components.script')
@endsection
