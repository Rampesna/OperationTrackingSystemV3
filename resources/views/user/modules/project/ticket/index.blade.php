@extends('user.layouts.master')
@section('title', 'Projeler / Destek Talepleri | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.project.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Projeler / Destek Talepleri</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.project.layouts.overview')

    @include('user.modules.project.ticket.drawers.ticketMessages')

    @include('user.modules.project.ticket.modals.transactions')
    @include('user.modules.project.ticket.modals.updateTicket')
    @include('user.modules.project.ticket.modals.deleteTicket')

    <button id="ticketMessagesDrawerButton" style="display: none"></button>

    <div class="row">
        <div class="col-xl-12 mb-5">
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
                                <select id="priorityId" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Talep Önceliği" data-close-on-select="false" multiple></select>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="form-group">
                                <label for="statusId">Talep Durumu</label>
                                <select id="statusId" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Talep Durumu" data-close-on-select="false" multiple></select>
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
                        <div class="col-xl-6 mb-5">
                            <div class="row">
                                <div class="col-xl-6"></div>
                                <div class="col-xl-6">
                                    <div class="form-group d-grid">
                                        <button class="btn btn-success mt-6" id="DownloadExcelButton">
                                            <i class="fa fa-file-excel"></i> Excel İndir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <input type="hidden" id="selected_ticket_id">
    <input type="hidden" id="selected_ticket_row_index">
    <div class="row">
        <div class="col-xl-12">
            <div id="projectTickets"></div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.project.ticket.components.style')
@endsection

@section('customScripts')
    @include('user.modules.project.ticket.components.script')
@endsection

