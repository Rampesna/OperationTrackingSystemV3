<div class="modal fade show" id="UpdateTicketModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
                        <h1 class="mb-3">Destek Talebi Güncelle</h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <input type="hidden" id="update_ticket_id">
                        <input type="hidden" id="update_ticket_todo_end_date">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_ticket_relation_type" class="font-weight-bolder">Bağlantı Türü</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="update_ticket_relation_type" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Bağlantı Türü">
                                        <option value="App\Models\Eloquent\Project">Proje</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_ticket_relation_id" class="font-weight-bolder">Talep Bağlantısı</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="update_ticket_relation_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Talep Bağlantısı"></select>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_ticket_title" class="font-weight-bolder">Talep Başlığı</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_ticket_title" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_ticket_source" class="font-weight-bolder">Talep Kaynağı</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_ticket_source" type="text" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_ticket_priority_id" class="font-weight-bolder">Talep Önceliği</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="update_ticket_priority_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Talep Önceliği"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_ticket_status_id" class="font-weight-bolder">Talep Durumu</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="update_ticket_status_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Talep Önceliği"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_ticket_requested_end_date" class="font-weight-bolder">İstenilen Temin Zamanı</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="update_ticket_requested_end_date" type="date" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_ticket_description" class="font-weight-bolder">Açıklamalar</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <textarea id="update_ticket_description" class="form-control form-control-solid" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="update_ticket_notes" class="font-weight-bolder">Ek Notlar</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <textarea id="update_ticket_notes" class="form-control form-control-solid" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Vazgeç</button>
                        <button type="button" class="btn btn-success" id="UpdateTicketButton">Güncelle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
