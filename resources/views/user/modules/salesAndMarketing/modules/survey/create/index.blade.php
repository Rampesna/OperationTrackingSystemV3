@extends('user.layouts.master')
@section('title', 'Satış Pazarlama / Scriptler / Yeni Script Oluştur | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{ route('user.web.salesAndMarketing.index') }}" class="fas fa-lg fa-backward cursor-pointer me-5"></a>
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Satış Pazarlama / Scriptler / Yeni Script Oluştur</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row mb-3">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-xl-2 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Script Kodu</label>
                                <div class="input-group flex-nowrap">
                                    <input id="create_survey_code" type="text" class="form-control form-control-solid" aria-label="Script Kodu" placeholder="Script Kodu" disabled>
                                    <button class="btn btn-icon btn-success" type="button" onclick="reGenerateCreateSurveyCode()">
                                        <i class="fas fa-redo-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Script Adı</label>
                                <input id="create_survey_name" type="text" class="form-control form-control-solid" placeholder="Script Adı" aria-label="Script Adı">
                            </div>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Durum</label>
                                <select id="create_survey_status" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Durum" aria-label="Durum" aria-hidden="true">
                                    <option value="" selected hidden disabled></option>
                                    <option value="Beklemede">Beklemede</option>
                                    <option value="Arama Listesi Bekleniyor">Arama Listesi Bekleniyor</option>
                                    <option value="Oto Arama Aktif Edildi | Devam Ediyor">Oto Arama Aktif Edildi | Devam Ediyor</option>
                                    <option value="Otomatik Arama Durdu | Devam Ediyor">Otomatik Arama Durdu | Devam Ediyor</option>
                                    <option value="Yeniden Taranıyor">Yeniden Taranıyor</option>
                                    <option value="İptal Edildi">İptal Edildi</option>
                                    <option value="Tamamlandı">Tamamlandı</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Hizmet/Ürün</label>
                                <input id="create_survey_service_product" type="text" class="form-control form-control-solid" placeholder="Hizmet/Ürün" aria-label="Hizmet/Ürün">
                            </div>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Çağrı Nedeni</label>
                                <input id="create_survey_call_reason" type="text" class="form-control form-control-solid" placeholder="Çağrı Nedeni" aria-label="Çağrı Nedeni">
                            </div>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Etiketler</label>
                                <input id="create_survey_tags" type="text" class="form-control form-control-solid" placeholder="Etiketler" aria-label="Etiketler">
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Müşteri Bilgilendirmesi 1</label>
                                <textarea id="create_survey_customer_information_1" type="text" class="form-control form-control-solid" rows="4" placeholder="Müşteri Bilgilendirmesi 1" aria-label="Müşteri Bilgilendirmesi 1"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Müşteri Bilgilendirmesi 2</label>
                                <textarea id="create_survey_customer_information_2" type="text" class="form-control form-control-solid" rows="4" placeholder="Müşteri Bilgilendirmesi 2" aria-label="Müşteri Bilgilendirmesi 2"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Bilgi Notu (Müşteri Ek Bilgi İsterse)</label>
                                <textarea id="create_survey_description" type="text" class="form-control form-control-solid" rows="4" placeholder="Bilgi Notu (Müşteri Ek Bilgi İsterse)" aria-label="Bilgi Notu (Müşteri Ek Bilgi İsterse)"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-12 mb-5">
                            <div class="form-group">
                                <label class="ms-1">HTML Açıklama</label>
                                <textarea id="create_survey_description_html"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Script Anket Mi?</label>
                                <select id="create_survey_is_survey" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Script Anket Mi?" aria-label="Script Anket Mi?" aria-hidden="true">
                                    <option value="" selected disabled hidden></option>
                                    <option value="0">Hayır</option>
                                    <option value="1">Evet</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Aranmayacak Grup Kodu</label>
                                <input id="create_survey_cant_call_group_code" class="form-control form-control-solid" placeholder="Aranmayacak Grup Kodu" aria-label="Aranmayacak Grup Kodu">
                            </div>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Fırsat Açılsın mı?</label>
                                <select id="create_survey_opportunity" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Fırsat Açılsın mı?" aria-label="Fırsat Açılsın mı?" aria-hidden="true">
                                    <option value="" selected disabled hidden></option>
                                    <option value="0">Hayır</option>
                                    <option value="1">Evet</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Çağrı Kaydı Atılsın mı?</label>
                                <select id="create_survey_call" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Çağrı Kaydı Atılsın mı?" aria-label="Çağrı Kaydı Atılsın mı?" aria-hidden="true">
                                    <option value="" selected disabled hidden></option>
                                    <option value="0">Hayır</option>
                                    <option value="1">Evet</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Arama Planı Gönderilsin mi?</label>
                                <select id="create_survey_dial_plan" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Arama Planı Gönderilsin mi?" aria-label="Arama Planı Gönderilsin mi?" aria-hidden="true">
                                    <option value="" selected disabled hidden></option>
                                    <option value="0">Hayır</option>
                                    <option value="1">Evet</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Satıcıya Yönlendir Durumunda Fırsat Gönderilsin mi?</label>
                                <select id="create_survey_opportunity_redirect_to_seller" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Satıcıya Yönlendir Durumunda Fırsat Gönderilsin mi?" aria-label="Satıcıya Yönlendir Durumunda Fırsat Gönderilsin mi?" aria-hidden="true">
                                    <option value="" selected disabled hidden></option>
                                    <option value="0">Hayır</option>
                                    <option value="1">Evet</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Satıcıya Yönlendir Durumunda Arama Planı Gönderilsin mi?</label>
                                <select id="create_survey_dial_plan_redirect_to_seller" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Satıcıya Yönlendir Durumunda Arama Planı Gönderilsin mi?" aria-label="Satıcıya Yönlendir Durumunda Arama Planı Gönderilsin mi?" aria-hidden="true">
                                    <option value="" selected disabled hidden></option>
                                    <option value="0">Hayır</option>
                                    <option value="1">Evet</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Ek Ürün İçin Fırsat Gönderilsin mi?</label>
                                <select id="create_survey_additional_product_opportunity" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Ek Ürün İçin Fırsat Gönderilsin mi?" aria-label="Ek Ürün İçin Fırsat Gönderilsin mi?" aria-hidden="true">
                                    <option value="" selected disabled hidden></option>
                                    <option value="0">Hayır</option>
                                    <option value="1">Evet</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Ek Ürün İçin Arama Planı Gönderilsin mi?</label>
                                <select id="create_survey_additional_product_call_plan" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Ek Ürün İçin Arama Planı Gönderilsin mi?" aria-label="Ek Ürün İçin Arama Planı Gönderilsin mi?" aria-hidden="true">
                                    <option value="" selected disabled hidden></option>
                                    <option value="0">Hayır</option>
                                    <option value="1">Evet</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Satıcı Yönlendirme Tipi</label>
                                <select id="create_survey_seller_redirection_type" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Satıcı Yönlendirme Tipi" aria-label="Satıcı Yönlendirme Tipi" aria-hidden="true">
                                    <option value="" selected disabled hidden></option>
                                    <option value="1">Şehire Göre Satıcı Yönlendirme</option>
                                    <option value="2">Özelden Satıcı Yönlendirme</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 mb-5">
                            <div class="form-group">
                                <label class="ms-1">Durum Kodu Yönlendirme Tipi</label>
                                <select id="create_survey_is_new_marketing_screen" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Durum Kodu Yönlendirme Tipi" aria-label="Durum Kodu Yönlendirme Tipi" aria-hidden="true">
                                    <option value="" selected disabled hidden></option>
                                    <option value="0">Seçilen Durum Koduna Göre Yönlendirme</option>
                                    <option value="1">Cevaplardaki Durum Koduna Göre Yönlendirme</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <div class="form-group">
                                <label class="ms-1">İş Kaynağı</label>
                                <input id="create_survey_job_resource" type="text" class="form-control form-control-solid" placeholder="İş Kaynağı" aria-label="İş Kaynağı">
                            </div>
                        </div>
                        <div class="col-xl-4 mb-5">
                            <div class="form-group">
                                <label class="ms-1">UyumCRM Liste Kodu</label>
                                <input id="create_survey_list_code" type="text" class="form-control form-control-solid" placeholder="UyumCRM Liste Kodu" aria-label="UyumCRM Liste Kodu">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label class="ms-1 font-weight-bolder">Aranacak Liste Dosyası Seçimi</label>
                                <input id="create_survey_call_list" type="file" class="form-control form-control-solid" placeholder="Aranacak Liste Dosyası Seçimi" aria-label="Aranacak Liste Dosyası Seçimi">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 text-end">
            <button class="btn btn-success" id="CreateSurveyButton">Oluştur</button>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.salesAndMarketing.modules.survey.create.components.style')
@endsection

@section('customScripts')
    @include('user.modules.salesAndMarketing.modules.survey.create.components.script')
@endsection
