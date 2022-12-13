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

    var opponentsDiv = $('#opponents');

    var CreateOpponentButton = $('#CreateOpponentButton');
    var UpdateOpponentButton = $('#UpdateOpponentButton');
    var DeleteOpponentButton = $('#DeleteOpponentButton');

    function getOpponents() {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyOpponentList') }}',
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
                opponentsDiv.jqxGrid({
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
                            text: 'Rakip Firma Kodu',
                            dataField: 'kodu',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Rakip Firma Adı',
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
                opponentsDiv.on('rowclick', function (event) {
                    opponentsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = opponentsDiv.jqxGrid('getselectedrowindex');
                    $('#selected_opponent_row_index').val(rowindex);
                    var dataRecord = opponentsDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_opponent_id').val(dataRecord.id);
                    return false;
                });
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Rakip Firma Listesi Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getOpponents();

    function transactions() {
        var selectedOpponentId = $('#selected_opponent_id').val();
        if (!selectedOpponentId) {
            $('.editingTransaction').hide();
        } else {
            $('.editingTransaction').show();
        }
        $('#TransactionsModal').modal('show');
    }

    function createOpponent() {
        $('#TransactionsModal').modal('hide');
        $('#create_opponent_code').val('');
        $('#create_opponent_name').val('');
        $('#create_opponent_status').val('');
        $('#CreateOpponentModal').modal('show');
    }

    function updateOpponent() {
        var opponentId = $('#selected_opponent_id').val();
        console.log(opponentId);
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyOpponentEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                opponentId: opponentId,
            },
            success: function (response) {
                console.log(response);
                $('#TransactionsModal').modal('hide');
                $('#update_opponent_code').val(response.response.kodu);
                $('#update_opponent_name').val(response.response.adi);
                $('#update_opponent_status').val(response.response.durum);
                $('#UpdateOpponentModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Rakip Firma Bilgileri Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    function deleteOpponent() {
        $('#TransactionsModal').modal('hide');
        $('#DeleteOpponentModal').modal('show');
    }

    CreateOpponentButton.click(function () {
        var code = $('#create_opponent_code').val();
        var name = $('#create_opponent_name').val();
        var status = $('#create_opponent_status').val();

        if (!code) {
            toastr.warning('Rakip Firma Kodu Boş Olamaz.');
        } else if (!name) {
            toastr.warning('Rakip Firma Adı Boş Olamaz.');
        } else if (!status) {
            toastr.warning('Rakip Firma Durumu Seçmediniz!');
        } else {
            CreateOpponentButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyOpponent') }}',
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
                    CreateOpponentButton.attr('disabled', false).html('Oluştur');
                    $('#CreateOpponentModal').modal('hide');
                    toastr.success('Rakip Firma Başarıyla Oluşturuldu.');
                    getOpponents();
                },
                error: function (error) {
                    CreateOpponentButton.attr('disabled', false).html('Oluştur');
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

    UpdateOpponentButton.click(function () {
        var id = $('#selected_opponent_id').val();
        var code = $('#update_opponent_code').val();
        var name = $('#update_opponent_name').val();
        var status = $('#update_opponent_status').val();

        if (!id) {
            toastr.warning('Rakip Firma Seçiminde Hata Var, Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else if (!code) {
            toastr.warning('Rakip Firma Kodu Boş Olamaz.');
        } else if (!name) {
            toastr.warning('Rakip Firma Adı Boş Olamaz.');
        } else if (!status) {
            toastr.warning('Rakip Firma Durumu Seçmediniz!');
        } else {
            UpdateOpponentButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyOpponent') }}',
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
                    UpdateOpponentButton.attr('disabled', false).html('Güncelle');
                    $('#UpdateOpponentModal').modal('hide');
                    toastr.success('Rakip Firma Başarıyla Güncellendi.');
                    getOpponents();
                },
                error: function (error) {
                    UpdateOpponentButton.attr('disabled', false).html('Güncelle');
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

    DeleteOpponentButton.click(function () {
        var opponentId = $('#selected_opponent_id').val();
        if (!opponentId) {
            toastr.warning('Rakip Firma Seçiminde Hata Var, Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else {
            DeleteOpponentButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyOpponentDelete') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    opponentId: opponentId,
                },
                success: function () {
                    DeleteOpponentButton.attr('disabled', false).html('Sil');
                    $('#DeleteOpponentModal').modal('hide');
                    toastr.success('Rakip Firma Başarıyla Silindi.');
                    getOpponents();
                },
                error: function (error) {
                    DeleteOpponentButton.attr('disabled', false).html('Sil');
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
