@extends('user.layouts.master')
@section('title', 'Yemek Yönetimi | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.dashboard.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Yemek Yönetimi</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">

        @if(checkUserPermission(136, $userPermissions))
        <a href="{{ route('user.web.foodList.foodList') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M12.3028 2C2.20276 8.5 0.302758 19.4 12.3028 22C24.3028 19.4 22.4028 8.5 12.3028 2Z" fill="black"/>
                                <path d="M12.3028 22L20.6028 13.7C20.7028 17.5 18.2028 20.7 12.3028 22ZM19.6028 9.7C19.1028 8.7 18.5028 7.7 17.6028 6.7L12.3028 12V17L19.6028 9.7ZM9.40277 4.10001C8.50277 4.90001 7.60277 5.80001 6.90277 6.60001L12.2028 11.9V6.89999L9.40277 4.10001ZM12.3028 2V7L15.2028 4.10001C14.3028 3.40001 13.3028 2.7 12.3028 2ZM4.00278 13.7L12.3028 22V17L5.00278 9.7C4.40278 11.1 4.00278 12.4 4.00278 13.7Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Yemek Listesi</span>
                    </div>
                </div>
            </div>
        </a>
        @endif
        @if(checkUserPermission(137, $userPermissions))
        <a href="{{ route('user.web.foodList.report') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M13.0021 10.9128V3.01281C13.0021 2.41281 13.5021 1.91281 14.1021 2.01281C16.1021 2.21281 17.9021 3.11284 19.3021 4.61284C20.7021 6.01284 21.6021 7.91285 21.9021 9.81285C22.0021 10.4129 21.5021 10.9128 20.9021 10.9128H13.0021Z" fill="black"/>
                                <path opacity="0.3" d="M11.0021 13.7128V4.91283C11.0021 4.31283 10.5021 3.81283 9.90208 3.91283C5.40208 4.51283 1.90209 8.41284 2.00209 13.1128C2.10209 18.0128 6.40208 22.0128 11.3021 21.9128C13.1021 21.8128 14.7021 21.3128 16.0021 20.4128C16.5021 20.1128 16.6021 19.3128 16.1021 18.9128L11.0021 13.7128Z" fill="black"/>
                                <path opacity="0.3" d="M21.9021 14.0128C21.7021 15.6128 21.1021 17.1128 20.1021 18.4128C19.7021 18.9128 19.0021 18.9128 18.6021 18.5128L13.0021 12.9128H20.9021C21.5021 12.9128 22.0021 13.4128 21.9021 14.0128Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Rapor</span>
                    </div>
                </div>
            </div>
        </a>
        @endif

    </div>

@endsection

@section('customStyles')
    @include('user.modules.foodList.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.foodList.index.components.script')
@endsection
