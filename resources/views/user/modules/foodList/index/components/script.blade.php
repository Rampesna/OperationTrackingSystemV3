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

    var ReportButton = $('#ReportButton');
    var DownloadExcelButton = $('#DownloadExcelButton');

    ReportButton.click(function () {
        var companyIds = SelectedCompanies.val();
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçmediniz!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçmediniz!');
        } else {
            ReportButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.foodList.report') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyIds: companyIds,
                    startDate: startDate,
                    endDate: endDate,
                },
                success: function (response) {
                    dataFields = [
                        {name: 'employee'}
                    ];
                    columns = [
                        {
                            text: 'Personel',
                            dataField: 'employee',
                            columntype: 'textbox',
                        }
                    ];
                    $.each(response.response.dates, function (i, date) {
                        dataFields.push(
                            {name: date}
                        );
                        columns.push(
                            {
                                text: date,
                                dataField: date,
                                columntype: 'numberinput',
                            }
                        );
                    });
                    var reportSource = {
                        localdata: response.response.report,
                        datatype: "array",
                        datafields: dataFields
                    };
                    var reportDataAdapter = new $.jqx.dataAdapter(reportSource);
                    reportDiv.jqxGrid({
                        width: '100%',
                        height: '500',
                        source: reportDataAdapter,
                        columnsresize: true,
                        groupable: true,
                        theme: jqxGridGlobalTheme,
                        filterable: true,
                        showfilterrow: true,
                        localization: getLocalization('tr'),
                        columns: columns
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
                    ReportButton.attr('disabled', false).html('Raporla');
                    DownloadExcelButton.show();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Rapor Alınırken Serviste Bir Sorun Oluştu!');
                    ReportButton.attr('disabled', false).html('Raporla');
                }
            });
        }
    });

    DownloadExcelButton.click(function () {
        reportDiv.jqxGrid('exportdata', 'xlsx', `${$('#startDate').val()} - ${$('#endDate').val()} Yemek Raporu`);
    });

</script>
