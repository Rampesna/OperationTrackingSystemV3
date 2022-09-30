@extends('employee.layouts.master')
@section('title', 'Bilgi Bankası | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-5 my-1" id="subheaderQuestionArea">
                <i class="fa fa-spinner fa-spin"></i>
            </h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-fluid">
            <div class="card">
                <div class="card-body p-lg-20 pb-lg-0">
                    <div class="d-flex flex-column flex-xl-row">
                        <div class="flex-lg-row-fluid me-xl-15">
                            <div class="mb-17">
                                <div class="mb-8">
                                    <div class="d-flex flex-wrap mb-6">
                                        <div class="me-9 my-1">

                                        </div>
                                    </div>
                                    <span class="text-dark text-hover-primary fs-2 fw-bolder" id="questionArea"></span>
                                    <br>
                                    <span class="badge badge-secondary mt-3" id="categoryArea"></span>
                                </div>
                                <div class="fs-5 fw-bold text-gray-600" id="answerArea"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('employee.modules.knowledgeBase.question.components.style')
@endsection

@section('customScripts')
    @include('employee.modules.knowledgeBase.question.components.script')
@endsection
