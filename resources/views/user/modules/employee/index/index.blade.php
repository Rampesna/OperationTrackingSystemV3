@extends('user.layouts.master')
@section('title', 'Personeller | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Personeller</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.employee.index.modals.updateEmployeeQueues')
    @include('user.modules.employee.index.modals.updateEmployeeCompetences')
    @include('user.modules.employee.index.modals.updateEmployeeTasks')
    @include('user.modules.employee.index.modals.updateEmployeeWorkTasks')
    @include('user.modules.employee.index.modals.updateEmployeeGroupTasks')
    @include('user.modules.employee.index.modals.updateEmployeeJobDepartments')

    <div class="row">
        <div class="col-xl-4 col-12 mb-5">
            <label style="width: 100%">
                <input id="keyword" type="text" class="form-control" placeholder="Arayın...">
            </label>
        </div>
        <div class="col-xl-4 col-12 mb-5">
            <label style="width: 100%">
                <select id="jobDepartmentFilterer" class="form-select select2-hidden-accessible" data-control="select2" data-hide-search="true" data-placeholder="Departman" aria-hidden="true" multiple>

                </select>
            </label>
        </div>
        <div class="col-xl-4 mb-5">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-xl-12 d-grid">
                            <button type="button" class="btn btn-success btn-sm" id="SelectAllEmployeesButton">
                                <span class="svg-icon svg-icon-muted svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M10.3 14.3L11 13.6L7.70002 10.3C7.30002 9.9 6.7 9.9 6.3 10.3C5.9 10.7 5.9 11.3 6.3 11.7L10.3 15.7C9.9 15.3 9.9 14.7 10.3 14.3Z" fill="black"/>
                                        <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM11.7 15.7L17.7 9.70001C18.1 9.30001 18.1 8.69999 17.7 8.29999C17.3 7.89999 16.7 7.89999 16.3 8.29999L11 13.6L7.70001 10.3C7.30001 9.89999 6.69999 9.89999 6.29999 10.3C5.89999 10.7 5.89999 11.3 6.29999 11.7L10.3 15.7C10.5 15.9 10.8 16 11 16C11.2 16 11.5 15.9 11.7 15.7Z" fill="black"/>
                                    </svg>
                                </span>
                                <span>Tümünü Seç</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-xl-12 d-grid">
                            <button type="button" class="btn btn-secondary btn-sm" id="DeSelectAllEmployeesButton">
                                <span class="svg-icon svg-icon-muted svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM18 12C18 11.4 17.6 11 17 11H7C6.4 11 6 11.4 6 12C6 12.6 6.4 13 7 13H17C17.6 13 18 12.6 18 12Z" fill="black"/>
                                    </svg>
                                </span>
                                <span>Tümünü Kaldır</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="text-muted">
    <div class="row mb-5" id="employeesRow">

    </div>

@endsection

@section('customStyles')
    @include('user.modules.employee.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.employee.index.components.script')
@endsection
