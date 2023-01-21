<div class="modal fade show" id="UpdatePrCritterModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
                        <h1 class="mb-3">Kriter Güncelle</h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_pr_card_name" class="font-weight-bolder">Kriter Adı</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_pr_critter_name" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_pr_critter_min_target" class="font-weight-bolder">Min Hedef</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_pr_critter_min_target" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_pr_critter_min_target_percent" class="font-weight-bolder">Min Hedef Yüzde</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_pr_critter_min_target_percent" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_pr_critter_default_target" class="font-weight-bolder">Varsayılan Hedef</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_pr_critter_default_target" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_pr_critter_default_target_percent" class="font-weight-bolder">Varsayılan Hedef Yüzde</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_pr_critter_default_target_percent" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_pr_critter_max_target" class="font-weight-bolder">Max Hedef</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_pr_critter_max_target" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_pr_critter_max_target" class="font-weight-bolder">Max Hedef Yüzde</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_pr_critter_max_target_percent" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_pr_critter_general_percent" class="font-weight-bolder">Genel Yüzde</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_pr_critter_general_percent" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Vazgeç</button>
                        <button type="button" class="btn btn-success" id="CreatePrCardButton" onclick="updatePrCritter()">Kaydet</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
