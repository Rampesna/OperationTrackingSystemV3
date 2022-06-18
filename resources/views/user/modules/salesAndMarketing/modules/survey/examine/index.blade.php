@extends('user.layouts.master')
@section('title', 'Script İncele | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Script İncele</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-5">
            <div class="card">
                <div class="card-body">
                    <h6 class="mt-3 mb-0" id="surveyName">
                        <i class="fa fa-spinner fa-spin"></i>
                    </h6>
                    <span>Durum:</span><span class="ms-2" id="surveyStatus">
                        <i class="fa fa-spinner fa-spin"></i>
                    </span>
                    <hr class="text-muted">
                    <div class="d-flex justify-content-between">
                        <div>ID</div>
                        <div id="surveyId">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Kodu</div>
                        <div id="surveyCode">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="d-flex justify-content-between">
                        <div class="font-weight-bolder">Müşteri Bilgilendirmesi 1</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div id="surveyCustomerInformation1">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="d-flex justify-content-between">
                        <div class="font-weight-bolder">Müşteri Bilgilendirmesi 2</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div id="surveyCustomerInformation2">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="d-flex justify-content-between">
                        <div class="font-weight-bolder">Bilgi Notu (Müşteri Ek Bilgi İsterse)</div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div id="surveyDescription">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="d-flex justify-content-between">
                        <div>Hizmet / Ürün</div>
                        <div id="surveyServiceProduct">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="d-flex justify-content-between">
                        <div>Fırsat Açılsın mı?</div>
                        <div id="surveyOpportunity">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Çağrı Kaydı Atılsın mı?</div>
                        <div id="surveyCall">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Arama Planı Gönderilsin mi?</div>
                        <div id="surveyDialPlan">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Satıcıya Yönlendir Durumunda Fırsat Gönderilsin mi?</div>
                        <div id="surveyOpportunityRedirectToSeller">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Satıcıya Yönlendir Durumunda Arama Planı Gönderilsin mi?</div>
                        <div id="surveyDialPlanRedirectToSeller">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Ek Ürün İçin Fırsat Gönderilsin mi?</div>
                        <div id="surveyAdditionalProductOpportunity">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Ek Ürün İçin Arama Planı Gönderilsin mi?</div>
                        <div id="surveyAdditionalProductCallPlan">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>Satıcı Yönlendirme Tipi</div>
                        <div id="surveySellerRedirectionType">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>İş Kaynağı</div>
                        <div id="surveyJobResource">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <div>UyumCRM Liste Kodu</div>
                        <div id="surveyListCode">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header pt-4 pb-2">
                    <h5>Script Soruları</h5>
                </div>
                <div class="card-body" id="surveyQuestions">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.salesAndMarketing.modules.survey.examine.components.style')
@endsection

@section('customScripts')
    @include('user.modules.salesAndMarketing.modules.survey.examine.components.script')
@endsection
