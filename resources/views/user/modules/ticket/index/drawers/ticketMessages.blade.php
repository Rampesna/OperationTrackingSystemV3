<div id="ticketMessagesDrawer"
     class=""
     data-kt-drawer="true"
     data-kt-drawer-activate="true"
     data-kt-drawer-toggle="#ticketMessagesDrawerButton"
     data-kt-drawer-close="#ticketMessagesDrawerCloseButton"
     data-kt-drawer-width="90%">

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="row mt-3">
                    <div class="col-xl-3 mt-3">
                        <span class="fw-bolder">Talep Başlığı</span>
                    </div>
                    <div class="col-xl-9">
                        <input type="text" class="form-control form-control-solid" id="ticket_messages_ticket_title_input" aria-label="Talep Başlığı" disabled>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-xl-3 mt-3">
                        <span class="fw-bolder">Talebi Oluşturan</span>
                    </div>
                    <div class="col-xl-9">
                        <input type="text" class="form-control form-control-solid" id="ticket_messages_ticket_creator_input" aria-label="Talebi Oluşturan" disabled>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-xl-3 mt-3">
                        <span class="fw-bolder">Talep Kaynağı</span>
                    </div>
                    <div class="col-xl-9">
                        <input type="text" class="form-control form-control-solid" id="ticket_messages_ticket_source_input" aria-label="Talep Kaynağı" disabled>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-xl-3 mt-3">
                        <span class="fw-bolder">Açıklamalar</span>
                    </div>
                    <div class="col-xl-9">
                        <textarea id="ticket_messages_ticket_description_input" class="form-control form-control-solid" rows="4" aria-label="Açıklamalar" disabled></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-xl-3 mt-3">
                        <span class="fw-bolder">Notlar</span>
                    </div>
                    <div class="col-xl-9">
                        <textarea id="ticket_messages_ticket_notes_input" class="form-control form-control-solid" rows="4" aria-label="Notlar" disabled></textarea>
                    </div>
                </div>
                <hr class="text-muted">
                <div class="row mt-3">
                    <div class="col-xl-3 mt-3">
                        <span class="fw-bolder">Oluşturulma Tarihi</span>
                    </div>
                    <div class="col-xl-9">
                        <input type="datetime-local" class="form-control form-control-solid" id="ticket_messages_ticket_created_at_input" aria-label="Oluşturulma Tarihi" disabled>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-xl-3 mt-3">
                        <span class="fw-bolder">İstenilen Temin Zamanı</span>
                    </div>
                    <div class="col-xl-9">
                        <input type="date" class="form-control form-control-solid" id="ticket_messages_ticket_requested_end_date_input" aria-label="İstenilen Temin Zamanı" disabled>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-xl-3 mt-3">
                        <span class="fw-bolder">Yapılacak Temin Zamanı</span>
                    </div>
                    <div class="col-xl-9">
                        <input type="date" class="form-control form-control-solid" id="ticket_messages_ticket_todo_end_date_input" aria-label="Yapılacak Temin Zamanı" disabled>
                    </div>
                </div>
                <hr class="text-muted">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group">
                            <textarea class="form-control form-control-lg form-control-solid" id="create_ticket_message_message" rows="3" placeholder="Mesajınız..." aria-label="Mesajınız..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-xl-12 text-end">
                        <button type="button" id="CreateTicketMessageButton" class="btn btn-light-success font-weight-bold">Cevapla</button>
                    </div>
                </div>
                <hr class="text-muted">
                <div class="row">
                    <div class="col-xl-12">
                        <h6 class="font-size-h6-sm">Mesaj Geçmişi</h6>
                    </div>
                </div>
                <br>
                <div class="row" id="ticketMessagesRow">

                </div>
            </div>
        </div>
    </div>

</div>
