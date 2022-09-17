@extends('user.layouts.master')
@section('title', 'Görev Takibi | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.project.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Görev Takibi</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label for="userIds">Kullanıcılar</label>
                                <select id="userIds" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Kullanıcılar" multiple></select>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label for="projectIds">Projeler</label>
                                <select id="projectIds" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Projeler" multiple></select>
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
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body pt-2">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                        <tr class="text-start text-dark fw-bolder fs-7 gs-0">
                            <th class="">Kullanıcı</th>
                            <th class="">Aktif Proje</th>
                            <th class="">Aktif Görev</th>
                            <th class="hideIfMobile">Çalışma Başlangıcı</th>
                            <th class="hideIfMobile">Görev Deadline</th>
                        </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600" id="users"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.project.timesheet.components.style')
@endsection

@section('customScripts')
    @include('user.modules.project.timesheet.components.script')
@endsection

