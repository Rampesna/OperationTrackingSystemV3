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

    $(document).ready(function () {
        $('#loader').hide();
    });

    var reportDiv = $('#report');
    var reportRow = $('#reportRow');
    var ReportButton = $('#ReportButton');
    var DownloadExcelButton = $('#DownloadExcelButton');

    function getDataScanSummaryList() {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        var companyIds = [];
        if (parseInt(SelectedCompany.val()) === 1 || parseInt(SelectedCompany.val()) === 1) {
            companyIds = [1, 2];
        } else {
            companyIds = [parseInt(SelectedCompany.val())];
        }

        if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçiniz.');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçiniz.');
        } else {
            $('#loader').show();
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.dataScanning.getDataScanSummaryList') }}',
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
                    var source = {
                        localdata: response.response,
                        datatype: "array",
                        datafields: [
                            {name: 'kullaniciAdSoyad', type: 'string'},
                            {name: 'deger', type: 'string'},
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
                                text: 'Personel',
                                dataField: 'kullaniciAdSoyad',
                                columntype: 'textbox',
                                width: '30%',
                            },
                            {
                                text: 'Adet',
                                dataField: 'deger',
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
                    toastr.error('Rapor Alınırken Serviste Bir Hata Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    }

    ReportButton.click(function () {
        getDataScanSummaryList();
    });

    DownloadExcelButton.click(function () {
        $('#report').jqxGrid('exportdata', 'xls', 'Telefon Bulma Özet Raporu');
    });

</script>
