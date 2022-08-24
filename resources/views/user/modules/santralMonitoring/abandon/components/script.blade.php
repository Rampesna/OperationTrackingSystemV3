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

    var abandonsDiv = $('#abandons');

    var queueIdFilter = $('#queue_id_filter');

    var DownloadExcelArea = $('#DownloadExcelArea');

    var GetAbandonsButton = $('#GetAbandonsButton');
    var DownloadExcelButton = $('#DownloadExcelButton');

    function getQueuesByCompanyIds() {
        var companyIds = SelectedCompanies.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.queue.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: 0,
                pageSize: 10000,
            },
            success: function (response) {
                queueIdFilter.empty();
                $.each(response.response.queues, function (i, queue) {
                    queueIdFilter.append(`<option value="${queue.id}" data-short="${queue.short}">${queue.name}</option>`);
                });
                queueIdFilter.val('').trigger('change');
            },
            error: function (error) {
                console.log(error);
                toastt.error('Kuyruk Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getQueuesByCompanyIds();

    SelectedCompanies.change(function () {
        getQueuesByCompanyIds();
    });

    GetAbandonsButton.click(function () {
        var queueShort = queueIdFilter.find(':selected').data('short');
        if (!queueShort) {
            toastr.warning('Lütfen Kuyruk Seçiniz!');
        } else {
            DownloadExcelArea.hide();
            GetAbandonsButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.netsantralApi.abandons') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    queueShort: queueShort,
                },
                success: function (response) {
                    var source = {
                        localdata: response.response,
                        datatype: "array",
                        datafields:
                            [
                                {name: 'callerNumber', type: 'string'},
                                {name: 'callTime', type: 'string'},
                                {name: 'status', type: 'string'},
                                {name: 'result', type: 'string'},
                                {name: 'standByTime', type: 'string'},
                                {name: 'callbackTime', type: 'string'},
                                {name: 'callbackAgent', type: 'string'},
                            ]
                    };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    abandonsDiv.jqxGrid({
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
                                text: 'Numara',
                                dataField: 'callerNumber',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Arama Zamanı',
                                dataField: 'callTime',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Durum',
                                dataField: 'status',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Sonuç',
                                dataField: 'result',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Bekleme Süresi',
                                dataField: 'standByTime',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Geri Dönülme Zamanı',
                                dataField: 'callbackTime',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Geri Dönen Agent',
                                dataField: 'callbackAgent',
                                columntype: 'textbox',
                            }
                        ],
                    });
                    abandonsDiv.on('rowclick', function (event) {
                        abandonsDiv.jqxGrid('selectrow', event.args.rowindex);
                        var rowindex = abandonsDiv.jqxGrid('getselectedrowindex');
                        $('#selected_survey_row_index').val(rowindex);
                        var dataRecord = abandonsDiv.jqxGrid('getrowdata', rowindex);
                        return false;
                    });
                    abandonsDiv.jqxGrid('sortby', 'id', 'desc');

                    GetAbandonsButton.attr('disabled', false).html('Kayıp Çağrıları Getir');
                    DownloadExcelArea.show();
                },
                error: function (error) {
                    console.log(error);
                    toaste.error('Kayıp Çağrılar Alınırken Serviste Bir Sorun Oluştu!');
                    GetAbandonsButton.attr('disabled', false).html('Kayıp Çağrıları Getir');
                }
            });
        }
    });

    DownloadExcelButton.click(function () {
        var queue = queueIdFilter.find(':selected').text();
        abandonsDiv.jqxGrid('exportdata', 'xls', `${queue} - Kayıp Çağrılar`);
    });

</script>
