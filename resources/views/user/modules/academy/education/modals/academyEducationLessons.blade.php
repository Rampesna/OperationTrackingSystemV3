<div class="modal fade show" id="AcademyEducationLessonsModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
                        <h1 class="mb-3">Eğitim Dersleri</h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <input type="hidden" id="create_academy_education_lesson_academy_education_id">
                        <div class="row">
                            <div class="col-xl-8">
                                <input type="text" id="create_academy_education_lesson_name" class="form-control form-control-solid createAcademyEducationLessonInput" aria-label="Yeni Ders Adı" placeholder="Yeni Ders Adı">
                            </div>
                            <div class="col-xl-3">
                                <input type="number" id="create_academy_education_lesson_duration_in_minutes" class="form-control form-control-solid onlyNumber createAcademyEducationLessonInput" aria-label="Yeni Ders Süresi" placeholder="Ders Süresi(dk)">
                            </div>
                            <div class="col-xl-1">
                                <button id="CreateAcademyEducationLessonButton" class="btn btn-icon btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div id="academyEducationLessonsRow">

                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Kapat</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
