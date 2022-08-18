@extends('user.layouts.master')
@section('title', 'Projeler /  Yönetim İşleri | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.project.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Projeler /  Yönetim İşleri</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.project.layouts.overview')

    <button id="updateTaskDrawerButton" style="display: none"></button>

    @include('user.modules.project.managementTask.drawers.updateTask')

    @include('user.modules.project.managementTask.modals.deleteTask')
    @include('user.modules.project.managementTask.modals.taskFiles')

    @include('user.modules.project.managementTask.modals.deleteBoard')

    <input type="hidden" id="selected_board_id">
    <input type="hidden" id="selected_task_id">
    <div id="boards" class="mt-5"></div>

@endsection

@section('customStyles')
    @include('user.modules.project.managementTask.components.style')
@endsection

@section('customScripts')
    @include('user.modules.project.managementTask.components.script')
@endsection

