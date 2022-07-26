@extends('user.layouts.master')
@section('title', 'İnsan Kaynakları / Kontrol Paneli | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">İnsan Kaynakları / Kontrol Paneli</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.humanResources.dashboard.modals.acceptPermit')
    @include('user.modules.humanResources.dashboard.modals.acceptOvertime')
    @include('user.modules.humanResources.dashboard.modals.acceptPayment')
    @include('user.modules.humanResources.dashboard.modals.denyPermit')
    @include('user.modules.humanResources.dashboard.modals.denyOvertime')
    @include('user.modules.humanResources.dashboard.modals.denyPayment')
    @include('user.modules.humanResources.dashboard.modals.updatePermit')
    @include('user.modules.humanResources.dashboard.modals.updateOvertime')
    @include('user.modules.humanResources.dashboard.modals.updatePayment')
    @include('user.modules.humanResources.dashboard.modals.deletePermit')
    @include('user.modules.humanResources.dashboard.modals.deleteOvertime')
    @include('user.modules.humanResources.dashboard.modals.deletePayment')

    <div class="row">
        <div class="col-xl-4 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-2hx">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z" fill="black"/>
                                <rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="black"/>
                                <path d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z" fill="black"/>
                                <rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-5">
                        <span class="fw-bolder text-gray-800 fs-2 lh-1 ls-n2" id="totalEmployeesCountSpan">
                            <i class="fa fa-lg fa-spinner fa-spin"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-3">
                        <span class="fw-bold text-gray-800 fs-5 lh-1 ls-n2">Toplam Personel</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M15.43 8.56949L10.744 15.1395C10.6422 15.282 10.5804 15.4492 10.5651 15.6236C10.5498 15.7981 10.5815 15.9734 10.657 16.1315L13.194 21.4425C13.2737 21.6097 13.3991 21.751 13.5557 21.8499C13.7123 21.9488 13.8938 22.0014 14.079 22.0015H14.117C14.3087 21.9941 14.4941 21.9307 14.6502 21.8191C14.8062 21.7075 14.9261 21.5526 14.995 21.3735L21.933 3.33649C22.0011 3.15918 22.0164 2.96594 21.977 2.78013C21.9376 2.59432 21.8452 2.4239 21.711 2.28949L15.43 8.56949Z" fill="black"/>
                                <path opacity="0.3" d="M20.664 2.06648L2.62602 9.00148C2.44768 9.07085 2.29348 9.19082 2.1824 9.34663C2.07131 9.50244 2.00818 9.68731 2.00074 9.87853C1.99331 10.0697 2.04189 10.259 2.14054 10.4229C2.23919 10.5869 2.38359 10.7185 2.55601 10.8015L7.86601 13.3365C8.02383 13.4126 8.19925 13.4448 8.37382 13.4297C8.54839 13.4145 8.71565 13.3526 8.85801 13.2505L15.43 8.56548L21.711 2.28448C21.5762 2.15096 21.4055 2.05932 21.2198 2.02064C21.034 1.98196 20.8409 1.99788 20.664 2.06648Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-5">
                        <span class="fw-bolder fs-2 text-gray-800 lh-1 ls-n2" id="todayPermittedEmployeesCountSpan">
                            <i class="fa fa-lg fa-spinner fa-spin"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-3">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Bugün İzinliler</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="21" viewBox="0 0 14 21" fill="none">
                                <path opacity="0.3" d="M12 6.20001V1.20001H2V6.20001C2 6.50001 2.1 6.70001 2.3 6.90001L5.6 10.2L2.3 13.5C2.1 13.7 2 13.9 2 14.2V19.2H12V14.2C12 13.9 11.9 13.7 11.7 13.5L8.4 10.2L11.7 6.90001C11.9 6.70001 12 6.50001 12 6.20001Z" fill="black"/>
                                <path d="M13 2.20001H1C0.4 2.20001 0 1.80001 0 1.20001C0 0.600012 0.4 0.200012 1 0.200012H13C13.6 0.200012 14 0.600012 14 1.20001C14 1.80001 13.6 2.20001 13 2.20001ZM13 18.2H10V16.2L7.7 13.9C7.3 13.5 6.7 13.5 6.3 13.9L4 16.2V18.2H1C0.4 18.2 0 18.6 0 19.2C0 19.8 0.4 20.2 1 20.2H13C13.6 20.2 14 19.8 14 19.2C14 18.6 13.6 18.2 13 18.2ZM4.4 6.20001L6.3 8.10001C6.7 8.50001 7.3 8.50001 7.7 8.10001L9.6 6.20001H4.4Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-5">
                        <input type="hidden" id="waitingTransactionsCountInput" value="0">
                        <span class="fw-bolder fs-2 text-gray-800 lh-1 ls-n2" id="waitingTransactionsCountSpan">
                            <i class="fa fa-lg fa-spinner fa-spin"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-3">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Bekleyen İşlemler</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="text-muted">
    <div class="row g-5 g-xl-10">
        <div class="col-xl-8">
            <div class="card h-xl-100" id="kt_timeline_widget_2_card">
                <div class="card-header position-relative py-0 border-bottom-2">
                    <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3">
                        <li class="nav-item p-0 ms-0 me-8">
                            <a class="nav-link btn btn-color-muted px-0 active" data-bs-toggle="pill" href="#waitingPermitsTab">
                                <span class="nav-text fw-bold fs-4 mb-3">Bekleyen İzinler</span>
                                <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            </a>
                        </li>
                        <li class="nav-item p-0 ms-0 me-8">
                            <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="pill" href="#waitingOvertimesTab">
                                <span class="nav-text fw-bold fs-4 mb-3">Bekleyen Mesailer</span>
                                <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            </a>
                        </li>
                        <li class="nav-item p-0 ms-0">
                            <a class="nav-link btn btn-color-muted px-0" data-bs-toggle="pill" href="#waitingPaymentsTab">
                                <span class="nav-text fw-bold fs-4 mb-3">Bekleyen Ödemeler</span>
                                <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="waitingPermitsTab">
                            <div class="table-responsive">
                                <table class="table align-middle gs-0 gy-4">
                                    <thead>
                                        <tr>
                                            <th class="p-0 w-25px"></th>
                                            <th class="p-0 w-25px"></th>
                                            <th class="p-0"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="waitingPermitsTBody"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="waitingOvertimesTab">
                            <div class="table-responsive">
                                <table class="table align-middle gs-0 gy-4">
                                    <thead>
                                    <tr>
                                        <th class="p-0 w-25px"></th>
                                        <th class="p-0 w-25px"></th>
                                        <th class="p-0"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="waitingOvertimesTBody"></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="waitingPaymentsTab">
                            <div class="table-responsive">
                                <table class="table align-middle gs-0 gy-4">
                                    <thead>
                                    <tr>
                                        <th class="p-0 w-25px"></th>
                                        <th class="p-0 w-25px"></th>
                                        <th class="p-0"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="waitingPaymentsTBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.humanResources.dashboard.components.style')
@endsection

@section('customScripts')
    @include('user.modules.humanResources.dashboard.components.script')
@endsection
