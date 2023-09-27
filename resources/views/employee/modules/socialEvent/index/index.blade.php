@extends('employee.layouts.master')
@section('title', 'Etkinlikler | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-5 my-1">Etkinlikler</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="card">
        <div class="card-header card-header-stretch">
            <div class="card-title d-flex align-items-center">
                <h3 class="fw-bold m-0 text-gray-800">Etkinlikler</h3>
            </div>
        </div>

        <div class="card-body">
            <div class="timeline">
                <div class="row" id="timelineBody">
                    @foreach($socialEvents as $socialEvent)
                        <div class="timeline-item">
                            <div class="timeline-line w-40px"></div>
                            <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                                <div class="symbol-label bg-light">
                                    <i class="fa fa-flag"></i>
                                </div>
                            </div>
                            <div class="timeline-content mb-10 mt-n1">
                                <div class="pe-3 mb-5">
                                    <div class="d-flex align-items-center fs-6">
                                        <div class="text-muted fw-bolder me-2 fs-7">{{ $socialEvent->date }}</div>
                                    </div>
                                    <div class="fs-5 fw-bolder">{{ $socialEvent->name }}</div>
                                </div>
                                <div class="overflow-auto pb-5">
                                    <p class="text-muted">
                                        {{ $socialEvent->description }}
                                    </p>
                                    <div class="min-w-750px py-3 mb-5">
                                        @foreach($socialEvent->images as $image)
                                            <a data-fslightbox="lightbox-basic" href="{{ $image->path }}">
                                                <img class="me-5 mb-5 rounded-3" src="{{ $image->path }}" alt="{{ $image->name }}" width="100" height="100">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

@endsection

@section('customStyles')
    @include('employee.modules.socialEvent.index.components.style')
@endsection

@section('customScripts')
    @include('employee.modules.socialEvent.index.components.script')
@endsection
