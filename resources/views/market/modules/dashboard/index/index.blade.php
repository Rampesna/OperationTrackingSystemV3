@extends('market.layouts.master')
@section('title', 'Anasayfa | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-5 my-1">Anasayfa</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('market.modules.dashboard.index.modals.setMarketPaymentCompleted')

    <div class="row">
        <div class="col-xl-6 mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-3hx">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M20 18H4C3.4 18 3 17.6 3 17V7C3 6.4 3.4 6 4 6H20C20.6 6 21 6.4 21 7V17C21 17.6 20.6 18 20 18ZM12 8C10.3 8 9 9.8 9 12C9 14.2 10.3 16 12 16C13.7 16 15 14.2 15 12C15 9.8 13.7 8 12 8Z" fill="black"/>
                                <path d="M18 6H20C20.6 6 21 6.4 21 7V9C19.3 9 18 7.7 18 6ZM6 6H4C3.4 6 3 6.4 3 7V9C4.7 9 6 7.7 6 6ZM21 17V15C19.3 15 18 16.3 18 18H20C20.6 18 21 17.6 21 17ZM3 15V17C3 17.6 3.4 18 4 18H6C6 16.3 4.7 15 3 15Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-2hx text-success lh-1 ls-n2" id="marketBalanceSpan">
                            <i class="fa fa-spinner fa-spin fa-lg"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 lh-1 ls-n2">Bakiye</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-5">
            <div onclick="setMarketPaymentCompleted()" class="card cursor-pointer h-lg-100">
                <div class="card-body bg-success d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-5hx svg-icon-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M20 18H4C3.4 18 3 17.6 3 17V7C3 6.4 3.4 6 4 6H20C20.6 6 21 6.4 21 7V17C21 17.6 20.6 18 20 18ZM12 8C10.3 8 9 9.8 9 12C9 14.2 10.3 16 12 16C13.7 16 15 14.2 15 12C15 9.8 13.7 8 12 8Z" fill="black"/>
                                <path d="M18 6H20C20.6 6 21 6.4 21 7V9C19.3 9 18 7.7 18 6ZM6 6H4C3.4 6 3 6.4 3 7V9C4.7 9 6 7.7 6 6ZM21 17V15C19.3 15 18 16.3 18 18H20C20.6 18 21 17.6 21 17ZM3 15V17C3 17.6 3.4 18 4 18H6C6 16.3 4.7 15 3 15Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-2 text-white lh-1 ls-n2">Ödeme Al</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('market.modules.dashboard.index.components.style')
@endsection

@section('customScripts')
    @include('market.modules.dashboard.index.components.script')
@endsection
