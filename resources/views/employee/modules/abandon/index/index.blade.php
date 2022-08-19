@extends('employee.layouts.master')
@section('title', 'Kayıp Çağrılar | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-5 my-1">Kayıp Çağrılar</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12 text-right">
            <button type="button" id="reload_abandons" class="btn btn-primary" disabled>Kontrol Et</button>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row" id="accordionExample3">
                        <div class="col-xl-6">
                            <div class="accordion accordion-solid accordion-toggle-plus">
                                <div class="card">
                                    <div class="card-header" id="headingOne3">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#iuyum">I-Uyum - Kayıplar</div>
                                    </div>
                                    <div id="iuyum" class="collapse" data-parent="#accordionExample3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <table class="table">
                                                        <tbody id="iuyum_row">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo3">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#efaturaearsiv">E-Fatura | E-Arşiv - Kayıplar</div>
                                    </div>
                                    <div id="efaturaearsiv" class="collapse" data-parent="#accordionExample3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <table class="table">
                                                        <tbody id="efaturaearsiv_row">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree3">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#hesapaktivasyon">Hesap Aktivasyon - Kayıplar</div>
                                    </div>
                                    <div id="hesapaktivasyon" class="collapse" data-parent="#accordionExample3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <table class="table">
                                                        <tbody id="hesapaktivasyon_row">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingOne3">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#eirsaliyeaktivasyon">İrsaliye Aktivasyon - Kayıplar</div>
                                    </div>
                                    <div id="eirsaliyeaktivasyon" class="collapse" data-parent="#accordionExample3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <table class="table">
                                                        <tbody id="eirsaliyeaktivasyon_row">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo3">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#yedek">Yedekleme - Kayıplar</div>
                                    </div>
                                    <div id="yedek" class="collapse" data-parent="#accordionExample3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <table class="table">
                                                        <tbody id="yedek_row">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo3">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#edatra">Edatra - Kayıplar</div>
                                    </div>
                                    <div id="edatra" class="collapse" data-parent="#accordionExample3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <table class="table">
                                                        <tbody id="edatra_row">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="accordion accordion-solid accordion-toggle-plus">
                                <div class="card">
                                    <div class="card-header" id="headingTwo3">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#eirsaliyedestek">E-İrsaliye - Destek</div>
                                    </div>
                                    <div id="eirsaliyedestek" class="collapse" data-parent="#accordionExample3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <table class="table">
                                                        <tbody id="eirsaliyedestek_row">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree3">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#ekocari">Ekocari - Kayıplar</div>
                                    </div>
                                    <div id="ekocari" class="collapse" data-parent="#accordionExample3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <table class="table">
                                                        <tbody id="ekocari_row">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingOne3">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#edefter">E-Defter - Kayıplar</div>
                                    </div>
                                    <div id="edefter" class="collapse" data-parent="#accordionExample3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <table class="table">
                                                        <tbody id="edefter_row">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo3">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#edefterimzalama">E-Defter İmzalama - Kayıplar</div>
                                    </div>
                                    <div id="edefterimzalama" class="collapse" data-parent="#accordionExample3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <table class="table">
                                                        <tbody id="edefterimzalama_row">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo3">
                                        <div class="card-title collapsed" data-toggle="collapse" data-target="#iys">IYS</div>
                                    </div>
                                    <div id="iys" class="collapse" data-parent="#accordionExample3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <table class="table">
                                                        <tbody id="iys_row">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('employee.modules.abandon.index.components.style')
@endsection

@section('customScripts')
    @include('employee.modules.abandon.index.components.script')
@endsection
