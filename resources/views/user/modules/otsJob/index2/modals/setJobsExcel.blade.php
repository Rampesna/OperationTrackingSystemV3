<div class="modal fade show" id="SetJobsExcelModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
                        <h1 class="mb-3">İş Aktarımı</h1>
                        <a class="ms-5 fs-5" href="{{ route('user.web.file.downloadByKey', ['key' => 'excelTemplates/jobs.xlsx']) }}">
                            <i class="fa fa-lg fa-file-download"></i> Aktarım Dosyası Şablonu
                        </a>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row">
                            <div class="col-xl-4 mb-5">
                                <div class="form-group">
                                    <label for="set_jobs_excel_file" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span>Aktarım Dosyası</span>
                                    </label>
                                    <input id="set_jobs_excel_file" type="file" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-4 mb-5">
                                <div class="form-group">
                                    <label for="set_jobs_excel_type" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span>İş Türü</span>
                                    </label>
                                    <select id="set_jobs_excel_type" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="İş Türü" aria-hidden="true">
                                        <option value="1">I-Dönüşüm</option>
                                        <option value="3">E-Yedekleme</option>
                                        <option value="6">Eski Aktivasyon</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 mb-5">
                                <div class="form-group">
                                    <label for="set_jobs_excel_commercial_company_id" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span>Firma Türü</span>
                                    </label>
                                    <select id="set_jobs_excel_commercial_company_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Firma Türü" aria-hidden="true"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">İptal</button>
                        <button type="button" class="btn btn-primary" id="SetJobsExcelButton">Aktar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
