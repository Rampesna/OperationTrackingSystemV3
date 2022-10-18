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

    var ReportButton = $('#ReportButton');
    var DownloadExcelButton = $('#DownloadExcelButton');

    var reportsDiv = $('#reports');

    var survey = null;

    function getSurvey() {
        var id = parseInt('{{ $id }}');
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                survey = response.response;
                $('#surveyCodeSpan').text(response.response.kodu);
                $('#surveyListCodeSpan').text(response.response.uyumCrmListeKod);
                $('#surveyNameSpan').text(response.response.adi);
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Script Verileri Alınırken Sistemsel Bir Hata Oluştu!');
                $('#loader').hide();
            }
        });
    }

    getSurvey();

    function getSurveyDetailReport() {
        var surveyCode = parseInt('{{ $code }}');
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        var companyIds = SelectedCompanies.val();

        if (!surveyCode) {
            toastr.warning('Script Seçiminde Hata Var, Sayfayı Yenilemeyi Deneyebilirsiniz');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Boş Olamaz');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Boş Olamaz');
        } else if (companyIds.length === 0) {
            toastr.warning('Firma Seçilmedi');
        } else {
            $('#loader').show();
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.operationApi.surveySystem.getSurveyDetailReportGroupById') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    surveyCode: surveyCode,
                    startDate: startDate,
                    endDate: endDate,
                    companyIds: companyIds,
                },
                success: function (response) {
                    console.log(response);
                    var dataFields = [
                        {name: 'id'},
                        {name: 'musteriAdi'},
                        {name: 'yetkili'},
                        {name: 'gorusmeNotlari'},
                        {name: 'cariId'},
                        {name: 'durum'},
                        {name: 'islemYapanKullanici'},
                        {name: 'kayitYapanKullanici'},
                        {name: 'sonucDurumu'},
                        {name: 'kayitTarihi'}
                    ];
                    var columns = [
                        {
                            text: '#',
                            dataField: 'id',
                            columntype: 'textbox',
                            width: '10%',
                        },
                        {
                            text: 'Müşteri Adı',
                            dataField: 'musteriAdi',
                            columntype: 'textbox',
                            width: '10%',
                        },
                        {
                            text: 'Yetkili Adı',
                            dataField: 'yetkili',
                            columntype: 'textbox',
                            width: '10%',
                        },
                        {
                            text: 'Görüşme Notları',
                            dataField: 'gorusmeNotlari',
                            columntype: 'textbox',
                            width: '10%',
                        },
                        {
                            text: 'Cari ID',
                            dataField: 'cariId',
                            columntype: 'textbox',
                            width: '5%',
                        },
                        {
                            text: 'Durum',
                            dataField: 'durum',
                            columntype: 'textbox',
                            width: '5%',
                        },
                        {
                            text: 'İşlemi Yapan Personel',
                            dataField: 'islemYapanKullanici',
                            columntype: 'textbox',
                            width: '10%',
                        },
                        {
                            text: 'Kayıt Yapan Personel',
                            dataField: 'kayitYapanKullanici',
                            columntype: 'textbox',
                            width: '10%',
                        },
                        {
                            text: 'Sonuç Durumu',
                            dataField: 'sonucDurumu',
                            columntype: 'textbox',
                            width: '10%',
                        },
                        {
                            text: 'Kayıt Tarihi',
                            dataField: 'kayitTarihi',
                            columntype: 'textbox',
                            width: '10%',
                        }
                    ];

                    var biggerDataCount = 0;
                    var biggerDataList = [];
                    var questions = [];

                    $.each(response.response, function (i, list) {
                        var listItemCount = list.length;
                        if (listItemCount > biggerDataCount) {
                            biggerDataList = list;
                            biggerDataCount = listItemCount;
                        }
                    });

                    $.each(biggerDataList, function (i, biggerData) {
                        var getDataField = dataFields.find(
                            function (item) {
                                return item.name === biggerData.soru;
                            }
                        );
                        if (!getDataField) {
                            dataFields.push({
                                name: biggerData.soru,
                            });
                            columns.push({
                                text: biggerData.soru,
                                dataField: biggerData.soru,
                                columntype: 'textbox',
                            });
                            questions.push(biggerData.soru);
                        }
                    });

                    var resultArray = [];
                    $.each(response.response, function (i, list) {
                        if (list.length > 1) {
                            resultArray.push({
                                id: i,
                                musteriAdi: list[0].musteriAdi,
                                yetkili: list[0].yetkili,
                                gorusmeNotlari: list[0].gorusmeNotlari,
                                cariId: list[0].cariId,
                                durum: list[0].durum,
                                islemYapanKullanici: list[0].islemYapanKullanici,
                                kayitYapanKullanici: list[0].kayitYapanKullanici,
                                sonucDurumu: list[0].sonucDurumu,
                                kayitTarihi: list[0].kayitTarihi,
                            });
                            var getResult = resultArray.find(
                                function (item) {
                                    return item.id === i;
                                }
                            );
                            $.each(questions, function (j, question) {
                                var findData = list.find(
                                    function (item) {
                                        return item.soru === question;
                                    }
                                );
                                if (findData) {
                                    getResult[question] = findData.cevap;
                                }
                            });
                        }
                    });

                    var source = {
                        localdata: resultArray,
                        datatype: "array",
                        datafields: dataFields
                    };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    reportsDiv.jqxGrid({
                        width: '100%',
                        height: '500',
                        source: dataAdapter,
                        columnsresize: true,
                        groupable: true,
                        theme: jqxGridGlobalTheme,
                        filterable: true,
                        showfilterrow: true,
                        localization: getLocalization('tr'),
                        columns: columns
                    });
                    reportsDiv.on('contextmenu', function () {
                        return false;
                    });
                    reportsDiv.on('rowclick', function (event) {
                        if (event.args.rightclick) {
                            reportsDiv.jqxGrid('selectrow', event.args.rowindex);
                            var scrollTop = $(window).scrollTop();
                            var scrollLeft = $(window).scrollLeft();
                            contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                            return false;
                        }
                    });

                    DownloadExcelButton.show();

                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Rapor Alınırken Serviste Bir Hata Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    }

    ReportButton.click(function () {
        getSurveyDetailReport();
    });

    DownloadExcelButton.click(function () {
        $('#loader').show();
        setTimeout(function () {
            reportsDiv.jqxGrid('exportdata', 'xlsx', `${survey.adi} - Detay Raporu`);
            $('#loader').hide();
        }, 250);
    });

</script>
