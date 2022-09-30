@extends('employee.layouts.master')
@section('title', 'Bilgi Bankası | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-5 my-1">Bilgi Bankası</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-3">
            <div class="card mb-5">
                <div class="card-header pt-5">
                    <span class="fw-bolder fs-2">Kategoriler</span>
                </div>
                <div class="card-body">
                    <div class="row" id="knowledgeBaseCategoriesRow"></div>
                </div>
                <div class="card-footer d-grid">
                    <button class="btn btn-primary" id="FilterButton">Filtrele</button>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-header pt-5">
                    <span class="fw-bolder fs-2">En Çok Arananlar</span>
                </div>
                <div class="card-body">
                    <div class="row" id="">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <h1 class="fw-bolder fs-4 fs-lg-1 text-gray-800 mb-5 mb-lg-10">Nasıl Yardımcı Olabiliriz ?</h1>
                        </div>
                        <div class="col-xl-12">
                            <div class="position-relative w-100">
                                <span class="svg-icon svg-icon-2 svg-icon-primary position-absolute top-50 translate-middle ms-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                    </svg>
                                </span>
                                <input type="text" class="form-control fs-4 py-4 ps-14 text-gray-700 placeholder-gray-400 w-100" id="keyword" placeholder="Arayın..." aria-label="Arayın..." autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5" id="knowledgeBaseQuestionsRow"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('employee.modules.knowledgeBase.index.components.style')
@endsection

@section('customScripts')
    @include('employee.modules.knowledgeBase.index.components.script')
@endsection
