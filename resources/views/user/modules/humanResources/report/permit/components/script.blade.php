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

    var permitReportDiv = $('#permitReport');

    var employeeIdsSelector = $('#employeeIds');
    var typeIdsSelector = $('#typeIds');

    var SelectAllEmployeesButton = $('#SelectAllEmployeesButton');
    var UnSelectAllEmployeesButton = $('#UnSelectAllEmployeesButton');

    var ReportButton = $('#ReportButton');
    var DownloadExcelButton = $('#DownloadExcelButton');

    function getEmployeesByCompanyIds() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: SelectedCompanies.val(),
                pageIndex: 0,
                pageSize: 1000,
                leave: 0,
            },
            success: function (response) {
                employeeIdsSelector.empty();
                $.each(response.response.employees, function (i, employee) {
                    employeeIdsSelector.append(`<option value="${employee.id}">${employee.name}</option>`);
                });
                employeeIdsSelector.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Listesi Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    function getPermitTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.permitType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                typeIdsSelector.empty();
                $.each(response.response, function (i, permitType) {
                    typeIdsSelector.append(`<option value="${permitType.id}">${permitType.name}</option>`);
                });
                typeIdsSelector.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('İzin Türleri Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    function getPermitsDateBetweenByEmployeeIds() {
        var employeeIds = employeeIdsSelector.val();
        var typeIds = typeIdsSelector.val();
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        if (employeeIds.length === 0) {
            toastr.warning('Hiç Personel Seçmediniz.');
        } else if (typeIds.length === 0) {
            toastr.warning('Hiç İzin Türü Seçmediniz.');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçilmedi.');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçilmedi.');
        } else {
            DownloadExcelButton.hide();
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.permit.getDateBetweenByEmployeeIdsAndTypeIds') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    employeeIds: employeeIds,
                    typeIds: typeIds,
                    startDate: startDate,
                    endDate: endDate,
                },
                success: function (response) {
                    var start = startDate + ' 09:00:00';
                    var end = endDate + ' 18:00:00';
                    var employees = [];
                    var employeePermits = groupBy(response.response, 'employee_id');
                    $.each(employeePermits, function (i, permits) {
                        var minutes = 0;
                        $.each(permits, function (j, permit) {
                            minutes += getMinutesBetweenTwoDates(
                                new Date(permit.start_date) < new Date(start) ? start : permit.start_date,
                                new Date(permit.end_date) > new Date(end) ? end : permit.end_date
                            );
                        });
                        employees.push({
                            name: permits[0].employee.name,
                            duration: minutesToString(minutes),
                        });
                    });
                    var source = {
                        localdata: employees,
                        datatype: "array",
                        datafields:
                            [
                                {name: 'name', type: 'string'},
                                {name: 'duration', type: 'string'},
                            ]
                    };
                    var dataAdapter = new $.jqx.dataAdapter(source);
                    permitReportDiv.jqxGrid({
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
                                text: 'Personel',
                                dataField: 'name',
                                columntype: 'textbox',
                                width: '50%'
                            },
                            {
                                text: 'Toplam İzin Süresi',
                                dataField: 'duration',
                                columntype: 'textbox',
                                width: '50%'
                            }
                        ],
                    });
                    permitReportDiv.on('rowclick', function (event) {
                        permitReportDiv.jqxGrid('selectrow', event.args.rowindex);
                        var rowindex = permitReportDiv.jqxGrid('getselectedrowindex');
                        $('#selected_survey_row_index').val(rowindex);
                        var dataRecord = permitReportDiv.jqxGrid('getrowdata', rowindex);
                        $('#selected_survey_id').val(dataRecord.id);
                        $('#selected_survey_code').val(dataRecord.kodu);
                        return false;
                    });
                    permitReportDiv.jqxGrid('sortby', 'name', 'asc');
                    DownloadExcelButton.show();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İzinler Alınırken Serviste Bir Hata Oluştu.');
                    DownloadExcelButton.hide();
                }
            });
        }
    }

    getEmployeesByCompanyIds();
    getPermitTypes();

    SelectAllEmployeesButton.click(function () {
        employeeIdsSelector.selectpicker('selectAll');
    });

    UnSelectAllEmployeesButton.click(function () {
        employeeIdsSelector.selectpicker('deselectAll');
    });

    ReportButton.click(function () {
        getPermitsDateBetweenByEmployeeIds();
    });

    DownloadExcelButton.click(function () {
        window.open('{{ route('user.web.permitReport.downloadPermitReport') }}?employeeIds=' + employeeIdsSelector.val() + '&typeIds=' + typeIdsSelector.val() + '&startDate=' + $('#startDate').val() + '&endDate=' + $('#endDate').val());
    });

    SelectedCompanies.change(function () {
        getEmployeesByCompanyIds();
    });

</script>
