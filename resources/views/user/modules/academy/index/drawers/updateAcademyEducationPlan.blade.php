<div id="updateAcademyEducationPlanDrawer"
     class=""
     data-kt-drawer="true"
     data-kt-drawer-activate="true"
     data-kt-drawer-toggle="#updateAcademyEducationPlanDrawerButton"
     data-kt-drawer-close="#updateAcademyEducationPlanDrawerCloseButton"
     data-kt-drawer-width="90%">
    <button id="updateAcademyEducationPlanDrawerButton" style="display: none"></button>
    <div class="container-fluid">
        <input type="hidden" id="update_academy_education_plan_id">
        <div class="row mt-10">
            <div class="col-xl-12">
                <h5 id="updateAcademyEducationPlanLessonNameSpan">Test Eğitim</h5>
            </div>
        </div>
        <hr class="text-muted">
        <div class="row mt-5">
            <div class="col-xl-3 mt-3 mb-5">
                <span class="fw-bolder">Eğitim Başlangıcı</span>
            </div>
            <div class="col-xl-9">
                <input type="datetime-local" class="form-control form-control-solid" id="update_academy_education_plan_start_datetime" aria-label="Eğitim Başlangıcı">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-3 mt-3 mb-5">
                <span class="fw-bolder">Eğitmen</span>
            </div>
            <div class="col-xl-9">
                <input type="text" class="form-control form-control-solid" id="update_academy_education_plan_educationist" aria-label="Eğitmen">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-3 mt-3 mb-5">
                <span class="fw-bolder">Eğitim Türü</span>
            </div>
            <div class="col-xl-9">
                <select id="update_academy_education_plan_academy_education_plan_type_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Eğitim Türü" aria-label="Eğitim Türü">
                    <option value="1">Yüzyüze</option>
                    <option value="2">Online</option>
                </select>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-3 mt-3 mb-5">
                <span class="fw-bolder">Eğitim Adresi</span>
            </div>
            <div class="col-xl-9">
                <input type="text" class="form-control form-control-solid" id="update_academy_education_plan_location" aria-label="Eğitim Adresi">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-3 mt-3 mb-5">
                <span class="fw-bolder">Katılacak Personeller</span>
            </div>
            <div class="col-xl-9">
                <select id="update_academy_education_plan_employee_ids" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Katılacak Personeller" aria-label="Katılacak Personeller" multiple></select>
            </div>
        </div>
        <hr class="text-muted">
        <div class="row">
            <div class="col-xl-4 mb-3 d-grid">
                <button class="btn btn-info btn-sm" id="ParticipantsAcademyEducationPlanButton">Yoklama Listesi</button>
            </div>
            <div class="col-xl-4 mb-3 d-grid">
                <button class="btn btn-danger btn-sm" id="DeleteAcademyEducationPlanModalButton">Sil</button>
            </div>
            <div class="col-xl-4 mb-3 d-grid">
                <button class="btn btn-success btn-sm" id="UpdateAcademyEducationPlanButton">Güncelle</button>
            </div>
        </div>
    </div>

</div>
