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

    var examId = parseInt('{{ $examId }}');

    var allQuestions = [];

    var examQuestionsDiv = $('#examQuestions');
    var examQuestionAnswersDiv = $('#examQuestionAnswers');

    var CreateQuestionButton = $("#CreateQuestionButton");
    var UpdateQuestionButton = $("#UpdateQuestionButton");
    var DeleteQuestionButton = $("#DeleteQuestionButton");

    var CreateAnswerButton = $("#CreateAnswerButton");
    var UpdateAnswerButton = $("#UpdateAnswerButton");
    var DeleteAnswerButton = $("#DeleteAnswerButton");

    function getExamQuestions() {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.examSystem.getQuestionsList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                examId: examId,
            },
            success: function (response) {

                allQuestions = response.response;

                var source = {
                    localdata: response.response,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'id', type: 'integer'},
                            {name: 'soru', type: 'string'},
                            {name: 'soruTurKodu', type: 'string'},
                            {name: 'siraNo', type: 'number'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                examQuestionsDiv.jqxGrid({
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
                            width: '10%',
                        },
                        {
                            text: 'Soru',
                            dataField: 'soru',
                            columntype: 'textbox',
                            width: '60%',
                        },
                        {
                            text: 'Tür',
                            dataField: 'soruTurKodu',
                            columntype: 'textbox',
                            width: '15%',
                        },
                        {
                            text: 'Sıra',
                            dataField: 'siraNo',
                            columntype: 'textbox',
                            width: '15%',
                        }
                    ],
                });
                examQuestionsDiv.on('rowclick', function (event) {
                    examQuestionsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = examQuestionsDiv.jqxGrid('getselectedrowindex');
                    $('#selected_exam_question_row_index').val(rowindex);
                    var dataRecord = examQuestionsDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_exam_question_id').val(dataRecord.id);

                    getExamQuestionAnswers();

                    return false;
                });
                examQuestionsDiv.jqxGrid('sortby', 'siraNo', 'asc');

                var selectedExamQuestion = $('#selected_exam_question_id');
                if (selectedExamQuestion.val()) {
                    selectedExamQuestion.val('');
                    examQuestionsDiv.jqxGrid('clearselection');
                }

                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Script Soruları Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    function getExamQuestionAnswers() {
        $('#loader').show();
        var questionId = parseInt($('#selected_exam_question_id').val());
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.examSystem.getQuestionOptionsList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                questionId: questionId,
            },
            success: function (response) {

                var source = {
                    localdata: response.response,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'id', type: 'integer'},
                            {name: 'cevap', type: 'string'},
                            {name: 'siraNo', type: 'string'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                examQuestionAnswersDiv.jqxGrid({
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
                            width: '10%',
                        },
                        {
                            text: 'Cevap',
                            dataField: 'cevap',
                            columntype: 'textbox',
                            width: '80%',
                        },
                        {
                            text: 'Sıra',
                            dataField: 'siraNo',
                            columntype: 'textbox',
                            width: '10%',
                        }
                    ],
                });
                examQuestionAnswersDiv.on('rowclick', function (event) {
                    examQuestionAnswersDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = examQuestionAnswersDiv.jqxGrid('getselectedrowindex');
                    $('#selected_question_answer_row_index').val(rowindex);
                    var dataRecord = examQuestionAnswersDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_question_answer_id').val(dataRecord.id);
                    return false;
                });
                examQuestionAnswersDiv.jqxGrid('sortby', 'siraNo', 'asc');

                var selectedQuestionAnswer = $('#selected_question_answer_id');
                if (selectedQuestionAnswer.val()) {
                    selectedQuestionAnswer.val('');
                    examQuestionAnswersDiv.jqxGrid('clearselection');
                }

                $('#questionAnswersColumn').show();
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Cevap Listesi Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    function questionTransactions() {
        if (!$('#selected_exam_question_id').val()) {
            $('.selectedQuestionTransaction').hide();
        } else {
            $('.selectedQuestionTransaction').show();
        }
        $('#QuestionTransactionsModal').modal('show');
    }

    function createQuestion() {
        $('#QuestionTransactionsModal').modal('hide');
        $('#create_question_question').val('');
        $('#create_question_order').val('');
        $('#create_question_type').val('');
        $('#CreateQuestionModal').modal('show');
    }

    function updateQuestion() {
        $('#QuestionTransactionsModal').modal('hide');
        $('#loader').show();
        var questionId = parseInt($('#selected_exam_question_id').val());
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.examSystem.getQuestionsEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                questionId: questionId,
            },
            success: function (response) {
                $('#loader').hide();
                $('#update_question_question').val(response.response[0].soru);
                $('#update_question_type').val(response.response[0].soruTurKodu);
                $('#update_question_order').val(response.response[0].siraNo);
                $('#UpdateQuestionModal').modal('show');
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

    function deleteQuestion() {
        $('#QuestionTransactionsModal').modal('hide');
        $('#DeleteQuestionModal').modal('show');
    }

    function answerTransactions() {
        if (!$('#selected_question_answer_id').val()) {
            $('.selectedAnswerTransaction').hide();
        } else {
            $('.selectedAnswerTransaction').show();
        }
        $('#AnswerTransactionsModal').modal('show');
    }

    function createAnswer() {
        $('#AnswerTransactionsModal').modal('hide');
        $('#create_answer_answer').val('');
        $('#create_answer_order').val('');
        $('#CreateAnswerModal').modal('show');
    }

    function updateAnswer() {
        $('#AnswerTransactionsModal').modal('hide');
        $('#loader').show();
        var answerId = parseInt($('#selected_question_answer_id').val());
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.examSystem.getQuestionOptionsEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                questionOptionId: answerId,
            },
            success: function (response) {
                $('#loader').hide();
                $('#update_answer_answer').val(response.response[0].cevap);
                $('#update_answer_order').val(response.response[0].siraNo);
                $('#UpdateAnswerModal').modal('show');
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

    function deleteAnswer() {
        $('#AnswerTransactionsModal').modal('hide');
        $('#DeleteAnswerModal').modal('show');
    }

    getExamQuestions();

    CreateQuestionButton.click(function () {
        var id = '';
        var question = $('#create_question_question').val();
        var typeId = $('#create_question_type').val();
        var order = $('#create_question_order').val();

        if (!order) {
            toastr.warning('Sıra Boş Olamaz!');
        } else if (!question) {
            toastr.warning('Soru Boş Olamaz!');
        } else if (!typeId) {
            toastr.warning('Soru Türü Seçimi Boş Olamaz!');
        } else {
            $('#loader').show();
            $('#CreateQuestionModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.examSystem.setQuestions') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    examId: examId,
                    question: question,
                    questionType: parseInt(typeId),
                    order: parseInt(order),
                },
                success: function (response) {
                    console.log(response);
                    getExamQuestions();
                    toastr.success('Soru Başarıyla Eklendi.');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Soru Eklenirken Serviste Bir Hata Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateQuestionButton.click(function () {
        var id = parseInt($('#selected_exam_question_id').val());
        var question = $('#update_question_question').val();
        var typeId = $('#update_question_type').val();
        var order = $('#update_question_order').val();

        if (!order) {
            toastr.warning('Sıra Boş Olamaz!');
        } else if (!question) {
            toastr.warning('Soru Boş Olamaz!');
        } else if (!typeId) {
            toastr.warning('Soru Türü Seçimi Boş Olamaz!');
        } else {
            console.log({
                id: id,
                examId: examId,
                question: question,
                questionType: parseInt(typeId),
                order: parseInt(order),
            });
            $('#loader').show();
            $('#CreateQuestionModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.examSystem.setQuestions') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    examId: examId,
                    question: question,
                    questionType: parseInt(typeId),
                    order: parseInt(order),
                },
                success: function (response) {
                    console.log(response);
                    getExamQuestions();
                    toastr.success('Soru Başarıyla Güncellendi.');
                    $('#UpdateQuestionModal').modal('hide');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Soru Güncellenirken Serviste Bir Hata Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteQuestionButton.click(function () {
        var questionId = parseInt($('#selected_exam_question_id').val());
        DeleteQuestionButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.examSystem.setQuestionsDelete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                questionId: questionId,
            },
            success: function () {
                DeleteQuestionButton.attr('disabled', false).html('Sil');
                getExamQuestions();
                toastr.success('Soru Başarıyla Silindi.');
                $('#DeleteQuestionModal').modal('hide');
            },
            error: function (error) {
                console.log(error);
                DeleteQuestionButton.attr('disabled', false).html('Sil');
                toastr.error('Soru Silinirken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    });

    CreateAnswerButton.click(function () {
        var id = '';
        var questionId = $('#selected_exam_question_id').val();
        var answer = $('#create_answer_answer').val();
        var order = $('#create_answer_order').val();

        if (!questionId) {
            toastr.warning('Soru Seçiminde Hata Var!');
        } else if (!order) {
            toastr.warning('Sıra Boş Olamaz!');
        } else if (!answer) {
            toastr.warning('Cevap Boş Olamaz!');
        } else {
            $('#loader').show();
            $('#CreateAnswerModal').modal('hide');

            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.examSystem.setQuestionOptions') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    questionId: parseInt(questionId),
                    answer: answer,
                    order: parseInt(order),
                },
                success: function (response) {
                    getExamQuestionAnswers();
                    toastr.success('Cevap Oluşturuldu.');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Cevap Oluşturulurken Serviste Bir Hata Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateAnswerButton.click(function () {
        var id = $('#selected_question_answer_id').val();
        var questionId = $('#selected_exam_question_id').val();
        var answer = $('#update_answer_answer').val();
        var order = $('#update_answer_order').val();

        if (!questionId) {
            toastr.warning('Soru Seçiminde Hata Var!');
        } else if (!order) {
            toastr.warning('Sıra Boş Olamaz!');
        } else if (!answer) {
            toastr.warning('Cevap Boş Olamaz!');
        } else {
            $('#loader').show();
            $('#UpdateAnswerModal').modal('hide');

            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.examSystem.setQuestionOptions') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    questionId: parseInt(questionId),
                    answer: answer,
                    order: parseInt(order),
                },
                success: function () {
                    getExamQuestionAnswers();
                    toastr.success('Cevap Güncellendi.');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Cevap Güncellenirken Serviste Bir Hata Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteAnswerButton.click(function () {
        var answerId = $('#selected_question_answer_id').val();
        DeleteAnswerButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.examSystem.setQuestionOptionsDelete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                questionOptionId: answerId,
            },
            success: function (response) {
                console.log(response)
                DeleteAnswerButton.attr('disabled', false).html('Sil');
                getExamQuestionAnswers();
                toastr.success('Cevap Silindi.');
            },
            error: function (error) {
                console.log(error);
                DeleteAnswerButton.attr('disabled', false).html('Sil');
                toastr.error('Cevap Silinirken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    });

</script>
