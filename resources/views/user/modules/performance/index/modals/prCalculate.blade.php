<div class="modal fade show" id="prCalculateModal" tabindex="-1" aria-modal="true" role="dialog"
     data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                  transform="rotate(-45 6 17.3137)" fill="black"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                  fill="black"></rect>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <div class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Performans Hesapla</h1>
                    </div>
                    <input type="hidden" id="selectedDepartmentId">
                    <input type="hidden" id="selectedCardId">
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row mb-5">
                            <div class="form-group mb-5">
                                <select id="prDepartment" class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Departman Seçimi" data-minimum-results-for-search="Infinity"
                                        aria-label="Kart Seçimi">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row mb-5">
                            <div class="form-group mb-5">
                                <select id="prCards" class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Kart Seçimi" data-minimum-results-for-search="Infinity"
                                        aria-label="Kart Seçimi">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row mb-5">
                            <label for="prSeletedDate">Performans Dönemi</label>
                            <div class="form-group mb-5">
                                <input type="month" class="form-control" id="prSeletedDate">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row mb-5">
                            <div class="form-group mb-5">
                                <label for="calculateType">Hesaplama Türü</label>
                                <select id="calculateType" class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Hesaplama Türü" data-minimum-results-for-search="Infinity"
                                        aria-label="Hesaplama Türü">
                                    <option value="1">Günlük</option>
                                    <option value="2">Aylık</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Vazgeç </button>
                        <button class="btn btn-success" id="CalculateButton" type="button">Hesapla</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
