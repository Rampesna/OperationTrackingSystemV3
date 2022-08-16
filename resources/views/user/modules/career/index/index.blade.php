@extends('user.layouts.master')
@section('title', 'Kariyer Başvuruları | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Kariyer Başvuruları</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.career.index.modals.transactions')
    @include('user.modules.career.index.modals.sendBatchSms')

    <div class="row">
        <div class="col-xl-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label for="keyword">Arayın</label>
                                <input id="keyword" type="text" class="form-control form-control-solid filterInput" placeholder="Arayın...">
                            </div>
                        </div>
                        <div class="col-xl-2 mb-5">
                            <div class="form-group d-grid">
                                <button class="btn btn-primary mt-6" id="FilterButton">Filtrele</button>
                            </div>
                        </div>
                        <div class="col-xl-2 mb-5">
                            <div class="form-group d-grid">
                                <button class="btn btn-secondary mt-6" id="ClearFilterButton">Temizle</button>
                            </div>
                        </div>
                        <div class="col-xl-2 mb-5">
                            <div class="form-group d-grid">
                                <button class="btn btn-info mt-6" onclick="transactions()">İşlemler</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body pt-0">
                    <br>
                    <div class="row">
                        <div class="col-xl-1">
                            <div class="form-group">
                                <label>
                                    <select data-control="select2" id="pageSize" data-hide-search="true" class="form-select border-0">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-xl-11 text-end">
                            <button class="btn btn-sm btn-icon bg-transparent bg-hover-opacity-0 text-dark" id="pageDown" disabled>
                                <i class="fas fa-angle-left"></i>
                            </button>
                            <button class="btn btn-sm btn-icon bg-transparent bg-hover-opacity-0 text-dark cursor-default" disabled>
                                <span class="text-muted" id="page">1</span>
                            </button>
                            <button class="btn btn-sm btn-icon bg-transparent bg-hover-opacity-0 text-dark" id="pageUp">
                                <i class="fas fa-angle-right"></i>
                            </button>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                        <tr class="text-start text-dark fw-bolder fs-7 gs-0">
                            <th class="">#</th>
                            <th class="">Ad Soyad</th>
                            <th class="">Departman</th>
                            <th class="hideIfMobile">TCKN</th>
                            <th class="hideIfMobile">E-posta Adresi</th>
                            <th class="hideIfMobile">Telefon</th>
                        </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600" id="careers"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.career.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.career.index.components.script')
@endsection
