@extends('user.layouts.master')
@section('title', 'Telefon Bulma Raporu | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Telefon Bulma Raporu</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-2 mb-5">
            <div class="form-group">
                <label for="startDate" class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">Başlangıç Tarihi</span>
                </label>
                <input id="startDate" type="datetime-local" class="form-control" aria-hidden="true" value="{{ date('Y-m-d') . 'T00:00' }}">
            </div>
        </div>
        <div class="col-xl-2 mb-5">
            <div class="form-group">
                <label for="endDate" class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">Bitiş Tarihi</span>
                </label>
                <input id="endDate" type="datetime-local" class="form-control" aria-hidden="true" value="{{ date('Y-m-d') . 'T' . date('H:i') }}">
            </div>
        </div>
        <div class="col-xl-4 mb-5">
            <div class="form-group">
                <label for="dataScanningTables" class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">Rapor Seçin</span>
                </label>
                <select id="dataScanningTables" class="form-select select2Input" data-control="select2" data-placeholder="Rapor Seçin"></select>
            </div>
        </div>
        <div class="col-xl-4 mb-5">
            <div class="form-group d-grid">
                <button class="btn btn-primary mt-8" type="button" id="ReportButton">Raporla</button>
            </div>
        </div>
    </div>
    <hr class="mb-5">
    <div class="row" id="cards" style="display: none">
        <div class="col-xl-4 mb-5">
            <div class="card cursor-pointer typeSelector" data-type="total">
                <div class="card-body d-flex justify-content-between align-items-start flex-column py-0">
                    <div class="d-flex flex-column my-7">
                        <span class="fw-bold fs-2x text-gray-800 lh-1 ls-n2" id="totalSpan">
                            <i class="fas fa-spinner fa-spin"></i>
                        </span>
                        <div class="mt-2">
                            <span class="fw-bold fs-5 text-gray-400">Toplam Kayıt Sayısı</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 mb-5">
            <div class="card cursor-pointer typeSelector" data-type="waiting">
                <div class="card-body d-flex justify-content-between align-items-start flex-column py-0">
                    <div class="d-flex flex-column my-7">
                        <span class="fw-bold fs-2x text-gray-800 lh-1 ls-n2" id="waitingSpan">
                            <i class="fas fa-spinner fa-spin"></i>
                        </span>
                        <div class="mt-2">
                            <span class="fw-bold fs-5 text-gray-400">Toplam Kalan Kayıt Sayısı</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 mb-5">
            <div class="card cursor-pointer typeSelector" data-type="finded">
                <div class="card-body d-flex justify-content-between align-items-start flex-column py-0">
                    <div class="d-flex flex-column my-7">
                        <span class="fw-bold fs-2x text-gray-800 lh-1 ls-n2" id="findedSpan">
                            <i class="fas fa-spinner fa-spin"></i>
                        </span>
                        <div class="mt-2">
                            <span class="fw-bold fs-5 text-gray-400">Personel Bazlı Bulunan Kayıt Sayısı</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="reportRow" style="display: none">
        <div class="col-xl-12 mb-5">
            <div id="report"></div>
        </div>
        <div class="col-xl-12 text-end">
            <button class="btn btn-sm btn-primary" id="DownloadExcelButton">Excel İndir</button>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.report.reports.job.reports.callFind.components.style')
@endsection

@section('customScripts')
    @include('user.modules.report.reports.job.reports.callFind.components.script')
@endsection
