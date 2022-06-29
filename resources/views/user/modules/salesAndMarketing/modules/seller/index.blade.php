@extends('user.layouts.master')
@section('title', 'Satıcılar | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Satıcılar</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.salesAndMarketing.modules.seller.modals.transactions')
    @include('user.modules.salesAndMarketing.modules.seller.modals.createSeller')
    @include('user.modules.salesAndMarketing.modules.seller.modals.deleteFilteredSellers')

    <input type="hidden" id="selected_row_index">
    <input type="hidden" id="selected_row_id">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 mb-5">
                            <div class="form-group">
                                <label for="survey_code_filterer">Script Seçin</label>
                                <div class="input-group flex-nowrap">
                                    <select id="survey_code_filterer" class="form-select form-select-sm form-select-solid select2Input" data-control="select2" data-placeholder="Script Seçin" disabled multiple></select>
                                    <button class="btn btn-sm btn-secondary btn-icon" id="survey_code_filterer_input_group">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="form-group">
                                <label for="seller_code_filterer">Satıcı Seçin</label>
                                <div class="input-group flex-nowrap">
                                    <select id="seller_code_filterer" class="form-select form-select-sm form-select-solid select2Input" data-control="select2" data-placeholder="Satıcı Seçin" disabled multiple></select>
                                    <button class="btn btn-sm btn-secondary btn-icon" id="seller_code_filterer_input_group">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <label for="product_code_filterer">Ürün Seçin</label>
                                <div class="input-group flex-nowrap">
                                    <select id="product_code_filterer" class="form-select form-select-sm form-select-solid select2Input" data-control="select2" data-placeholder="Ürün Seçin" disabled multiple></select>
                                    <button class="btn btn-sm btn-secondary btn-icon" id="product_code_filterer_input_group">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="row">
                                <div class="col-xl-6 d-grid">
                                    <button class="btn btn-block btn-primary btn-sm mt-7" id="FilterButton">Filtrele</button>
                                </div>
                                <div class="col-xl-6 d-grid">
                                    <button class="btn btn-block btn-primary btn-sm mt-7" id="TransactionsButton">
                                        <span class="svg-icon svg-icon-muted svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z" fill="black"/>
                                                <path d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z" fill="black"/>
                                                <path opacity="0.3" d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z" fill="black"/>
                                                <path opacity="0.3" d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z" fill="black"/>
                                            </svg>
                                        </span>
                                        <span>İşlemler</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="text-muted">
    <div class="row">
        <div class="col-xl-12">
            <div id="sellers"></div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.salesAndMarketing.modules.seller.components.style')
@endsection

@section('customScripts')
    @include('user.modules.salesAndMarketing.modules.seller.components.script')
@endsection
