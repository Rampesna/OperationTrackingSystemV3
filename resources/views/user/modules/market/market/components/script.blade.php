<script>

    var updatePermission = `{{ checkUserPermission(95, $userPermissions) ? 'true' : 'false' }}`;
    var setPaymentPermission = `{{ checkUserPermission(96, $userPermissions) ? 'true' : 'false' }}`;
    var deletePermission = `{{ checkUserPermission(97, $userPermissions) ? 'true' : 'false' }}`;

    $(document).ready(function () {
        $('#loader').hide();
    });

    var markets = $('#markets');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');
    var typeIdFilter = $('#typeId');
    var statusIdFilter = $('#statusId');
    var startDateFilter = $('#startDate');
    var endDateFilter = $('#endDate');

    var CreateMarketButton = $('#CreateMarketButton');
    var UpdateMarketButton = $('#UpdateMarketButton');
    var CreateMarketPaymentButton = $('#CreateMarketPaymentButton');
    var DeleteMarketButton = $('#DeleteMarketButton');

    function createMarket() {
        $('#create_market_code').val('');
        $('#create_market_name').val('');
        $('#create_market_password').val('');
        $('#CreateMarketModal').modal('show');
    }

    function updateMarket(id) {
        $('#loader').show();
        $('#update_market_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.market.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#update_market_code').val(response.response.code);
                $('#update_market_name').val(response.response.name);
                $('#UpdateMarketModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Market Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function createMarketPayment(marketId) {
        $('#create_market_payment_market_id').val(marketId);
        $('#create_market_payment_amount').val('');
        $('#CreateMarketPaymentModal').modal('show');
    }

    function deleteMarket(id) {
        $('#delete_market_id').val(id);
        $('#DeleteMarketModal').modal('show');
    }

    function getMarkets() {
        markets.html(`<tr><td colspan="4" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.market.index') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
            },
            success: function (response) {
                markets.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.markets, function (i, market) {
                    markets.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${market.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${market.id}_Dropdown" style="width: 175px">
                                    ${updatePermission === 'true' ? `
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateMarket(${market.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    ` : ``}
                                    ${setPaymentPermission === 'true' ? `
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="createMarketPayment(${market.id})" title="Ödeme Yap"><i class="fas fa-credit-card me-2 text-info"></i> <span class="text-dark">Ödeme Yap</span></a>
                                    ` : ``}
                                    ${deletePermission === 'true' ? `
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteMarket(${market.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                    ` : ``}
                                </div>
                            </div>
                        </td>
                        <td>
                            ${market.code ?? ''}
                        </td>
                        <td>
                            ${market.name ?? ''}
                        </td>
                        <td>
                            ${reformatNumberToMoney(market.balance)} ₺
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
                toastr.error('Marketler Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getMarkets();

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
        getMarkets();
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
        changePage(1);
    });

    CreateMarketButton.click(function () {
        var code = $('#create_market_code').val();
        var name = $('#create_market_name').val();
        var password = $('#create_market_password').val();

        if (!code) {
            toastr.warning('Market Kodu Boş Olamaz!');
        } else if (!name) {
            toastr.warning('Market Adı Boş Olamaz!');
        } else if (!password) {
            toastr.warning('OTS Giriş Şifresi Boş Olamaz!');
        } else {
            CreateMarketButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.market.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    code: code,
                    name: name,
                    password: password,
                },
                success: function () {
                    toastr.success('Market Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#CreateMarketModal').modal('hide');
                    CreateMarketButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İzin Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateMarketButton.attr('disabled', false).html(`Oluştur`);
                }
            });
        }
    });

    UpdateMarketButton.click(function () {
        var id = $('#update_market_id').val();
        var code = $('#update_market_code').val();
        var name = $('#update_market_name').val();

        if (!code) {
            toastr.warning('Market Kodu Boş Olamaz!');
        } else if (!name) {
            toastr.warning('Market Adı Boş Olamaz!');
        } else {
            UpdateMarketButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.market.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    code: code,
                    name: name,
                },
                success: function () {
                    toastr.success('Market Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#UpdateMarketModal').modal('hide');
                    UpdateMarketButton.attr('disabled', false).html(`Güncelle`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Market Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdateMarketButton.attr('disabled', false).html(`Güncelle`);
                }
            });
        }
    });

    CreateMarketPaymentButton.click(function () {
        var marketId = $('#create_market_payment_market_id').val();
        var amount = $('#create_market_payment_amount').val();
        var direction = 0;
        var completed = 1;

        if (!amount) {
            toastr.warning('Ödenecek Tutar Boş Olamaz!');
        } else {
            CreateMarketPaymentButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.marketPayment.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    marketId: marketId,
                    amount: amount,
                    direction: direction,
                    completed: completed,
                },
                success: function () {
                    toastr.success('Ödeme Başarıyla Yapıldı!');
                    changePage(parseInt(page.html()));
                    $('#CreateMarketPaymentModal').modal('hide');
                    CreateMarketPaymentButton.attr('disabled', false).html(`Ödeme Yap`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Ödeme Yapılırken Serviste Bir Sorun Oluştu!');
                    CreateMarketPaymentButton.attr('disabled', false).html(`Ödeme Yap`);
                }
            });
        }
    });

    DeleteMarketButton.click(function () {
        var id = $('#delete_market_id').val();
        DeleteMarketButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.market.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Market Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#DeleteMarketModal').modal('hide');
                DeleteMarketButton.attr('disabled', false).html(`Sil`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Market Silinirken Serviste Bir Sorun Oluştu!');
                DeleteMarketButton.attr('disabled', false).html(`Sil`);
            }
        });
    });

</script>
