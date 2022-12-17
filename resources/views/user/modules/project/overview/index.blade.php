@extends('user.layouts.master')
@section('title', 'Projeler / Önizleme | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.project.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Projeler / Önizleme</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.project.layouts.overview')

    @include('user.modules.project.overview.modals.updateProject')

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h5>Destek Talepleri</h5>
                    <hr class="text-muted">
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mt-5">İncelenecek</h6>
                            </div>
                            <div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bolder" id="status_1_count">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mt-5">Devam Ediyor</h6>
                            </div>
                            <div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bolder" id="status_2_count">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mt-5">İşlem Sonuçlandı</h6>
                            </div>
                            <div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bolder" id="status_3_count">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mt-5">Tamamlandı</h6>
                            </div>
                            <div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bolder" id="status_4_count">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h6 class="mt-5">İptal Edildi</h6>
                            </div>
                            <div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-4 fw-bolder" id="status_5_count">
                                            0
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.project.overview.components.style')
@endsection

@section('customScripts')
    @include('user.modules.project.overview.components.script')
@endsection

