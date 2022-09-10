<script src="{{ asset('assets/jqwidgets/jqxcore.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxbuttons.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxscrollbar.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxlistbox.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdropdownlist.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxmenu.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxcheckbox.js') }}"></script>
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

    $(document).ready(function () {
        $('#loader').hide();
    });

    var sellersDiv = $('#sellers');
    var scriptsDiv = $('#scripts');
    var productsDiv = $('#products');

    var CreateBatchSellerButton = $('#CreateBatchSellerButton');

    function getSellers() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveySellerList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                var sellersList = [];
                sellers = response.response;
                $.each(sellers, function (i, seller) {
                    checkSeller = sellersList.find(x => x.saticiKodu === seller.saticiKodu);
                    if (!checkSeller) {
                        sellersList.push({
                            saticiKodu: seller.saticiKodu,
                            saticiAdi: seller.saticiAdi,
                        });
                    }
                });

                var sellersSource = {
                    localdata: sellersList,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'saticiKodu', type: 'string'},
                            {name: 'saticiAdi', type: 'string'},
                        ]
                };
                var sellersDataAdapter = new $.jqx.dataAdapter(sellersSource);
                sellersDiv.jqxGrid({
                    width: '100%',
                    height: '500',
                    source: sellersDataAdapter,
                    columnsresize: true,
                    columnsreorder: true,
                    autoloadstate: true,
                    autosavestate: true,
                    groupable: true,
                    theme: 'metro',
                    filterable: true,
                    showfilterrow: true,
                    pageable: false,
                    sortable: true,
                    selectionmode: 'checkbox',
                    altrows: true,
                    pagesizeoptions: ['10', '20', '50', '1000'],
                    localization: getLocalization('tr'),
                    columns: [
                        {
                            text: 'Satıcı Kodu',
                            dataField: 'saticiKodu',
                            columntype: 'textbox',
                            width: '25%'
                        },
                        {
                            text: 'Satıcı Adı',
                            dataField: 'saticiAdi',
                            columntype: 'textbox',
                            width: '75%'
                        }
                    ],
                });
                sellersDiv.on('contextmenu', function (e) {
                    var top = e.pageY - 10;
                    var left = e.pageX - 10;

                    $("#context-menu").css({
                        display: "block",
                        top: top,
                        left: left
                    });

                    return false;
                });
                sellersDiv.on('rowclick', function (event) {
                    if (event.args.rightclick) {
                        scriptsDiv.jqxGrid('selectrow', event.args.rowindex);
                        var rowindex = scriptsDiv.jqxGrid('getselectedrowindex');
                        $('#selected_row_index').val(rowindex);
                        var dataRecord = scriptsDiv.jqxGrid('getrowdata', rowindex);
                        $('#id_edit').val(dataRecord.id);
                        $('#deleting').html(dataRecord.adi);
                        return false;
                    } else {
                        $("#context-menu").hide();
                    }
                });
                sellersDiv.jqxGrid('sortby', 'id', 'desc');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Satıcı Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin!');
            }
        });
    }

    function getScripts() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                scripts = response.response;
                var scriptsSource = {
                    localdata: scripts,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'id', type: 'integer'},
                            {name: 'kodu', type: 'string'},
                            {name: 'adi', type: 'string'},
                        ]
                };
                var scriptsDataAdapter = new $.jqx.dataAdapter(scriptsSource);
                scriptsDiv.jqxGrid({
                    width: '100%',
                    height: '500',
                    source: scriptsDataAdapter,
                    columnsresize: true,
                    columnsreorder: true,
                    autoloadstate: true,
                    autosavestate: true,
                    groupable: true,
                    theme: 'metro',
                    filterable: true,
                    showfilterrow: true,
                    pageable: false,
                    sortable: true,
                    selectionmode: 'checkbox',
                    altrows: true,
                    pagesizeoptions: ['10', '20', '50', '1000'],
                    localization: getLocalization('tr'),
                    columns: [
                        {
                            text: '#',
                            dataField: 'id',
                            columntype: 'textbox',
                            width: '10%'

                        },
                        {
                            text: 'Script Kodu',
                            dataField: 'kodu',
                            columntype: 'textbox',
                            width: '15%'
                        },
                        {
                            text: 'Script Adı',
                            dataField: 'adi',
                            columntype: 'textbox',
                            width: '75%'
                        }
                    ],
                });
                scriptsDiv.on('contextmenu', function (e) {
                    var top = e.pageY - 10;
                    var left = e.pageX - 10;

                    $("#context-menu").css({
                        display: "block",
                        top: top,
                        left: left
                    });

                    return false;
                });
                scriptsDiv.on('rowclick', function (event) {
                    if (event.args.rightclick) {
                        scriptsDiv.jqxGrid('selectrow', event.args.rowindex);
                        var rowindex = scriptsDiv.jqxGrid('getselectedrowindex');
                        $('#selected_row_index').val(rowindex);
                        var dataRecord = scriptsDiv.jqxGrid('getrowdata', rowindex);
                        $('#id_edit').val(dataRecord.id);
                        $('#deleting').html(dataRecord.adi);
                        return false;
                    } else {
                        $("#context-menu").hide();
                    }
                });
                scriptsDiv.jqxGrid('sortby', 'id', 'desc');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Script Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin!');
            }
        });
    }

    function getProducts() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyProductList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                products = response.response;
                var productsSource = {
                    localdata: products,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'adi', type: 'string'},
                            {name: 'kodu', type: 'string'},
                        ]
                };
                var productsDataAdapter = new $.jqx.dataAdapter(productsSource);
                productsDiv.jqxGrid({
                    width: '100%',
                    height: '500',
                    source: productsDataAdapter,
                    columnsresize: true,
                    columnsreorder: true,
                    autoloadstate: true,
                    autosavestate: true,
                    groupable: true,
                    theme: 'metro',
                    filterable: true,
                    showfilterrow: true,
                    pageable: false,
                    sortable: true,
                    selectionmode: 'checkbox',
                    altrows: true,
                    pagesizeoptions: ['10', '20', '50', '1000'],
                    localization: getLocalization('tr'),
                    columns: [
                        {
                            text: 'Ürün Adı',
                            dataField: 'adi',
                            columntype: 'textbox',
                            width: '50%'
                        },
                        {
                            text: 'Ürün Kodu',
                            dataField: 'kodu',
                            columntype: 'textbox',
                            width: '50%'
                        }
                    ],
                });
                productsDiv.on('contextmenu', function (e) {
                    var top = e.pageY - 10;
                    var left = e.pageX - 10;

                    $("#context-menu").css({
                        display: "block",
                        top: top,
                        left: left
                    });

                    return false;
                });
                productsDiv.on('rowclick', function (event) {
                    if (event.args.rightclick) {
                        scriptsDiv.jqxGrid('selectrow', event.args.rowindex);
                        var rowindex = scriptsDiv.jqxGrid('getselectedrowindex');
                        $('#selected_row_index').val(rowindex);
                        var dataRecord = scriptsDiv.jqxGrid('getrowdata', rowindex);
                        $('#id_edit').val(dataRecord.id);
                        $('#deleting').html(dataRecord.adi);
                        return false;
                    } else {
                        $("#context-menu").hide();
                    }
                });
                productsDiv.jqxGrid('sortby', 'id', 'desc');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ürün Listesi Alınırken Sistemsel Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin!');
            }
        });
    }

    getSellers();
    getScripts();
    getProducts();

    function createBatchSeller() {
        $('#CreateBatchSellerModal').modal('show');
    }

    CreateBatchSellerButton.click(function () {
        var sellers = [];
        var scripts = [];
        var products = [];

        var sellersIndexes = sellersDiv.jqxGrid('getselectedrowindexes');
        if (sellersIndexes.length > 0) {
            $.each(sellersIndexes, function (i, index) {
                sellers.push(sellersDiv.jqxGrid('getrowdata', index));
            });
        }

        var scriptsIndexes = scriptsDiv.jqxGrid('getselectedrowindexes');
        if (scriptsIndexes.length > 0) {
            $.each(scriptsIndexes, function (i, index) {
                scripts.push(scriptsDiv.jqxGrid('getrowdata', index));
            });
        }

        var productsIndexes = productsDiv.jqxGrid('getselectedrowindexes');
        if (productsIndexes.length > 0) {
            $.each(productsIndexes, function (i, index) {
                products.push(productsDiv.jqxGrid('getrowdata', index));
            });
        }

        if (sellers.length === 0) {
            toastr.warning('En Az Bir Satıcı Seçmelisiniz!');
            return false;
        } else if (scripts.length === 0) {
            toastr.warning('En Az Bir Script Seçmelisiniz!');
            return false;
        } else if (products.length === 0) {
            toastr.warning('En Az Bir Ürün Seçmelisiniz!');
            return false;
        } else {
            var list = [];
            $.each(sellers, function (x, sellerCode) {
                $.each(scripts, function (y, surveyCode) {
                    $.each(products, function (z, productCode) {
                        list.push({
                            id: null,
                            saticiKodu: sellerCode.saticiAdi,
                            saticiAdi: sellerCode.saticiAdi,
                            durum: 1,
                            grupKodu: surveyCode.kodu,
                            urunKodu: productCode.kodu
                        });
                    });
                });
            });
            CreateBatchSellerButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveySellerConnect') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    sellers: sellers,
                    surveys: scripts,
                    products: products,
                },
                success: function (response) {
                    console.log(response);
                    CreateBatchSellerButton.attr('disabled', false).html('Oluştur');
                    sellersDiv.jqxGrid('clearselection');
                    scriptsDiv.jqxGrid('clearselection');
                    productsDiv.jqxGrid('clearselection');
                    $('#CreateBatchSellerModal').modal('hide');
                    toastr.success('Satıcılar Başarıyla Oluşturuldu!');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Satıcılar Eklenirken Serviste Bir Hata Oluştu');
                    CreateBatchSellerButton.attr('disabled', false).html('Oluştur');
                }
            });
        }
    });

</script>
