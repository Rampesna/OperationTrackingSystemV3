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

    var selectedStatusesArray = [];

    var ReportButton = $('#ReportButton');
    var ReportSelectedStatusesButton = $('#ReportSelectedStatusesButton');

    var reportCards = $('#reportCards');
    var reportsRow = $('#reportsRow');
    var reportsSection = $('#reportsSection');

    var wantedReportsDiv = $('#wantedReports');
    var remainingReportsDiv = $('#remainingReports');
    var statusReportsDiv = $('#statusReports');

    function setSelectedStatusesArray() {
        selectedStatusesArray = [];
        var selectedStatuses = $('.selectedStatus');
        $.each(selectedStatuses, function (i, status) {
            selectedStatusesArray.push($(status).attr('data-id'));
        });
        if (selectedStatusesArray.length > 0) {
            ReportSelectedStatusesButton.show();
        } else {
            ReportSelectedStatusesButton.hide();
        }
    }

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

    ReportButton.click(function () {
        var surveyCode = parseInt('{{ $code }}');
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        var companyIds = SelectedCompanies.val();

        if (!surveyCode) {
            toastr.warning('Script Kodunda Hata Var, Sayfayı Yenilemeyi Deneyin!');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçilmedi!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçilmedi!');
        } else if (companyIds.length === 0) {
            toastr.warning('Firma Seçilmedi!');
        } else {
            $('#loader').show();
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.operationApi.surveySystem.getSurveyReport') }}',
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

                    var unReachableCustomers = response.response.find(function (data) {
                        return parseInt(data.pazarlamaDurumKodu) === 1;
                    }).aranandatA1;

                    reportCards.html('');
                    reportsRow.html('');
                    reportCards.append(`
                    <div class="col-xl-3 mb-5">
                        <div class="card">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column py-0">
                                <div class="d-flex flex-column my-7">
                                    <span class="fw-bold fs-2x text-gray-800 lh-1 ls-n2" id="totalSpan">
                                        ${response.response[0].toplamadata ?? '--'}
                                    </span>
                                    <div class="mt-2">
                                        <span class="fw-bold fs-5 text-gray-400">Toplam Arama Sayısı</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 mb-5">
                        <div class="card cursor-pointer typeSelector" data-type="wantedDetails">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column py-0">
                                <div class="d-flex flex-column my-7">
                                    <span class="fw-bold fs-2x text-gray-800 lh-1 ls-n2" id="totalSpan">
                                        ${response.response[0].aranandata ?? '--'}
                                    </span>
                                    <div class="mt-2">
                                        <span class="fw-bold fs-5 text-gray-400">Toplam Aranan Firma</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 mb-5">
                        <div class="card cursor-pointer typeSelector" data-type="remainingDetails">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column py-0">
                                <div class="d-flex flex-column my-7">
                                    <span class="fw-bold fs-2x text-gray-800 lh-1 ls-n2" id="totalSpan">
                                        ${response.response[0].kalandata ?? '--'}
                                    </span>
                                    <div class="mt-2">
                                        <span class="fw-bold fs-5 text-gray-400">Kalan Arama Sayısı</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 mb-5">
                        <div class="card cursor-pointer typeSelector" data-type="statusDetails">
                            <div class="card-body d-flex justify-content-between align-items-start flex-column py-0">
                                <div class="d-flex flex-column my-7">
                                    <span class="fw-bold fs-2x text-gray-800 lh-1 ls-n2" id="totalSpan">
                                        ${unReachableCustomers ?? '--'}
                                    </span>
                                    <div class="mt-2">
                                        <span class="fw-bold fs-5 text-gray-400">Müşteriye Ulaşılamadı</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);

                    $.each(response.response, function (i, reportData) {
                        reportsRow.append(`
                        <div class="col-xl-2 mb-3">
                            <div class="card cursor-pointer statusSelector" data-id="${reportData.pazarlamaDurumKodu}">
                                <div class="card-body">
                                    <span class="card-title font-weight-bolder fs-3 mb-0 d-block dataCardSelectorCounter">${reportData.aranandatA1}</span>
                                    <span class="font-weight-bold font-size-sm dataCardSelectorTitle">${reportData.adi}</span>
                                </div>
                            </div>
                        </div>
                        `);
                    });

                    reportsSection.show();

                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Script Raporu Alınırken Serviste Bir Hata Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    $(document).delegate('.typeSelector', 'click', function () {
        var surveyCode = parseInt('{{ $code }}');
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        var statusCodes = selectedStatusesArray;

        var type = $(this).data('type');
        if (type === 'wantedDetails') {
            wantedReportsDiv.show();
            remainingReportsDiv.hide();
            statusReportsDiv.hide();
            $('#loader').show();
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.operationApi.surveySystem.getSurveyReportWantedDetails') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    surveyCode: surveyCode,
                },
                success: function (response) {
                    var source = {
                        localdata: response.response,
                        datatype: "array",
                        datafields: [
                            {name: 'id'},
                            {name: 'islemTarihi1'},
                            {name: 'kullaniciAdSoyad'},
                            {name: 'cariId'},
                            {name: 'musteriAdi'},
                            {name: 'gorusmeNotlari'},
                        ]
                    };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    wantedReportsDiv.jqxGrid({
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
                                text: 'İşlem Tarihi',
                                dataField: 'islemTarihi1',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Personel',
                                dataField: 'kullaniciAdSoyad',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Cari ID',
                                dataField: 'cariId',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Müşteri Adı',
                                dataField: 'musteriAdi',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Görüşme Notları',
                                dataField: 'gorusmeNotlari',
                                columntype: 'textbox',
                            }
                        ]
                    });
                    wantedReportsDiv.on('contextmenu', function () {
                        return false;
                    });
                    wantedReportsDiv.on('rowclick', function (event) {
                        if (event.args.rightclick) {
                            wantedReportsDiv.jqxGrid('selectrow', event.args.rowindex);
                            var scrollTop = $(window).scrollTop();
                            var scrollLeft = $(window).scrollLeft();
                            contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                            return false;
                        }
                    });
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Rapor Alınırken Serviste Bir Hata Oluştu!');
                    $('#loader').hide();
                }
            });
        } else if (type === 'remainingDetails') {
            wantedReportsDiv.hide();
            remainingReportsDiv.show();
            statusReportsDiv.hide();
            $('#loader').show();
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.operationApi.surveySystem.getSurveyReportRemainingDetails') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    surveyCode: surveyCode,
                    startDate: startDate,
                    endDate: endDate,
                },
                success: function (response) {
                    var source = {
                        localdata: response.response,
                        datatype: "array",
                        datafields: [
                            {name: 'id'},
                            {name: 'cariid'},
                            {name: 'grupkodu'},
                        ]
                    };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    remainingReportsDiv.jqxGrid({
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
                                text: 'cari ID',
                                dataField: 'cariid',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Grup Kodu',
                                dataField: 'grupkodu',
                                columntype: 'textbox',
                            }
                        ]
                    });
                    remainingReportsDiv.on('contextmenu', function () {
                        return false;
                    });
                    remainingReportsDiv.on('rowclick', function (event) {
                        if (event.args.rightclick) {
                            remainingReportsDiv.jqxGrid('selectrow', event.args.rowindex);
                            var scrollTop = $(window).scrollTop();
                            var scrollLeft = $(window).scrollLeft();
                            contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                            return false;
                        }
                    });
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Rapor Alınırken Serviste Bir Hata Oluştu!');
                    $('#loader').hide();
                }
            });
        } else if (type === 'statusDetails') {
            wantedReportsDiv.hide();
            remainingReportsDiv.hide();
            statusReportsDiv.show();
            $('#loader').show();
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.operationApi.surveySystem.getSurveyReportStatusDetails') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    surveyCode: surveyCode,
                    startDate: startDate,
                    endDate: endDate,
                    statusCodes: [
                        {
                            statusCode: 1
                        }
                    ],
                },
                success: function (response) {
                    var source = {
                        localdata: response.response,
                        datatype: "array",
                        datafields: [
                            {name: 'id'},
                            {name: 'islemTarihi1'},
                            {name: 'kullaniciAdSoyad'},
                            {name: 'cariId'},
                            {name: 'musteriAdi'},
                            {name: 'gorusmeNotlari'},
                        ]
                    };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    statusReportsDiv.jqxGrid({
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
                                text: 'İşlem Tarihi',
                                dataField: 'islemTarihi1',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Personel',
                                dataField: 'kullaniciAdSoyad',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Cari ID',
                                dataField: 'cariId',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Müşteri Adı',
                                dataField: 'musteriAdi',
                                columntype: 'textbox',
                            },
                            {
                                text: 'Görüşme Notları',
                                dataField: 'gorusmeNotlari',
                                columntype: 'textbox',
                            }
                        ]
                    });
                    statusReportsDiv.on('contextmenu', function () {
                        return false;
                    });
                    statusReportsDiv.on('rowclick', function (event) {
                        if (event.args.rightclick) {
                            statusReportsDiv.jqxGrid('selectrow', event.args.rowindex);
                            var scrollTop = $(window).scrollTop();
                            var scrollLeft = $(window).scrollLeft();
                            contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                            return false;
                        }
                    });
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

    $(document).delegate('.statusSelector', 'click', function () {
        $(this).toggleClass('selectedStatus');
        setSelectedStatusesArray();
    });

    ReportSelectedStatusesButton.click(function () {
        var surveyCode = parseInt('{{ $code }}');
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        wantedReportsDiv.hide();
        remainingReportsDiv.hide();
        statusReportsDiv.show();
        $('#loader').show();

        var statusCodes = [];
        $.each(selectedStatusesArray, function (i, status) {
            statusCodes.push({
                statusCode: status
            });
        });

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyReportStatusDetails') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                surveyCode: surveyCode,
                startDate: startDate,
                endDate: endDate,
                statusCodes: statusCodes,
            },
            success: function (response) {
                var source = {
                    localdata: response.response,
                    datatype: "array",
                    datafields: [
                        {name: 'id'},
                        {name: 'islemTarihi1'},
                        {name: 'kullaniciAdSoyad'},
                        {name: 'cariId'},
                        {name: 'musteriAdi'},
                        {name: 'gorusmeNotlari'},
                    ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                statusReportsDiv.jqxGrid({
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
                            text: 'İşlem Tarihi',
                            dataField: 'islemTarihi1',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Personel',
                            dataField: 'kullaniciAdSoyad',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Cari ID',
                            dataField: 'cariId',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Müşteri Adı',
                            dataField: 'musteriAdi',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Görüşme Notları',
                            dataField: 'gorusmeNotlari',
                            columntype: 'textbox',
                        }
                    ]
                });
                statusReportsDiv.on('contextmenu', function () {
                    return false;
                });
                statusReportsDiv.on('rowclick', function (event) {
                    if (event.args.rightclick) {
                        statusReportsDiv.jqxGrid('selectrow', event.args.rowindex);
                        var scrollTop = $(window).scrollTop();
                        var scrollLeft = $(window).scrollLeft();
                        contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                        return false;
                    }
                });
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Rapor Alınırken Serviste Bir Hata Oluştu!');
                $('#loader').hide();
            }
        });
    });

</script>
