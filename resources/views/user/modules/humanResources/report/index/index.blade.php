@extends('user.layouts.master')
@section('title', 'İnsan Kaynakları / Raporlar | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">İnsan Kaynakları / Raporlar</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">

        <a href="{{ route('user.web.humanResources.report.ageAndGender') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M21 10.7192H3C2.4 10.7192 2 11.1192 2 11.7192C2 12.3192 2.4 12.7192 3 12.7192H6V14.7192C6 18.0192 8.7 20.7192 12 20.7192C15.3 20.7192 18 18.0192 18 14.7192V12.7192H21C21.6 12.7192 22 12.3192 22 11.7192C22 11.1192 21.6 10.7192 21 10.7192Z" fill="black"/>
                                <path d="M11.6 21.9192C11.4 21.9192 11.2 21.8192 11 21.7192C10.6 21.4192 10.5 20.7191 10.8 20.3191C11.7 19.1191 12.3 17.8191 12.7 16.3191C12.8 15.8191 13.4 15.4192 13.9 15.6192C14.4 15.7192 14.8 16.3191 14.6 16.8191C14.2 18.5191 13.4 20.1192 12.4 21.5192C12.2 21.7192 11.9 21.9192 11.6 21.9192ZM8.7 19.7192C10.2 18.1192 11 15.9192 11 13.7192V8.71917C11 8.11917 11.4 7.71917 12 7.71917C12.6 7.71917 13 8.11917 13 8.71917V13.0192C13 13.6192 13.4 14.0192 14 14.0192C14.6 14.0192 15 13.6192 15 13.0192V8.71917C15 7.01917 13.7 5.71917 12 5.71917C10.3 5.71917 9 7.01917 9 8.71917V13.7192C9 15.4192 8.4 17.1191 7.2 18.3191C6.8 18.7191 6.9 19.3192 7.3 19.7192C7.5 19.9192 7.7 20.0192 8 20.0192C8.3 20.0192 8.5 19.9192 8.7 19.7192ZM6 16.7192C6.5 16.7192 7 16.2192 7 15.7192V8.71917C7 8.11917 7.1 7.51918 7.3 6.91918C7.5 6.41918 7.2 5.8192 6.7 5.6192C6.2 5.4192 5.59999 5.71917 5.39999 6.21917C5.09999 7.01917 5 7.81917 5 8.71917V15.7192V15.8191C5 16.3191 5.5 16.7192 6 16.7192ZM9 4.71917C9.5 4.31917 10.1 4.11918 10.7 3.91918C11.2 3.81918 11.5 3.21917 11.4 2.71917C11.3 2.21917 10.7 1.91916 10.2 2.01916C9.4 2.21916 8.59999 2.6192 7.89999 3.1192C7.49999 3.4192 7.4 4.11916 7.7 4.51916C7.9 4.81916 8.2 4.91918 8.5 4.91918C8.6 4.91918 8.8 4.81917 9 4.71917ZM18.2 18.9192C18.7 17.2192 19 15.5192 19 13.7192V8.71917C19 5.71917 17.1 3.1192 14.3 2.1192C13.8 1.9192 13.2 2.21917 13 2.71917C12.8 3.21917 13.1 3.81916 13.6 4.01916C15.6 4.71916 17 6.61917 17 8.71917V13.7192C17 15.3192 16.8 16.8191 16.3 18.3191C16.1 18.8191 16.4 19.4192 16.9 19.6192C17 19.6192 17.1 19.6192 17.2 19.6192C17.7 19.6192 18 19.3192 18.2 18.9192Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Yaş & Cinsiyet Raporu</span>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('user.web.humanResources.report.education') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="black"/>
                                <rect x="7" y="17" width="6" height="2" rx="1" fill="black"/>
                                <rect x="7" y="12" width="10" height="2" rx="1" fill="black"/>
                                <rect x="7" y="7" width="6" height="2" rx="1" fill="black"/>
                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Eğitim Durumu Raporu</span>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('user.web.humanResources.report.bloodGroup') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M18.937 11.985L12.015 5.06303C11.9228 4.96752 11.8124 4.89131 11.6904 4.8389C11.5684 4.7865 11.4372 4.75888 11.3044 4.75773C11.1716 4.75657 11.04 4.78191 10.9171 4.83219C10.7942 4.88247 10.6825 4.9568 10.5886 5.0507C10.4947 5.14459 10.4205 5.25617 10.3702 5.37907C10.3199 5.50196 10.2946 5.63362 10.2958 5.7664C10.2969 5.89917 10.3245 6.03038 10.3769 6.15238C10.4293 6.27439 10.5055 6.38484 10.601 6.47709L11.293 7.16898L5.693 12.7691C5.50663 12.9552 5.37581 13.1894 5.31522 13.4457C5.25464 13.702 5.26669 13.9702 5.35001 14.22L6.10401 16.4821L2.28901 20.297C2.1935 20.3893 2.11733 20.4996 2.06492 20.6216C2.01251 20.7436 1.98493 20.8748 1.98377 21.0076C1.98262 21.1404 2.00789 21.272 2.05817 21.3949C2.10845 21.5178 2.18273 21.6295 2.27662 21.7234C2.37051 21.8173 2.48215 21.8915 2.60505 21.9418C2.72795 21.9921 2.85963 22.0174 2.99241 22.0163C3.12519 22.0151 3.25642 21.9875 3.37843 21.9351C3.50043 21.8827 3.61076 21.8066 3.70301 21.7111L7.51801 17.896L9.78001 18.6501C10.0298 18.7334 10.298 18.7454 10.5543 18.6849C10.8106 18.6243 11.0449 18.4934 11.231 18.307L16.831 12.7071L17.523 13.3991C17.6153 13.4946 17.7256 13.5707 17.8476 13.6231C17.9696 13.6755 18.1008 13.7031 18.2336 13.7043C18.3664 13.7054 18.4981 13.6801 18.6209 13.6298C18.7438 13.5795 18.8555 13.5053 18.9494 13.4114C19.0433 13.3175 19.1175 13.2059 19.1678 13.083C19.2181 12.9601 19.2434 12.8284 19.2423 12.6956C19.2411 12.5628 19.2135 12.4316 19.1611 12.3096C19.1087 12.1876 19.0325 12.0773 18.937 11.985Z" fill="black"/>
                                <path d="M21.707 7.861C21.5195 8.04847 21.2652 8.15385 21 8.15385C20.7348 8.15385 20.4805 8.04847 20.293 7.861L19.6 7.16898L16.861 9.9091L14.091 7.13908L16.831 4.40006L16.139 3.70707C15.9568 3.51847 15.8561 3.26577 15.8583 3.00358C15.8606 2.74138 15.9658 2.49062 16.1512 2.30521C16.3366 2.11981 16.5874 2.01465 16.8496 2.01237C17.1118 2.01009 17.3644 2.11085 17.553 2.29301L21.707 6.44706C21.8945 6.63459 21.9998 6.88893 21.9998 7.15409C21.9998 7.41925 21.8945 7.67347 21.707 7.861ZM8.00699 15.99L10.084 16.683L12.684 14.0771L9.91501 11.308L7.30899 13.908L8.00699 15.99Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Kan Grubu Raporu</span>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('user.web.humanResources.report.permit') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M15.43 8.56949L10.744 15.1395C10.6422 15.282 10.5804 15.4492 10.5651 15.6236C10.5498 15.7981 10.5815 15.9734 10.657 16.1315L13.194 21.4425C13.2737 21.6097 13.3991 21.751 13.5557 21.8499C13.7123 21.9488 13.8938 22.0014 14.079 22.0015H14.117C14.3087 21.9941 14.4941 21.9307 14.6502 21.8191C14.8062 21.7075 14.9261 21.5526 14.995 21.3735L21.933 3.33649C22.0011 3.15918 22.0164 2.96594 21.977 2.78013C21.9376 2.59432 21.8452 2.4239 21.711 2.28949L15.43 8.56949Z" fill="black"/>
                                <path opacity="0.3" d="M20.664 2.06648L2.62602 9.00148C2.44768 9.07085 2.29348 9.19082 2.1824 9.34663C2.07131 9.50244 2.00818 9.68731 2.00074 9.87853C1.99331 10.0697 2.04189 10.259 2.14054 10.4229C2.23919 10.5869 2.38359 10.7185 2.55601 10.8015L7.86601 13.3365C8.02383 13.4126 8.19925 13.4448 8.37382 13.4297C8.54839 13.4145 8.71565 13.3526 8.85801 13.2505L15.43 8.56548L21.711 2.28448C21.5762 2.15096 21.4055 2.05932 21.2198 2.02064C21.034 1.98196 20.8409 1.99788 20.664 2.06648Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">İzin Raporu</span>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('user.web.humanResources.report.overtime') }}" class="col-xl-2 col-6 cursor-pointer mb-5">
            <div class="card h-lg-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column">
                    <div class="m-0">
                        <span class="svg-icon svg-icon-2hx svg-icon-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="black"/>
                                <path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="black"/>
                            </svg>
                        </span>
                    </div>
                    <div class="d-flex flex-column mt-7">
                        <span class="fw-bold fs-5 text-gray-800 lh-1 ls-n2">Mesai Raporu</span>
                    </div>
                </div>
            </div>
        </a>

    </div>

@endsection

@section('customStyles')
    @include('user.modules.humanResources.report.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.humanResources.report.index.components.script')
@endsection
