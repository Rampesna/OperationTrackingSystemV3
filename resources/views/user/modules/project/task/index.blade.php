@extends('user.layouts.master')
@section('title', 'Proje Görevleri | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Proje Görevleri</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.project.layouts.overview')

    <button id="updateTaskDrawerButton" style="display: none"></button>

    @include('user.modules.project.task.drawers.updateTask')

    @include('user.modules.project.task.modals.deleteTask')
    @include('user.modules.project.task.modals.taskFiles')

    <input type="hidden" id="selected_board_id">
    <input type="hidden" id="selected_task_id">
    <div id="boards" class="mt-5"></div>

@endsection

@section('customStyles')
    @include('user.modules.project.task.components.style')
@endsection

@section('customScripts')
    @include('user.modules.project.task.components.script')
@endsection

