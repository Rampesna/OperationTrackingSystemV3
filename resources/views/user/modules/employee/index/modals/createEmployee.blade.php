<div class="modal fade show" id="CreateEmployeeModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered mw-1000px">
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
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0">
                <div class="row">
                    <div id="CreateEmployeeWizardStepper" class="stepper stepper-links d-flex flex-column pt-15 between" data-kt-stepper="true">
                        <div class="stepper-nav mb-5">
                            <div class="stepper-item current" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <h3 class="stepper-title">Genel Bilgiler</h3>
                            </div>
                            <div class="stepper-item pending" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <h3 class="stepper-title">CRM Bilgileri</h3>
                            </div>
                            <div class="stepper-item pending" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <h3 class="stepper-title">Kuyruk Görevleri</h3>
                            </div>
                            <div class="stepper-item pending" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <h3 class="stepper-title">İş Görevleri</h3>
                            </div>
                            <div class="stepper-item pending" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <h3 class="stepper-title">Gruplar</h3>
                            </div>
                            <div class="stepper-item pending" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <h3 class="stepper-title">Vardiya</h3>
                            </div>
                        </div>
                        <form class="mx-auto mw-700px w-100 pt-15 pb-10 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="createEmployeeForm">
                            <div class="current" data-kt-stepper-element="content">
                                <div class="row w-xl-1000px">
                                    <div class="col-xl-12 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_company_id" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Firma Seçimi</span>
                                            </label>
                                            <select id="create_employee_company_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Firma Seçimi"></select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_name" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Ad Soyad</span>
                                            </label>
                                            <input id="create_employee_name" type="text" class="form-control form-control-solid" placeholder="Ad Soyad" aria-hidden="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_email" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">E-posta Adresi</span>
                                            </label>
                                            <input id="create_employee_email" type="text" class="form-control form-control-solid emailMask" placeholder="E-posta Adresi" aria-hidden="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_job_department_id" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Departman</span>
                                            </label>
                                            <select id="create_employee_job_department_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Departman"></select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_santral_code" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span>Santral Dahilisi</span>
                                            </label>
                                            <input id="create_employee_santral_code" type="text" class="form-control form-control-solid" placeholder="Santral Dahilisi" aria-hidden="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-stepper-element="content">
                                <div class="row w-xl-1000px">
                                    <div class="col-xl-4 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_web_crm_user_id" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Web CRM Kullanıcı ID</span>
                                            </label>
                                            <input id="create_employee_web_crm_user_id" type="text" class="form-control form-control-solid onlyNumber" placeholder="Web CRM Kullanıcı ID" aria-hidden="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_web_crm_username" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Web CRM Kullanıcı Adı</span>
                                            </label>
                                            <input id="create_employee_web_crm_username" type="text" class="form-control form-control-solid" placeholder="Web CRM Kullanıcı Adı" aria-hidden="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_web_crm_password" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Web CRM Şifresi</span>
                                            </label>
                                            <input id="create_employee_web_crm_password" type="text" class="form-control form-control-solid" placeholder="Web CRM Şifresi" aria-hidden="true">
                                        </div>
                                    </div>
                                    <hr class="text-muted">
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_progress_crm_username" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Progress CRM Kullanıcı Adı</span>
                                            </label>
                                            <input id="create_employee_progress_crm_username" type="text" class="form-control form-control-solid" placeholder="Progress CRM Kullanıcı Adı" aria-hidden="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_progress_crm_password" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Progress CRM Şifresi</span>
                                            </label>
                                            <input id="create_employee_progress_crm_password" type="text" class="form-control form-control-solid" placeholder="Progress CRM Şifresi" aria-hidden="true">
                                        </div>
                                    </div>
                                    <hr class="text-muted">
                                    <div class="col-xl-4 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_team_code" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Takım Kodu</span>
                                            </label>
                                            <input id="create_employee_team_code" type="number" class="form-control form-control-solid onlyNumber" placeholder="Takım Kodu" aria-hidden="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_group_code" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Grup Kodu</span>
                                            </label>
                                            <input id="create_employee_group_code" type="number" class="form-control form-control-solid onlyNumber" placeholder="Grup Kodu" aria-hidden="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_call_scan_code" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Çağrı Tarama Kodu</span>
                                            </label>
                                            <input id="create_employee_call_scan_code" type="number" class="form-control form-control-solid onlyNumber" placeholder="Çağrı Tarama Kodu" aria-hidden="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-stepper-element="content">
                                <div class="row w-xl-1000px" id="createEmployeeTasks"></div>
                            </div>
                            <div data-kt-stepper-element="content">
                                <div class="row w-xl-1000px" id="createEmployeeWorkTasks"></div>
                            </div>
                            <div data-kt-stepper-element="content">
                                <div class="row w-xl-1000px" id="createEmployeeGroupTasks"></div>
                            </div>
                            <div data-kt-stepper-element="content">
                                <div class="row w-xl-1000px">
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_shift_groups" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Dahil Edilecek Vardiya Grupları</span>
                                            </label>
                                            <select id="create_employee_shift_groups" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Dahil Edilecek Vardiya Grupları" multiple></select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="create_employee_shift_group_id" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">İlk Vardiya Seçimi</span>
                                            </label>
                                            <select id="create_employee_shift_group_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="İlk Vardiya Seçimi"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-stack pt-15">
                                <div class="mr-2">
                                    <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black"></rect>
                                                <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black"></path>
                                            </svg>
                                        </span>Geri
                                    </button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit" id="CreateEmployeeButton">
                                        <span class="indicator-label">Kaydet
                                            <span class="svg-icon svg-icon-3 ms-2 me-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black"></rect>
                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black"></path>
                                                </svg>
                                            </span>
                                        </span>
                                    </button>
                                    <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">İleri
                                        <span class="svg-icon svg-icon-4 ms-1 me-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black"></rect>
                                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
