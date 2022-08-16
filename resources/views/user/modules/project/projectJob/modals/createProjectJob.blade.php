<div class="modal fade show" id="CreateProjectJobModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
                        <h1 class="mb-3">İş Oluştur</h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_project_job_type_id" class="font-weight-bolder">İş Türü</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_project_job_type_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="İş Türü"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_project_job_landing_customer_id" class="font-weight-bolder">Ürün Kullanıcısı</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_project_job_landing_customer_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Ürün Kullanıcısı"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_project_job_code" class="font-weight-bolder">İş Kodu</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_project_job_code" type="text" class="form-control form-control-solid" placeholder="İş Kodu">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_project_job_subject" class="font-weight-bolder">İş Konusu</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_project_job_subject" type="text" class="form-control form-control-solid" placeholder="İş Konusu">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_project_job_end_date" class="font-weight-bolder">Bitiş Tarihi</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="create_project_job_end_date" type="date" class="form-control form-control-solid" placeholder="İş Konusu">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_project_job_description" class="font-weight-bolder">Açıklamalar</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <textarea id="create_project_job_description" class="form-control form-control-solid" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Vazgeç</button>
                        <button type="button" class="btn btn-success" id="CreateProjectJobButton">Oluştur</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
