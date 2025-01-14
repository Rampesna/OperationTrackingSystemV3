<div class="modal fade show" id="CreateRecruitingModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered mw-800px">
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
                        <h1 class="mb-3">Yeni İşe Alım</h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_recruiting_company_id" class="font-weight-bolder">Firma Seçimi</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_recruiting_company_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Firma Seçimi"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_recruiting_department_id" class="font-weight-bolder">Departman Seçimi</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_recruiting_department_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Departman Seçimi"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_recruiting_name" class="font-weight-bolder">Ad Soyad</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_recruiting_name" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_recruiting_identity" class="font-weight-bolder">TCKN</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_recruiting_identity" type="text" class="form-control form-control-solid onlyNumber" maxlength="11">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_recruiting_email" class="font-weight-bolder">E-posta Adresi</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_recruiting_email" type="text" class="form-control form-control-solid emailMask">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_recruiting_phone_number" class="font-weight-bolder">Telefon Numarası</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_recruiting_phone_number" type="text" class="form-control form-control-solid phoneMask">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_recruiting_birth_date" class="font-weight-bolder">Doğum Tarihi</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_recruiting_birth_date" type="date" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_recruiting_obstacle" class="font-weight-bolder">Engellilik Durumu</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_recruiting_obstacle" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Engellilik Durumu">
                                        <option value="0">Yok</option>
                                        <option value="1">Var</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_recruiting_cv" class="font-weight-bolder">CV</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_recruiting_cv" type="file" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Vazgeç</button>
                        <button type="button" class="btn btn-success" id="CreateRecruitingButton">Oluştur</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
