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

    var DownloadExcelButton = $('#DownloadExcelButton');

    var bloodGroupReportDiv = $('#bloodGroupReport');

    function getEmployeesByCompanyIdsWithPersonalInformation() {
        DownloadExcelButton.hide();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getByCompanyIdsWithPersonalInformation') }}',
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
                var data = [];
                $.each(response.response.employees, function (i, employee) {
                    data.push({
                        name: employee.name,
                        bloodGroup: employee.personal_information ? (employee.personal_information.blood_group ? employee.personal_information.blood_group : '') : '',
                    });
                });
                var source = {
                    localdata: data,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'name', type: 'string'},
                            {name: 'bloodGroup', type: 'string'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                bloodGroupReportDiv.jqxGrid({
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
                            text: 'Kan Grubu',
                            dataField: 'bloodGroup',
                            columntype: 'textbox',
                            width: '50%'
                        }
                    ],
                });
                bloodGroupReportDiv.on('rowclick', function (event) {
                    bloodGroupReportDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = bloodGroupReportDiv.jqxGrid('getselectedrowindex');
                    $('#selected_survey_row_index').val(rowindex);
                    var dataRecord = bloodGroupReportDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_survey_id').val(dataRecord.id);
                    $('#selected_survey_code').val(dataRecord.kodu);
                    return false;
                });
                bloodGroupReportDiv.jqxGrid('sortby', 'name', 'asc');
                DownloadExcelButton.show();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Rapor Alınırken Serviste Bir Sorun Oluştu!');
                DownloadExcelButton.hide();
            }
        });
    }

    getEmployeesByCompanyIdsWithPersonalInformation();

    DownloadExcelButton.click(function () {
        bloodGroupReportDiv.jqxGrid('exportdata', 'xls', 'Kan Grubu Raporu');
    });

    SelectedCompanies.change(function () {
        getEmployeesByCompanyIdsWithPersonalInformation();
    });

</script>
