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

    @include('user.modules.employee.index.modals.operations')
    @include('user.modules.employee.index.modals.createEmployee')
    @include('user.modules.employee.index.modals.getEmployeeReport')
    @include('user.modules.employee.index.modals.setEmployeeScript')
    @include('user.modules.employee.index.modals.setEmployeeDataScanning')
    @include('user.modules.employee.index.modals.setEmployeeOtsLockType')
    @include('user.modules.employee.index.modals.setEmployeeWorkToDoType')

    @include('user.modules.employee.index.modals.updateEmployee')
    @include('user.modules.employee.index.modals.updateEmployeeQueues')
    @include('user.modules.employee.index.modals.updateEmployeeCompetences')
    @include('user.modules.employee.index.modals.updateEmployeeTasks')
    @include('user.modules.employee.index.modals.updateEmployeeWorkTasks')
    @include('user.modules.employee.index.modals.updateEmployeeGroupTasks')
    @include('user.modules.employee.index.modals.updateEmployeeJobDepartment')

    @include('user.modules.employee.index.components.contextMenu')

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
        <div class="col-xl-12">
            <div class="row showIfMobile">
                <div class="col-xl-12 d-grid">
                    <button onclick="operations()" type="button" class="btn btn-primary btn-sm">
                        <span class="svg-icon svg-icon-muted svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z" fill="black"/>
                                <path d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z" fill="black"/>
                                <path opacity="0.3" d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z" fill="black"/>
                                <path opacity="0.3" d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z" fill="black"/>
                            </svg>
                        </span>
                        <span>İşlemler</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <hr class="text-muted">
    <div class="row mb-5" id="employeesRow"></div>

@endsection

@section('customStyles')
    @include('user.modules.employee.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.employee.index.components.script')
@endsection
