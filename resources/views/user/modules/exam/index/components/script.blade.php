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
    var examResultListRow = $('#examResultListRow');
    var selectedExamTransactionsDiv = $('#selectedExamTransactionsDiv');

    var CreateExamButton = $('#CreateExamButton');
    var UpdateExamButton = $('#UpdateExamButton');
    var DeleteExamButton = $('#DeleteExamButton');
    var DownloadResultExcelButton = $('#DownloadResultExcelButton');

    function transactions() {
        var examId = $('#selected_exam_id').val();
        if (!examId) {
            // toastr.warning('İşlem Yapabilmek İçin Lütfen Bir Sınav Seçin');
            $('.selectedExamTransaction').hide();
        } else {
            $('.selectedExamTransaction').show();
        }

        $('#TransactionsModal').modal('show');
    }

    function createExam() {
        $('#TransactionsModal').modal('hide');
        $('#create_exam_name').val('');
        $('#create_exam_duration').val('');
        $('#create_exam_date').val('');
        $('#create_exam_description').val('');
        $('#CreateExamModal').modal('show');
    }

    function updateExam() {
        $('#TransactionsModal').modal('hide');
        $('#loader').show();
        var examId = $('#selected_exam_id').val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.examSystem.getExamEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                examId: examId,
            },
            success: function (response) {
                console.log(response)
                $('#update_exam_name').val(response.response[0].sinavAdi);
                $('#update_exam_duration').val(response.response[0].sinavSuresi);
                $('#update_exam_date').val(response.response[0].sinavTarihi);
                $('#update_exam_description').val(response.response[0].sinavAciklama);
                $('#UpdateExamModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                $('#loader').hide();
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

    function deleteExam() {
        $('#TransactionsModal').modal('hide');
        $('#DeleteExamModal').modal('show');
    }

    function examQuestions() {
        var examId = $('#selected_exam_id').val();
        window.location.href = `{{ route('user.web.exam.question') }}/${examId}`;
    }

    function examEmployees() {
        var examId = $('#selected_exam_id').val();
        window.location.href = `{{ route('user.web.exam.employee') }}/${examId}`;
    }

    function examResultList() {
        var examId = $('#selected_exam_id').val();
        $('#TransactionsModal').modal('hide');
        $('#ResultModal').modal('show');
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.examSystem.getExamResultList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                examId: examId,
            },
            success: function (response) {
                var source = {
                    localdata: response.response,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'kullaniciAdSoyad', type: 'string'},
                            {name: 'puan', type: 'string'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                examResultListRow.jqxGrid({
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
                            dataField: 'kullaniciAdSoyad',
                            columntype: 'textbox',
                        },
                        {
                            text: 'Puan',
                            dataField: 'puan',
                            columntype: 'textbox',
                        }
                    ],
                });
                examResultListRow.on('rowclick', function (event) {
                    examsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = examsDiv.jqxGrid('getselectedrowindex');
                    $('#selected_survey_row_index').val(rowindex);
                    var dataRecord = examsDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_exam_id').val(dataRecord.id);
                    return false;
                });
                examResultListRow.jqxGrid('sortby', 'id', 'desc');
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
                            text: 'Sınav Süresi(saniye)',
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

    CreateExamButton.click(function () {
        var name = $('#create_exam_name').val();
        var duration = $('#create_exam_duration').val();
        var date = $('#create_exam_date').val();
        var description = $('#create_exam_description').val();

        if (!name) {
            toastr.warning('Sınav Adı Boş Bırakılamaz!');
        } else if (!duration) {
            toastr.warning('Sınav Süresi Boş Bırakılamaz!');
        } else if (!date) {
            toastr.warning('Sınav Tarihi Boş Bırakılamaz!');
        } else {
            CreateExamButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.examSystem.setExams') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    name: name,
                    duration: duration,
                    date: date,
                    description: description,
                },
                success: function () {
                    toastr.success('Sınav Başarıyla Oluşturuldu!');
                    $('#CreateExamModal').modal('hide');
                    CreateExamButton.attr('disabled', false).html('Kaydet');
                    getExamList();
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
                    CreateExamButton.attr('disabled', false).html('Kaydet');
                }
            });
        }
    });

    UpdateExamButton.click(function () {
        var id = $('#selected_exam_id').val();
        var name = $('#update_exam_name').val();
        var duration = $('#update_exam_duration').val();
        var date = $('#update_exam_date').val();
        var description = $('#update_exam_description').val();

        if (!name) {
            toastr.warning('Sınav Adı Boş Bırakılamaz!');
        } else if (!duration) {
            toastr.warning('Sınav Süresi Boş Bırakılamaz!');
        } else if (!date) {
            toastr.warning('Sınav Tarihi Boş Bırakılamaz!');
        } else {
            UpdateExamButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.examSystem.setExams') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    name: name,
                    duration: duration,
                    date: date,
                    description: description,
                },
                success: function () {
                    toastr.success('Sınav Başarıyla Güncellendi!');
                    $('#UpdateExamModal').modal('hide');
                    UpdateExamButton.attr('disabled', false).html('Kaydet');
                    getExamList();
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
                    UpdateExamButton.attr('disabled', false).html('Kaydet');
                }
            });
        }
    });

    DeleteExamButton.click(function () {
        var examId = $('#selected_exam_id').val();
        DeleteExamButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.examSystem.setExamDelete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                examId: examId,
            },
            success: function (response) {
                toastr.success('Sınav Başarıyla Silindi!');
                $('#DeleteExamModal').modal('hide');
                DeleteExamButton.attr('disabled', false).html('Sil');
                getExamList();
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
                DeleteExamButton.attr('disabled', false).html('Sil');
            }
        });
    });

    DownloadResultExcelButton.click(function () {
        examResultListRow.jqxGrid('exportdata', 'xlsx', 'Sınav Sonuçları');
    });

</script>
