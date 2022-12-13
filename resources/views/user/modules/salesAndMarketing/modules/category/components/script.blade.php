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
                            text: 'Tür Kodu',
                            dataField: 'turKodu',
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
                toastr.error('Kategori Listesi Alınırken Serviste Bir Hata Oluştu.');
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
        $('#create_category_type_code').val('');
        $('#create_category_status').val('');
        $('#CreateCategoryModal').modal('show');
    }

    function updateCategory() {
        var categoryId = $('#selected_category_id').val();
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
                $('#update_category_type_code').val(response.response.turKodu);
                $('#update_category_status').val(response.response.durum);
                $('#UpdateCategoryModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kategori Bilgileri Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    function deleteCategory() {
        $('#TransactionsModal').modal('hide');
        $('#DeleteCategoryModal').modal('show');
    }

    CreateCategoryButton.click(function () {
        var code = $('#create_category_code').val();
        var name = $('#create_category_name').val();
        var typeCode = $('#create_category_type_code').val();
        var status = $('#create_category_status').val();

        if (!code) {
            toastr.warning('Kategori Kodu Boş Olamaz.');
        } else if (!name) {
            toastr.warning('Kategori Adı Boş Olamaz.');
        } else if (!typeCode) {
            toastr.warning('Tür Kodu Boş Olamaz.');
        } else if (!status) {
            toastr.warning('Kategori Durumu Seçmediniz!');
        } else {
            CreateCategoryButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyCategory') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    code: code,
                    name: name,
                    typeCode: typeCode,
                    status: status,
                },
                success: function () {
                    CreateCategoryButton.attr('disabled', false).html('Oluştur');
                    $('#CreateCategoryModal').modal('hide');
                    toastr.success('Kategori Başarıyla Oluşturuldu.');
                    getCategories();
                },
                error: function (error) {
                    CreateCategoryButton.attr('disabled', false).html('Oluştur');
                    console.log(error);
                    if (parseInt(error.status) === 422) {
                        $.each(error.responseJSON.response, function (i, error) {
                            toastr.error(error[0]);
                        });
                    } else {
                        toastr.error(error.responseJSON.message);
                    }
                }
            });
        }
    });

    UpdateCategoryButton.click(function () {
        var id = $('#selected_category_id').val();
        var code = $('#update_category_code').val();
        var name = $('#update_category_name').val();
        var typeCode = $('#update_category_type_code').val();
        var status = $('#update_category_status').val();

        if (!id) {
            toastr.warning('Kategori Seçiminde Hata Var, Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else if (!code) {
            toastr.warning('Kategori Kodu Boş Olamaz.');
        } else if (!name) {
            toastr.warning('Kategori Adı Boş Olamaz.');
        } else if (!typeCode) {
            toastr.warning('Tür Kodu Boş Olamaz.');
        } else if (!status) {
            toastr.warning('Kategori Durumu Seçmediniz!');
        } else {
            UpdateCategoryButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyCategory') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    code: code,
                    name: name,
                    typeCode: typeCode,
                    status: status,
                },
                success: function () {
                    UpdateCategoryButton.attr('disabled', false).html('Güncelle');
                    $('#UpdateCategoryModal').modal('hide');
                    toastr.success('Kategori Başarıyla Güncellendi.');
                    getCategories();
                },
                error: function (error) {
                    UpdateCategoryButton.attr('disabled', false).html('Güncelle');
                    console.log(error);
                    if (parseInt(error.status) === 422) {
                        $.each(error.responseJSON.response, function (i, error) {
                            toastr.error(error[0]);
                        });
                    } else {
                        toastr.error(error.responseJSON.message);
                    }
                }
            });
        }
    });

    DeleteCategoryButton.click(function () {
        var categoryId = $('#selected_category_id').val();
        if (!categoryId) {
            toastr.warning('Kategori Seçiminde Hata Var, Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else {
            DeleteCategoryButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyCategoryDelete') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    categoryId: categoryId,
                },
                success: function () {
                    DeleteCategoryButton.attr('disabled', false).html('Sil');
                    $('#DeleteCategoryModal').modal('hide');
                    toastr.success('Kategori Başarıyla Silindi.');
                    getCategories();
                },
                error: function (error) {
                    DeleteCategoryButton.attr('disabled', false).html('Sil');
                    console.log(error);
                    if (parseInt(error.status) === 422) {
                        $.each(error.responseJSON.response, function (i, error) {
                            toastr.error(error[0]);
                        });
                    } else {
                        toastr.error(error.responseJSON.message);
                    }
                }
            });
        }
    });

    $('body').on('contextmenu', function () {
        transactions();
        return false;
    });

</script>
