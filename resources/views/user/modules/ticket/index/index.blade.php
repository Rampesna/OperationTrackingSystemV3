@extends('user.layouts.master')
@section('title', 'Destek Talepleri | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.dashboard.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Destek Talepleri</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.ticket.index.modals.createTicket')
    @include('user.modules.ticket.index.modals.updateTicket')
    @include('user.modules.ticket.index.modals.deleteTicket')

    @include('user.modules.ticket.index.drawers.ticketMessages')

    <button id="ticketMessagesDrawerButton" style="display: none"></button>

    <div class="row">
        <div class="col-xl-8 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label for="keyword">Talep Başlığı</label>
                                <input id="keyword" type="text" class="form-control form-control-solid filterInput" placeholder="Talep Başlığı">
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="form-group">
                                <label for="priorityId">Talep Önceliği</label>
                                <select id="priorityId" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Talep Önceliği" multiple></select>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="form-group">
                                <label for="statusId">Talep Durumu</label>
                                <select id="statusId" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Talep Durumu" multiple></select>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group d-grid">
                                        <button class="btn btn-primary mt-6" id="FilterButton">Filtrele</button>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group d-grid">
                                        <button class="btn btn-secondary mt-6" id="ClearFilterButton">Temizle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 mb-5 text-end">
            <div class="row">
                <div class="col-xl-12 d-grid">
                    @if(checkUserPermission(162, $userPermissions))
                    <button class="btn btn-primary" onclick="createTicket()">Yeni Destek Talebi Oluştur</button>
                    @endif
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
                            <th>#</th>
                            <th class="hideIfMobile">Bağlantı Türü</th>
                            <th class="hideIfMobile">Bağlantı</th>
                            <th>Başlık</th>
                            <th>Öncelik</th>
                            <th>Durum</th>
                            <th class="hideIfMobile">Talep Kaynağı</th>
                            <th class="hideIfMobile">İstenilen Temin Zamanı</th>
                            <th class="hideIfMobile">Yapılacak Temin Zamanı</th>
                        </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600" id="tickets"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.ticket.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.ticket.index.components.script')
@endsection
