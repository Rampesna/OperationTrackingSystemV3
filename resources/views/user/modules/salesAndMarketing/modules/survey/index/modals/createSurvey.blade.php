<div class="modal fade show" id="CreateSurveyModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <div class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Script Oluştur</h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_code" class="font-weight-bolder">Script Kodu</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <div class="input-group flex-nowrap">
                                        <input id="create_survey_code" type="text" class="form-control form-control-solid" disabled>
                                        <button class="btn btn-icon btn-success" type="button" onclick="reGenerateCreateSurveyCode()">
                                            <i class="fas fa-redo-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_name" class="font-weight-bolder">Script Adı</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_survey_name" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_status" class="font-weight-bolder">Durum</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_survey_status" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Durum" aria-hidden="true">
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
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_service_product" class="font-weight-bolder">Hizmet/Ürün</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_survey_service_product" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_call_reason" class="font-weight-bolder">Çağrı Nedeni</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_survey_call_reason" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_tags" class="font-weight-bolder">Etiketler</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_survey_tags" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_customer_information_1" class="font-weight-bolder">Müşteri Bilgilendirmesi 1</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <textarea id="create_survey_customer_information_1" type="text" class="form-control form-control-solid" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_customer_information_2" class="font-weight-bolder">Müşteri Bilgilendirmesi 2</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <textarea id="create_survey_customer_information_2" type="text" class="form-control form-control-solid" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_description" class="font-weight-bolder">Bilgi Notu (Müşteri Ek Bilgi İsterse)</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <textarea id="create_survey_description" type="text" class="form-control form-control-solid" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_opportunity" class="font-weight-bolder">Fırsat Açılsın mı?</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_survey_opportunity" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Fırsat Açılsın mı?" aria-hidden="true">
                                        <option value="" selected disabled hidden></option>
                                        <option value="0">Hayır</option>
                                        <option value="1">Evet</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_call" class="font-weight-bolder">Çağrı Kaydı Atılsın mı?</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_survey_call" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Çağrı Kaydı Atılsın mı?" aria-hidden="true">
                                        <option value="" selected disabled hidden></option>
                                        <option value="0">Hayır</option>
                                        <option value="1">Evet</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_dial_plan" class="font-weight-bolder">Arama Planı Gönderilsin mi?</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_survey_dial_plan" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Arama Planı Gönderilsin mi?" aria-hidden="true">
                                        <option value="" selected disabled hidden></option>
                                        <option value="0">Hayır</option>
                                        <option value="1">Evet</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_opportunity_redirect_to_seller" class="font-weight-bolder">Satıcıya Yönlendir Durumunda Fırsat Gönderilsin mi?</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_survey_opportunity_redirect_to_seller" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Satıcıya Yönlendir Durumunda Fırsat Gönderilsin mi?" aria-hidden="true">
                                        <option value="" selected disabled hidden></option>
                                        <option value="0">Hayır</option>
                                        <option value="1">Evet</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_dial_plan_redirect_to_seller" class="font-weight-bolder">Satıcıya Yönlendir Durumunda Arama Planı Gönderilsin mi?</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_survey_dial_plan_redirect_to_seller" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Satıcıya Yönlendir Durumunda Arama Planı Gönderilsin mi?" aria-hidden="true">
                                        <option value="" selected disabled hidden></option>
                                        <option value="0">Hayır</option>
                                        <option value="1">Evet</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_additional_product_opportunity" class="font-weight-bolder">Ek Ürün İçin Fırsat Gönderilsin mi?</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_survey_additional_product_opportunity" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Ek Ürün İçin Fırsat Gönderilsin mi?" aria-hidden="true">
                                        <option value="" selected disabled hidden></option>
                                        <option value="0">Hayır</option>
                                        <option value="1">Evet</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_additional_product_call_plan" class="font-weight-bolder">Ek Ürün İçin Arama Planı Gönderilsin mi?</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_survey_additional_product_call_plan" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Ek Ürün İçin Arama Planı Gönderilsin mi?" aria-hidden="true">
                                        <option value="" selected disabled hidden></option>
                                        <option value="0">Hayır</option>
                                        <option value="1">Evet</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_seller_redirection_type" class="font-weight-bolder">Satıcı Yönlendirme Tipi</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_survey_seller_redirection_type" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Satıcı Yönlendirme Tipi" aria-hidden="true">
                                        <option value="" selected disabled hidden></option>
                                        <option value="1">Şehire Göre Satıcı Yönlendirme</option>
                                        <option value="2">Özelden Satıcı Yönlendirme</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_job_resource" class="font-weight-bolder">İş Kaynağı</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_survey_job_resource" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_list_code" class="font-weight-bolder">UyumCRM Liste Kodu</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_survey_list_code" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_survey_call_list" class="font-weight-bolder">Aranacak Liste Dosyası Seçimi</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_survey_call_list" type="file" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">İptal</button>
                        <button type="button" class="btn btn-primary" id="CreateSurveyButton">Oluştur</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
