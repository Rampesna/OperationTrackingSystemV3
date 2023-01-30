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

    var jobFileUploadDiv = $('#jobFileUpload');

    function getJobFiles() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.fileQuee.getByUploader') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                uploaderType: 'App\\Models\\Eloquent\\User',
                uploaderId: masterAuthId,
            },
            success: function (response) {
                var jobFiles = [];
                $.each(response.response, function (i, jobFile) {
                    jobFiles.push({
                        id: jobFile.id,
                        file_name: jobFile.file_name,
                        status: jobFile.status.name,
                        transaction: jobFile.transaction.name,
                    });
                });
                job_files_count = jobFiles.length;
                var source = {
                    localdata: jobFiles,
                    datatype: "array",
                    datafields: [
                        {name: 'id', type: 'integer'},
                        {name: 'file_name', type: 'string'},
                        {name: 'status', type: 'string'},
                        {name: 'transaction', type: 'string'},
                    ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                jobFileUploadDiv.jqxGrid({
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
                            text: 'Dosya Adı',
                            dataField: 'file_name',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Durum',
                            dataField: 'status',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Aktarım Tipi',
                            dataField: 'transaction',
                            columntype: 'textbox',
                        },

                    ],
                });

                jobFiles.jqxGrid('sortby', 'id', 'desc');

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

    getJobFiles();


</script>
