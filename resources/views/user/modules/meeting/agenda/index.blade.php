@extends('user.layouts.master')
@section('title', 'Toplantı / Gündemler | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.meeting.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Toplantı / Gündemler</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.meeting.agenda.modals.createMeetingAgenda')
    @include('user.modules.meeting.agenda.modals.updateMeetingAgenda')
    @include('user.modules.meeting.agenda.modals.deleteMeetingAgenda')

    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img id="imageSelector" src="{{ asset('assets/media/logos/avatar.png') }}" alt="image">
                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <span class="text-gray-900 fs-2 fw-bolder me-4" id="meetingNameSpan">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </span>
                                <span class="badge badge-secondary" id="meetingTypeSpan">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a class="d-flex align-items-center text-gray-400 me-5 mb-2">
                                    <i class="fas fa-user me-2"></i>
                                    <span class="me-2">Katılımcılar: </span>
                                    <span id="meetingUsersSpan">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap flex-stack">
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <div class="d-flex flex-wrap">
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bolder counted" id="meetingStartDateSpan">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">Başlangıç</div>
                                </div>
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="fs-2 fw-bolder counted" id="meetingEndDateSpan">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">Bitiş</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12 mb-5">
                            <div class="form-group">
                                <label for="keyword">Arayın</label>
                                <input id="keyword" type="text" class="form-control form-control-solid filterInput" placeholder="Arayın...">
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
                    <button class="btn btn-primary" onclick="createMeetingAgenda()">Yeni Gündem Oluştur</button>
                </div>
            </div>
        </div>
    </div>
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
                            <th class="w-50px">#</th>
                            <th class="">Gündem Konusu</th>
                        </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600" id="meetingAgendas"></tbody>
                    </table>
                    <hr class="text-muted">
                    <div class="row">
                        <div class="col-xl-12 text-end">
                            <span class="text-muted">Toplam <span id="totalCountSpan">%</span> Kayıttan <span id="startCountSpan">%</span> - <span id="endCountSpan">%</span> Arasındakiler Gösteriliyor</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.meeting.agenda.components.style')
@endsection

@section('customScripts')
    @include('user.modules.meeting.agenda.components.script')
@endsection
