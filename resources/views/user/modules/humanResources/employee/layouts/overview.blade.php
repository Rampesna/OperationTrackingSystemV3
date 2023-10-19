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
                        <button class="btn btn-info" style="display: none" id="reActivateEmployeeButton">Personeli Tekrar İşe Al</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="separator"></div>
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">

            @if(checkUserPermission(112, $userPermissions))
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ request()->segment(4) === 'personalInformation' ? 'active' : '' }}" href="{{ route('user.web.humanResources.employee.personalInformation', ['id' => $id]) }}">Kişisel Bilgiler</a>
            </li>
            @endif
            @if(checkUserPermission(113, $userPermissions))
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ request()->segment(4) === 'position' ? 'active' : '' }}" href="{{ route('user.web.humanResources.employee.position', ['id' => $id]) }}">Kariyer</a>
            </li>
            @endif
            @if(checkUserPermission(114, $userPermissions))
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ request()->segment(4) === 'permit' ? 'active' : '' }}" href="{{ route('user.web.humanResources.employee.permit', ['id' => $id]) }}">İzinler</a>
            </li>
            @endif
            @if(checkUserPermission(115, $userPermissions))
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ request()->segment(4) === 'overtime' ? 'active' : '' }}" href="{{ route('user.web.humanResources.employee.overtime', ['id' => $id]) }}">Mesailer</a>
            </li>
            @endif
            @if(checkUserPermission(116, $userPermissions))
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ request()->segment(4) === 'payment' ? 'active' : '' }}" href="{{ route('user.web.humanResources.employee.payment', ['id' => $id]) }}">Ödemeler</a>
            </li>
            @endif
            @if(checkUserPermission(117, $userPermissions))
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ request()->segment(4) === 'device' ? 'active' : '' }}" href="{{ route('user.web.humanResources.employee.device', ['id' => $id]) }}">Zimmetler</a>
            </li>
            @endif
            @if(checkUserPermission(118, $userPermissions))
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ request()->segment(4) === 'file' ? 'active' : '' }}" href="{{ route('user.web.humanResources.employee.file', ['id' => $id]) }}">Dosyalar</a>
            </li>
            @endif
            @if(checkUserPermission(119, $userPermissions))
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ request()->segment(4) === 'shift' ? 'active' : '' }}" href="{{ route('user.web.humanResources.employee.shift', ['id' => $id]) }}">Vardiyalar</a>
            </li>
            @endif
            @if(checkUserPermission(120, $userPermissions))
            <li class="nav-item">
                <a class="nav-link text-active-primary py-5 me-6 {{ request()->segment(4) === 'punishment' ? 'active' : '' }}" href="{{ route('user.web.humanResources.employee.punishment', ['id' => $id]) }}">Cezalar</a>
            </li>
            @endif

        </ul>
    </div>
</div>
