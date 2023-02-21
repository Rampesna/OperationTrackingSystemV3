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

    var CreateEarthquakeInformationButton = $('#CreateEarthquakeInformationButton');
    var UpdateEarthquakeInformationButton = $('#UpdateEarthquakeInformationButton');
    var DownloadExcelButton = $('#DownloadExcelButton');

    function transactions() {
        var selectedEmployeeId = $('#selected_employee_id').val();
        if (!selectedEmployeeId) {
            toastr.warning('Seçim Yapmadınız!');
        } else {
            updateEarthquakeInformation();
        }
    }

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
                pageSize: 100000,
                leave: 0,
            },
            success: function (response) {
                $('#create_earthquake_information_employee_id').empty();
                $('#update_earthquake_information_employee_id').empty();
                $.each(response.response.employees, function (i, employee) {
                    $('#create_earthquake_information_employee_id').append(`<option value="${employee.id}">${employee.name}</option>`);
                    $('#update_earthquake_information_employee_id').append(`<option value="${employee.id}">${employee.name}</option>`);
                });
                $('#create_earthquake_information_employee_id').val('').select2();
                $('#update_earthquake_information_employee_id').val('').select2();
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

    getEmployeesByCompanyIds();

    function createEarthquakeInformation() {
        $('#create_earthquake_information_employee_id').val('').select2();
        $('#create_earthquake_information_city').val('').select2();
        $('#create_earthquake_information_address').val('');
        $('#create_earthquake_information_home_status').val('').select2();
        $('#create_earthquake_information_family_health_status').val('').select2();
        $('#create_earthquake_information_working_status').val('').select2();
        $('#create_earthquake_information_working_address').val('');
        $('#create_earthquake_information_working_department').val('');
        $('#create_earthquake_information_workable_date').val('');
        $('#create_earthquake_information_computer_status').val('').select2();
        $('#create_earthquake_information_internet_status').val('').select2();
        $('#create_earthquake_information_headphone_status').val('').select2();
        $('#create_earthquake_information_general_notes').val('');
        $('#CreateEarthquakeInformationModal').modal('show');
    }

    function updateEarthquakeInformation() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.earthquakeInformation.getByEmployeeId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: $('#selected_employee_id').val()
            },
            success: function (response) {
                $('#update_earthquake_information_city').val(response.response.city).select2();
                $('#update_earthquake_information_address').val(response.response.address);
                $('#update_earthquake_information_home_status').val(response.response.home_status).select2();
                $('#update_earthquake_information_family_health_status').val(response.response.family_health_status).select2();
                $('#update_earthquake_information_working_status').val(response.response.working_status).select2();
                $('#update_earthquake_information_working_address').val(response.response.working_address);
                $('#update_earthquake_information_working_department').val(response.response.working_department);
                $('#update_earthquake_information_workable_date').val(response.response.workable_date);
                $('#update_earthquake_information_computer_status').val(response.response.computer_status).select2();
                $('#update_earthquake_information_internet_status').val(response.response.internet_status).select2();
                $('#update_earthquake_information_headphone_status').val(response.response.headphone_status).select2();
                $('#update_earthquake_information_general_notes').val(response.response.general_notes);
                $('#UpdateEarthquakeInformationModal').modal('show');
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
                        employee_id: item.employee ? item.employee.id : '',
                        employee: item.employee ? item.employee.name : '',
                        city: item.city ?? '',
                        address: item.address ?? '',
                        home_status: item.home_status ?? '',
                        family_health_status: item.family_health_status ?? '',
                        working_status: item.working_status ?? '',
                        working_address: item.working_address ?? '',
                        working_department: item.working_department ?? '',
                        workable_date: item.workable_date ?? '',
                        computer_status: item.computer_status ?? '',
                        internet_status: item.internet_status ?? '',
                        headphone_status: item.headphone_status ?? '',
                        general_notes: item.general_notes ?? '',
                    };
                });
                var source = {
                    localdata: informations,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'employee_id', type: 'string'},
                            {name: 'employee', type: 'string'},
                            {name: 'city', type: 'string'},
                            {name: 'address', type: 'string'},
                            {name: 'home_status', type: 'string'},
                            {name: 'family_health_status', type: 'string'},
                            {name: 'working_status', type: 'string'},
                            {name: 'working_address', type: 'string'},
                            {name: 'working_department', type: 'string'},
                            {name: 'workable_date', type: 'string'},
                            {name: 'computer_status', type: 'string'},
                            {name: 'internet_status', type: 'string'},
                            {name: 'headphone_status', type: 'string'},
                            {name: 'general_notes', type: 'string'},
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
                            text: '#',
                            dataField: 'employee_id',
                            columntype: 'textbox',
                            width: '3%'
                        },
                        {
                            text: 'Personel',
                            dataField: 'employee',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Şehir',
                            dataField: 'city',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Adres',
                            dataField: 'address',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Malatyadaki Ev Durumu',
                            dataField: 'home_status',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Ailede Vefat Var Mı?',
                            dataField: 'family_health_status',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Şuanda Çalışıyor Mu?',
                            dataField: 'working_status',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Şuanda Nerede Çalışıyor?',
                            dataField: 'working_address',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Hangi Kuyruk/Departmanda Çalışıyor?',
                            dataField: 'working_department',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Hangi Tarihte Çalışmaya Başlayabilir?',
                            dataField: 'workable_date',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Bilgisayar Durumu',
                            dataField: 'computer_status',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'İnternet Durumu',
                            dataField: 'internet_status',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Kulaklık Durumu',
                            dataField: 'headphone_status',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Genel Notlar',
                            dataField: 'general_notes',
                            columntype: 'textbox',
                            width: '10%'
                        }
                    ],
                });
                earthquakeInformationsDiv.on('rowclick', function (event) {
                    earthquakeInformationsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = earthquakeInformationsDiv.jqxGrid('getselectedrowindex');
                    $('#selected_employee_row_index').val(rowindex);
                    var dataRecord = earthquakeInformationsDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_employee_id').val(dataRecord.employee_id);
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

    CreateEarthquakeInformationButton.click(function () {
        var employeeId = $('#create_earthquake_information_employee_id').val();
        var city = $('#create_earthquake_information_city').val();
        var address = $('#create_earthquake_information_address').val();
        var homeStatus = $('#create_earthquake_information_home_status').val();
        var familyHealthStatus = $('#create_earthquake_information_family_health_status').val();
        var workingStatus = $('#create_earthquake_information_working_status').val();
        var workingAddress = $('#create_earthquake_information_working_address').val();
        var workingDepartment = $('#create_earthquake_information_working_department').val();
        var workableDate = $('#create_earthquake_information_workable_date').val();
        var computerStatus = $('#create_earthquake_information_computer_status').val();
        var internetStatus = $('#create_earthquake_information_internet_status').val();
        var headphoneStatus = $('#create_earthquake_information_headphone_status').val();
        var generalNotes = $('#create_earthquake_information_general_notes').val();

        if (!employeeId) {
            toastr.warning('Personel Seçmediniz!');
        } else {
            CreateEarthquakeInformationButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.earthquakeInformation.checkIfExists') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    employeeId: employeeId,
                },
                success: function () {
                    toastr.warning('Bu personel için zaten deprem bilgisi kaydı yapılmış!');
                    CreateEarthquakeInformationButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    if (parseInt(error.status) === 422) {
                        $.each(error.responseJSON.response, function (i, error) {
                            toastr.error(error[0]);
                        });
                        CreateEarthquakeInformationButton.attr('disabled', false).html(`Oluştur`);
                    } else if (parseInt(error.status) === 404) {
                        $.ajax({
                            type: 'post',
                            url: '{{ route('user.api.earthquakeInformation.create') }}',
                            headers: {
                                'Accept': 'application/json',
                                'Authorization': token
                            },
                            data: {
                                employeeId: employeeId,
                                city: city,
                                address: address,
                                homeStatus: homeStatus,
                                familyHealthStatus: familyHealthStatus,
                                workingStatus: workingStatus,
                                workingAddress: workingAddress,
                                workingDepartment: workingDepartment,
                                workableDate: workableDate,
                                computerStatus: computerStatus,
                                internetStatus: internetStatus,
                                headphoneStatus: headphoneStatus,
                                generalNotes: generalNotes
                            },
                            success: function () {
                                toastr.success('Başarıyla Oluşturuldu!');
                                CreateEarthquakeInformationButton.attr('disabled', false).html(`Oluştur`);
                                $('#CreateEarthquakeInformationModal').modal('hide');
                                getEarthquakeInformations();
                            },
                            error: function (error) {
                                console.log(error);
                                CreateEarthquakeInformationButton.attr('disabled', false).html(`Oluştur`);
                                if (parseInt(error.status) === 422) {
                                    $.each(error.responseJSON.response, function (i, error) {
                                        toastr.error(error[0]);
                                    });
                                } else {
                                    toastr.error(error.responseJSON.message);
                                }
                            }
                        });
                    } else {
                        toastr.error(error.responseJSON.message);
                        CreateEarthquakeInformationButton.attr('disabled', false).html(`Oluştur`);
                    }
                }
            });
        }
    });

    UpdateEarthquakeInformationButton.click(function () {
        var employeeId = $('#selected_employee_id').val();
        var city = $('#update_earthquake_information_city').val();
        var address = $('#update_earthquake_information_address').val();
        var homeStatus = $('#update_earthquake_information_home_status').val();
        var familyHealthStatus = $('#update_earthquake_information_family_health_status').val();
        var workingStatus = $('#update_earthquake_information_working_status').val();
        var workingAddress = $('#update_earthquake_information_working_address').val();
        var workingDepartment = $('#update_earthquake_information_working_department').val();
        var workableDate = $('#update_earthquake_information_workable_date').val();
        var computerStatus = $('#update_earthquake_information_computer_status').val();
        var internetStatus = $('#update_earthquake_information_internet_status').val();
        var headphoneStatus = $('#update_earthquake_information_headphone_status').val();
        var generalNotes = $('#update_earthquake_information_general_notes').val();

        UpdateEarthquakeInformationButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'put',
            url: '{{ route('user.api.earthquakeInformation.update') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: employeeId,
                city: city,
                address: address,
                homeStatus: homeStatus,
                familyHealthStatus: familyHealthStatus,
                workingStatus: workingStatus,
                workingAddress: workingAddress,
                workingDepartment: workingDepartment,
                workableDate: workableDate,
                computerStatus: computerStatus,
                internetStatus: internetStatus,
                headphoneStatus: headphoneStatus,
                generalNotes: generalNotes
            },
            success: function () {
                toastr.success('Başarıyla Güncellendi!');
                UpdateEarthquakeInformationButton.attr('disabled', false).html(`Güncelle`);
                $('#UpdateEarthquakeInformationModal').modal('hide');
                getEarthquakeInformations();
            },
            error: function (error) {
                console.log(error);
                UpdateEarthquakeInformationButton.attr('disabled', false).html(`Güncelle`);
                if (parseInt(error.status) === 422) {
                    $.each(error.responseJSON.response, function (i, error) {
                        toastr.error(error[0]);
                    });
                } else {
                    toastr.error(error.responseJSON.message);
                }
            }
        });
    });

    DownloadExcelButton.click(function () {
        earthquakeInformationsDiv.jqxGrid('exportdata', 'xlsx', 'Deprem Bilgileri');
    });

    $('body').on('contextmenu', function () {
        transactions();
        return false;
    });

    SelectedCompanies.change(function () {
        getEmployeesByCompanyIds();
    });

</script>
