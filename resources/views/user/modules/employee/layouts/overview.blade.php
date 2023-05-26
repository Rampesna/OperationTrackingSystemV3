<div class="card mb-6 mb-xl-9">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
            <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                <img class="w-100 h-100" src="{{ asset('assets/media/logos/avatar.png') }}" alt="image" id="employeeImageSpan">
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-4 mt-2">
                            <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3" id="employeeNameSpan">
                                <i class="fa fa-spinner fa-spin"></i>
                            </a>
                        </div>
                        <div class="d-flex flex-wrap fw-bold mb-1 fs-6 text-gray-400" id="employeeIdentitySpan">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                        <div class="d-flex flex-wrap fw-bold mb-1 fs-6 text-gray-400" id="employeeEmailSpan">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                        <div class="d-flex flex-wrap fw-bold mb-1 fs-6 text-gray-400" id="employeePhoneSpan">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
                    <div class="d-flex mb-4">

                    </div>
                </div>
            </div>
        </div>
        <div class="separator"></div>
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">

            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ request()->segment(4) === 'stats' ? 'active' : '' }}" href="{{ route('user.web.employee.info.stats', ['id' => $employeeId]) }}">İstatistikler</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ request()->segment(4) === 'academyEducation' ? 'active' : '' }}" href="{{ route('user.web.employee.info.stats', ['id' => $employeeId]) }}">Alınan Eğitimler</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ request()->segment(4) === 'academyEducation' ? 'active' : '' }}" href="{{ route('user.web.employee.info.stats', ['id' => $employeeId]) }}">Yazılı İlet. Değerlendirmeler</a>
            </li>

        </ul>
    </div>
</div>
