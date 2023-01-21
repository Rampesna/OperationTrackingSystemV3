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

    var prCardsDiv = $('#prCardsDiv');

    var GetPrCardsButton = $('#GetPrCardsButton');

    var jobDepartmentsInput = $('#jobDepartments');

    function createPrCard() {
        if (!jobDepartmentsInput.val()) {
            toastr.warning('Lütften kart oluşturmadan önce bir departman seçiniz');
        } else {
            toastr.info('Lütfen bekleyin...');
        }
    }

    function getJobDepartmentsByCompanyIds() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.jobDepartment.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: SelectedCompanies.val(),
                pageIndex: 0,
                pageSize: 1000,
            },
            success: function (response) {
                jobDepartmentsInput.empty();
                $.each(response.response.jobDepartments, function (i, jobDepartment) {
                    jobDepartmentsInput.append(`<option value="${jobDepartment.id}">${jobDepartment.name}</option>`);
                });
                jobDepartmentsInput.val('');
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

    function getPrCardsByJobDepartmentId() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.prCard.getByJobDepartmentId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                jobDepartmentId: jobDepartmentsInput.val(),
            },
            success: function (response) {
                var prCards = [];
                $.each(response.response, function (i, prCard) {
                    prCards.push({
                        id: prCard.id,
                        jobDepartment: prCard.job_department.name,
                        name: prCard.name,
                        code: prCard.code,
                        version: prCard.version,
                    });
                });
                var source = {
                    localdata: prCards,
                    datatype: "array",
                    datafields: [
                        {name: 'id', type: 'integer'},
                        {name: 'jobDepartment', type: 'string'},
                        {name: 'name', type: 'string'},
                        {name: 'code', type: 'string'},
                        {name: 'version', type: 'string'},
                    ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                prCardsDiv.jqxGrid({
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
                            dataField: 'id',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Departman',
                            dataField: 'jobDepartment',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Adı',
                            dataField: 'name',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Kodu',
                            dataField: 'code',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Versiyonu',
                            dataField: 'version',
                            columntype: 'textbox',
                        }
                    ],
                });
                prCardsDiv.on('rowclick', function (event) {
                    prCardsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = prCardsDiv.jqxGrid('getselectedrowindex');
                    $('#selected_survey_row_index').val(rowindex);
                    var dataRecord = prCardsDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_survey_id').val(dataRecord.id);
                    $('#selected_survey_code').val(dataRecord.kodu);
                    return false;
                });
                prCardsDiv.jqxGrid('sortby', 'id', 'desc');
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

    getJobDepartmentsByCompanyIds();

    jobDepartmentsInput.change(function () {
        if (this.value !== '') {
            GetPrCardsButton.removeAttr('disabled');
        } else {
            GetPrCardsButton.attr('disabled', 'disabled');
        }
    });

    GetPrCardsButton.click(function () {
        getPrCardsByJobDepartmentId();
    });

</script>
