<div class="modal fade show" id="AcceptModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <div class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Talep Ürünleri</h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <input type="hidden" id="accept_purchase_id">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="accept_receipt_number" class="font-weight-bolder">Fatura/Fiş Numarası</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="accept_receipt_number" type="text" class="form-control form-control-solid" placeholder="Fatura/Fiş Numarası" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="accept_price" class="font-weight-bolder">Fatura Tutarı</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <input id="accept_price" type="text" class="form-control form-control-solid" placeholder="Fatura Tutarı" readonly>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <span>Ürün Adı</span>
                            </div>
                            <div class="col-xl-2 mt-3">
                                <span>İstenilen Adet</span>
                            </div>
                            <div class="col-xl-2 mt-3">
                                <span>Alınan Adet</span>
                            </div>
                        </div>
                        <div id="acceptPurchaseItemsRow">

                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Kapat</button>
                        <button type="button" class="btn btn-success" id="AcceptButton">Onayla</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
