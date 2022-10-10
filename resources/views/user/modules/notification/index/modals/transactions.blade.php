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
                        @if(checkUserPermission(217, $userPermissions))
                        <a onclick="sendNotification()" class="card py-0 cursor-pointer">
                            <div class="card-body">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z" fill="black"></path>
                                            <path d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z" fill="black"></path>
                                        </svg>
                                    </span>
                                </span>
                                <span class="text-dark ms-5">Bildirim Gönder</span>
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
