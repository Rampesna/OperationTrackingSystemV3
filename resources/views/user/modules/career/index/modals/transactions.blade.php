<div class="modal fade show" id="TransactionsModal" aria-modal="true" role="dialog" data-bs-modal-backdrop-opacity="0.1">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content rounded" style="background: transparent; border: none; box-shadow: none">
            <div class="modal-header pb-0 border-0 justify-content-end">

            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">

                <div class="row mb-2">
                    <div class="col-xl-2">

                    </div>
                    <div class="col-xl-8">
                        @if(checkUserPermission(189, $userPermissions))
                            <a onclick="sendBatchSms()" class="card py-0 cursor-pointer">
                                <div class="card-body">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="black"/>
                                                <path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="black"/>
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="text-dark ms-5">Toplu SMS Gönder</span>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="col-xl-2">

                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="text-center">
                            <a href="#" class="text-center">
                                <i class="fas fa-times-circle fa-2x text-secondary" data-bs-dismiss="modal"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
