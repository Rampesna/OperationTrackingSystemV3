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

    var reportDiv = $('#report');
    var allSpecialReports = [];

    var startDateInput = $('#startDate');
    var endDateInput = $('#endDate');
    var specialReportsInput = $('#specialReports');

    var employeeReportDiv = $('#employeeReport');
    var statusReportDiv = $('#statusReport');

    var ReportButton = $('#ReportButton');

    function getSpecialReportsByCompanyIds() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.specialReport.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: 0,
                pageSize: 1000,
            },
            success: function (response) {
                allSpecialReports = response.response.specialReports;
                specialReportsInput.empty();
                $.each(response.response.specialReports, function (i, specialReport) {
                    specialReportsInput.append(`<option value="${specialReport.id}">${specialReport.name}</option>`);
                });
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Rapor Listesi Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getSpecialReportsByCompanyIds();

    SelectedCompanies.change(function () {
        getSpecialReportsByCompanyIds();
    });

    ReportButton.click(function () {
        var startDate = startDateInput.val();
        var endDate = endDateInput.val();
        var specialReportId = specialReportsInput.val();

        if (!startDate) {
            toastr.warning('Başlangıç Tarihi Boş Olamaz!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Boş Olamaz!');
        } else if (!specialReportId) {
            toastr.warning('Rapor Boş Olamaz!');
        } else {
            $('#loader').show();
            var query = allSpecialReports.find(report => parseInt(report.id) === parseInt(specialReportId)).query;
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.operationApi.specialReport.getSpecialReport') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    query: query,
                },
                success: function (response) {
                    var dataFields = [];
                    var columns = [];

                    $.each(response.response[0], function (key) {
                        dataFields.push({
                            name: `${key}`,
                            type: 'string'
                        });

                        columns.push({
                            text: `${key}`,
                            dataField: `${key}`,
                            columntype: 'textbox'
                        });
                    });

                    var source = {
                        localdata: response.response,
                        datatype: "array",
                        datafields: dataFields
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
                        sortable: true,
                        pagesizeoptions: ['10', '20', '50', '1000'],
                        localization: getLocalization('tr'),
                        columns: columns,
                    });
                    reportDiv.on('contextmenu', function (e) {
                        var top = e.pageY - 10;
                        var left = e.pageX - 10;

                        $("#context-menu").css({
                            display: "block",
                            top: top,
                            left: left
                        });

                        return false;
                    });
                    reportDiv.on('rowclick', function (event) {
                        if (event.args.rightclick) {
                            reportDiv.jqxGrid('selectrow', event.args.rowindex);
                            var rowindex = reportDiv.jqxGrid('getselectedrowindex');
                            $('#selected_row_index').val(rowindex);
                            var dataRecord = reportDiv.jqxGrid('getrowdata', rowindex);
                            $('#id_edit').val(dataRecord.id);
                            $('#deleting').html(dataRecord.adi);
                            return false;
                        } else {
                            $("#context-menu").hide();
                        }
                    });
                    reportDiv.jqxGrid('sortby', 'id', 'desc');

                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Rapor Alınırken Serviste Bir Sorun Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

</script>
