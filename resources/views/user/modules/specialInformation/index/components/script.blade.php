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

    var specialInformationsDiv = $('#specialInformations');

    var CreateSpecialInformationButton = $('#CreateSpecialInformationButton');
    var UpdateSpecialInformationButton = $('#UpdateSpecialInformationButton');
    var DownloadExcelButton = $('#DownloadExcelButton');

    function goToUnRegistereds() {
        window.location.href = '{{ route('user.web.specialInformation.employee') }}';
    }

    function transactions() {
        var selectedEmployeeId = $('#selected_employee_id').val();
        if (!selectedEmployeeId) {
            toastr.warning('Seçim Yapmadınız!');
        } else {
            updateSpecialInformation();
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
                $('#create_special_information_employee_id').empty();
                $('#update_special_information_employee_id').empty();
                $.each(response.response.employees, function (i, employee) {
                    $('#create_special_information_employee_id').append(`<option value="${employee.id}">${employee.name}</option>`);
                    $('#update_special_information_employee_id').append(`<option value="${employee.id}">${employee.name}</option>`);
                });
                $('#create_special_information_employee_id').val('').select2();
                $('#update_special_information_employee_id').val('').select2();
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

    function createSpecialInformation() {
        $('#create_special_information_employee_id').val('').select2();
        $('#create_special_information_city').val('').select2();
        $('#create_special_information_current_office').val('').select2();
        $('#create_special_information_address').val('');
        $('#create_special_information_working_status').val('').select2();
        $('#create_special_information_general_status').val('').select2();
        $('#create_special_information_general_equipment_status').val('').select2();
        $('#create_special_information_computer_status').val('').select2();
        $('#create_special_information_internet_status').val('').select2();
        $('#create_special_information_headphone_status').val('').select2();
        $('#create_special_information_workable_date').val('');
        $('#create_special_information_general_notes').val('');
        $('#CreateSpecialInformationModal').modal('show');
    }

    function updateSpecialInformation() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.specialInformation.getByEmployeeId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: $('#selected_employee_id').val()
            },
            success: function (response) {
                $('#update_special_information_city').val(response.response.city).select2();
                $('#update_special_information_current_office').val(response.response.current_office).select2();
                $('#update_special_information_address').val(response.response.address);
                $('#update_special_information_working_status').val(response.response.working_status).select2();
                $('#update_special_information_general_status').val(response.response.general_status).select2();
                $('#update_special_information_general_equipment_status').val(response.response.general_equipment_status).select2();
                $('#update_special_information_computer_status').val(response.response.computer_status).select2();
                $('#update_special_information_internet_status').val(response.response.internet_status).select2();
                $('#update_special_information_headphone_status').val(response.response.headphone_status).select2();
                $('#update_special_information_workable_date').val(response.response.workable_date);
                $('#update_special_information_general_notes').val(response.response.general_notes);
                $('#UpdateSpecialInformationModal').modal('show');
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

    function getSpecialInformations() {
        var companyIds = SelectedCompanies.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.specialInformation.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
            },
            success: function (response) {
                let informations = response.response.map(function (item) {
                    return {
                        employee_id: item.employee ? item.employee.id : '',
                        employee: item.employee ? item.employee.name : '',
                        city: item.city ?? '',
                        current_office: item.current_office ?? '',
                        address: item.address ?? '',
                        working_status: item.working_status ?? '',
                        general_status: item.general_status ?? '',
                        general_equipment_status: item.general_equipment_status ?? '',
                        computer_status: item.computer_status ?? '',
                        internet_status: item.internet_status ?? '',
                        headphone_status: item.headphone_status ?? '',
                        workable_date: item.workable_date ?? '',
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
                            {name: 'current_office', type: 'string'},
                            {name: 'address', type: 'string'},
                            {name: 'working_status', type: 'string'},
                            {name: 'general_status', type: 'string'},
                            {name: 'general_equipment_status', type: 'string'},
                            {name: 'computer_status', type: 'string'},
                            {name: 'internet_status', type: 'string'},
                            {name: 'headphone_status', type: 'string'},
                            {name: 'workable_date', type: 'string'},
                            {name: 'general_notes', type: 'string'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                specialInformationsDiv.jqxGrid({
                    width: '100%',
                    height: '600',
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
                            text: 'Şuanda Bulunduğu Şehir',
                            dataField: 'city',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Şuanda Bulunduğu Ofis',
                            dataField: 'current_office',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Şuanda Bulunduğ Adres',
                            dataField: 'address',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'İş Durumu',
                            dataField: 'working_status',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Genel Durum',
                            dataField: 'general_status',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Genel Ekipman Durumu',
                            dataField: 'general_equipment_status',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Bilgisayar',
                            dataField: 'computer_status',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'İnternet',
                            dataField: 'internet_status',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Kulaklık',
                            dataField: 'headphone_status',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'İşe Başlama Tarihi',
                            dataField: 'workable_date',
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
                specialInformationsDiv.on('rowclick', function (event) {
                    specialInformationsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = specialInformationsDiv.jqxGrid('getselectedrowindex');
                    $('#selected_employee_row_index').val(rowindex);
                    var dataRecord = specialInformationsDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_employee_id').val(dataRecord.employee_id);
                    return false;
                });
                specialInformationsDiv.jqxGrid('sortby', 'id', 'desc');
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

    getSpecialInformations();

    CreateSpecialInformationButton.click(function () {
        var employeeId = $('#create_special_information_employee_id').val();
        var city = $('#create_special_information_city').val();
        var currentOffice = $('#create_special_information_current_office').val();
        var address = $('#create_special_information_address').val();
        var workingStatus = $('#create_special_information_working_status').val();
        var generalStatus = $('#create_special_information_general_status').val();
        var generalEquipmentStatus = $('#create_special_information_general_equipment_status').val();
        var computerStatus = $('#create_special_information_computer_status').val();
        var internetStatus = $('#create_special_information_internet_status').val();
        var headphoneStatus = $('#create_special_information_headphone_status').val();
        var workableDate = $('#create_special_information_workable_date').val();
        var generalNotes = $('#create_special_information_general_notes').val();
        if (!employeeId) {
            toastr.warning('Personel Seçmediniz!');
        } else {
            CreateSpecialInformationButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.specialInformation.checkIfExists') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    employeeId: employeeId,
                },
                success: function () {
                    toastr.warning('Bu personel için zaten özel bilgi kaydı yapılmış!');
                    CreateSpecialInformationButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    if (parseInt(error.status) === 422) {
                        $.each(error.responseJSON.response, function (i, error) {
                            toastr.error(error[0]);
                        });
                        CreateSpecialInformationButton.attr('disabled', false).html(`Oluştur`);
                    } else if (parseInt(error.status) === 404) {
                        $.ajax({
                            type: 'post',
                            url: '{{ route('user.api.specialInformation.create') }}',
                            headers: {
                                'Accept': 'application/json',
                                'Authorization': token
                            },
                            data: {
                                employeeId: employeeId,
                                city: city,
                                currentOffice: currentOffice,
                                address: address,
                                workingStatus: workingStatus,
                                generalStatus: generalStatus,
                                generalEquipmentStatus: generalEquipmentStatus,
                                computerStatus: computerStatus,
                                internetStatus: internetStatus,
                                headphoneStatus: headphoneStatus,
                                workableDate: workableDate,
                                generalNotes: generalNotes,
                            },
                            success: function () {
                                toastr.success('Başarıyla Oluşturuldu!');
                                CreateSpecialInformationButton.attr('disabled', false).html(`Oluştur`);
                                $('#CreateSpecialInformationModal').modal('hide');
                                getSpecialInformations();
                            },
                            error: function (error) {
                                console.log(error);
                                CreateSpecialInformationButton.attr('disabled', false).html(`Oluştur`);
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
                        CreateSpecialInformationButton.attr('disabled', false).html(`Oluştur`);
                    }
                }
            });
        }
    });

    UpdateSpecialInformationButton.click(function () {
        var employeeId = $('#selected_employee_id').val();
        var city = $('#update_special_information_city').val();
        var currentOffice = $('#update_special_information_current_office').val();
        var address = $('#update_special_information_address').val();
        var workingStatus = $('#update_special_information_working_status').val();
        var generalStatus = $('#update_special_information_general_status').val();
        var generalEquipmentStatus = $('#update_special_information_general_equipment_status').val();
        var computerStatus = $('#update_special_information_computer_status').val();
        var internetStatus = $('#update_special_information_internet_status').val();
        var headphoneStatus = $('#update_special_information_headphone_status').val();
        var workableDate = $('#update_special_information_workable_date').val();
        var generalNotes = $('#update_special_information_general_notes').val();

        UpdateSpecialInformationButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'put',
            url: '{{ route('user.api.specialInformation.update') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: employeeId,
                city: city,
                currentOffice: currentOffice,
                address: address,
                workingStatus: workingStatus,
                generalStatus: generalStatus,
                generalEquipmentStatus: generalEquipmentStatus,
                computerStatus: computerStatus,
                internetStatus: internetStatus,
                headphoneStatus: headphoneStatus,
                workableDate: workableDate,
                generalNotes: generalNotes,
            },
            success: function () {
                toastr.success('Başarıyla Güncellendi!');
                UpdateSpecialInformationButton.attr('disabled', false).html(`Güncelle`);
                $('#UpdateSpecialInformationModal').modal('hide');
                getSpecialInformations();
            },
            error: function (error) {
                console.log(error);
                UpdateSpecialInformationButton.attr('disabled', false).html(`Güncelle`);
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
        specialInformationsDiv.jqxGrid('exportdata', 'xlsx', 'Personel Özel Bilgileri');
    });

    $('body').on('contextmenu', function () {
        transactions();
        return false;
    });

    SelectedCompanies.change(function () {
        getEmployeesByCompanyIds();
    });

</script>
