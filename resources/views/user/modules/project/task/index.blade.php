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

    <input type="hidden" id="board_id">
    <input type="hidden" id="task_id">
    <input type="file" style="display: none" id="taskFile">
    <div id="boards" class="mt-15"></div>

@endsection

@section('customStyles')
    @include('user.modules.project.task.components.style')
@endsection

@section('customScripts')
    @include('user.modules.project.task.components.script')
@endsection

