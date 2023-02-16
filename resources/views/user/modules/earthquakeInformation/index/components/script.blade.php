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

    var earthquakeInformationsDiv = $('#earthquakeInformations');

    var DownloadExcelButton = $('#DownloadExcelButton');

    function getEarthquakeInformations() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.earthquakeInformation.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                let informations = response.response.map(function (item) {
                    return {
                        employee: item.employee ? item.employee.name : '',
                        city: item.city_id ?? '',
                        address: item.address ?? '',
                        home_status: item.home_status ?? '',
                        family_health_status: item.family_health_status ?? '',
                        work_status: item.work_status ?? '',
                        computer_status: item.computer_status ?? '',
                        internet_status: item.internet_status ?? '',
                        headphone_status: item.headphone_status ?? '',
                    };
                });
                var source = {
                    localdata: informations,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'employee', type: 'string'},
                            {name: 'city', type: 'string'},
                            {name: 'address', type: 'string'},
                            {name: 'home_status', type: 'string'},
                            {name: 'family_health_status', type: 'string'},
                            {name: 'work_status', type: 'string'},
                            {name: 'computer_status', type: 'string'},
                            {name: 'internet_status', type: 'string'},
                            {name: 'headphone_status', type: 'string'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                earthquakeInformationsDiv.jqxGrid({
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
                            dataField: 'employee',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Şehir',
                            dataField: 'city',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Adres',
                            dataField: 'address',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Ev Durumu',
                            dataField: 'home_status',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Aile Sağlık Durumu',
                            dataField: 'family_health_status',
                            columntype: 'textbox',
                        },
                        {
                            text: 'İş Durumu',
                            dataField: 'work_status',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Bilgisayar Durumu',
                            dataField: 'computer_status',
                            columntype: 'textbox',
                        },
                        {
                            text: 'İnternet Durumu',
                            dataField: 'internet_status',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Kulaklık Durumu',
                            dataField: 'headphone_status',
                            columntype: 'textbox',
                        }
                    ],
                });
                earthquakeInformationsDiv.on('rowclick', function (event) {
                    earthquakeInformationsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = earthquakeInformationsDiv.jqxGrid('getselectedrowindex');
                    $('#selected_survey_row_index').val(rowindex);
                    var dataRecord = earthquakeInformationsDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_survey_id').val(dataRecord.id);
                    $('#selected_survey_code').val(dataRecord.kodu);
                    return false;
                });
                earthquakeInformationsDiv.jqxGrid('sortby', 'id', 'desc');
                $('#DownloadExcelButtonArea').show();
            },
            error: function (error) {
                console.log(error);
                if (parseInt(error.status) === 422) {
                    $.each(error.responseJSON.response, function (i, error) {
                        toastr.error(error[0]);
                    });
                } else {
                    toastr.error(error.responseJSON.message);
                }
            }
        });
    }

    getEarthquakeInformations();

    DownloadExcelButton.click(function () {
        earthquakeInformationsDiv.jqxGrid('exportdata', 'xlsx', 'Deprem Bilgileri');
    });

</script>
