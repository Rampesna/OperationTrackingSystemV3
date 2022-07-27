<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var payments = $('#payments');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');
    var typeIdFilter = $('#typeId');
    var statusIdFilter = $('#statusId');
    var dateFilter = $('#date');
    var amountFilter = $('#amount');

    var CreatePaymentButton = $('#CreatePaymentButton');
    var UpdatePaymentButton = $('#UpdatePaymentButton');
    var DeletePaymentButton = $('#DeletePaymentButton');

    var createPaymentEmployeeId = $('#create_payment_employee_id');
    var updatePaymentEmployeeId = $('#update_payment_employee_id');

    var createPaymentTypeId = $('#create_payment_type_id');
    var updatePaymentTypeId = $('#update_payment_type_id');

    var createPaymentStatusId = $('#create_payment_status_id');
    var updatePaymentStatusId = $('#update_payment_status_id');

    function createPayment() {
        createPaymentEmployeeId.val('');
        createPaymentTypeId.val('');
        createPaymentStatusId.val('');
        $('#create_payment_date').val('');
        $('#create_payment_amount').val('');
        $('#create_payment_description').val('');
        $('#CreatePaymentModal').modal('show');
    }

    function updatePayment(id) {
        $('#loader').show();
        $('#update_payment_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.payment.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updatePaymentEmployeeId.val(response.response.employee_id);
                updatePaymentTypeId.val(response.response.type_id);
                updatePaymentStatusId.val(response.response.status_id);
                $('#update_payment_date').val(response.response.date);
                $('#update_payment_amount').val(response.response.amount);
                $('#update_payment_description').val(response.response.description);
                $('#UpdatePaymentModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ödeme Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deletePayment(id) {
        $('#delete_payment_id').val(id);
        $('#DeletePaymentModal').modal('show');
    }

    function getEmployeesByCompanyIds() {
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
                createPaymentEmployeeId.empty();
                $.each(response.response.employees, function (i, employee) {
                    createPaymentEmployeeId.append(`<option value="${employee.id}">${employee.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Listesi Alınırken Serviste Bir Sorun Oluştu!');
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
                createPaymentTypeId.empty();
                updatePaymentTypeId.empty();
                typeIdFilter.empty();
                $.each(response.response, function (i, paymentType) {
                    createPaymentTypeId.append($('<option>', {
                        value: paymentType.id,
                        text: paymentType.name
                    }));
                    updatePaymentTypeId.append($('<option>', {
                        value: paymentType.id,
                        text: paymentType.name
                    }));
                    typeIdFilter.append($('<option>', {
                        value: paymentType.id,
                        text: paymentType.name
                    }));
                });
                typeIdFilter.val('');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ödeme Türleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getPayments() {
        payments.html(`<tr><td colspan="7" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();
        var date = dateFilter.val();
        var amount = amountFilter.val();
        var statusId = statusIdFilter.val();
        var typeId = typeIdFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.payment.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
                date: date,
                amount: amount,
                statusId: statusId,
                typeId: typeId,
            },
            success: function (response) {
                payments.empty();
                $.each(response.response.payments, function (i, payment) {
                    payments.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${payment.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${payment.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updatePayment(${payment.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deletePayment(${payment.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${payment.employee ? payment.employee.name : ''}
                        </td>
                        <td>
                            <span class="badge badge-${payment.status ? payment.status.color : ''}">${payment.status ? payment.status.name : ''}</span>
                        </td>
                        <td class="hideIfMobile">
                            ${payment.type ? payment.type.name : ''}
                        </td>
                        <td class="hideIfMobile">
                            ${reformatDatetimeToDateForHuman(payment.date)}
                        </td>
                        <td class="hideIfMobile">
                            ${payment.amount} ₺
                        </td>
                    </tr>
                    `);
                });

                checkScreen();

                if (response.response.totalCount <= (pageIndex + 1) * pageSize) {
                    pageUpButton.attr('disabled', true);
                } else {
                    pageUpButton.attr('disabled', false);
                }
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ödemeler Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getEmployeesByCompanyIds();
    getPaymentTypes();
    getPayments();

    SelectedCompanies.change(function () {
        getEmployeesByCompanyIds();
        getPayments();
    });

    keywordFilter.on('keypress', function (e) {
        if (e.which === 13) {
            changePage(1);
        }
    });

    function changePage(newPage) {
        if (newPage === 1) {
            pageDownButton.attr('disabled', true);
        } else {
            pageDownButton.attr('disabled', false);
        }

        page.html(newPage);
        getPayments();
    }

    pageUpButton.click(function () {
        changePage(parseInt(page.html()) + 1);
    });

    pageDownButton.click(function () {
        changePage(parseInt(page.html()) - 1);
    });

    pageSizeSelector.change(function () {
        changePage(1);
    });

    FilterButton.click(function () {
        changePage(1);
    });

    ClearFilterButton.click(function () {
        keywordFilter.val('');
        typeIdFilter.val('').trigger('change');
        statusIdFilter.val('').trigger('change');
        dateFilter.val('');
        amountFilter.val('');
        changePage(1);
    });

    CreatePaymentButton.click(function () {
        var employeeId = createPaymentEmployeeId.val();
        var typeId = createPaymentTypeId.val();
        var statusId = createPaymentStatusId.val();
        var date = $('#create_payment_date').val();
        var amount = $('#create_payment_amount').val();
        var description = $('#create_payment_description').val();

        if (!employeeId) {
            toastr.warning('Personel Seçimi Zorunludur!');
        } else if (!typeId) {
            toastr.warning('Ödeme Türü Seçimi Zorunludur!');
        } else if (!statusId) {
            toastr.warning('Ödeme Durumu Seçimi Zorunludur!');
        } else if (!date) {
            toastr.warning('Ödeme Tarihi Seçimi Zorunludur!');
        } else if (!amount) {
            toastr.warning('İstenilen Miktar Zorunludur!');
        } else {
            CreatePaymentButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.payment.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    employeeId: employeeId,
                    typeId: typeId,
                    statusId: statusId,
                    date: date,
                    amount: amount,
                    description: description,
                },
                success: function () {
                    toastr.success('Ödeme Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#CreatePaymentModal').modal('hide');
                    CreatePaymentButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Ödeme Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreatePaymentButton.attr('disabled', false).html(`Oluştur`);
                }
            });
        }
    });

    UpdatePaymentButton.click(function () {
        var id = $('#update_payment_id').val();
        var employeeId = updatePaymentEmployeeId.val();
        var typeId = updatePaymentTypeId.val();
        var statusId = updatePaymentStatusId.val();
        var date = $('#update_payment_date').val();
        var amount = $('#update_payment_amount').val();
        var description = $('#update_payment_description').val();

        if (!typeId) {
            toastr.warning('Ödeme Türü Seçimi Zorunludur!');
        } else if (!statusId) {
            toastr.warning('Ödeme Durumu Seçimi Zorunludur!');
        } else if (!date) {
            toastr.warning('Ödeme Tarihi Seçimi Zorunludur!');
        } else if (!amount) {
            toastr.warning('İstenilen Miktar Zorunludur!');
        } else {
            UpdatePaymentButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.payment.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    employeeId: employeeId,
                    typeId: typeId,
                    statusId: statusId,
                    date: date,
                    amount: amount,
                    description: description,
                },
                success: function () {
                    toastr.success('Ödeme Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#UpdatePaymentModal').modal('hide');
                    UpdatePaymentButton.attr('disabled', false).html(`Güncelle`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Ödeme Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdatePaymentButton.attr('disabled', false).html(`Güncelle`);
                }
            });
        }
    });

    DeletePaymentButton.click(function () {
        var id = $('#delete_payment_id').val();
        DeletePaymentButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.payment.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Ödeme Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#DeletePaymentModal').modal('hide');
                DeletePaymentButton.attr('disabled', false).html(`Sil`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ödeme Silinirken Serviste Bir Sorun Oluştu!');
                DeletePaymentButton.attr('disabled', false).html(`Sil`);
            }
        });
    });

</script>
