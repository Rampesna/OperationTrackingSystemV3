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
    var DownloadExcelButton = $('#DownloadExcelButton');

    function getEmployeeSkillInventoryByCompanyId() {
        var companyIds = [];
        $.each(SelectedCompanies.val(), function (i, SelectedCompany) {
            companyIds.push(parseInt(SelectedCompany));
        });

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employeeSkillInventory.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
            },
            success: function (response) {
                let employeeSkillInventories = response.response.map(function (item) {
                    return {
                        employee_id: item.employee ? item.employee.id : '',
                        employee: item.employee ? item.employee.name : '',
                        central_code: item.central_code,
                        department: item.department,
                        education_level: item.education_level,
                        languages: item.languages,
                        certificates: item.certificates,
                        job_start_date: item.job_start_date,
                        products: item.products,
                        total_work_experience: item.total_work_experience,
                        age: item.age,
                        gender: item.gender,
                        hobbies: item.hobbies,
                        old_work_companies: item.old_work_companies,
                        old_work_positions: item.old_work_positions,
                        future_works_taken: item.future_works_taken,
                        notes: item.notes,
                    };
                });
                var source = {
                    localdata: employeeSkillInventories,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'employee_id', type: 'string'},
                            {name: 'employee', type: 'string'},
                            {name: 'central_code', type: 'string'},
                            {name: 'department', type: 'string'},
                            {name: 'education_level', type: 'string'},
                            {name: 'languages', type: 'string'},
                            {name: 'certificates', type: 'string'},
                            {name: 'job_start_date', type: 'string'},
                            {name: 'products', type: 'string'},
                            {name: 'total_work_experience', type: 'string'},
                            {name: 'age', type: 'string'},
                            {name: 'gender', type: 'string'},
                            {name: 'hobbies', type: 'string'},
                            {name: 'old_work_companies', type: 'string'},
                            {name: 'old_work_positions', type: 'string'},
                            {name: 'future_works_taken', type: 'string'},
                            {name: 'notes', type: 'string'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                reportDiv.jqxGrid({
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
                            text: 'Dahili',
                            dataField: 'central_code',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Departman',
                            dataField: 'department',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Eğitim Düzeyi',
                            dataField: 'education_level',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Yabancı Diller ve Düzeyi',
                            dataField: 'languages',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Sertifikalar ve Katıldığı Eğitimler',
                            dataField: 'certificates',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'İşe Giriş Tarihi',
                            dataField: 'job_start_date',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Hangi Ürünlere Destek veriyor',
                            dataField: 'products',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Toplam İş Deneyimi (Yıl - Ay)',
                            dataField: 'total_work_experience',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Yaş',
                            dataField: 'age',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Cinsiyet',
                            dataField: 'gender',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'İlgi, Hobi ve Becerileri',
                            dataField: 'hobbies',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Bugüne Kadar Çalıştığı Yerler',
                            dataField: 'old_work_companies',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Çalıştığı Pozisyonlar',
                            dataField: 'old_work_positions',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Gelecekte Üstlenebileceği İşler',
                            dataField: 'future_works_taken',
                            columntype: 'textbox',
                            width: '10%'
                        },
                        {
                            text: 'Genel Notlar',
                            dataField: 'notes',
                            columntype: 'textbox',
                            width: '10%'
                        }
                    ],
                });
                reportDiv.on('rowclick', function (event) {
                    specialInformationsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = specialInformationsDiv.jqxGrid('getselectedrowindex');
                    $('#selected_employee_row_index').val(rowindex);
                    var dataRecord = specialInformationsDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_employee_id').val(dataRecord.employee_id);
                    return false;
                });
                reportDiv.jqxGrid('sortby', 'id', 'desc');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Listesi Alınırken Serviste Bir Sorun Oluştu. Lütfen Geliştirici Ekibi İle İletişime Geçin!');
                $('#loader').hide();
            }
        });
    }

    getEmployeeSkillInventoryByCompanyId();

    SelectedCompanies.change(function () {
        getEmployeeSkillInventoryByCompanyId();
    });

    DownloadExcelButton.click(function () {
        $("#report").jqxGrid('exportdata', 'xlsx', 'Beceri Envanteri Raporu');
    });

</script>
