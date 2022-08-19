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

    var examsDiv = $('#exams');

    function transactions() {
        var examId = $('#selected_exam_id').val();
        if (!examId) {
            toastr.warning('İşlem Yapabilmek İçin Lütfen Bir Sınav Seçin');
        } else {
            $('#TransactionsModal').modal('show');
        }
    }

    function examEmployees() {
        var examId = $('#selected_exam_id').val();
        window.location.href = `{{ route('user.web.exam.employee') }}/${examId}`;
    }

    function getExamList() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.examSystem.getExamList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                $('#loader').hide();

                var source = {
                    localdata: response.response,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'id', type: 'integer'},
                            {name: 'sinavAdi', type: 'string'},
                            {name: 'sinavAciklama', type: 'string'},
                            {name: 'sinavSuresi', type: 'string'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                examsDiv.jqxGrid({
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
                            text: 'Sınav Adı',
                            dataField: 'sinavAdi',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Sınav Açıklaması',
                            dataField: 'sinavAciklama',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Sınav Süresi(dk)',
                            dataField: 'sinavSuresi',
                            columntype: 'textbox',
                        }
                    ],
                });
                examsDiv.on('rowclick', function (event) {
                    examsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = examsDiv.jqxGrid('getselectedrowindex');
                    $('#selected_survey_row_index').val(rowindex);
                    var dataRecord = examsDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_exam_id').val(dataRecord.id);
                    return false;
                });
                examsDiv.jqxGrid('sortby', 'id', 'desc');
            },
            error: function (error) {
                $('#loader').hide();
                console.log(error);
                toastr.error('Sımav Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getExamList();

</script>
