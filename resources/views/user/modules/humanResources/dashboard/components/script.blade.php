<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var totalEmployeesCountSpan = $('#totalEmployeesCountSpan');
    var todayPermittedEmployeesCountSpan = $('#todayPermittedEmployeesCountSpan');
    var waitingTransactionsCountSpan = $('#waitingTransactionsCountSpan');
    var waitingTransactionsCount = 0;

    var waitingPermitsTBody = $('#waitingPermitsTBody');
    var waitingOvertimesTBody = $('#waitingOvertimesTBody');
    var waitingPaymentsTBody = $('#waitingPaymentsTBody');

    var updatePermitTypeId = $('#update_permit_type_id');
    var updateOvertimeTypeId = $('#update_overtime_type_id');
    var updatePaymentTypeId = $('#update_payment_type_id');

    function getPermitTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.permitType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                updatePermitTypeId.empty();
                $.each(response.response, function (i, permitType) {
                    updatePermitTypeId.append(`<option value="${permitType.id}">${permitType.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('İzin Türleri Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    function getOvertimeTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.overtimeType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                updateOvertimeTypeId.empty();
                $.each(response.response, function (i, overtimeType) {
                    updateOvertimeTypeId.append(`<option value="${overtimeType.id}">${overtimeType.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Mesai Türleri Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    function getPaymentTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.paymentType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                updatePaymentTypeId.empty();
                $.each(response.response, function (i, paymentType) {
                    updatePaymentTypeId.append(`<option value="${paymentType.id}">${paymentType.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ödeme Türleri Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    getPermitTypes();
    getOvertimeTypes();
    getPaymentTypes();

    function getEmployeesByCompanyIds() {
        totalEmployeesCountSpan.html(`<i class="fa fa-lg fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: SelectedCompanies.val(),
                pageIndex: 0,
                pageSize: 1000,
                leave: 0,
            },
            success: function (response) {
                totalEmployeesCountSpan.html(response.response.length);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Listesi Alınırken Serviste Bir Hata Oluştu!');
            }
        });
    }

    function getPermitsByDateAndCompanyIds() {
        todayPermittedEmployeesCountSpan.html(`<i class="fa fa-lg fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.permit.getByDateAndCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                date: reformatDatetimeTo_YYYY_MM_DD(new Date()),
                companyIds: SelectedCompanies.val(),
            },
            success: function (response) {
                todayPermittedEmployeesCountSpan.html(response.response.length);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Bugün İzinliler Listesi Alınırken Serviste Bir Hata Oluştu!');
            }
        });
    }

    function getPermitsByStatusIdAndCompanyIds() {
        waitingPermitsTBody.html(`<tr><td colspan="4" class="text-center"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.permit.getByStatusIdAndCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                statusId: 1,
                companyIds: SelectedCompanies.val(),
            },
            success: function (response) {
                waitingTransactionsCount += response.response.length;
                waitingTransactionsCountSpan.html(waitingTransactionsCount);
                waitingPermitsTBody.empty();
                $.each(response.response, function (i, permit) {
                    waitingPermitsTBody.append(`
                    <tr>
                        <td class="ps-0">
                            <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-warning"></span>
                        </td>
                        <td class="ps-0 text-end">
                            <div class="d-flex justify-content-start flex-shrink-0">
                                <span class="btn btn-icon btn-secondary btn-sm me-3" id="waitingPermitDropdown${permit.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </span>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3 dropdown-menu" data-kt-menu="true" aria-labelledby="waitingPermitDropdown${permit.id}">
                                    <div class="menu-item px-3" onclick="acceptPermit(${permit.id})">
                                        <span class="menu-link px-3">
                                            <i class="fa fa-check-circle text-success me-3"></i>
                                            <span class="fw-bolder">Onayla</span>
                                        </span>
                                    </div>
                                    <div class="menu-item px-3" onclick="denyPermit(${permit.id})">
                                        <span class="menu-link px-3">
                                            <i class="fa fa-times-circle text-danger me-3"></i>
                                            <span class="fw-bolder">Reddet</span>
                                        </span>
                                    </div>
                                    <hr class="text-muted">
                                    <div class="menu-item px-3" onclick="updatePermit(${permit.id})">
                                        <span class="menu-link px-3">
                                            <i class="fa fa-pen text-primary me-3"></i>
                                            <span class="fw-bolder">Düzenle</span>
                                        </span>
                                    </div>
                                    <hr class="text-muted">
                                    <div class="menu-item px-3" onclick="deletePermit(${permit.id})">
                                        <span class="menu-link px-3">
                                            <i class="fa fa-trash text-danger me-3"></i>
                                            <span class="fw-bolder">Sil</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-gray-800 fw-bolder fs-6 d-block cursor-pointer">${permit.employee ? permit.employee.name : ''}(${permit.type ? permit.type.name : ''})</span>
                            <span class="text-gray-800 fs-6 d-block">${reformatDatetimeToDatetimeForHuman(permit.start_date)} - ${reformatDatetimeToDatetimeForHuman(permit.end_date)}</span>
                            <span class="text-gray-400 fw-bolder fs-7 d-block">${permit.description ?? ''}</span>
                        </td>
                    </tr>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Onay Bekleyen İzinler Alınırken Serviste Bir Hata Oluştu!');
            }
        });
    }

    function getOvertimesByStatusIdAndCompanyIds() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.overtime.getByStatusIdAndCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                statusId: 1,
                companyIds: SelectedCompanies.val(),
            },
            success: function (response) {
                waitingTransactionsCount += response.response.length;
                waitingTransactionsCountSpan.html(waitingTransactionsCount);
                waitingOvertimesTBody.empty();
                $.each(response.response, function (i, overtime) {
                    waitingOvertimesTBody.append(`
                    <tr>
                        <td class="ps-0">
                            <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-warning"></span>
                        </td>
                        <td class="ps-0 text-end">
                            <div class="d-flex justify-content-start flex-shrink-0">
                                <span class="btn btn-icon btn-secondary btn-sm me-3" id="waitingOvertimeDropdown${overtime.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </span>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3 dropdown-menu" data-kt-menu="true" aria-labelledby="waitingOvertimeDropdown${overtime.id}">
                                    <div class="menu-item px-3" onclick="acceptOvertime(${overtime.id})">
                                        <span class="menu-link px-3">
                                            <i class="fa fa-check-circle text-success me-3"></i>
                                            <span class="fw-bolder">Onayla</span>
                                        </span>
                                    </div>
                                    <div class="menu-item px-3" onclick="denyOvertime(${overtime.id})">
                                        <span class="menu-link px-3">
                                            <i class="fa fa-times-circle text-danger me-3"></i>
                                            <span class="fw-bolder">Reddet</span>
                                        </span>
                                    </div>
                                    <hr class="text-muted">
                                    <div class="menu-item px-3" onclick="updateOvertime(${overtime.id})">
                                        <span class="menu-link px-3">
                                            <i class="fa fa-pen text-primary me-3"></i>
                                            <span class="fw-bolder">Düzenle</span>
                                        </span>
                                    </div>
                                    <hr class="text-muted">
                                    <div class="menu-item px-3" onclick="deleteOvertime(${overtime.id})">
                                        <span class="menu-link px-3">
                                            <i class="fa fa-trash text-danger me-3"></i>
                                            <span class="fw-bolder">Sil</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-gray-800 fw-bolder fs-6 d-block cursor-pointer">${overtime.employee ? overtime.employee.name : ''}(${overtime.type ? overtime.type.name : ''})</span>
                            <span class="text-gray-800 fs-6 d-block">${reformatDatetimeToDatetimeForHuman(overtime.start_date)} - ${reformatDatetimeToDatetimeForHuman(overtime.end_date)}</span>
                            <span class="text-gray-400 fw-bolder fs-7 d-block">${overtime.description ?? ''}</span>
                        </td>
                    </tr>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function getPaymentsByStatusIdAndCompanyIds() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.payment.getByStatusIdAndCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                statusId: 1,
                companyIds: SelectedCompanies.val(),
            },
            success: function (response) {
                waitingTransactionsCount += response.response.length;
                waitingTransactionsCountSpan.html(waitingTransactionsCount);
                waitingPaymentsTBody.empty();
                $.each(response.response, function (i, payment) {
                    waitingPaymentsTBody.append(`
                    <tr>
                        <td class="ps-0">
                            <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px bg-warning"></span>
                        </td>
                        <td class="ps-0 text-end">
                            <div class="d-flex justify-content-start flex-shrink-0">
                                <span class="btn btn-icon btn-secondary btn-sm me-3" id="waitingPaymentDropdown${payment.id}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </span>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3 dropdown-menu" data-kt-menu="true" aria-labelledby="waitingPaymentDropdown${payment.id}">
                                    <div class="menu-item px-3" onclick="acceptPayment(${payment.id})">
                                        <span class="menu-link px-3">
                                            <i class="fa fa-check-circle text-success me-3"></i>
                                            <span class="fw-bolder">Onayla</span>
                                        </span>
                                    </div>
                                    <div class="menu-item px-3" onclick="denyPayment(${payment.id})">
                                        <span class="menu-link px-3">
                                            <i class="fa fa-times-circle text-danger me-3"></i>
                                            <span class="fw-bolder">Reddet</span>
                                        </span>
                                    </div>
                                    <hr class="text-muted">
                                    <div class="menu-item px-3" onclick="updatePayment(${payment.id})">
                                        <span class="menu-link px-3">
                                            <i class="fa fa-pen text-primary me-3"></i>
                                            <span class="fw-bolder">Düzenle</span>
                                        </span>
                                    </div>
                                    <hr class="text-muted">
                                    <div class="menu-item px-3" onclick="deletePayment(${payment.id})">
                                        <span class="menu-link px-3">
                                            <i class="fa fa-trash text-danger me-3"></i>
                                            <span class="fw-bolder">Sil</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-gray-800 fw-bolder fs-6 d-block cursor-pointer">${payment.employee ? payment.employee.name : ''}(${payment.type ? payment.type.name : ''}) - ${reformatNumberToMoney(payment.amount)} ₺</span>
                            <span class="text-gray-800 fs-6 d-block">${reformatDatetimeToDateForHuman(payment.date)}</span>
                            <span class="text-gray-400 fw-bolder fs-7 d-block">${payment.description ?? ''}</span>
                        </td>
                    </tr>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function getWaitingTransactions() {
        waitingTransactionsCountSpan.html(`<i class="fa fa-lg fa-spinner fa-spin"></i>`);
        waitingTransactionsCount = 0;
        getPermitsByStatusIdAndCompanyIds();
        getOvertimesByStatusIdAndCompanyIds();
        getPaymentsByStatusIdAndCompanyIds();
    }

    getEmployeesByCompanyIds();
    getPermitsByDateAndCompanyIds();
    getWaitingTransactions();

    function acceptPermit(permitId) {
        $('#accept_permit_id').val(permitId);
        $('#AcceptPermitModal').modal('show');
    }

    function denyPermit(permitId) {
        $('#deny_permit_id').val(permitId);
        $('#DenyPermitModal').modal('show');
    }

    function updatePermit(permitId) {
        $('#loader').show();
        $('#update_permit_id').val(permitId);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.permit.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: permitId,
            },
            success: function (response) {
                updatePermitTypeId.val(response.response.type_id);
                $('#update_permit_start_date').val(reformatDatetimeForInput(response.response.start_date));
                $('#update_permit_end_date').val(reformatDatetimeForInput(response.response.end_date));
                $('#update_permit_description').val(response.response.description);
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İzin Verileri Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
        $('#UpdatePermitModal').modal('show');
    }

    function deletePermit(permitId) {
        $('#delete_permit_id').val(permitId);
        $('#DeletePermitModal').modal('show');
    }

    function acceptOvertime(overtimeId) {
        $('#accept_overtime_id').val(overtimeId);
        $('#AcceptOvertimeModal').modal('show');
    }

    function denyOvertime(overtimeId) {
        $('#deny_overtime_id').val(overtimeId);
        $('#DenyOvertimeModal').modal('show');
    }

    function updateOvertime(overtimeId) {
        $('#update_overtime_id').val(overtimeId);
        $('#UpdateOvertimeModal').modal('show');
    }

    function deleteOvertime(overtimeId) {
        $('#delete_overtime_id').val(overtimeId);
        $('#DeleteOvertimeModal').modal('show');
    }

    function acceptPayment(paymentId) {
        $('#accept_payment_id').val(paymentId);
        $('#AcceptPaymentModal').modal('show');
    }

    function denyPayment(paymentId) {
        $('#deny_payment_id').val(paymentId);
        $('#DenyPaymentModal').modal('show');
    }

    function updatePayment(paymentId) {
        $('#update_payment_id').val(paymentId);
        $('#UpdatePaymentModal').modal('show');
    }

    function deletePayment(paymentId) {
        $('#delete_payment_id').val(paymentId);
        $('#DeletePaymentModal').modal('show');
    }

    SelectedCompanies.change(function () {
        getEmployeesByCompanyIds();
        getPermitsByDateAndCompanyIds();
        getWaitingTransactions();
    });

</script>
