<div class="modal fade show" id="OperationsModal" aria-modal="true" role="dialog" data-bs-modal-backdrop-opacity="0.1">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content rounded" style="background: transparent; border: none; box-shadow: none">
            <div class="modal-header pb-0 border-0 justify-content-end">

            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">

                <div class="row mb-2">
                    <div class="col-xl-12">
                        <a onclick="createEmployee()" class="card py-0 cursor-pointer">
                            <div class="card-body">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black"/>
                                            <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"/>
                                        </svg>
                                    </span>
                                </span>
                                <span class="text-dark ms-5">Yeni Personel Oluştur</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-xl-12">
                        <a onclick="getEmployeeReport()" class="card py-0 cursor-pointer">
                            <div class="card-body">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                            <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="black"/>
                                            <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="black"/>
                                        </svg>
                                    </span>
                                </span>
                                <span class="text-dark ms-5">Personel Raporu</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div id="operationsBatchActions">
                    <div class="row mb-2">
                        <div class="col-xl-12">
                            <a onclick="setEmployeeScript()" class="card py-0 cursor-pointer">
                                <div class="card-body">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-1 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM14.5 12L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L10 12H11.5V17C11.5 17.6 11.4 18 12 18C12.6 18 12.5 17.6 12.5 17V12H14.5Z" fill="black"/>
                                                <path d="M13 11.5V17.9355C13 18.2742 12.6 19 12 19C11.4 19 11 18.2742 11 17.9355V11.5H13Z" fill="black"/>
                                                <path d="M8.2575 11.4411C7.82942 11.8015 8.08434 12.5 8.64398 12.5H15.356C15.9157 12.5 16.1706 11.8015 15.7425 11.4411L12.4375 8.65789C12.1875 8.44737 11.8125 8.44737 11.5625 8.65789L8.2575 11.4411Z" fill="black"/>
                                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="text-dark ms-5">Script Ataması</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-xl-12">
                            <a onclick="setEmployeeDataScanning()" class="card py-0 cursor-pointer">
                                <div class="card-body">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-1 svg-icon-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="black"/>
                                                <rect x="7" y="17" width="6" height="2" rx="1" fill="black"/>
                                                <rect x="7" y="12" width="10" height="2" rx="1" fill="black"/>
                                                <rect x="7" y="7" width="6" height="2" rx="1" fill="black"/>
                                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="text-dark ms-5">Data Tarama Ataması</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-xl-12">
                            <a onclick="setEmployeeOtsLockType()" class="card py-0 cursor-pointer">
                                <div class="card-body">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-1 svg-icon-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M2 16C2 16.6 2.4 17 3 17H21C21.6 17 22 16.6 22 16V15H2V16Z" fill="black"/>
                                                <path opacity="0.3" d="M21 3H3C2.4 3 2 3.4 2 4V15H22V4C22 3.4 21.6 3 21 3Z" fill="black"/>
                                                <path opacity="0.3" d="M15 17H9V20H15V17Z" fill="black"/>
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="text-dark ms-5">OTS Kilit Türü Ataması</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-xl-12">
                            <a onclick="setEmployeeWorkToDoType()" class="card py-0 cursor-pointer">
                                <div class="card-body">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-1 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z" fill="black"/>
                                                <path opacity="0.3" d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z" fill="black"/>
                                            </svg>
                                        </span>
                                    </span>
                                    <span class="text-dark ms-5">Yapılacak İş Ataması</span>
                                </div>
                            </a>
                        </div>
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
