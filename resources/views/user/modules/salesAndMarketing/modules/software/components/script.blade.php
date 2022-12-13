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

    var softwaresDiv = $('#softwares');

    var CreateSoftwareButton = $('#CreateSoftwareButton');
    var UpdateSoftwareButton = $('#UpdateSoftwareButton');
    var DeleteSoftwareButton = $('#DeleteSoftwareButton');

    function getSoftwares() {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveySoftwareList') }}',
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
                            {name: 'durum'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                softwaresDiv.jqxGrid({
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
                            text: 'Ticari Yazılım Kodu',
                            dataField: 'kodu',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Ticari Yazılım Adı',
                            dataField: 'adi',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Durum',
                            dataField: 'durum',
                            columntype: 'textbox',
                        },
                    ],
                });
                softwaresDiv.on('rowclick', function (event) {
                    softwaresDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = softwaresDiv.jqxGrid('getselectedrowindex');
                    $('#selected_software_row_index').val(rowindex);
                    var dataRecord = softwaresDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_software_id').val(dataRecord.id);
                    return false;
                });
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ticari Yazılım Listesi Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getSoftwares();

    function transactions() {
        var selectedSoftwareId = $('#selected_software_id').val();
        if (!selectedSoftwareId) {
            $('.editingTransaction').hide();
        } else {
            $('.editingTransaction').show();
        }
        $('#TransactionsModal').modal('show');
    }

    function createSoftware() {
        $('#TransactionsModal').modal('hide');
        $('#create_software_code').val('');
        $('#create_software_name').val('');
        $('#create_software_status').val('');
        $('#CreateSoftwareModal').modal('show');
    }

    function updateSoftware() {
        var softwareId = $('#selected_software_id').val();
        console.log(softwareId);
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveySoftwareEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                softwareId: softwareId,
            },
            success: function (response) {
                console.log(response);
                $('#TransactionsModal').modal('hide');
                $('#update_software_code').val(response.response.kodu);
                $('#update_software_name').val(response.response.adi);
                $('#update_software_status').val(response.response.durum);
                $('#UpdateSoftwareModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ticari Yazılım Bilgileri Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    function deleteSoftware() {
        $('#TransactionsModal').modal('hide');
        $('#DeleteSoftwareModal').modal('show');
    }

    CreateSoftwareButton.click(function () {
        var code = $('#create_software_code').val();
        var name = $('#create_software_name').val();
        var status = $('#create_software_status').val();

        if (!code) {
            toastr.warning('Ticari Yazılım Kodu Boş Olamaz.');
        } else if (!name) {
            toastr.warning('Ticari Yazılım Adı Boş Olamaz.');
        } else if (!status) {
            toastr.warning('Ticari Yazılım Durumu Seçmediniz!');
        } else {
            CreateSoftwareButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveySoftware') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    code: code,
                    name: name,
                    status: status,
                },
                success: function () {
                    CreateSoftwareButton.attr('disabled', false).html('Oluştur');
                    $('#CreateSoftwareModal').modal('hide');
                    toastr.success('Ticari Yazılım Başarıyla Oluşturuldu.');
                    getSoftwares();
                },
                error: function (error) {
                    CreateSoftwareButton.attr('disabled', false).html('Oluştur');
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

    UpdateSoftwareButton.click(function () {
        var id = $('#selected_software_id').val();
        var code = $('#update_software_code').val();
        var name = $('#update_software_name').val();
        var status = $('#update_software_status').val();

        if (!id) {
            toastr.warning('Ticari Yazılım Seçiminde Hata Var, Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else if (!code) {
            toastr.warning('Ticari Yazılım Kodu Boş Olamaz.');
        } else if (!name) {
            toastr.warning('Ticari Yazılım Adı Boş Olamaz.');
        } else if (!status) {
            toastr.warning('Ticari Yazılım Durumu Seçmediniz!');
        } else {
            UpdateSoftwareButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveySoftware') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    code: code,
                    name: name,
                    status: status,
                },
                success: function () {
                    UpdateSoftwareButton.attr('disabled', false).html('Güncelle');
                    $('#UpdateSoftwareModal').modal('hide');
                    toastr.success('Ticari Yazılım Başarıyla Güncellendi.');
                    getSoftwares();
                },
                error: function (error) {
                    UpdateSoftwareButton.attr('disabled', false).html('Güncelle');
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

    DeleteSoftwareButton.click(function () {
        var softwareId = $('#selected_software_id').val();
        if (!softwareId) {
            toastr.warning('Ticari Yazılım Seçiminde Hata Var, Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else {
            DeleteSoftwareButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveySoftwareDelete') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    softwareId: softwareId,
                },
                success: function () {
                    DeleteSoftwareButton.attr('disabled', false).html('Sil');
                    $('#DeleteSoftwareModal').modal('hide');
                    toastr.success('Ticari Yazılım Başarıyla Silindi.');
                    getSoftwares();
                },
                error: function (error) {
                    DeleteSoftwareButton.attr('disabled', false).html('Sil');
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
