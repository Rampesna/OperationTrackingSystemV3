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

    var startDateInput = $('#startDate');
    var endDateInput = $('#endDate');
    var reportTypeInput = $('#reportType');

    var employeeReportDiv = $('#employeeReport');
    var statusReportDiv = $('#statusReport');

    var ReportButton = $('#ReportButton');

    ReportButton.click(function () {
        var startDate = startDateInput.val();
        var endDate = endDateInput.val();
        var reportType = reportTypeInput.val();

        if (!startDate) {
            toastr.warning('Başlangıç Tarihi Boş Olamaz!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Boş Olamaz!');
        } else if (!reportType) {
            toastr.warning('Rapor Türü Boş Olamaz!');
        } else {
            $('#loader').show();
            employeeReportDiv.hide();
            statusReportDiv.hide();
            if (parseInt(reportType) === 1) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('user.api.operation.getDataScreening') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        startDate: startDate,
                        endDate: endDate,
                    },
                    success: function (response) {

                        var source = {
                            localdata: response.response,
                            datatype: "array",
                            datafields: [
                                {name: 'kullaniciAdSoyad', type: 'string'},
                                {name: 'toplam', type: 'integer'},
                            ]
                        };
                        var dataAdapter = new $.jqx.dataAdapter(source);
                        employeeReportDiv.jqxGrid({
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
                                },
                                {
                                    text: 'Adet',
                                    dataField: 'toplam',
                                    columntype: 'textbox',
                                }
                            ]
                        });
                        employeeReportDiv.on('contextmenu', function () {
                            return false;
                        });
                        employeeReportDiv.on('rowclick', function (event) {
                            if (event.args.rightclick) {
                                $("#employeesGrid").jqxGrid('selectrow', event.args.rowindex);
                                var scrollTop = $(window).scrollTop();
                                var scrollLeft = $(window).scrollLeft();
                                contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                                return false;
                            }
                        });
                        employeeReportDiv.show();

                        $('#loader').hide();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Rapor Alınırken Serviste Bir Sorun Oluştu!');
                        $('#loader').hide();
                    }
                });
            } else if (parseInt(reportType) === 2) {
                $('#loader').hide();
            } else {
                toastr.warning('Geçersiz Rapor Türü!');
            }
        }
    });

</script>
