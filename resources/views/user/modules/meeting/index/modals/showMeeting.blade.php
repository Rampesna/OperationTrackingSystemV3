<div class="modal fade show" id="ShowMeetingModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
                        <h1 class="mb-3" id="show_meeting_name_span">
                            <i class="fa fa-spinner fa-spin fa-2x"></i>
                        </h1>
                        <span id="show_meeting_type_badge_span" class="badge badge-secondary">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row text-center">
                            <div class="col-6 border-right pb-4 pt-4">
                                <label class="mb-0">Başlangıç</label>
                                <h6 id="show_meeting_start_date" class="font-20 font-weight-bold text-col-blue">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </h6>
                            </div>
                            <div class="col-6 pb-4 pt-4">
                                <label class="mb-0">Bitiş</label>
                                <h6 id="show_meeting_end_date" class="font-20 font-weight-bold text-col-blue">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </h6>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="show_meeting_location" class="font-weight-bolder">Toplantı Adresi</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="show_meeting_location" type="datetime-local" class="form-control form-control-solid" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Vazgeç</button>
                        <button type="button" class="btn btn-success" id="EditMeetingButton" onclick="updateMeeting()">Düzenle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
