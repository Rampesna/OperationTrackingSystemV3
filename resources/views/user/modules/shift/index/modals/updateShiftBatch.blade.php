<div class="modal fade show" id="UpdateShiftBatchModal" tabindex="-1" aria-modal="true" role="dialog">
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
                        <h1 class="mb-3">
                            Toplu Vardiya Güncelle
                        </h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_shift_batch_employee_ids" class="font-weight-bolder">Personeller</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="update_shift_batch_employee_ids" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Personeller" aria-label="Personeller" multiple></select>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="update_shift_batch_date" class="font-weight-bolder">Vardiya Tarihi</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="update_shift_batch_date" type="date" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="update_shift_batch_start_time" class="font-weight-bolder">Vardiya Başlangıcı</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="update_shift_batch_start_time" type="time" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="update_shift_batch_end_time" class="font-weight-bolder">Vardiya Bitişi</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="update_shift_batch_end_time" type="time" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Vazgeç</button>
                        <button type="button" class="btn btn-success" id="UpdateShiftBatchButton">Güncelle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
