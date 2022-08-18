@extends('user.layouts.master')
@section('title', 'İnsan Kaynakları / Personeller / Kariyer | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.humanResources.employee.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">İnsan Kaynakları / Personeller / Kariyer</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.humanResources.employee.layouts.overview')

    @include('user.modules.humanResources.employee.position.modals.createPosition')
    @include('user.modules.humanResources.employee.position.modals.updatePosition')
    @include('user.modules.humanResources.employee.position.modals.deletePosition')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="font-weight-bold"></h3>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" onclick="createPosition()">Yeni Oluştur</button>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                        <tr class="text-start text-dark fw-bolder fs-7 gs-0">
                            <th class="">#</th>
                            <th class="">Başlangıç</th>
                            <th class="">Bitiş</th>
                            <th class="hideIfMobile">Şirket</th>
                            <th class="hideIfMobile">Şube</th>
                            <th class="hideIfMobile">Departman</th>
                            <th class="hideIfMobile">Ünvan</th>
                            <th class="hideIfMobile">Maaş</th>
                        </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600" id="positions"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.humanResources.employee.position.components.style')
@endsection

@section('customScripts')
    @include('user.modules.humanResources.employee.position.components.script')
@endsection
