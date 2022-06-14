@extends('user.layouts.masterBlank')
@section('title', 'Personel Takibi | ')

@section('subheader')

@endsection

@section('content')

    <div class="row" style="margin-top: -130px">
        <div class="col-xl-2 col-lg-4 col-6 mb-5">
            <div class="card card-custom card-stretch gutter-b" style="background-color: darkgreen" id="totalEmployeeCountCard">
                <div class="card-body rounded align-items-center mt-n9" style="padding-bottom: 5px">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <div class="card-header border-0 px-0 pt-9">
                                <h1 class="fs-2 text-white">Toplam Personel:</h1>
                                <h1 class="fs-2x mt-n1 text-white" id="totalEmployeeCountSpan">
                                    <i class="fas fa-spinner fa-spin fa-sm text-white"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-6 mb-5">
            <div class="card card-custom card-stretch gutter-b" style="background-color: darkgreen" id="activeEmployeeCountCard">
                <div class="card-body rounded align-items-center mt-n9" style="padding-bottom: 5px">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <div class="card-header border-0 px-0 pt-9">
                                <h1 class="fs-2 text-white">Aktif Çalışan:</h1>
                                <h1 class="fs-2x mt-n1 text-white" id="activeEmployeeCountSpan">
                                    <i class="fas fa-spinner fa-spin fa-sm text-white"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-6 mb-5">
            <div class="card card-custom card-stretch gutter-b" style="background-color: darkgreen" id="requirementBreakEmployeeCountCard">
                <div class="card-body rounded align-items-center mt-n9" style="padding-bottom: 5px">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <div class="card-header border-0 px-0 pt-9">
                                <h1 class="fs-2 text-white">İhtiyaç Molasında:</h1>
                                <h1 class="fs-2x mt-n1 text-white" id="requirementBreakEmployeeCountSpan">
                                    <i class="fas fa-spinner fa-spin fa-sm text-white"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-6 mb-5">
            <div class="card card-custom card-stretch gutter-b" style="background-color: darkgreen" id="lunchBreakEmployeeCountCard">
                <div class="card-body rounded align-items-center mt-n9" style="padding-bottom: 5px">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <div class="card-header border-0 px-0 pt-9">
                                <h1 class="fs-2 text-white">Yemek Molasında:</h1>
                                <h1 class="fs-2x mt-n1 text-white" id="lunchBreakEmployeeCountSpan">
                                    <i class="fas fa-spinner fa-spin fa-sm text-white"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-6 mb-5">
            <div class="card card-custom card-stretch gutter-b" style="background-color: darkgreen" id="assignmentBreakEmployeeCountCard">
                <div class="card-body rounded align-items-center mt-n9" style="padding-bottom: 5px">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <div class="card-header border-0 px-0 pt-9">
                                <h1 class="fs-2 text-white">Görevlendirmede:</h1>
                                <h1 class="fs-2x mt-n1 text-white" id="assignmentBreakEmployeeCountSpan">
                                    <i class="fas fa-spinner fa-spin fa-sm text-white"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-6 mb-5">
            <div class="card card-custom card-stretch gutter-b" style="background-color: darkgreen" id="endOfWorkEmployeeCountCard">
                <div class="card-body rounded align-items-center mt-n9" style="padding-bottom: 5px">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <div class="card-header border-0 px-0 pt-9">
                                <h1 class="fs-2 text-white">İş Sonu:</h1>
                                <h1 class="fs-2x mt-n1 text-white" id="endOfWorkEmployeeCountSpan">
                                    <i class="fas fa-spinner fa-spin fa-sm text-white"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2" id="employeesRow"></div>

@endsection

@section('customStyles')
    @include('user.modules.santralMonitoring.monitor.employee.components.style')
@endsection

@section('customScripts')
    @include('user.modules.santralMonitoring.monitor.employee.components.script')
@endsection
