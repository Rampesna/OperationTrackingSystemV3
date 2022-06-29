<div class="modal fade show" id="CreateSellerModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
                        <h1 class="mb-3">Satıcı Oluştur</h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row">
                            <div class="col-xl-6 mb-5">
                                <div class="form-group">
                                    <label for="create_seller_survey_codes">Script Seçimi</label>
                                    <select id="create_seller_survey_codes" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Script Seçimi" multiple></select>
                                </div>
                            </div>
                            <div class="col-xl-6 mb-5">
                                <div class="form-group">
                                    <label for="create_seller_product_codes">Ürün Seçimi</label>
                                    <select id="create_seller_product_codes" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Ürün Seçimi" multiple></select>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-12">
                                <div class="input-group">
                                    <input type="text" id="create_seller_code" class="form-control form-control-solid" placeholder="Yeni Satıcı Kodu" aria-label="Yeni Satıcı Kodu">
                                    <button class="btn btn-success btn-icon" id="AddSellerButton">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="createSellersRow"></div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">İptal</button>
                        <button type="button" class="btn btn-success" id="CreateSellerButton">Oluştur</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
