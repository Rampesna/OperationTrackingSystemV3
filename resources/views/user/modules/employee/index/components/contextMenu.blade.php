<div class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-350px" id="context-menu">
    <div class="menu-item px-3">
        <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">İşlemler</div>
    </div>
    <div class="separator mb-3 opacity-75"></div>
    @if(checkUserPermission(77, $userPermissions))
    <div class="menu-item px-3">
        <a onclick="createEmployee()" class="menu-link px-3">
            <i class="fas fa-user-plus text-success"></i><span class="ms-2">Yeni Personel Oluştur</span>
        </a>
    </div>
    @endif
    @if(checkUserPermission(78, $userPermissions))
    <div class="menu-item px-3 mb-3">
        <a onclick="getEmployeeReport()" class="menu-link px-3">
            <i class="fas fa-table text-success"></i><span class="ms-2">Personel Raporu</span>
        </a>
    </div>
    @endif
    <div id="batchActions">
        @if(checkUserPermission(176, $userPermissions))
        <div class="separator mb-3 opacity-75"></div>
        <div class="menu-item px-3">
            <a onclick="setEmployeeScript()" class="menu-link px-3">
                <i class="fas fa-clipboard-list text-primary"></i><span class="ms-2">Script Ataması</span>
            </a>
        </div>
        @endif
            @if(checkUserPermission(177, $userPermissions))
        <div class="menu-item px-3">
            <a onclick="setEmployeeDataScanning()" class="menu-link px-3">
                <i class="far fa-file-alt text-info"></i><span class="ms-2">Data Tarama Ataması</span>
            </a>
        </div>
        @endif
        @if(checkUserPermission(178, $userPermissions))
        <div class="menu-item px-3">
            <a onclick="setEmployeeOtsLockType()" class="menu-link px-3">
                <i class="fas fa-desktop text-danger"></i><span class="ms-2">OTS Kilit Türü Ataması</span>
            </a>
        </div>
        @endif
        @if(checkUserPermission(179, $userPermissions))
        <div class="menu-item px-3 pb-3">
            <a onclick="setEmployeeWorkToDoType()" class="menu-link px-3">
                <i class="fas fa-search text-primary"></i><span class="ms-2">Yapılacak İş Ataması</span>
            </a>
        </div>
        @endif
    </div>
</div>
