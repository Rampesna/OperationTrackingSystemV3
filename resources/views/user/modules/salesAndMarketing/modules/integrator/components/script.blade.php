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

    var integratorsDiv = $('#integrators');

    var CreateIntegratorButton = $('#CreateIntegratorButton');
    var UpdateIntegratorButton = $('#UpdateIntegratorButton');
    var DeleteIntegratorButton = $('#DeleteIntegratorButton');

    function getIntegrators() {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyIntegratorList') }}',
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
                integratorsDiv.jqxGrid({
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
                            text: 'Entegratör Firma Kodu',
                            dataField: 'kodu',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Entegratör Firma Adı',
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
                integratorsDiv.on('rowclick', function (event) {
                    integratorsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = integratorsDiv.jqxGrid('getselectedrowindex');
                    $('#selected_integrator_row_index').val(rowindex);
                    var dataRecord = integratorsDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_integrator_id').val(dataRecord.id);
                    return false;
                });
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Entegratör Firma Listesi Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getIntegrators();

    function transactions() {
        var selectedIntegratorId = $('#selected_integrator_id').val();
        if (!selectedIntegratorId) {
            $('.editingTransaction').hide();
        } else {
            $('.editingTransaction').show();
        }
        $('#TransactionsModal').modal('show');
    }

    function createIntegrator() {
        $('#TransactionsModal').modal('hide');
        $('#create_integrator_code').val('');
        $('#create_integrator_name').val('');
        $('#create_integrator_status').val('');
        $('#CreateIntegratorModal').modal('show');
    }

    function updateIntegrator() {
        var integratorId = $('#selected_integrator_id').val();
        console.log(integratorId);
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyIntegratorEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                integratorId: integratorId,
            },
            success: function (response) {
                console.log(response);
                $('#TransactionsModal').modal('hide');
                $('#update_integrator_code').val(response.response.kodu);
                $('#update_integrator_name').val(response.response.adi);
                $('#update_integrator_status').val(response.response.durum);
                $('#UpdateIntegratorModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Entegratör Firma Bilgileri Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    function deleteIntegrator() {
        $('#TransactionsModal').modal('hide');
        $('#DeleteIntegratorModal').modal('show');
    }

    CreateIntegratorButton.click(function () {
        var code = $('#create_integrator_code').val();
        var name = $('#create_integrator_name').val();
        var status = $('#create_integrator_status').val();

        if (!code) {
            toastr.warning('Entegratör Firma Kodu Boş Olamaz.');
        } else if (!name) {
            toastr.warning('Entegratör Firma Adı Boş Olamaz.');
        } else if (!status) {
            toastr.warning('Entegratör Firma Durumu Seçmediniz!');
        } else {
            CreateIntegratorButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyIntegrator') }}',
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
                    CreateIntegratorButton.attr('disabled', false).html('Oluştur');
                    $('#CreateIntegratorModal').modal('hide');
                    toastr.success('Entegratör Firma Başarıyla Oluşturuldu.');
                    getIntegrators();
                },
                error: function (error) {
                    CreateIntegratorButton.attr('disabled', false).html('Oluştur');
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

    UpdateIntegratorButton.click(function () {
        var id = $('#selected_integrator_id').val();
        var code = $('#update_integrator_code').val();
        var name = $('#update_integrator_name').val();
        var status = $('#update_integrator_status').val();

        if (!id) {
            toastr.warning('Entegratör Firma Seçiminde Hata Var, Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else if (!code) {
            toastr.warning('Entegratör Firma Kodu Boş Olamaz.');
        } else if (!name) {
            toastr.warning('Entegratör Firma Adı Boş Olamaz.');
        } else if (!status) {
            toastr.warning('Entegratör Firma Durumu Seçmediniz!');
        } else {
            UpdateIntegratorButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyIntegrator') }}',
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
                    UpdateIntegratorButton.attr('disabled', false).html('Güncelle');
                    $('#UpdateIntegratorModal').modal('hide');
                    toastr.success('Entegratör Firma Başarıyla Güncellendi.');
                    getIntegrators();
                },
                error: function (error) {
                    UpdateIntegratorButton.attr('disabled', false).html('Güncelle');
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

    DeleteIntegratorButton.click(function () {
        var integratorId = $('#selected_integrator_id').val();
        if (!integratorId) {
            toastr.warning('Entegratör Firma Seçiminde Hata Var, Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else {
            DeleteIntegratorButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyIntegratorDelete') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    integratorId: integratorId,
                },
                success: function () {
                    DeleteIntegratorButton.attr('disabled', false).html('Sil');
                    $('#DeleteIntegratorModal').modal('hide');
                    toastr.success('Entegratör Firma Başarıyla Silindi.');
                    getIntegrators();
                },
                error: function (error) {
                    DeleteIntegratorButton.attr('disabled', false).html('Sil');
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
