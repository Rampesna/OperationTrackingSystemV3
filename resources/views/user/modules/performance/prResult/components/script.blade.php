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

    var prDepartmensInput = $('#prDepartmens');
    var prCardsInput = $('#prCards');
    var prResultsDiv = $('#prResultDiv');
    var getResultsButton = $('#getResultsButton');
    var prMonthInput = $('#prMonth');

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
                prDepartmensInput.empty();
                $.each(response.response.jobDepartments, function (i, jobDepartment) {
                    prDepartmensInput.append(`<option value="${jobDepartment.id}">${jobDepartment.name}</option>`);
                });
                prDepartmensInput.val('');
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

    function getPrCardsByJobDepartmentId() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.prCard.getByJobDepartmentId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                jobDepartmentId: prDepartmensInput.val(),
            },
            success: function (response) {
                prCardsInput.empty();
                $.each(response.response, function (i, prCritter) {
                    prCardsInput.append(`<option value="${prCritter.id}">${prCritter.name}</option>`);
                });
                prCardsInput.val('');


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

    prDepartmensInput.change(function () {
        if(this.value !== ''){
            getPrCardsByJobDepartmentId();
        }
    });

    // prCardsInput.change(function () {
    //     if (this.value !== '') {
    //         getResultsButton.removeAttr('disabled');
    //     } else {
    //         getResultsButton.attr('disabled', 'disabled');
    //     }
    // });

    prMonthInput.change(function () {
        if (this.value !== '') {
            getResultsButton.removeAttr('disabled');
        } else {
            getResultsButton.attr('disabled', 'disabled');
        }
    });

    getResultsButton.click(function () {
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.prResult.getResult') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                cardId: prCardsInput.val(),
                date: prMonthInput.val()

            },
            success: function (response) {
                console.log(response);

                var columns = [];
                var dataFields = [];

                $.each(response.response, function (i, prResult) {
                    $.each(prResult, function (i, column) {
                        columns.push({
                            text: i,
                            dataField: i,
                            columntype: 'textbox',
                        });
                        dataFields.push({
                            name: i,
                            type: 'string'
                        });
                    });
                    return false;
                });

                var source = {
                    localdata: response.response,
                    datatype: "array",
                    datafields: dataFields
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                prResultsDiv.jqxGrid({
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
                    columns: columns,
                });
                prResultsDiv.on('rowclick', function (event) {
                    prResultsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = prResultsDiv.jqxGrid('getselectedrowindex');
                    var dataRecord = prResultsDiv.jqxGrid('getrowdata', rowindex);
                    selected_pr_critter_id.val(dataRecord.id);
                    return false;
                });
                prResultsDiv.jqxGrid('sortby', 'id', 'desc');

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
    });





</script>
