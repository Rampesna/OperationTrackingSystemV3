<div class="modal fade show" id="CreateAnswerModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
                        <h1 class="mb-3">Cevap Oluştur</h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_answer_order" class="font-weight-bolder">Sıra</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_answer_order" type="number" class="form-control form-control-solid onlyNumber">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_answer_answer" class="font-weight-bolder">Cevap</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_answer_answer" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_answer_categories" class="font-weight-bolder">Kategoriler</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_answer_categories" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_answer_questions" class="font-weight-bolder">Cevaba Bağlı Alt Sorular</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_answer_questions" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Cevaba Bağlı Alt Sorular" aria-hidden="true" multiple></select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_answer_products" class="font-weight-bolder">Cevaba Bağlı Ürünler</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_answer_products" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Cevaba Bağlı Ürünler" aria-hidden="true" multiple></select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_answer_columns" class="font-weight-bolder">Zorunlu Alanlar</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_answer_columns" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Zorunlu Alanlar" aria-hidden="true" multiple>
                                        <option value="RandevuNotu">Randevu Notu Alanı</option>
                                        <option value="SeciliSehir">Şehir Alanı</option>
                                        <option value="SeciliIlce">İlçe Alanı</option>
                                        <option value="Email">E-Mail Alanı</option>
                                        <option value="YetkiliTel">Yetkili Telefon Alanı</option>
                                        <option value="MaliMusavirTel">Mali Müşavir Telefon Alanı</option>
                                        <option value="TicariYazilimAdi">Ticari Yazılım Alanı</option>
                                        <option value="EntegratorKodu">Entegratör Adı Alanı</option>
                                        <option value="KvkkIysIzni">Kvkk ve İys İzni Alanı</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">İptal</button>
                        <button type="button" class="btn btn-success" id="CreateAnswerButton">Oluştur</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
