<div class="modal fade show" id="CreateExamModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
                        <h1 class="mb-3">Sınav Oluştur</h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row mb-5">
                            <div class="col-xl-4 mt-3">
                                <label for="create_exam_name" class="font-weight-bolder">Sınav Adı</label>
                            </div>
                            <div class="col-xl-8">
                                <div class="form-group">
                                    <input id="create_exam_name" type="text" class="form-control form-control-solid" placeholder="Sınav Adı">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-4 mt-3">
                                <label for="create_exam_duration" class="font-weight-bolder">Sınav Süresi(saniye)</label>
                            </div>
                            <div class="col-xl-8">
                                <div class="form-group">
                                    <input id="create_exam_duration" type="number" class="form-control form-control-solid" placeholder="Sınav Süresi(saniye)">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-4 mt-3">
                                <label for="create_exam_date" class="font-weight-bolder">Sınav Tarihi</label>
                            </div>
                            <div class="col-xl-8">
                                <div class="form-group">
                                    <input id="create_exam_date" type="datetime-local" class="form-control form-control-solid" placeholder="Sınav Tarihi">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-4 mt-3">
                                <label for="create_exam_description" class="font-weight-bolder">Sınav Açıklaması</label>
                            </div>
                            <div class="col-xl-8">
                                <div class="form-group">
                                    <textarea id="create_exam_description" class="form-control form-control-solid" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Kapat</button>
                        <button type="button" class="btn btn-success me-3" id="CreateExamButton">Kaydet</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
