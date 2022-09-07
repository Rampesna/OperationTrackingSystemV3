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

    var reportDiv = $('#report');
    var reportRow = $('#reportRow');

    var ReportButton = $('#ReportButton');
    var DownloadExcelButton = $('#DownloadExcelButton');

    var startDateInput = $('#startDate');
    var endDateInput = $('#endDate');

    ReportButton.click(function () {
        var startDate = startDateInput.val();
        var endDate = endDateInput.val();
        var companyIds = SelectedCompanies.val();

        if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçilmedi!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçilmedi!');
        } else {
            ReportButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            reportRow.hide();
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.operationApi.dataScanning.getDataScanGibList') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    companyIds: companyIds
                },
                success: function (response) {
                    ReportButton.attr('disabled', false).html('Raporla');

                    var source = {
                        localdata: response.response,
                        datatype: "array",
                        datafields: [
                            {name: 'id'},
                            {name: 'vknTckn'},
                            {name: 'unvan'},
                            {name: 'sehir'},
                            {name: 'ilce'},
                            {name: 'oncelik'},
                            {name: 'yetkiliAdSoyad1'},
                            {name: 'yetkiliAdSoyad2'},
                            {name: 'telefon1'},
                            {name: 'telefon1Hatali'},
                            {name: 'telefon2'},
                            {name: 'telefon2Hatali'},
                            {name: 'telefon3'},
                            {name: 'telefon3Hatali'},
                            {name: 'adres1'},
                            {name: 'adres2'},
                            {name: 'mail1'},
                            {name: 'mail2'},
                            {name: 'mail3'},
                            {name: 'atananKullanicilarId'},
                            {name: 'durumKodu'},
                            {name: 'grupKodu'},
                            {name: 'islemAdi'},
                            {name: 'islemKullanicilarId'},
                            {name: 'islemTarihi'},
                            {name: 'islemTuruOzel'},
                            {name: 'kayitKullanicilarId'},
                            {name: 'kayitTarihi'},
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
                                text: '#',
                                dataField: 'id',
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
                                text: 'Öncelik',
                                dataField: 'oncelik',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Yetkili 1',
                                dataField: 'yetkiliAdSoyad1',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Yetkili 2',
                                dataField: 'yetkiliAdSoyad2',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Telefon 1',
                                dataField: 'telefon1',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Telefon 1 Hatalı mı?',
                                dataField: 'telefon1Hatali',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Telefon 2',
                                dataField: 'telefon2',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Telefon 2 Hatalı mı?',
                                dataField: 'telefon2Hatali',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Telefon 3',
                                dataField: 'telefon3',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Telefon 3 Hatalı mı?',
                                dataField: 'telefon3Hatali',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Adres 1',
                                dataField: 'adres1',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Adres 2',
                                dataField: 'adres2',
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
                                text: 'Atanan Personel',
                                dataField: 'atananKullanicilarId',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Durum Kodu',
                                dataField: 'durumKodu',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Grup Kodu',
                                dataField: 'grupKodu',
                                columntype: 'textbox',
                            },
                            {
                                text: 'İşlem Adı',
                                dataField: 'islemAdi',
                                columntype: 'textbox',
                            },
                            {
                                text: 'İşlem Yapan Personel',
                                dataField: 'islemKullanicilarId',
                                columntype: 'textbox',
                            },
                            {
                                text: 'İşlem Tarihi',
                                dataField: 'islemTarihi',
                                columntype: 'textbox',
                            },
                            {
                                text: 'İşlem Türü Özel',
                                dataField: 'islemTuruOzel',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Kayıt Yapan Personel',
                                dataField: 'kayitKullanicilarId',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Kayıt Tarihi',
                                dataField: 'kayitTarihi',
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
                    DownloadExcelButton.show();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Rapor Alınırken Serviste Bir Hata Oluştu!');
                    ReportButton.attr('disabled', false).html('Raporla');
                }
            });
        }
    });

    DownloadExcelButton.click(function () {
        $("#report").jqxGrid('exportdata', 'xlsx', 'Gib Telefon Bulma Raporu');
    });

</script>
