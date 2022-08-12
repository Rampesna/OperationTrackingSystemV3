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

    function report() {
        var employeeIds = employeeIdsSelector.val();
        var typeIds = typeIdsSelector.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.permit.calculateAnnualPermit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeIds: employeeIds,
                permitTypeIds: typeIds,
            },
            success: function (response) {
                var source = {
                    localdata: response.response,
                    datatype: "array",
                    datafields: [
                        {name: 'name', type: 'string'},
                        {name: 'date', type: 'string'},
                    ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                permitReportDiv.jqxGrid({
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
                            dataField: 'name',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Hakediş Tarihi',
                            dataField: 'date',
                            columntype: 'textbox',
                        }
                    ]
                });
                permitReportDiv.on('contextmenu', function () {
                    return false;
                });
                permitReportDiv.on('rowclick', function (event) {
                    if (event.args.rightclick) {
                        $("#employeesGrid").jqxGrid('selectrow', event.args.rowindex);
                        var scrollTop = $(window).scrollTop();
                        var scrollLeft = $(window).scrollLeft();
                        contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                        return false;
                    }
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Yıllık İzin Hakedişi Hesaplanırken Serviste Bir Hata Oluştu.');
            }
        });
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
        report();
    });

    DownloadExcelButton.click(function () {
        permitReportDiv.jqxGrid('exportdata', 'xls', 'Yıllık İzin Hakediş Raporu');
    });

    SelectedCompanies.change(function () {
        getEmployeesByCompanyIds();
    });

</script>
