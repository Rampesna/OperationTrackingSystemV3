@extends('user.layouts.master')
@section('title', 'Kalite Değerlendirme | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Kalite Değerlendirme</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">

        @if(checkUserPermission(182, $userPermissions))
        <a href="{{ route('user.web.qualityAssessment.call') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                    <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M14 3V20H2V3C2 2.4 2.4 2 3 2H13C13.6 2 14 2.4 14 3ZM11 13V11C11 9.7 10.2 8.59995 9 8.19995V7C9 6.4 8.6 6 8 6C7.4 6 7 6.4 7 7V8.19995C5.8 8.59995 5 9.7 5 11V13C5 13.6 4.6 14 4 14V15C4 15.6 4.4 16 5 16H11C11.6 16 12 15.6 12 15V14C11.4 14 11 13.6 11 13Z" fill="black"/>
                            <path d="M2 20H14V21C14 21.6 13.6 22 13 22H3C2.4 22 2 21.6 2 21V20ZM9 3V2H7V3C7 3.6 7.4 4 8 4C8.6 4 9 3.6 9 3ZM6.5 16C6.5 16.8 7.2 17.5 8 17.5C8.8 17.5 9.5 16.8 9.5 16H6.5ZM21.7 12C21.7 11.4 21.3 11 20.7 11H17.6C17 11 16.6 11.4 16.6 12C16.6 12.6 17 13 17.6 13H20.7C21.2 13 21.7 12.6 21.7 12ZM17 8C16.6 8 16.2 7.80002 16.1 7.40002C15.9 6.90002 16.1 6.29998 16.6 6.09998L19.1 5C19.6 4.8 20.2 5 20.4 5.5C20.6 6 20.4 6.60005 19.9 6.80005L17.4 7.90002C17.3 8.00002 17.1 8 17 8ZM19.5 19.1C19.4 19.1 19.2 19.1 19.1 19L16.6 17.9C16.1 17.7 15.9 17.1 16.1 16.6C16.3 16.1 16.9 15.9 17.4 16.1L19.9 17.2C20.4 17.4 20.6 18 20.4 18.5C20.2 18.9 19.9 19.1 19.5 19.1Z" fill="black"/>
                        </svg>
                    </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Çağrı</span>
                    </div>
                </div>
            </div>
        </a>
        @endif
        @if(checkUserPermission(183, $userPermissions))
            <a href="{{ route('user.web.qualityAssessment.mail') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
                <div class="card h-lg-100">
                    <div class="card-body d-flex justify-content-between align-items-center flex-column">
                        <div class="m-0">
                            <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="black"/>
                                    <rect x="6" y="12" width="7" height="2" rx="1" fill="black"/>
                                    <rect x="6" y="7" width="12" height="2" rx="1" fill="black"/>
                                </svg>
                            </span>
                        </div>
                        <div class="d-flex flex-column mt-7">
                            <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Yazılı İletişim</span>
                        </div>
                    </div>
                </div>
            </a>
        @endif

    </div>

@endsection

@section('customStyles')
    @include('user.modules.qualityAssessment.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.qualityAssessment.index.components.script')
@endsection
