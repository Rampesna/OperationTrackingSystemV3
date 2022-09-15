<script src="{{ asset('assets/jqwidgets/jqxcore.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxbuttons.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxscrollbar.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxlistbox.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdropdownlist.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxmenu.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.selection.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.columnsreorder.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.columnsresize.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.filter.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.sort.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdata.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.pager.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxnumberinput.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxwindow.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdata.export.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.export.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxexport.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.grouping.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/globalization/globalize.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqgrid-localization.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jszip.min.js') }}"></script>

<script>

    var FilterButton = $('#FilterButton');
    var TransactionsButton = $('#TransactionsButton');
    var AddSellerButton = $('#AddSellerButton');
    var CreateSellerButton = $('#CreateSellerButton');
    var DeleteFilteredSellersButton = $('#DeleteFilteredSellersButton');

    var surveyCodeFilterer = $('#survey_code_filterer');
    var sellerCodeFilterer = $('#seller_code_filterer');
    var productCodeFilterer = $('#product_code_filterer');

    var createSellerSurveyCodes = $('#create_seller_survey_codes');
    var createSellerProductCodes = $('#create_seller_product_codes');

    var createSellerCodeInput = $('#create_seller_code');

    var createSellersRow = $('#createSellersRow');

    var sellersDiv = $('#sellers');

    function getSurveys() {
        surveyCodeFilterer.attr('disabled', true);
        $('#survey_code_filterer_input_group').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                surveyCodeFilterer.empty();
                createSellerSurveyCodes.empty();
                $.each(response.response, function (i, survey) {
                    surveyCodeFilterer.append(`<option value="${survey.kodu}">${survey.kodu} - ${survey.adi}</option>`);
                    createSellerSurveyCodes.append(`<option value="${survey.kodu}">${survey.kodu} - ${survey.adi}</option>`);
                });
                surveyCodeFilterer.attr('disabled', false);
                $('#survey_code_filterer_input_group').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Script Listesi Alınırken Serviste Bir Hata Oluştu');
            }
        });
    }

    function getSellers() {
        $('#loader').show();
        sellerCodeFilterer.attr('disabled', true);
        $('#seller_code_filterer_input_group').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveySellerList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                sellerCodeFilterer.empty();
                $.each(groupBy(response.response, 'saticiKodu'), function (i, seller) {
                    sellerCodeFilterer.append(`<option value="${seller[0].saticiKodu}">${seller[0].saticiAdi}</option>`);
                });
                sellerCodeFilterer.attr('disabled', false);
                $('#seller_code_filterer_input_group').hide();

                var source = {
                    localdata: response.response,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'id'},
                            {name: 'saticiKodu'},
                            {name: 'saticiAdi'},
                            {name: 'grupKodu'},
                            {name: 'adi'},
                            {name: 'urunKodu'},
                            {name: 'durum'},
                            {name: 'atamaSayisi'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                sellersDiv.jqxGrid({
                    width: '100%',
                    height: '600',
                    source: dataAdapter,
                    columnsresize: true,
                    groupable: true,
                    theme: jqxGridGlobalTheme,
                    filterable: true,
                    showfilterrow: true,
                    pageable: false,
                    sortable: true,
                    pagesizeoptions: ['10', '20', '50', '1000'],
                    localization: getLocalization('tr'),
                    columns: [
                        {
                            text: '#',
                            dataField: 'id',
                            columntype: 'textbox',
                            width: '5%',
                        },
                        {
                            text: 'Satıcı Kodu',
                            dataField: 'saticiKodu',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Satıcı Adı',
                            dataField: 'saticiAdi',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Script Kodu',
                            dataField: 'grupKodu',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Script Adı',
                            dataField: 'adi',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Ürün Kodu',
                            dataField: 'urunKodu',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Durum',
                            dataField: 'durum',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Atama Sayısı',
                            dataField: 'atamaSayisi',
                            columntype: 'textbox',
                        }
                    ],
                });
                sellersDiv.on('rowclick', function (event) {
                    sellersDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = sellersDiv.jqxGrid('getselectedrowindex');
                    $('#selected_row_index').val(rowindex);
                    var dataRecord = sellersDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_row_id').val(dataRecord ? dataRecord.id : null);
                    return false;
                });

                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Satıcı Listesi Alınırken Serviste Bir Hata Oluştu');
            }
        });
    }

    function getProducts() {
        productCodeFilterer.attr('disabled', true);
        $('#product_code_filterer_input_group').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyProductList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                productCodeFilterer.empty();
                createSellerProductCodes.empty();
                $.each(response.response, function (i, product) {
                    productCodeFilterer.append(`<option value="${product.kodu}">${product.adi}</option>`);
                    createSellerProductCodes.append(`<option value="${product.kodu}">${product.adi}</option>`);
                });
                productCodeFilterer.attr('disabled', false);
                $('#product_code_filterer_input_group').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ürün Listesi Alınırken Serviste Bir Hata Oluştu');
            }
        });
    }

    function transactions() {
        $('#TransactionsModal').modal('show');
    }

    function createSeller() {
        $('#TransactionsModal').modal('hide');
        createSellerSurveyCodes.val([]);
        createSellerProductCodes.val([]);
        createSellersRow.empty();
        $('#CreateSellerModal').modal('show');
    }

    function deleteFilteredSellers() {
        $('#TransactionsModal').modal('hide');
        $('#deletingSellerCount').html(sellersDiv.jqxGrid('getrows').length);
        $('#DeleteFilteredSellersModal').modal('show');
    }

    getSurveys();
    getSellers();
    getProducts();

    FilterButton.click(function () {
        sellersDiv.jqxGrid('clearfilters');
        var filtertype = 'stringfilter';
        var filtergroup = new $.jqx.filter();
        var filter_or_operator = 1;
        var filtercondition = 'equal';

        if (surveyCodeFilterer.val().length > 0) {
            $.each(surveyCodeFilterer.val(), function (i, code) {
                filtergroup.addfilter(filter_or_operator, filtergroup.createfilter(filtertype, code, filtercondition));
                sellersDiv.jqxGrid('addfilter', 'grupKodu', filtergroup);
            });
        }
        if (sellerCodeFilterer.val().length > 0) {
            $.each(sellerCodeFilterer.val(), function (i, code) {
                filtergroup.addfilter(filter_or_operator, filtergroup.createfilter(filtertype, code, filtercondition));
                sellersDiv.jqxGrid('addfilter', 'saticiKodu', filtergroup);
            });
        }
        if (productCodeFilterer.val().length > 0) {
            $.each(productCodeFilterer.val(), function (i, code) {
                filtergroup.addfilter(filter_or_operator, filtergroup.createfilter(filtertype, code, filtercondition));
                sellersDiv.jqxGrid('addfilter', 'urunKodu', filtergroup);
            });
        }

        sellersDiv.jqxGrid('applyfilters');
    });

    TransactionsButton.click(function () {
        transactions();
    });

    createSellerCodeInput.on('keypress', function (e) {
        if (e.which === 13) {
            AddSellerButton.click();
        }
    });

    AddSellerButton.click(function () {
        var code = createSellerCodeInput.val();
        if (!code) {
            toastr.warning('Satıcı Kodu Boş Olamaz');
        } else {
            createSellersRow.append(`
            <div class="col-xl-12 mb-5">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm form-control-solid newSeller" value="${code}" aria-label="Yeni Satıcı" disabled>
                    <button class="btn btn-danger btn-sm btn-icon newSellerDeleterButton">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
            `);
            createSellerCodeInput.val('');
        }
    });

    $(document).delegate('.newSellerDeleterButton', 'click', function () {
        $(this).parent().parent().remove();
    });

    CreateSellerButton.click(function () {
        var sellers = [];
        var surveys = [];
        var products = [];
        var sellerCodes = $('.newSeller');
        var surveyCodes = createSellerSurveyCodes.val();
        var productCodes = createSellerProductCodes.val();
        if (sellerCodes.length === 0) {
            toastr.warning('Hiç Satıcı Eklenmedi!');
        } else if (surveyCodes.length === 0) {
            toastr.warning('Hiç Script Seçilmedi!');
        } else if (productCodes.length === 0) {
            toastr.warning('Hiç Ürün Seçilmedi!');
        } else {
            $.each(sellerCodes, function (x, sellerCode) {
                sellers.push({
                    saticiAdi: $(sellerCode).val(),
                });
            });

            $.each(surveyCodes, function (x, surveyCode) {
                surveys.push({
                    kodu: surveyCode,
                });
            });

            $.each(productCodes, function (x, productCode) {
                products.push({
                    kodu: productCode,
                });
            });

            $('#loader').show();

            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveySellerConnect') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    sellers: sellers,
                    surveys: surveys,
                    products: products,
                },
                success: function () {
                    getSellers();
                    $('#CreateSellerModal').modal('hide');
                    toastr.success('Satıcılar Başarıyla Eklendi');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Satıcılar Eklenirken Serviste Bir Hata Oluştu');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteFilteredSellersButton.click(function () {
        $('#DeleteFilteredSellersModal').modal('hide');
        var sellerIds = $.map(sellersDiv.jqxGrid('getrows'), function (seller) {
            return parseInt(seller.id);
        });

        if (sellerIds.length > 0) {
            toastr.info('Satıcı Silme İşlemi Başlatılıyor...');
            setTimeout(function () {
                $.each(sellerIds, function (i, sellerId) {
                    $.ajax({
                        async: false,
                        type: 'post',
                        url: '{{ route('user.api.operationApi.surveySystem.setSurveySellerDelete') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            sellerId: sellerId,
                        },
                        error: function (error) {
                            console.log(error);
                            console.log(`${sellerId} ID\'li Satıcı Silinirken Serviste Bir Hata Oluştu`);
                            toastr.error(`${sellerId} ID\'li Satıcı Silinirken Serviste Bir Hata Oluştu`);
                        }
                    });
                });
            }, 500);
            getSellers();
            toastr.success('Satıcıları Silme İşlemi Tamamlandı.');
        } else {
            toastr.warning('Listede Hiç Satıcı Yok!');
        }
    });

</script>
