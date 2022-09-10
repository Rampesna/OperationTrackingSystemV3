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

    var productsDiv = $('#products');

    var CreateProductButton = $('#CreateProductButton');
    var UpdateProductButton = $('#UpdateProductButton');
    var DeleteProductButton = $('#DeleteProductButton');

    function getProducts() {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyProductList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                var source = {
                    localdata: response.response,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'id'},
                            {name: 'kodu'},
                            {name: 'adi'},
                            {name: 'durum'},
                            {name: 'epostaBaslik'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                productsDiv.jqxGrid({
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
                            text: 'Ürün Kodu',
                            dataField: 'kodu',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Ürün Adı',
                            dataField: 'adi',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Durum',
                            dataField: 'durum',
                            columntype: 'textbox',
                        },
                        {
                            text: 'E-posta Başlığı',
                            dataField: 'epostaBaslik',
                            columntype: 'textbox',
                        },
                    ],
                });
                productsDiv.on('rowclick', function (event) {
                    productsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = productsDiv.jqxGrid('getselectedrowindex');
                    $('#selected_product_row_index').val(rowindex);
                    var dataRecord = productsDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_product_id').val(dataRecord.id);
                    return false;
                });
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ürün Listesi Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getProducts();

    function transactions() {
        var selectedProductId = $('#selected_product_id').val();
        if (!selectedProductId) {
            $('.editingTransaction').hide();
        } else {
            $('.editingTransaction').show();
        }
        $('#TransactionsModal').modal('show');
    }

    function createProduct() {
        $('#TransactionsModal').modal('hide');
        $('#create_product_code').val('');
        $('#create_product_name').val('');
        $('#create_product_status').val('');
        $('#create_product_email_title').val('');
        $('#create_product_email_content_file').val('');
        $('#CreateProductModal').modal('show');
    }

    function updateProduct() {
        var productId = $('#selected_product_id').val();
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyProductEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                productId: productId,
            },
            success: function (response) {
                $('#TransactionsModal').modal('hide');
                $('#update_product_code').val(response.response.kodu);
                $('#update_product_name').val(response.response.adi);
                $('#update_product_status').val(response.response.durum);
                $('#update_product_email_title').val(response.response.epostaBaslik);
                $('#selectedProductEmailContent').html(response.response.epostaIcerik);
                $('#update_product_email_content_file').val('');
                $('#UpdateProductModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ürün Bilgileri Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    function showProductEmailContent() {
        $('#ShowProductEmailContentModal').modal('show');
    }

    function deleteProduct() {
        $('#TransactionsModal').modal('hide');
        $('#DeleteProductModal').modal('show');
    }

    CreateProductButton.click(function () {
        var code = $('#create_product_code').val();
        var name = $('#create_product_name').val();
        var status = $('#create_product_status').val();
        var emailTitle = $('#create_product_email_title').val();
        var emailContentFile = $('#create_product_email_content_file')[0].files[0];

        if (!code) {
            toastr.warning('Ürün Kodu Boş Olamaz.');
        } else if (!name) {
            toastr.warning('Ürün Adı Boş Olamaz.');
        } else if (!status) {
            toastr.warning('Ürün Durumu Seçmediniz!');
        } else if (!emailTitle) {
            toastr.warning('E-posta Başlığı Boş Olamaz.');
        } else if (!emailContentFile) {
            toastr.warning('E-posta İçeriği Boş Olamaz.');
        } else {
            var input = document.getElementById("create_product_email_content_file");
            var fReader = new FileReader();
            fReader.readAsDataURL(input.files[0]);
            fReader.onloadend = function (event) {
                var products = [{
                    kodu: code,
                    adi: name,
                    durum: status,
                    epostaBaslik: emailTitle,
                    epostaIcerik: atob(event.target.result.split(',')[1]),
                }];
                $('#loader').show();
                $('#CreateProductModal').modal('hide');
                $.ajax({
                    type: 'post',
                    url: '{{ route('user.api.operationApi.surveySystem.setSurveyProduct') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        products: products,
                    },
                    success: function () {
                        getProducts();
                        toastr.success('Ürün Başarıyla Eklendi.');
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Ürün Eklenirken Serviste Bir Hata Oluştu.');
                        $('#loader').hide();
                    }
                });
            }
        }
    });

    UpdateProductButton.click(function () {
        var id = $('#selected_product_id').val();
        var code = $('#update_product_code').val();
        var name = $('#update_product_name').val();
        var status = $('#update_product_status').val();
        var emailTitle = $('#update_product_email_title').val();
        var emailContentFile = $('#update_product_email_content_file')[0].files[0];

        if (!id) {
            toastr.warning('Ürün Seçiminde Hata Var, Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else if (!code) {
            toastr.warning('Ürün Kodu Boş Olamaz.');
        } else if (!name) {
            toastr.warning('Ürün Adı Boş Olamaz.');
        } else if (!status) {
            toastr.warning('Ürün Durumu Seçmediniz!');
        } else if (!emailTitle) {
            toastr.warning('E-posta Başlığı Boş Olamaz.');
        } else if (!emailContentFile) {
            toastr.warning('E-posta İçeriği Boş Olamaz.');
        } else {
            var input = document.getElementById("update_product_email_content_file");
            var fReader = new FileReader();
            fReader.readAsDataURL(input.files[0]);
            fReader.onloadend = function (event) {
                var products = [{
                    id: id,
                    kodu: code,
                    adi: name,
                    durum: status,
                    epostaBaslik: emailTitle,
                    epostaIcerik: atob(event.target.result.split(',')[1]),
                }];
                $('#loader').show();
                $('#UpdateProductModal').modal('hide');
                $.ajax({
                    type: 'post',
                    url: '{{ route('user.api.operationApi.surveySystem.setSurveyProduct') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        products: products,
                    },
                    success: function () {
                        getProducts();
                        toastr.success('Ürün Başarıyla Güncellendi.');
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Ürün Güncellenirken Serviste Bir Hata Oluştu.');
                        $('#loader').hide();
                    }
                });
            }
        }
    });

    $('body').on('contextmenu', function () {
        transactions();
        return false;
    });

</script>
