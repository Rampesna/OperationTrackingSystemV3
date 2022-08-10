<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var purchases = $('#purchases');
    var createPurchaseItemsRow = $('#createPurchaseItemsRow');
    var updatePurchaseItemsRow = $('#updatePurchaseItemsRow');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');
    var statusIdFilter = $('#statusId');

    var CreatePurchaseButton = $('#CreatePurchaseButton');
    var AddNewPurchaseItemForCreateButton = $('#AddNewPurchaseItemForCreateButton');
    var UpdatePurchaseButton = $('#UpdatePurchaseButton');
    var DeletePurchaseButton = $('#DeletePurchaseButton');

    var updatePurchaseStatusId = $('#update_purchase_status_id');

    var createPurchaseItemNameInput = $('#create_purchase_item_name_input');
    var createPurchaseItemRequestedQuantityInput = $('#create_purchase_item_requested_quantity_input');

    function createPurchase() {
        createPurchaseItemsRow.empty();
        $('#CreatePurchaseModal').modal('show');
    }

    function updatePurchase(id) {
        $('#loader').show();
        $('#update_purchase_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.purchase.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                updatePurchaseItemsRow.empty();
                $('#UpdatePurchaseModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Talep Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deletePurchase(id) {
        $('#delete_purchase_id').val(id);
        $('#DeletePurchaseModal').modal('show');
    }

    function getPurchaseStatuses() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.purchaseStatus.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                statusIdFilter.empty();
                $.each(response.response, function (i, purchaseStatus) {
                    statusIdFilter.append($('<option>', {
                        value: purchaseStatus.id,
                        text: purchaseStatus.name
                    }));
                });
                statusIdFilter.val('');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Talep Türleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getPurchases() {
        purchases.html(`<tr><td colspan="6" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();
        var statusId = statusIdFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.purchase.getByUserId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
                statusId: statusId,
            },
            success: function (response) {
                purchases.empty();
                $.each(response.response.purchases, function (i, purchase) {
                    purchases.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${purchase.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${purchase.id}_Dropdown" style="width: 225px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updatePurchase(${purchase.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updatePurchasePurchaser(${purchase.id})" title="Satın Alıcıyı Seç"><i class="fas fa-user me-2 text-info"></i> <span class="text-dark">Satın Alıcıyı Seç</span></a>
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updatePurchaseItems(${purchase.id})" title="Ürün Listesi"><i class="fas fa-clipboard-list me-2 text-dark"></i> <span class="text-dark">Ürün Listesi</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deletePurchase(${purchase.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${purchase.name ?? ''}
                        </td>
                        <td>
                            ${purchase.user ? purchase.user.name : ''}
                        </td>
                        <td>
                            <span class="badge badge-${purchase.status ? purchase.status.color : 'secondary'}">${purchase.status ? purchase.status.name : ''}</span>
                        </td>
                        <td>
                            ${purchase.delivery_date ? reformatDatetimeToDateForHuman(purchase.delivery_date) : ''}
                        </td>
                        <td>
                            ${purchase.purchaser ? purchase.purchaser.name : ''}
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
                toastr.error('Talepler Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getPurchaseStatuses();
    getPurchases();

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
        getPurchases();
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
        statusIdFilter.val('').trigger('change');
        changePage(1);
    });

    AddNewPurchaseItemForCreateButton.click(function () {
        var name = createPurchaseItemNameInput.val();
        var requestedQuantity = createPurchaseItemRequestedQuantityInput.val();

        if (!name) {
            toastr.warning('Ürün Adı Boş Olamaz!');
        } else if (!requestedQuantity) {
            toastr.warning('Talep Edilen Miktar Boş Olamaz!');
        } else {
            createPurchaseItemsRow.append(`
            <div class="row mb-5 newPurchaseItemRow">
                <div class="col-xl-8 mt-3">
                    <input type="text" class="form-control form-control-solid createPurchaseItemName" placeholder="Yeni Ürün Adı" aria-label="Yeni Ürün Adı" value="${name}">
                </div>
                <div class="col-xl-3 mt-3">
                    <input type="number" class="form-control form-control-solid decimal createPurchaseItemRequestedQuantity" placeholder="Adet" aria-label="Adet" value="${requestedQuantity}">
                </div>
                <div class="col-xl-1 d-grid">
                    <button class="btn btn-icon btn-danger mt-3 removeNewPurchaseItemForCreateButton">x</button>
                </div>
            </div>
            `);
            createPurchaseItemNameInput.val('');
            createPurchaseItemRequestedQuantityInput.val('');
        }
    });

    $(document).delegate('.removeNewPurchaseItemForCreateButton', 'click', function () {
        $(this).closest('.newPurchaseItemRow').remove();
    });

    CreatePurchaseButton.click(function () {
        var name = $('#create_purchase_name').val();
        var deliveryDate = $('#create_purchase_delivery_date').val();
        var statusId = 1;

        var items = [];
        var newPurchaseItems = $('.newPurchaseItemRow');
        var control = 1;
        $.each(newPurchaseItems, function (i, newPurchaseItem) {
            var name = $(newPurchaseItem).find('.createPurchaseItemName').val();
            var requestedQuantity = $(newPurchaseItem).find('.createPurchaseItemRequestedQuantity').val();
            if (!name) {
                toastr.warning('Yeni Ürün Adı Boş Alanlar Var!');
                control = 0;
                return false;
            } else if (!requestedQuantity) {
                toastr.warning('Yeni Ürün Adedi Alanlar Var!');
                control = 0;
                return false;
            } else {
                items.push({
                    name: name,
                    requestedQuantity: requestedQuantity
                });
            }
        });

        if (control === 0) {
            console.log('Hata');
        } else if (!name) {
            toastr.warning('Talep Başlığı Boş Olamaz!');
        } else if (!deliveryDate) {
            toastr.warning('İstenilen Temin Tarihi Boş Olamaz!');
        } else if (!statusId) {
            toastr.warning('Talep Durumu Seçimi Zorunludur!');
        } else {
            CreatePurchaseButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.purchase.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    name: name,
                    deliveryDate: deliveryDate,
                    statusId: statusId
                },
                success: function (response) {
                    toastr.success('Talep Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#CreatePurchaseModal').modal('hide');
                    CreatePurchaseButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Talep Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreatePurchaseButton.attr('disabled', false).html(`Oluştur`);
                }
            });
        }
    });

    UpdatePurchaseButton.click(function () {
        var id = $('#update_purchase_id').val();
        var employeeId = updatePurchaseEmployeeId.val();
        var typeId = updatePurchaseTypeId.val();
        var statusId = updatePurchaseStatusId.val();
        var startDate = $('#update_purchase_start_date').val();
        var endDate = $('#update_purchase_end_date').val();
        var description = $('#update_purchase_description').val();

        if (!typeId) {
            toastr.warning('Talep Türü Seçimi Zorunludur!');
        } else if (!statusId) {
            toastr.warning('Talep Durumu Seçimi Zorunludur!');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçimi Zorunludur!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçimi Zorunludur!');
        } else {
            UpdatePurchaseButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.purchase.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    employeeId: employeeId,
                    typeId: typeId,
                    statusId: statusId,
                    startDate: startDate,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    toastr.success('Talep Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#UpdatePurchaseModal').modal('hide');
                    UpdatePurchaseButton.attr('disabled', false).html(`Güncelle`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Talep Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdatePurchaseButton.attr('disabled', false).html(`Güncelle`);
                }
            });
        }
    });

    DeletePurchaseButton.click(function () {
        var id = $('#delete_purchase_id').val();
        DeletePurchaseButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.purchase.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Talep Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#DeletePurchaseModal').modal('hide');
                DeletePurchaseButton.attr('disabled', false).html(`Sil`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Talep Silinirken Serviste Bir Sorun Oluştu!');
                DeletePurchaseButton.attr('disabled', false).html(`Sil`);
            }
        });
    });

</script>
