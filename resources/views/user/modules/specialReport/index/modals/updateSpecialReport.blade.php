<div class="modal fade show" id="UpdateSpecialReportModal" tabindex="-1" aria-modal="true" role="dialog">
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
                <input type="hidden" id="update_shift_clicked_date">
                <div class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Özel Rapor Güncelle</h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <input type="hidden" id="update_special_report_id">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_special_report_company_id" class="font-weight-bolder">Firma Seçimi</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="update_special_report_company_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Firma Seçimi"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_special_report_name" class="font-weight-bolder">Rapor Adı</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_special_report_name" type="text" class="form-control form-control-solid" placeholder="Rapor Adı">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_special_report_query" class="font-weight-bolder">SQL Sorgu</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <textarea id="update_special_report_query" class="form-control form-control-solid" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Vazgeç</button>
                        <button type="button" class="btn btn-success" id="UpdateSpecialReportButton">Güncelle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
