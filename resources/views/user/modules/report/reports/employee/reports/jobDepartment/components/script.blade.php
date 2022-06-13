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
    var DownloadExcelButton = $('#DownloadExcelButton');

    function getEmployees() {
        var companyIds = [];
        $.each(SelectedCompanies.val(), function (i, SelectedCompany) {
            companyIds.push(parseInt(SelectedCompany));
        });

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getByCompanies') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: 0,
                pageSize: 1000,
                leave: 0
            },
            success: function (response) {
                var employees = [];
                $.each(response.response, function (i, employee) {
                    employees.push({
                        name: employee.name,
                        job_department: employee.job_department ? employee.job_department.name : ''
                    });
                });

                var source = {
                    localdata: employees,
                    datatype: "array",
                    datafields: [
                        {name: 'name', type: 'string'},
                        {name: 'job_department', type: 'string'},
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
                            dataField: 'name',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Departman',
                            dataField: 'job_department',
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

                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Listesi Alınırken Serviste Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin!');
                $('#loader').hide();
            }
        });
    }

    getEmployees();

    SelectedCompanies.change(function () {
        getEmployees();
    });

    DownloadExcelButton.click(function () {
        $("#report").jqxGrid('exportdata', 'xlsx', 'Personel Departman Raporu');
    });

</script>
