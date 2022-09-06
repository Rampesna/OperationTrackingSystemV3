<div class="modal fade show" id="ShowModal" aria-modal="true" role="dialog" data-bs-modal-backdrop-opacity="0.1">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content rounded" style="background: transparent; border: none; box-shadow: none">
            <div class="modal-header pb-0 border-0 justify-content-end">

            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <div class="row mb-5">
                    <div class="col-xl-6 mb-5">
                        <input type="hidden" id="download_file_id">
                        <div onclick="downloadFile()" class="card py-0 cursor-pointer">
                            <div class="card-body">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2hx">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z" fill="black"/>
                                            <path d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z" fill="black"/>
                                            <path opacity="0.3" d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z" fill="black"/>
                                        </svg>
                                    </span>
                                </span>
                                <span class="text-dark ms-5">İndir</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 mb-5">
                        <input type="hidden" id="delete_file_id">
                        <div onclick="deleteFile()" class="card py-0 cursor-pointer">
                            <div class="card-body">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2hx">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"/>
                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"/>
                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"/>
                                        </svg>
                                    </span>
                                </span>
                                <span class="text-dark ms-5">Sil</span>
                            </div>
                        </div>
                    </div>
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
