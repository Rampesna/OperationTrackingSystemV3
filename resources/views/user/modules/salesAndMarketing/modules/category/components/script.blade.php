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

    $(document).ready(function () {
        $('#loader').hide();
    });

    var categoriesDiv = $('#categories');

    var CreateCategoryButton = $('#CreateCategoryButton');
    var UpdateCategoryButton = $('#UpdateCategoryButton');
    var DeleteCategoryButton = $('#DeleteCategoryButton');

    function getCategories() {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyCategoryList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                console.log(response);
                var source = {
                    localdata: response.response,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'id'},
                            {name: 'kodu'},
                            {name: 'adi'},
                            {name: 'turKodu'},
                            {name: 'durum'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                categoriesDiv.jqxGrid({
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
                            text: 'Kategori Kodu',
                            dataField: 'kodu',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Kategori Adı',
                            dataField: 'adi',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Kategori Türü',
                            dataField: 'typeCode',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Durum',
                            dataField: 'durum',
                            columntype: 'textbox',
                        },
                    ],
                });
                categoriesDiv.on('rowclick', function (event) {
                    categoriesDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = categoriesDiv.jqxGrid('getselectedrowindex');
                    $('#selected_category_row_index').val(rowindex);
                    var dataRecord = categoriesDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_category_id').val(dataRecord.id);
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

    getCategories();

    function transactions() {
        var selectedCategoryId = $('#selected_category_id').val();
        if (!selectedCategoryId) {
            $('.editingTransaction').hide();
        } else {
            $('.editingTransaction').show();
        }
        $('#TransactionsModal').modal('show');
    }

    function createCategory() {
        $('#TransactionsModal').modal('hide');
        $('#create_category_code').val('');
        $('#create_category_name').val('');
        $('#create_category_status').val('');
        $('#create_category_email_title').val('');
        $('#create_category_email_content_file').val('');
        $('#CreateCategoryModal').modal('show');
    }

    function updateCategory() {
        var categoryId = 1;
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyCategoryEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                categoryId: categoryId,
            },
            success: function (response) {
                console.log(response);
                $('#TransactionsModal').modal('hide');
                $('#update_category_code').val(response.response.kodu);
                $('#update_category_name').val(response.response.adi);
                $('#update_category_status').val(response.response.durum);
                $('#update_category_email_title').val(response.response.epostaBaslik);
                $('#selectedCategoryEmailContent').html(response.response.epostaIcerik);
                $('#update_category_email_content_file').val('');
                $('#UpdateCategoryModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ürün Bilgileri Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    updateCategory();

    function showCategoryEmailContent() {
        $('#ShowCategoryEmailContentModal').modal('show');
    }

    function deleteCategory() {
        $('#TransactionsModal').modal('hide');
        $('#DeleteCategoryModal').modal('show');
    }

    CreateCategoryButton.click(function () {
        var code = $('#create_category_code').val();
        var name = $('#create_category_name').val();
        var status = $('#create_category_status').val();
        var emailTitle = $('#create_category_email_title').val();
        var emailContentFile = $('#create_category_email_content_file')[0].files[0];

        if (!code) {
            toastr.warning('Ürün Kodu Boş Olamaz.');
        } else if (!name) {
            toastr.warning('Ürün Adı Boş Olamaz.');
        } else if (!status) {
            toastr.warning('Ürün Durumu Seçmediniz!');
        } else {
            $('#loader').show();
            var data = new FormData();
            data.append('kodu', code);
            data.append('adi', name);
            data.append('durum', status);
            data.append('epostaBaslik', emailTitle);
            data.append('epostaIcerik', emailContentFile);

            $('#CreateCategoryModal').modal('hide');
            $.ajax({
                contentType: false,
                processData: false,
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyCategory') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: data,
                success: function () {
                    getCategories();
                    toastr.success('Ürün Başarıyla Eklendi.');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Ürün Eklenirken Serviste Bir Hata Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateCategoryButton.click(function () {
        var id = $('#selected_category_id').val();
        var code = $('#update_category_code').val();
        var name = $('#update_category_name').val();
        var status = $('#update_category_status').val();
        var emailTitle = $('#update_category_email_title').val();
        var emailContentFile = $('#update_category_email_content_file')[0].files[0];

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
            var data = new FormData();
            data.append('id', id);
            data.append('kodu', code);
            data.append('adi', name);
            data.append('durum', status);
            data.append('epostaBaslik', emailTitle);
            data.append('epostaIcerik', document.getElementById("update_category_email_content_file").files[0]);

            $('#loader').show();
            $('#UpdateCategoryModal').modal('hide');
            $.ajax({
                contentType: false,
                processData: false,
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyCategory') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: data,
                success: function () {
                    getCategories();
                    toastr.success('Ürün Başarıyla Güncellendi.');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Ürün Güncellenirken Serviste Bir Hata Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    $('body').on('contextmenu', function () {
        transactions();
        return false;
    });

</script>
