<div class="modal fade show" id="SetEmployeeOtsLockTypeModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered mw-700px">
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
                <div class="row mb-5">
                    <div class="col-xl-12">
                        <h5>OTS Kilit Türü Ataması</h5>
                    </div>
                </div>
                <hr class="text-muted">
                <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="form-group">
                                <label for="set_employee_ots_lock_type" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Kilit Türü</span>
                                </label>
                                <select id="set_employee_ots_lock_type" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Kilit Türü">
                                    <option value="1">Bilgisayar Kilit Ekranı</option>
                                    <option value="2">OTS Kilit Ekranı</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">İptal</button>
                    <button type="button" class="btn btn-primary" id="SetEmployeeOtsLockTypeButton">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
</div>
