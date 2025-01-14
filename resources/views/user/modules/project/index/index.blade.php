@extends('user.layouts.master')
@section('title', 'Projeler | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.dashboard.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Projeler</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.project.index.modals.createProject')

    <div class="row">
        <div class="col-xl-8 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-9 mb-5">
                            <div class="form-group">
                                <label for="keyword">Proje Adı</label>
                                <input id="keyword" type="text" class="form-control form-control-solid filterInput" placeholder="Personel Adı">
                            </div>
                        </div>
                        <div class="col-xl-3 mb-5">
                            <div class="form-group">
                                <label for="statusIds">Proje Durumu</label>
                                <select id="statusIds" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Proje Durumu" multiple></select>
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
                    @if(checkUserPermission(141, $userPermissions))
                    <button class="btn btn-primary mb-3" onclick="createProject()">Yeni Proje Oluştur</button>
                    @endif
                    <a href="{{ route('user.web.project.timesheet') }}" class="btn btn-info">Görev Takibi</a>
                </div>
            </div>
        </div>
    </div>
    <hr class="text-muted">
    <div class="row" id="projects"></div>

@endsection

@section('customStyles')
    @include('user.modules.project.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.project.index.components.script')
@endsection

