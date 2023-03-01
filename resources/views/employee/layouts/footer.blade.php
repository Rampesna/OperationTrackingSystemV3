<div id="defaultFooter" style="display: none">
    <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="text-dark order-2 order-md-1">
                <span class="text-muted fw-bold me-1">{{ date('Y') }}©</span>
                <a href="https://bienteknoloji.com.tr" target="_blank" class="text-gray-800 text-hover-primary">Ayssoft Bilgi Teknolojileri A.Ş.</a>
            </div>
            <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">

            </ul>
        </div>
    </div>
</div>

<div id="mobileFooter" style="display: none; margin-top: 75px">
    <div class="{{ auth()->user()->theme() == 1 ? 'mobileFooterDark' : 'mobileFooter' }} py-5 px-3">
        <div class="row h-50px">
            <a href="{{ route('employee.web.dashboard.index') }}" class="col-3 text-dark text-center">
                <span class="svg-icon {{ request()->segment(2) == 'dashboard' ? 'svg-icon-primary' : '' }} svg-icon-2qx">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z" fill="black"/>
                        <path opacity="0.3" d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z" fill="black"/>
                        <path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z" fill="black"/>
                        <path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z" fill="black"/>
                        <path opacity="0.3" d="M14 4H10V10H14V4Z" fill="black"/>
                        <path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="black"/>
                        <path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="black"/>
                        <path d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z" fill="black"/>
                    </svg>
                </span>
                <br>
                <span class="text-dark">Anasayfa</span>
            </a>
            <a href="{{ route('employee.web.profile.index') }}" class="col-3 text-dark text-center">
                <span class="svg-icon {{ request()->segment(2) == 'profile' ? 'svg-icon-primary' : '' }} svg-icon-2qx">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"/>
                        <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"/>
                    </svg>
                </span>
                <br>
                <span class="text-dark">Profilim</span>
            </a>
            <a href="{{ route('employee.web.performance.index') }}" class="col-3 text-dark">
                <span class="svg-icon {{ request()->segment(2) == 'performance' ? 'svg-icon-primary' : '' }} svg-icon-2qx">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" d="M14 3V21H10V3C10 2.4 10.4 2 11 2H13C13.6 2 14 2.4 14 3ZM7 14H5C4.4 14 4 14.4 4 15V21H8V15C8 14.4 7.6 14 7 14Z" fill="black"/>
                        <path d="M21 20H20V8C20 7.4 19.6 7 19 7H17C16.4 7 16 7.4 16 8V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z" fill="black"/>
                    </svg>
                </span>
                <br>
                <span class="text-dark">Performans</span>
            </a>
            <a href="{{ route('employee.web.specialInformation.index') }}" class="col-3 text-dark text-center">
                <span class="svg-icon {{ request()->segment(2) == 'specialInformation' ? 'svg-icon-primary' : '' }} svg-icon-2qx">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18.3721 4.65439C17.6415 4.23815 16.8052 4 15.9142 4C14.3444 4 12.9339 4.73924 12.003 5.89633C11.0657 4.73913 9.66 4 8.08626 4C7.19611 4 6.35789 4.23746 5.62804 4.65439C4.06148 5.54462 3 7.26056 3 9.24232C3 9.81001 3.08941 10.3491 3.25153 10.8593C4.12155 14.9013 9.69287 20 12.0034 20C14.2502 20 19.875 14.9013 20.7488 10.8593C20.9109 10.3491 21 9.81001 21 9.24232C21.0007 7.26056 19.9383 5.54462 18.3721 4.65439Z" fill="black"/>
                    </svg>
                </span>
                <br>
                <span class="text-dark">Özel Bilgilerim</span>
            </a>
        </div>
    </div>
</div>
