<div class="modal fade show" id="UpdateEmployeeModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
                        <h1 class="mb-3" id="updateEmployeeNameSpan"></h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <input type="hidden" id="update_employee_id">
                        <input type="hidden" id="update_employee_guid">
                        <input type="hidden" id="update_employee_company_id">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_name" class="font-weight-bolder">Ad Soyad</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_name" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_email" class="font-weight-bolder">E-posta Adresi</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_email" type="text" class="form-control form-control-solid emailMask">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_phone" class="font-weight-bolder">Telefon Numarası</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_phone" type="text" class="form-control form-control-solid phoneMask">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_identity" class="font-weight-bolder">Kimlik Numarası</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_identity" type="text" class="form-control form-control-solid" maxlength="11">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_santral_code" class="font-weight-bolder">Santral Dahilisi</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_santral_code" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_saturday_permit_exemption" class="font-weight-bolder">Cumartesi İzni Muafiyeti</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="update_employee_saturday_permit_exemption" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Cumartesi İzni Muafiyeti">
                                        <option value="0">Hayır</option>
                                        <option value="1">Evet</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_ots_status" class="font-weight-bolder">OTS Durumu</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="update_employee_ots_status" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Cumartesi İzni Muafiyeti">
                                        <option value="0">Pasif</option>
                                        <option value="1">Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_web_crm_user_id" class="font-weight-bolder">Web CRM Kullanıcı ID</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_web_crm_user_id" type="number" class="form-control form-control-solid onlyNumber">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_web_crm_username" class="font-weight-bolder">Web CRM Kullanıcı Adı</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_web_crm_username" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_web_crm_password" class="font-weight-bolder">Web CRM Şifresi</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_web_crm_password" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_progress_crm_username" class="font-weight-bolder">Progress CRM Kullanıcı Adı</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_progress_crm_username" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_progress_crm_password" class="font-weight-bolder">Progress CRM Şifresi</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_progress_crm_password" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_marketing_crm_username" class="font-weight-bolder">Satış CRM Kullanıcı Adı</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_marketing_crm_username" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_marketing_crm_password" class="font-weight-bolder">Satış CRM Şifresi</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_marketing_crm_password" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_team_code" class="font-weight-bolder">Takım Kodu</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_team_code" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_group_code" class="font-weight-bolder">Grup Kodu</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_group_code" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_employee_call_scan_code" class="font-weight-bolder">Çağrı Tarama Kodu</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_employee_call_scan_code" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Vazgeç</button>
                        <button type="button" class="btn btn-success" id="UpdateEmployeeButton">Güncelle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
