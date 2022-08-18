@extends('user.layouts.master')
@section('title', 'Merkezi Görev Sistemi | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.dashboard.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Merkezi Görev Sistemi</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.centralMission.index.modals.createCentralMission')
    @include('user.modules.centralMission.index.modals.updateCentralMission')
    @include('user.modules.centralMission.index.modals.deleteCentralMission')
    @include('user.modules.centralMission.index.modals.diagram')

    <div class="row">
        <div class="col-xl-8 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 mb-5">
                            <div class="form-group">
                                <label for="relationTypeFilter">Görevli Türü</label>
                                <select id="relationTypeFilter" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Bağlantı Türü">
                                    <option value="" selected hidden disabled></option>
                                    <option value="App\Models\Eloquent\Employee">Personel</option>
                                    <option value="App\Models\Eloquent\User">Yönetici</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="form-group">
                                <label for="relationIdFilter">Görevli Seçimi</label>
                                <select id="relationIdFilter" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Görevli Seçimi"></select>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="form-group">
                                <label for="typeIdsFilter">Görev Türü</label>
                                <select id="typeIdsFilter" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Görev Türü" multiple></select>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="form-group">
                                <label for="statusIdsFilter">Görev Durumu</label>
                                <select id="statusIdsFilter" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Görev Durumu" multiple></select>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="form-group d-grid">
                                <button class="btn btn-primary mt-6" id="GetCentralMissionsButton">Görevleri Getir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 mb-5 text-end">
            <div class="row">
                <div class="col-xl-12 d-grid">
                    @if(checkUserPermission(158, $userPermissions))
                    <button class="btn btn-primary" onclick="createCentralMission()">Yeni Görev Oluştur</button>
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
                            <th class="">#</th>
                            <th class="">Görev Türü</th>
                            <th class="">Görev Başlığı</th>
                            <th class="hideIfMobile">Görev Başlangıcı</th>
                            <th class="hideIfMobile">Görev Bitişi</th>
                            <th class="hideIfMobile">Görev Durumu</th>
                        </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600" id="centralMissions"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.centralMission.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.centralMission.index.components.script')
@endsection
