@extends('user.layouts.master')
@section('title', 'Raporlar / İş Raporları / Ayrılan Personel İşleri | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.report.job.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Raporlar / İş Raporları / Ayrılan Personel İşleri</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')



@endsection

@section('customStyles')
    @include('user.modules.report.reports.job.reports.leavedEmployeeWorkStatus.components.style')
@endsection

@section('customScripts')
    @include('user.modules.report.reports.job.reports.leavedEmployeeWorkStatus.components.script')
@endsection
