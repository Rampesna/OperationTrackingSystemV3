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


    var prCrittersDiv = $('#prCrittersDiv');
    var selected_pr_cards_id = $('#selected_pr_cards_id');
    var prCritters = $('#prCritters');
    var newCritterButton = $('#newCritterButton');
    var getPrCardsCritterButton = $('#getPrCardsCritterButton');
    var selected_pr_critter_id = $('#selected_pr_critter_id');
    var updatePrCritterModal = $('#UpdatePrCritterModal');
    var CreatePrCritterModal = $('#createPrCritterModal');
    var transactionsModal = $('#TransactionsModal');

    var update_pr_critter_name = $('#update_pr_critter_name');
    var update_pr_critter_min_target = $('#update_pr_critter_min_target');
    var update_pr_critter_min_target_percent = $('#update_pr_critter_min_target_percent');
    var update_pr_critter_max_target = $('#update_pr_critter_max_target');
    var update_pr_critter_max_target_percent = $('#update_pr_critter_max_target_percent');
    var update_pr_critter_default_target = $('#update_pr_critter_default_target');
    var update_pr_critter_default_target_percent = $('#update_pr_critter_default_target_percent');
    var update_pr_critter_general_percent = $('#update_pr_critter_general_percent');

    var create_pr_critter_name = $('#create_pr_critter_name');
    var create_pr_critter_min_target = $('#create_pr_critter_min_target');
    var create_pr_critter_min_target_percent = $('#create_pr_critter_min_target_percent');
    var create_pr_critter_max_target = $('#create_pr_critter_max_target');
    var create_pr_critter_max_target_percent = $('#create_pr_critter_max_target_percent');
    var create_pr_critter_default_target = $('#create_pr_critter_default_target');
    var create_pr_critter_default_target_percent = $('#create_pr_critter_default_target_percent');
    var create_pr_critter_general_percent = $('#create_pr_critter_general_percent');


    function getPrCards() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.prCard.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            success: function (response) {
                console.log(response);
                prCritters.empty();
                $.each(response.response, function (i, prCritter) {
                    prCritters.append(`<option value="${prCritter.id}">${prCritter.name}</option>`);
                });
                selected_pr_cards_id.val(response.response[0].id);

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

    getPrCards();

    prCritters.change(function () {
        prCrittersDiv.hide();
        if (this.value) {
            selected_pr_cards_id.val(this.value);
        }
    });


    function getPrCritterByCardId() {
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.prCritter.getAllByCardId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                cardId: selected_pr_cards_id.val(),
            },
            success: function (response) {
                prCrittersDiv.show();
                var prCritters = [];
                $.each(response.response, function (i, prCritter) {
                    prCritters.push({
                        id: prCritter.id,
                        name: prCritter.name,
                        min_target: prCritter.min_target,
                        min_target_percent: prCritter.min_target_percent,
                        default_target: prCritter.default_target,
                        default_target_percent: prCritter.default_target_percent,
                        max_target: prCritter.max_target,
                        max_target_percent: prCritter.max_target_percent,
                        general_percent: prCritter.general_percent,

                    });
                });
                var source = {
                    localdata: prCritters,
                    datatype: "array",
                    datafields: [
                        {name: 'id', type: 'integer'},
                        {name: 'name', type: 'string'},
                        {name: 'min_target', type: 'string'},
                        {name: 'min_target_percent', type: 'string'},
                        {name: 'default_target', type: 'string'},
                        {name: 'default_target_percent', type: 'string'},
                        {name: 'max_target', type: 'string'},
                        {name: 'max_target_percent', type: 'string'},
                        {name: 'general_percent', type: 'string'},
                    ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                prCrittersDiv.jqxGrid({
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
                            text: 'Kart Adı',
                            dataField: 'name',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Min Hedef',
                            dataField: 'min_target',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Min Hedef Yüzde',
                            dataField: 'min_target_percent',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Varsayılan Hedef',
                            dataField: 'default_target',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Varsayılan Hedef Yüzde',
                            dataField: 'default_target_percent',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Max Hedef',
                            dataField: 'max_target',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Max Hedef Yüzde',
                            dataField: 'max_target_percent',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Genel Yüzde',
                            dataField: 'general_percent',
                            columntype: 'textbox',
                        },

                    ],
                });
                prCrittersDiv.on('rowclick', function (event) {
                    prCrittersDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = prCrittersDiv.jqxGrid('getselectedrowindex');
                    var dataRecord = prCrittersDiv.jqxGrid('getrowdata', rowindex);
                   selected_pr_critter_id.val(dataRecord.id);
                    return false;
                });
                prCrittersDiv.jqxGrid('sortby', 'id', 'desc');

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

    function getPrCritterById() {
        transactionsModal.modal('hide');
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.prCritter.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: selected_pr_critter_id.val(),
            },
            success: function (response) {
                console.log(response);
                updatePrCritterModal.modal('show');
                update_pr_critter_name.val(response.response.name);
                update_pr_critter_min_target.val(response.response.min_target);
                update_pr_critter_min_target_percent.val(response.response.min_target_percent);
                update_pr_critter_default_target.val(response.response.default_target);
                update_pr_critter_default_target_percent.val(response.response.default_target_percent);
                update_pr_critter_max_target.val(response.response.max_target);
                update_pr_critter_max_target_percent.val(response.response.max_target_percent);
                update_pr_critter_general_percent.val(response.response.general_percent);
                updatePrCritterModal.modal('show');
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

    function updatePrCritter() {
        $.ajax({
            type: 'put',
            url: '{{ route('user.api.prCritter.update') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: selected_pr_critter_id.val(),
                name: update_pr_critter_name.val(),
                minTarget: update_pr_critter_min_target.val(),
                minTargetPercent: update_pr_critter_min_target_percent.val(),
                defaultTarget: update_pr_critter_default_target.val(),
                defaultTargetPercent: update_pr_critter_default_target_percent.val(),
                maxTarget: update_pr_critter_max_target.val(),
                maxTargetPercent: update_pr_critter_max_target_percent.val(),
                generalPercent: update_pr_critter_general_percent.val(),
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.message);
                updatePrCritterModal.modal('hide');
                getPrCritterByCardId();
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

    function createPrCritterModal(){
        CreatePrCritterModal.modal('show');
    }

    function createPrCritter() {

        $.ajax({
            type: 'post',
            url: '{{ route('user.api.prCritter.create') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                prCardId: selected_pr_cards_id.val(),
                name: create_pr_critter_name.val(),
                minTarget: create_pr_critter_min_target.val(),
                minTargetPercent: create_pr_critter_min_target_percent.val(),
                defaultTarget: create_pr_critter_default_target.val(),
                defaultTargetPercent: create_pr_critter_default_target_percent.val(),
                maxTarget: create_pr_critter_max_target.val(),
                maxTargetPercent: create_pr_critter_max_target_percent.val(),
                generalPercent: create_pr_critter_general_percent.val(),
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.message);
                CreatePrCritterModal.modal('hide');
                create_pr_critter_name.val('');
                create_pr_critter_min_target.val('');
                create_pr_critter_min_target_percent.val('');
                create_pr_critter_default_target.val('');
                create_pr_critter_default_target_percent.val('');
                create_pr_critter_max_target.val('');
                create_pr_critter_max_target_percent.val('');
                create_pr_critter_general_percent.val('');
                getPrCritterByCardId();
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

    function deletePrCritter() {
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.prCritter.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: selected_pr_critter_id.val()
            },
            success: function (response) {
                console.log(response);
                toastr.success(response.message);
                transactionsModal.modal('hide');
                getPrCritterByCardId();
                selected_pr_critter_id.val('');
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

    $('body').on('contextmenu', function () {

        if (selected_pr_critter_id.val()) {
          transactionsModal.modal('show');
        } else {
            toastr.warning('Lütfen kriter seçiniz');
        }
        return false;
    });


</script>
