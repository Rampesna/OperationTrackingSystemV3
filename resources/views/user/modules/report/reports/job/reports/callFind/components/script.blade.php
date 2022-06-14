<script src="{{ asset('assets/jqwidgets/jqxcore.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxbuttons.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxscrollbar.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxlistbox.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdropdownlist.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxmenu.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.selection.js') }}"></script>
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

    var reportDiv = $('#report');
    var reportRow = $('#reportRow');

    var ReportButton = $('#ReportButton');
    var DownloadExcelButton = $('#DownloadExcelButton');

    var startDateInput = $('#startDate');
    var endDateInput = $('#endDate');
    var dataScanningTablesInput = $('#dataScanningTables');

    function getDataScanningTables() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.dataScanning.getDataScanTables') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                dataScanningTablesInput.empty().append(`<option value="Tum">Tümü</option>`);
                $.each(response.response, function (i, dataScanningTable) {
                    dataScanningTablesInput.append(`<option value="${dataScanningTable.tabloAdi}">${dataScanningTable.grupAdi}</option>`);
                });
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Rapor Listesi Alınırken Serviste Bir Hata Oluştu!');
                $('#loader').hide();
            }
        });
    }

    getDataScanningTables();

    ReportButton.click(function () {
        var startDate = startDateInput.val();
        var endDate = endDateInput.val();
        var tableName = dataScanningTablesInput.val();
        var companyIds = [];
        $.each(SelectedCompanies.val(), function (i, SelectedCompany) {
            companyIds.push(
                {
                    'ofisKodu': parseInt(SelectedCompany)
                }
            );
        });

        if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçilmedi!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçilmedi!');
        } else if (!tableName) {
            toastr.warning('Rapor Seçilmedi!');
        } else {
            $('#loader').show();
            reportRow.hide();
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.operationApi.dataScanning.getDataScanNumbersList') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    tableName: tableName,
                    companyIds: companyIds
                },
                success: function (response) {
                    $('#totalSpan').html(`${response.response[2].deger}`);
                    $('#waitingSpan').html(`${response.response[1].deger}`);
                    $('#findedSpan').html(`${response.response[0].deger} / ${response.response[1].deger - response.response[0].deger}`);
                    $('#cards').show();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Rapor Alınırken Serviste Bir Hata Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    $(document).delegate('.typeSelector', 'click', function () {
        $('#loader').show();
        var startDate = startDateInput.val();
        var endDate = endDateInput.val();
        var tableName = dataScanningTablesInput.val();
        var type = $(this).data('type');
        var companyIds = [];
        $.each(SelectedCompanies.val(), function (i, SelectedCompany) {
            companyIds.push(
                {
                    'ofisKodu': parseInt(SelectedCompany)
                }
            );
        });

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.dataScanning.getDataScanningDetails') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                startDate: startDate,
                endDate: endDate,
                tableName: tableName,
                type: type,
                companyIds: companyIds
            },
            success: function (response) {
                var source = {
                    localdata: response.response,
                    datatype: "array",
                    datafields: [
                        {name: 'tarih'},
                        {name: 'personel'},
                        {name: 'vknTckn'},
                        {name: 'unvan'},
                        {name: 'sehir'},
                        {name: 'ilce'},
                        {name: 'telefon1'},
                        {name: 'telefon2'},
                        {name: 'telefon3'},
                        {name: 'mail1'},
                        {name: 'mail2'},
                        {name: 'mail3'},
                        {name: 'adres1'},
                        {name: 'yetkiliAdSoyad1'},
                    ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                reportDiv.jqxGrid({
                    width: '100%',
                    height: '500',
                    source: dataAdapter,
                    columnsresize: true,
                    groupable: true,
                    theme: jqxGridGlobalTheme,
                    filterable: true,
                    showfilterrow: true,
                    localization: getLocalization('tr'),
                    columns: [
                        {
                            text: 'Tarih',
                            dataField: 'tarih',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Personel',
                            dataField: 'personel',
                            columntype: 'textbox',
                        },
                        {
                            text: 'VKN/TCKN',
                            dataField: 'vknTckn',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Ünvan',
                            dataField: 'unvan',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Şehir',
                            dataField: 'sehir',
                            columntype: 'textbox',
                        },
                        {
                            text: 'İlçe',
                            dataField: 'ilce',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Telefon 1',
                            dataField: 'telefon1',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Telefon 2',
                            dataField: 'telefon2',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Telefon 3',
                            dataField: 'telefon3',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Mail 1',
                            dataField: 'mail1',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Mail 2',
                            dataField: 'mail2',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Mail 3',
                            dataField: 'mail3',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Adres',
                            dataField: 'adres1',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Yetkili Ad Soyad',
                            dataField: 'yetkiliAdSoyad1',
                            columntype: 'textbox',
                        }
                    ]
                });
                reportDiv.on('contextmenu', function () {
                    return false;
                });
                reportDiv.on('rowclick', function (event) {
                    if (event.args.rightclick) {
                        $("#employeesGrid").jqxGrid('selectrow', event.args.rowindex);
                        var scrollTop = $(window).scrollTop();
                        var scrollLeft = $(window).scrollLeft();
                        contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                        return false;
                    }
                });
                reportRow.show();
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Rapor Listesi Alınırken Serviste Bir Hata Oluştu!');
                $('#loader').hide();
            }
        });
    });

    DownloadExcelButton.click(function () {
        $("#report").jqxGrid('exportdata', 'xlsx', 'Telefon Bulma Raporu');
    });

</script>
