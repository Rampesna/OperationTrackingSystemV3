@extends('employee.layouts.master')
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

    <h1 id="happyBirthday" style="display: none"></h1>

    @include('employee.modules.dashboard.index.modals.createPermit')
    @include('employee.modules.dashboard.index.modals.updatePermit')
    @include('employee.modules.dashboard.index.modals.createOvertime')
    @include('employee.modules.dashboard.index.modals.updateOvertime')
    @include('employee.modules.dashboard.index.modals.createPayment')
    @include('employee.modules.dashboard.index.modals.updatePayment')
    @include('employee.modules.dashboard.index.modals.createMarketPayment')
    @include('employee.modules.dashboard.index.modals.showShift')
    @include('employee.modules.dashboard.index.modals.showPermit')
    @include('employee.modules.dashboard.index.modals.showOvertime')
    @include('employee.modules.dashboard.index.modals.showPayment')
    @include('employee.modules.dashboard.index.modals.updateFoodListCheck')
    @include('employee.modules.dashboard.index.modals.diagram')

    <div class="row" id="mainMissions"></div>
{{--    <div class="row">--}}
{{--        <div class="col-xl-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header pt-3 pb-2">--}}
{{--                    <h5>Ek Görevlerim</h5>--}}
{{--                </div>--}}
{{--                <div class="card-body mt-n5">--}}
{{--                    <table class="table align-middle table-row-dashed fs-6 gy-5">--}}
{{--                        <thead>--}}
{{--                        <tr class="text-start text-dark fw-bolder fs-7 gs-0">--}}
{{--                            <th>Görev Adı</th>--}}
{{--                            <th>Görev Durumu</th>--}}
{{--                            <th>Görev Başlangıcı</th>--}}
{{--                            <th>Görev Bitişi</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody class="fw-bold text-gray-600" id="additionalCentralMissions"></tbody>--}}
{{--                    </table>--}}
{{--                    <hr class="text-muted">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-xl-12 text-end">--}}
{{--                            <span class="text-muted">Toplam <span id="totalCountSpan">%</span> Kayıttan <span id="startCountSpan">%</span> - <span id="endCountSpan">%</span> Arasındakiler Gösteriliyor</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <hr class="text-muted">

    <div class="row">
        <div class="col-xl-5">
            <div class="row">
                <div class="col-xl-6 mb-5">
                    <div onclick="createPermit()" class="card cursor-pointer h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-center flex-column">
                            <div class="m-0">
                                <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M15.43 8.56949L10.744 15.1395C10.6422 15.282 10.5804 15.4492 10.5651 15.6236C10.5498 15.7981 10.5815 15.9734 10.657 16.1315L13.194 21.4425C13.2737 21.6097 13.3991 21.751 13.5557 21.8499C13.7123 21.9488 13.8938 22.0014 14.079 22.0015H14.117C14.3087 21.9941 14.4941 21.9307 14.6502 21.8191C14.8062 21.7075 14.9261 21.5526 14.995 21.3735L21.933 3.33649C22.0011 3.15918 22.0164 2.96594 21.977 2.78013C21.9376 2.59432 21.8452 2.4239 21.711 2.28949L15.43 8.56949Z" fill="black"/>
                                        <path opacity="0.3" d="M20.664 2.06648L2.62602 9.00148C2.44768 9.07085 2.29348 9.19082 2.1824 9.34663C2.07131 9.50244 2.00818 9.68731 2.00074 9.87853C1.99331 10.0697 2.04189 10.259 2.14054 10.4229C2.23919 10.5869 2.38359 10.7185 2.55601 10.8015L7.86601 13.3365C8.02383 13.4126 8.19925 13.4448 8.37382 13.4297C8.54839 13.4145 8.71565 13.3526 8.85801 13.2505L15.43 8.56548L21.711 2.28448C21.5762 2.15096 21.4055 2.05932 21.2198 2.02064C21.034 1.98196 20.8409 1.99788 20.664 2.06648Z" fill="black"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column mt-7">
                                <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">İzin Talebi</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-5">
                    <div onclick="createOvertime()" class="card cursor-pointer h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-center flex-column">
                            <div class="m-0">
                                <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="black"/>
                                        <path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="black"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column mt-7">
                                <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Mesai Talebi</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-5">
                    <div onclick="createPayment()" class="card cursor-pointer h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-center flex-column">
                            <div class="m-0">
                                <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="black"/>
                                        <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="black"/>
                                        <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="black"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column mt-7">
                                <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Ödeme Talebi</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div onclick="createMarketPayment()" class="col-xl-6 mb-5" disabled>
                    <div class="card cursor-pointer h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-center flex-column">
                            <span class="fw-bolder fs-2 mt-3" id="employeeBalanceSpan">
                                <i class="fa fa-lg fa-spinner fa-spin"></i>
                            </span>
                            <div class="d-flex flex-column mt-3">
                                <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Ödeme Yap</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('employee.modules.dashboard.index.components.style')
@endsection

@section('customScripts')
    @include('employee.modules.dashboard.index.components.script')
@endsection
