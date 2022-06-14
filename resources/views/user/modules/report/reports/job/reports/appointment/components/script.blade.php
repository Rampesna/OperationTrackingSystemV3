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

    var DownloadExcelButton = $('#DownloadExcelButton');

    function getGetPersonAppointmentReport() {
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
            url: '{{ route('user.api.operationApi.personReport.getPersonAppointmentReport') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
            },
            success: function (response) {
                var appointments = response.response;
                var now = new Date();
                $.each(appointments, function (i, item) {
                    var appointmentDate = new Date(item.randevuTarihi);
                    item.late = now.getTime() > appointmentDate.getTime() ? 'Gecikti' : 'Gecikmedi';
                });

                var source = {
                    localdata: appointments,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'kullaniciAdSoyad', type: 'string'},
                            {name: 'late', type: 'string'},
                            {name: 'kayitTarihi', type: 'string'},
                            {name: 'randevuTarihi', type: 'string'},
                            {name: 'randevuNotu', type: 'string'},
                            {name: 'randevuAciklama', type: 'string'},
                            {name: 'durumKodu', type: 'string'},
                            {name: 'musterilerId', type: 'string'},
                            {name: 'yapilacakIslerId', type: 'string'},
                            {name: 'yapilanIslerId', type: 'string'},
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
                    pageable: true,
                    pagesizeoptions: ['10', '20', '50', '1000'],
                    localization: getLocalization('tr'),
                    columns: [
                        {
                            text: 'Personel',
                            dataField: 'kullaniciAdSoyad',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Gecikti Mi',
                            dataField: 'late',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Olusturulma Tarihi',
                            dataField: 'kayitTarihi',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Randevu Tarihi',
                            dataField: 'randevuTarihi',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Randevu Notu',
                            dataField: 'randevuNotu',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Açıklamalar',
                            dataField: 'randevuAciklama',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Durum Kodu',
                            dataField: 'durumKodu',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Müşteri ID',
                            dataField: 'musterilerId',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Yapılacak İşler ID',
                            dataField: 'yapilacakIslerId',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Yapılan İşler ID',
                            dataField: 'yapilanIslerId',
                            columntype: 'textbox',
                        }
                    ]
                });
                reportDiv.on('contextmenu', function () {
                    return false;
                });
                reportDiv.on('rowclick', function (event) {
                    if (event.args.rightclick) {
                        $("#grid").jqxGrid('selectrow', event.args.rowindex);
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
                toastr.error('Rapor Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getGetPersonAppointmentReport();

    DownloadExcelButton.click(function () {
        $('#report').jqxGrid('exportdata', 'xls', 'Telefon Bulma Özet Raporu');
    });

</script>
