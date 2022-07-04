<div class="modal fade show" id="ShowOvertimeModal" tabindex="-1" aria-modal="true" role="dialog">
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
                        <h1 class="mb-3" id="show_overtime_type_name_span">
                            <i class="fa fa-spinner fa-spin fa-2x"></i>
                        </h1>
                        <span id="show_overtime_status_badge_span" class="badge badge-secondary">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row text-center">
                            <div class="col-6 border-right pb-4 pt-4">
                                <label class="fw-bolder mb-2">Başlangıç</label>
                                <h6 id="show_overtime_start_date_span" class="fs-4 fw-bolder">
                                    <i class="fa fa-spinner fa-spin fa-lg"></i>
                                </h6>
                            </div>
                            <div class="col-6 pb-4 pt-4">
                                <label class="fw-bolder mb-2">Bitiş</label>
                                <h6 id="show_overtime_end_date_span" class="fs-4 fw-bolder">
                                    <i class="fa fa-spinner fa-spin fa-lg"></i>
                                </h6>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row">
                            <div class="col-xl-12 mb-5 text-center">
                                <h5>Açıklamalar</h5>
                            </div>
                            <div class="col-xl-12">
                                <textarea id="show_overtime_description_input" aria-label="Açıklamalar" class="form-control form-control-solid" rows="4" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Kapat</button>
                        <button type="button" class="btn btn-primary me-3" id="EditOvertimeButton">Düzenle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
