<div class="modal fade show" id="TransactionsModal" aria-modal="true" role="dialog" data-bs-modal-backdrop-opacity="0.1">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content rounded" style="background: transparent; border: none; box-shadow: none">
            <div class="modal-header pb-0 border-0 justify-content-end">

            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <div class="row mb-5">

                    @if(checkUserPermission(68, $userPermissions))
                    <div class="col-xl-6 mb-5">
                        <div onclick="createProduct()" class="card py-0 cursor-pointer">
                            <div class="card-body">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M11 13H7C6.4 13 6 12.6 6 12C6 11.4 6.4 11 7 11H11V13ZM17 11H13V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black"/>
                                            <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM17 11H13V7C13 6.4 12.6 6 12 6C11.4 6 11 6.4 11 7V11H7C6.4 11 6 11.4 6 12C6 12.6 6.4 13 7 13H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black"/>
                                        </svg>
                                    </span>
                                </span>
                                <span class="text-dark ms-5">Yeni Ürün Oluştur</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(checkUserPermission(69, $userPermissions))
                    <div class="col-xl-6 mb-5 editingTransaction">
                        <div onclick="updateProduct()" class="card py-0 cursor-pointer">
                            <div class="card-body">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"/>
                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"/>
                                        </svg>
                                    </span>
                                </span>
                                <span class="text-dark ms-5">Ürünü Düzenle</span>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="text-center">
                            <span class="text-center">
                                <i class="fas fa-times-circle fa-2x text-danger cursor-pointer" data-bs-dismiss="modal"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
