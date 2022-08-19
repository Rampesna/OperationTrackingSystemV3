@extends('user.layouts.master')
@section('title', 'Sınav Sistemi / Sınava Giren Personeller | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.exam.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Sınav Sistemi / Sınava Giren Personeller</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.exam.employee.modals.reading')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                        <tr class="text-start text-dark fw-bolder fs-7 gs-0">
                            <th class="w-50px">#</th>
                            <th class="">Personel</th>
                        </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600" id="employees">
                            <tr>
                                <td colspan="2" class="text-center fw-bolder">
                                    <i class="fa fa-lg fa-spinner fa-spin"></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.exam.employee.components.style')
@endsection

@section('customScripts')
    @include('user.modules.exam.employee.components.script')
@endsection
