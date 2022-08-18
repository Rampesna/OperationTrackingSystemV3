@extends('user.layouts.master')
@section('title', 'İnsan Kaynakları / Personeller / Dosyalar | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.humanResources.employee.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">İnsan Kaynakları / Personeller / Dosyalar</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.humanResources.employee.layouts.overview')

    @include('user.modules.humanResources.employee.file.modals.show')

    <input type="file" id="fileSelector" style="display: none">

    <div class="row" id="filesRow"></div>

@endsection

@section('customStyles')
    @include('user.modules.humanResources.employee.file.components.style')
@endsection

@section('customScripts')
    @include('user.modules.humanResources.employee.file.components.script')
@endsection
