<div class="modal fade show" id="TransactionsModal" aria-modal="true" role="dialog" data-bs-modal-backdrop-opacity="0.1">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content rounded" style="background: transparent; border: none; box-shadow: none">
            <div class="modal-header pb-0 border-0 justify-content-end">

            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <div class="row mb-5">

                    @if(checkUserPermission(70, $userPermissions))
                    <div class="col-xl-4 mb-5">
                        <div onclick="academyEducation()" class="card py-0 cursor-pointer">
                            <div class="card-body">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2hx">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black"/>
                                            <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black"/>
                                        </svg>
                                    </span>
                                </span>
                                <span class="text-dark ms-5">Eğitim Listesi</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(checkUserPermission(71, $userPermissions))
                    <div class="col-xl-4 mb-5">
                        <div onclick="createAcademyEducationPlan()" class="card py-0 cursor-pointer">
                            <div class="card-body">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2hx">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M11 13H7C6.4 13 6 12.6 6 12C6 11.4 6.4 11 7 11H11V13ZM17 11H13V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black"/>
                                            <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM17 11H13V7C13 6.4 12.6 6 12 6C11.4 6 11 6.4 11 7V11H7C6.4 11 6 11.4 6 12C6 12.6 6.4 13 7 13H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V13H17C17.6 13 18 12.6 18 12C18 11.4 17.6 11 17 11Z" fill="black"/>
                                        </svg>
                                    </span>
                                </span>
                                <span class="text-dark ms-5">Yeni Eğitim Planla</span>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(checkUserPermission(72, $userPermissions))
                    <div class="col-xl-4 mb-5">
                        <div onclick="getReport()" class="card py-0 cursor-pointer">
                            <div class="card-body">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2hx">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M13.0021 10.9128V3.01281C13.0021 2.41281 13.5021 1.91281 14.1021 2.01281C16.1021 2.21281 17.9021 3.11284 19.3021 4.61284C20.7021 6.01284 21.6021 7.91285 21.9021 9.81285C22.0021 10.4129 21.5021 10.9128 20.9021 10.9128H13.0021Z" fill="black"/>
                                            <path opacity="0.3" d="M11.0021 13.7128V4.91283C11.0021 4.31283 10.5021 3.81283 9.90208 3.91283C5.40208 4.51283 1.90209 8.41284 2.00209 13.1128C2.10209 18.0128 6.40208 22.0128 11.3021 21.9128C13.1021 21.8128 14.7021 21.3128 16.0021 20.4128C16.5021 20.1128 16.6021 19.3128 16.1021 18.9128L11.0021 13.7128Z" fill="black"/>
                                            <path opacity="0.3" d="M21.9021 14.0128C21.7021 15.6128 21.1021 17.1128 20.1021 18.4128C19.7021 18.9128 19.0021 18.9128 18.6021 18.5128L13.0021 12.9128H20.9021C21.5021 12.9128 22.0021 13.4128 21.9021 14.0128Z" fill="black"/>
                                        </svg>
                                    </span>
                                </span>
                                <span class="text-dark ms-5">Rapor Oluştur</span>
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
