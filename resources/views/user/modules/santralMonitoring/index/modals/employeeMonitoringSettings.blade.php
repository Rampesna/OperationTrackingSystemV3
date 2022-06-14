<div class="modal fade show" id="EmployeeMonitoringSettingsModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
                <div class="row mb-5">
                    <div class="col-xl-12">
                        <h5>Personel Takip Ekranı Seçenekleri</h5>
                    </div>
                </div>
                <hr class="text-muted">
                <div class="row">
                    <div class="col-xl-6 mb-5">
                        <div class="form-group">
                            <label for="employeeMonitoringType">Personel Listesi Türü</label>
                            <select id="employeeMonitoringType" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Personel Listesi Türü">
                                <option value="" selected hidden disabled></option>
                                <option value="1">Firma Bazlı</option>
                                <option value="2">Ekip Bazlı</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 mb-5" id="employeeMonitoringCompanyIdsColumn" style="display: none">
                        <div class="form-group">
                            <label for="employeeMonitoringCompanyIds">Firma Seçimi</label>
                            <select id="employeeMonitoringCompanyIds" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Firma Seçimi" multiple></select>
                        </div>
                    </div>
                    <div class="col-xl-6 mb-5" id="employeeMonitoringJobDepartmentTypeIdsColumn" style="display: none">
                        <div class="form-group">
                            <label for="employeeMonitoringJobDepartmentTypeIds">Ekip Seçimi</label>
                            <select id="employeeMonitoringJobDepartmentTypeIds" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Ekip Seçimi" multiple></select>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">İptal</button>
                    <button type="button" class="btn btn-primary" id="EmployeeMonitoringSettingsButton">Ekranı Aç</button>
                </div>
            </div>
        </div>
    </div>
</div>
