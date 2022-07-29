@extends('user.layouts.master')
@section('title', 'Envanter Yönetimi | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Envanter Yönetimi</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">

        <a href="{{ route('user.web.inventory.employee') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"/>
                                <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Personel Listesi</span>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('user.web.inventory.device') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 5C12.3 5 12.7 4.99998 13 5.09998V5V3C13 2.4 12.6 2 12 2C11.4 2 11 2.4 11 3V5V5.09998C11.3 4.99998 11.7 5 12 5Z" fill="black"/>
                                <path opacity="0.3" d="M12 22C8.7 22 6 19.3 6 16V11C6 7.7 8.7 5 12 5C15.3 5 18 7.7 18 11V16C18 19.3 15.3 22 12 22ZM13 12V9C13 8.4 12.6 8 12 8C11.4 8 11 8.4 11 9V12C11 12.6 11.4 13 12 13C12.6 13 13 12.6 13 12Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Cihaz Listesi</span>
                    </div>
                </div>
            </div>
        </a>

    </div>

@endsection

@section('customStyles')
    @include('user.modules.inventory.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.inventory.index.components.script')
@endsection
