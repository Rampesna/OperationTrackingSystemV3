<script>

    var updatePurchaserPermission = `{{ checkUserPermission(101, $userPermissions) ? 'true' : 'false' }}`;
    var acceptPurchasePermission = `{{ checkUserPermission(102, $userPermissions) ? 'true' : 'false' }}`;
    var deletePurchasePermission = `{{ checkUserPermission(103, $userPermissions) ? 'true' : 'false' }}`;

    $(document).ready(function () {
        $('#loader').hide();
    });

    var purchases = $('#purchases');
    var createPurchaseItemsRow = $('#createPurchaseItemsRow');
    var updatePurchaseItemsRow = $('#updatePurchaseItemsRow');
    var purchaseItemsRow = $('#purchaseItemsRow');
    var sendForAcceptPurchaseItemsRow = $('#sendForAcceptPurchaseItemsRow');
    var acceptPurchaseItemsRow = $('#acceptPurchaseItemsRow');

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
    var AddNewPurchaseItemForUpdateButton = $('#AddNewPurchaseItemForUpdateButton');
    var UpdatePurchaserButton = $('#UpdatePurchaserButton');
    var SendForAcceptButton = $('#SendForAcceptButton');
    var AcceptButton = $('#AcceptButton');
    var DeletePurchaseButton = $('#DeletePurchaseButton');

    var updatePurchaseStatusId = $('#update_purchase_status_id');

    var createPurchaseItemNameInput = $('#create_purchase_item_name_input');
    var createPurchaseItemRequestedQuantityInput = $('#create_purchase_item_requested_quantity_input');

    var updatePurchaseItemNameInput = $('#update_purchase_item_name_input');
    var updatePurchaseItemRequestedQuantityInput = $('#update_purchase_item_requested_quantity_input');

    var updatePurchaserUserId = $('#update_purchaser_user_id');

    function createPurchase() {
        $('#create_purchase_name').val('');
        $('#create_purchase_delivery_date').val('');
        createPurchaseItemNameInput.val('');
        createPurchaseItemRequestedQuantityInput.val('');
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
            success: function (response) {
                $('#update_purchase_name').val(response.response.name);
                $('#update_purchase_delivery_date').val(response.response.delivery_date);
                $('#update_purchase_status_id').val(response.response.status_id);
                updatePurchaseItemNameInput.val('');
                updatePurchaseItemRequestedQuantityInput.val('');
                updatePurchaseItemsRow.empty();
                $.ajax({
                    type: 'get',
                    url: '{{ route('user.api.purchaseItem.getByPurchaseId') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        purchaseId: response.response.id,
                    },
                    success: function (response) {
                        $.each(response.response, function (i, purchaseItem) {
                            updatePurchaseItemsRow.append(`
                            <div class="row mb-5 updatePurchaseItemRow">
                                <div class="col-xl-8 mt-3">
                                    <input type="text" class="form-control form-control-solid updatePurchaseItemName" placeholder="Ürün Adı" aria-label="Ürün Adı" value="${purchaseItem.name}">
                                </div>
                                <div class="col-xl-3 mt-3">
                                    <input type="number" class="form-control form-control-solid decimal updatePurchaseItemRequestedQuantity" placeholder="Adet" aria-label="Adet" value="${purchaseItem.requested_quantity}">
                                </div>
                                <div class="col-xl-1 d-grid">
                                    <button class="btn btn-icon btn-danger mt-3 removePurchaseItemForUpdateButton">x</button>
                                </div>
                            </div>
                            `);
                        });
                        $('#UpdatePurchaseModal').modal('show');
                        $('#loader').hide();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Satın Alım Talebine Ait Ürünler Alınırken Serviste Bir Sorun Oluştu!');
                        $('#loader').hide();
                    }
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Talep Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function updatePurchaser(id) {
        $('#update_purchaser_purchase_id').val(id);
        updatePurchaserUserId.val('').trigger('change');
        $('#UpdatePurchaserModal').modal('show');
    }

    function sendForAccept(id) {
        $('#send_for_accept_purchase_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.purchaseItem.getByPurchaseId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                purchaseId: id,
            },
            success: function (response) {
                sendForAcceptPurchaseItemsRow.empty();
                $.each(response.response, function (i, purchaseItem) {
                    sendForAcceptPurchaseItemsRow.append(`
                    <div class="row mb-5">
                        <div class="col-xl-8 mt-3">
                            <input type="text" class="form-control form-control-solid" aria-label="Ürün Adı" value="${purchaseItem.name}" readonly>
                        </div>
                        <div class="col-xl-2 mt-3">
                            <input type="text" class="form-control form-control-solid" aria-label="İstenilen Adet" value="${purchaseItem.requested_quantity}" readonly>
                        </div>
                        <div class="col-xl-2 mt-3">
                            <input type="text" class="form-control form-control-solid sendForAcceptPurchaseItemPurchasedQuantityInput" aria-label="Alınan Adet" data-id="${purchaseItem.id}">
                        </div>
                    </div>
                    `);
                });
                $('#SendForAcceptModal').modal('show');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Satın Alım Talebine Ait Ürünler Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function accept(id) {
        $('#accept_purchase_id').val(id);
        $('#loader').show();
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
            success: function (response) {
                $('#accept_receipt_number').val(response.response.receipt_number);
                $('#accept_price').val(`${reformatNumberToMoney(response.response.price)} ₺`);
                $.ajax({
                    type: 'get',
                    url: '{{ route('user.api.purchaseItem.getByPurchaseId') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        purchaseId: id,
                    },
                    success: function (response) {
                        acceptPurchaseItemsRow.empty();
                        $.each(response.response, function (i, purchaseItem) {
                            acceptPurchaseItemsRow.append(`
                            <div class="row mb-5">
                                <div class="col-xl-8 mt-3">
                                    <input type="text" class="form-control form-control-solid" aria-label="Ürün Adı" value="${purchaseItem.name}" readonly>
                                </div>
                                <div class="col-xl-2 mt-3">
                                    <input type="text" class="form-control form-control-solid" aria-label="İstenilen Adet" value="${purchaseItem.requested_quantity}" readonly>
                                </div>
                                <div class="col-xl-2 mt-3">
                                    <input type="text" class="form-control form-control-solid" aria-label="Alınan Adet" value="${purchaseItem.purchased_quantity}" readonly>
                                </div>
                            </div>
                            `);
                        });
                        $('#AcceptModal').modal('show');
                        $('#loader').hide();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Satın Alım Talebine Ait Ürünler Alınırken Serviste Bir Sorun Oluştu!');
                        $('#loader').hide();
                    }
                });
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

    function getUsers() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.user.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                updatePurchaserUserId.empty();
                $.each(response.response, function (i, user) {
                    updatePurchaserUserId.append(`
                        <option value="${user.id}">${user.name}</option>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kullanıcılar Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
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
        var url = `{{ checkUserPermission(100, $userPermissions) ? route('user.api.purchase.getAllPaginate') : route('user.api.purchase.getByUserId') }}`;

        $.ajax({
            type: 'get',
            url: url,
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
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="getPurchaseItems(${purchase.id})" title="Ürün Listesi"><i class="fas fa-clipboard-list me-2 text-dark"></i> <span class="text-dark">Ürün Listesi</span></a>
                                    ${parseInt(purchase.status_id) === 1 ? `
                                        <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updatePurchase(${purchase.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                        ${updatePurchaserPermission === 'true' ? `<a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updatePurchaser(${purchase.id})" title="Satın Alıcıyı Seç"><i class="fas fa-user me-2 text-info"></i> <span class="text-dark">Satın Alıcıyı Seç</span></a>` : ``}
                                    ` : `
                                    ${parseInt(purchase.status_id) === 2 && parseInt(purchase.purchaser_id) === masterAuthId ? `
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="sendForAccept(${purchase.id})" title="Onaya Gönder"><i class="fa fa-check-circle me-2 text-success"></i> <span class="text-dark">Onaya Gönder</span></a>
                                    ` : `
                                    ${parseInt(purchase.status_id) === 3 ? `
                                    ${acceptPurchasePermission === 'true' ? `<a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="accept(${purchase.id})" title="Onayla"><i class="fa fa-check-circle me-2 text-success"></i> <span class="text-dark">Onayla</span></a>` : ``}
                                    ` : ``}
                                    `}
                                    `}
                                    ${parseInt(purchase.user_id) === masterAuthId ? `
                                    <hr class="text-muted">
                                    ${deletePurchasePermission === 'true' ? `<a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deletePurchase(${purchase.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>` : ``}
                                    ` : ``}
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

    function getPurchaseItems(id) {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.purchaseItem.getByPurchaseId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                purchaseId: id,
            },
            success: function (response) {
                purchaseItemsRow.empty();
                $.each(response.response, function (i, purchaseItem) {
                    purchaseItemsRow.append(`
                    <div class="row mb-5">
                        <div class="col-xl-8 mt-3">
                            <input type="text" class="form-control form-control-solid" aria-label="Ürün Adı" value="${purchaseItem.name}" readonly>
                        </div>
                        <div class="col-xl-2 mt-3">
                            <input type="text" class="form-control form-control-solid" aria-label="İstenilen Adet" value="${purchaseItem.requested_quantity}" readonly>
                        </div>
                        <div class="col-xl-2 mt-3">
                            <input type="text" class="form-control form-control-solid" aria-label="Alınan Adet" value="${purchaseItem.purchased_quantity ?? ''}" readonly>
                        </div>
                    </div>
                    `);
                });
                $('#PurchaseItemsModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Talep Ürünleri Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getUsers();
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

    createPurchaseItemNameInput.on('keypress', function (e) {
        if (e.which === 13) {
            AddNewPurchaseItemForCreateButton.click();
            createPurchaseItemNameInput.focus();
        }
    });

    createPurchaseItemRequestedQuantityInput.on('keypress', function (e) {
        if (e.which === 13) {
            AddNewPurchaseItemForCreateButton.click();
            createPurchaseItemNameInput.focus();
        }
    });

    updatePurchaseItemNameInput.on('keypress', function (e) {
        if (e.which === 13) {
            AddNewPurchaseItemForUpdateButton.click();
            updatePurchaseItemNameInput.focus();
        }
    });

    updatePurchaseItemRequestedQuantityInput.on('keypress', function (e) {
        if (e.which === 13) {
            AddNewPurchaseItemForUpdateButton.click();
            updatePurchaseItemNameInput.focus();
        }
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

    AddNewPurchaseItemForUpdateButton.click(function () {
        var name = updatePurchaseItemNameInput.val();
        var requestedQuantity = updatePurchaseItemRequestedQuantityInput.val();

        if (!name) {
            toastr.warning('Ürün Adı Boş Olamaz!');
        } else if (!requestedQuantity) {
            toastr.warning('Talep Edilen Miktar Boş Olamaz!');
        } else {
            updatePurchaseItemsRow.append(`
            <div class="row mb-5 updatePurchaseItemRow">
                <div class="col-xl-8 mt-3">
                    <input type="text" class="form-control form-control-solid updatePurchaseItemName" placeholder="Yeni Ürün Adı" aria-label="Yeni Ürün Adı" value="${name}">
                </div>
                <div class="col-xl-3 mt-3">
                    <input type="number" class="form-control form-control-solid decimal updatePurchaseItemRequestedQuantity" placeholder="Adet" aria-label="Adet" value="${requestedQuantity}">
                </div>
                <div class="col-xl-1 d-grid">
                    <button class="btn btn-icon btn-danger mt-3 removePurchaseItemForUpdateButton">x</button>
                </div>
            </div>
            `);
            updatePurchaseItemNameInput.val('');
            updatePurchaseItemRequestedQuantityInput.val('');
        }
    });

    $(document).delegate('.removeNewPurchaseItemForCreateButton', 'click', function () {
        $(this).closest('.newPurchaseItemRow').remove();
    });

    $(document).delegate('.removePurchaseItemForUpdateButton', 'click', function () {
        $(this).closest('.updatePurchaseItemRow').remove();
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
                    if (items.length > 0) {
                        $.ajax({
                            type: 'post',
                            url: '{{ route('user.api.purchaseItem.setByPurchaseId') }}',
                            headers: {
                                'Accept': 'application/json',
                                'Authorization': token
                            },
                            data: {
                                purchaseId: response.response.id,
                                items: items
                            },
                            success: function () {
                                toastr.success('Talep Ürünleri Başarıyla Oluşturuldu!');
                                $('#CreatePurchaseModal').modal('hide');
                                CreatePurchaseButton.attr('disabled', false).html(`Oluştur`);
                            },
                            error: function (error) {
                                console.log(error);
                                toastr.error('Talep Ürünleri Oluşturulurken Serviste Bir Sorun Oluştu.');
                                CreatePurchaseButton.attr('disabled', false).html(`Oluştur`);
                            }
                        });
                    } else {
                        $('#CreatePurchaseModal').modal('hide');
                        CreatePurchaseButton.attr('disabled', false).html(`Oluştur`);
                    }
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
        var name = $('#update_purchase_name').val();
        var deliveryDate = $('#update_purchase_delivery_date').val();
        var statusId = $('#update_purchase_status_id').val();

        var items = [];
        var updatePurchaseItems = $('.updatePurchaseItemRow');
        var control = 1;
        $.each(updatePurchaseItems, function (i, updatePurchaseItem) {
            var name = $(updatePurchaseItem).find('.updatePurchaseItemName').val();
            var requestedQuantity = $(updatePurchaseItem).find('.updatePurchaseItemRequestedQuantity').val();
            if (!name) {
                toastr.warning('Ürün Adı Boş Alanlar Var!');
                control = 0;
                return false;
            } else if (!requestedQuantity) {
                toastr.warning('Ürün Adedi Alanlar Var!');
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
                    name: name,
                    deliveryDate: deliveryDate,
                    statusId: statusId
                },
                success: function (response) {
                    toastr.success('Talep Başarıyla Güncellendi!');
                    changePage(1);
                    if (items.length > 0) {
                        $.ajax({
                            type: 'post',
                            url: '{{ route('user.api.purchaseItem.setByPurchaseId') }}',
                            headers: {
                                'Accept': 'application/json',
                                'Authorization': token
                            },
                            data: {
                                purchaseId: response.response.id,
                                items: items
                            },
                            success: function () {
                                toastr.success('Talep Ürünleri Başarıyla Güncellendi!');
                                $('#UpdatePurchaseModal').modal('hide');
                                UpdatePurchaseButton.attr('disabled', false).html(`Oluştur`);
                            },
                            error: function (error) {
                                console.log(error);
                                toastr.error('Talep Ürünleri Güncellenirken Serviste Bir Sorun Oluştu.');
                                UpdatePurchaseButton.attr('disabled', false).html(`Oluştur`);
                            }
                        });
                    } else {
                        $('#UpdatePurchaseModal').modal('hide');
                        UpdatePurchaseButton.attr('disabled', false).html(`Oluştur`);
                    }
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Talep Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdatePurchaseButton.attr('disabled', false).html(`Oluştur`);
                }
            });
        }
    });

    UpdatePurchaserButton.click(function () {
        var id = $('#update_purchaser_purchase_id').val();
        var purchaserId = updatePurchaserUserId.val();

        if (!purchaserId) {
            toastr.warning('Satın Alacak Kişiyi Seçmediniz!');
        } else {
            UpdatePurchaserButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.purchase.updatePurchaser') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    purchaserId: purchaserId
                },
                success: function () {
                    toastr.success('Satın Alacak Kişi Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#UpdatePurchaserModal').modal('hide');
                    UpdatePurchaserButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Satın Alacak Kişi Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdatePurchaserButton.attr('disabled', false).html(`Güncelle`);
                }
            });
        }
    });

    SendForAcceptButton.click(function () {
        var id = $('#send_for_accept_purchase_id').val();
        var receiptNumber = $('#send_for_accept_receipt_number').val();
        var price = $('#send_for_accept_price').val();
        var purchaseItemInputs = $('.sendForAcceptPurchaseItemPurchasedQuantityInput');
        var purchasedItems = [];
        var control = 1;
        $.each(purchaseItemInputs, function (i, purchaseItemInput) {
            var purchaseItemId = $(purchaseItemInput).attr('data-id');
            var purchasedQuantity = $(purchaseItemInput).val();
            if (!purchasedQuantity) {
                toastr.warning('Ürün Adedi Alanları Boş Olamaz!');
                control = 0;
                return false;
            } else {
                purchasedItems.push({
                    id: purchaseItemId,
                    purchasedQuantity: purchasedQuantity
                });
            }
        });
        if (control === 1) {
            if (!receiptNumber) {
                toastr.warning('Fatura/Fiş Numarası Boş Olamaz!');
            } else if (!price) {
                toastr.warning('Fatura Tutarı Boş Olamaz!');
            } else {
                SendForAcceptButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
                $.ajax({
                    type: 'put',
                    url: '{{ route('user.api.purchase.sendForAccept') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        id: id,
                        receiptNumber: receiptNumber,
                        price: price,
                    },
                    success: function () {
                        $.ajax({
                            type: 'post',
                            url: '{{ route('user.api.purchaseItem.setPurchasedQuantities') }}',
                            headers: {
                                'Accept': 'application/json',
                                'Authorization': token
                            },
                            data: {
                                purchasedItems: purchasedItems,
                            },
                            success: function () {
                                toastr.success('Talep Başarıyla Onaya Gönderildi.');
                                changePage(parseInt(page.html()));
                                $('#SendForAcceptModal').modal('hide');
                                SendForAcceptButton.attr('disabled', false).html(`Onaya Gönder`);
                            },
                            error: function (error) {
                                console.log(error);
                                toastr.error('Talebe Ait Ürünlerin Alınan Adetleri Güncellenirken Serviste Bir Sorun Oluştu!');
                                SendForAcceptButton.attr('disabled', false).html(`Onaya Gönder`);
                            }
                        });
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Talep Onaya Gönderilirken Serviste Bir Sorun Oluştu!');
                        SendForAcceptButton.attr('disabled', false).html(`Onaya Gönder`);
                    }
                });
            }
        }
    });

    AcceptButton.click(function () {
        var id = $('#accept_purchase_id').val();
        AcceptButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'put',
            url: '{{ route('user.api.purchase.accept') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Talep Başarıyla Onaylandı.');
                changePage(parseInt(page.html()));
                $('#AcceptModal').modal('hide');
                AcceptButton.attr('disabled', false).html(`Onayla`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Talep Kabul Edilirken Serviste Bir Sorun Oluştu!');
                AcceptButton.attr('disabled', false).html(`Onayla`);
            }
        });
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
