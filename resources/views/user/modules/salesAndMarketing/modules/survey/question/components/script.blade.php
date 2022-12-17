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

    var createAnswerCategoriesTagify = new Tagify(document.querySelector("#create_answer_categories"));
    var updateAnswerCategoriesTagify = new Tagify(document.querySelector("#update_answer_categories"));

    var allQuestions = [];

    var surveyQuestionsDiv = $('#surveyQuestions');
    var surveyQuestionAnswersDiv = $('#surveyQuestionAnswers');

    var createAnswerQuestions = $('#create_answer_questions');
    var createAnswerProducts = $('#create_answer_products');

    var updateAnswerQuestions = $('#update_answer_questions');
    var updateAnswerProducts = $('#update_answer_products');

    var CreateQuestionButton = $("#CreateQuestionButton");
    var UpdateQuestionButton = $("#UpdateQuestionButton");
    var DeleteQuestionButton = $("#DeleteQuestionButton");

    var CreateAnswerButton = $("#CreateAnswerButton");
    var UpdateAnswerButton = $("#UpdateAnswerButton");
    var DeleteAnswerButton = $("#DeleteAnswerButton");

    function getProducts() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyProductList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createAnswerProducts.empty();
                updateAnswerProducts.empty();
                $.each(response.response, function (i, product) {
                    createAnswerProducts.append(`<option value="${product.kodu}" data-id="${product.id}">${product.adi}</option>`);
                    updateAnswerProducts.append(`<option value="${product.kodu}" data-id="${product.id}">${product.adi}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ürün Listesi Alınırken Serviste Bir Hata Oluştu');
            }
        });
    }

    function getSurveyQuestions() {
        $('#loader').show();
        var surveyCode = parseInt('{{ $code }}');
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyQuestionsList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                surveyCode: surveyCode,
            },
            success: function (response) {

                allQuestions = response.response;

                var source = {
                    localdata: response.response,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'id', type: 'integer'},
                            {name: 'siraNo', type: 'integer'},
                            {name: 'soru', type: 'string'},
                            {name: 'soruTurKodu', type: 'string'},
                            {name: 'zorunlumu', type: 'string'},
                            {name: 'altSoru', type: 'string'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                surveyQuestionsDiv.jqxGrid({
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
                            width: '7%',
                        },
                        {
                            text: 'Sıra',
                            dataField: 'siraNo',
                            columntype: 'textbox',
                            width: '5%',
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
                            width: '8%',
                        },
                        {
                            text: 'Zorunluluk',
                            dataField: 'zorunlumu',
                            columntype: 'textbox',
                            width: '12%',
                        },
                        {
                            text: 'Alt Soru',
                            dataField: 'altSoru',
                            columntype: 'textbox',
                            width: '8%',
                        }
                    ],
                });
                surveyQuestionsDiv.on('rowclick', function (event) {
                    surveyQuestionsDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = surveyQuestionsDiv.jqxGrid('getselectedrowindex');
                    $('#selected_survey_question_row_index').val(rowindex);
                    var dataRecord = surveyQuestionsDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_survey_question_id').val(dataRecord.id);

                    getSurveyQuestionAnswers();

                    return false;
                });
                surveyQuestionsDiv.jqxGrid('sortby', 'siraNo', 'asc');

                var selectedSurveyQuestion = $('#selected_survey_question_id');
                if (selectedSurveyQuestion.val()) {
                    selectedSurveyQuestion.val('');
                    surveyQuestionsDiv.jqxGrid('clearselection');
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

    function getSurveyQuestionAnswers() {
        $('#loader').show();
        var questionId = parseInt($('#selected_survey_question_id').val());
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyAnswersList') }}',
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
                            {name: 'siraNo', type: 'integer'},
                            {name: 'cevap', type: 'string'},
                            {name: 'zorunluKolonAdlari', type: 'string'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                surveyQuestionAnswersDiv.jqxGrid({
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
                            width: '7%',
                        },
                        {
                            text: 'Sıra',
                            dataField: 'siraNo',
                            columntype: 'textbox',
                            width: '5%',
                        },
                        {
                            text: 'Cevap',
                            dataField: 'cevap',
                            columntype: 'textbox',
                            width: '60%',
                        },
                        {
                            text: 'Zorunlu Kolonlar',
                            dataField: 'zorunluKolonAdlari',
                            columntype: 'textbox',
                            width: '28%',
                        }
                    ],
                });
                surveyQuestionAnswersDiv.on('rowclick', function (event) {
                    surveyQuestionAnswersDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = surveyQuestionAnswersDiv.jqxGrid('getselectedrowindex');
                    $('#selected_question_answer_row_index').val(rowindex);
                    var dataRecord = surveyQuestionAnswersDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_question_answer_id').val(dataRecord.id);
                    return false;
                });
                surveyQuestionAnswersDiv.jqxGrid('sortby', 'siraNo', 'asc');

                var selectedQuestionAnswer = $('#selected_question_answer_id');
                if (selectedQuestionAnswer.val()) {
                    selectedQuestionAnswer.val('');
                    surveyQuestionAnswersDiv.jqxGrid('clearselection');
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
        if (!$('#selected_survey_question_id').val()) {
            $('.selectedQuestionTransaction').hide();
        } else {
            $('.selectedQuestionTransaction').show();
        }
        $('#QuestionTransactionsModal').modal('show');
    }

    function createQuestion() {
        $('#QuestionTransactionsModal').modal('hide');
        $('#create_question_question').val('');
        $('#create_question_type').val('');
        $('#create_question_order').val('');
        $('#create_question_required').val('');
        $('#create_question_description').val('');
        $('#CreateQuestionModal').modal('show');
    }

    function updateQuestion() {
        $('#QuestionTransactionsModal').modal('hide');
        $('#loader').show();
        var questionId = $('#selected_survey_question_id').val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyQuestionEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                questionId: questionId,
            },
            success: function (response) {
                console.log(response);
                $('#UpdateQuestionModal').modal('show');
                $('#update_question_question').val(response.response.soru);
                $('#update_question_type').val(response.response.soruTurKodu);
                $('#update_question_order').val(response.response.siraNo);
                $('#update_question_required').val(response.response.zorunlumu);
                $('#update_question_description').val(response.response.aciklama);
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Soru Verileri Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
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
        $('#create_answer_order').val('');
        $('#create_answer_answer').val('');
        $('#create_answer_categories').val('');
        createAnswerQuestions.empty();
        var selectedQuestionId = $('#selected_survey_question_id').val();
        $.each(allQuestions, function (i, question) {
            if (parseInt(selectedQuestionId) !== parseInt(question.id)) {
                createAnswerQuestions.append(`<option value="${question.id}">${question.soru}</option>`);
            }
        });
        createAnswerProducts.val([]);
        $('#create_answer_columns').val([]);
        $('#create_answer_status_id').val('');
        $('#CreateAnswerModal').modal('show');
    }

    function updateAnswer() {
        $('#AnswerTransactionsModal').modal('hide');
        $('#loader').show();
        var answerId = parseInt($('#selected_question_answer_id').val());
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyAnswerEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                answerId: answerId,
            },
            success: function (response) {
                var answerColumns = response.response.zorunluKolonAdlari;
                $('#update_answer_order').val(response.response.siraNo);
                $('#update_answer_answer').val(response.response.cevap);
                $('#update_answer_columns').val(answerColumns.split(';'));
                updateAnswerQuestions.empty();
                var selectedQuestionId = $('#selected_survey_question_id').val();
                $.each(allQuestions, function (i, question) {
                    if (parseInt(selectedQuestionId) !== parseInt(question.id)) {
                        updateAnswerQuestions.append(`<option value="${question.id}">${question.soru}</option>`);
                    }
                });
                $.ajax({
                    async: false,
                    type: 'get',
                    url: '{{ route('user.api.operationApi.surveySystem.getSurveyAnswersCategoryConnectList') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        answerId: answerId,
                    },
                    success: function (response) {
                        console.log(response);
                        updateAnswerCategoriesTagify.removeAllTags();
                        $.each(response.response, function (i, answerCategory) {
                            updateAnswerCategoriesTagify.addTags([`${answerCategory.kategori}`]);
                        });
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Cevaba Bağlı Kategori Listesi Alınırken Serviste Bir Hata Oluştu.');
                    }
                });
                $.ajax({
                    async: false,
                    type: 'get',
                    url: '{{ route('user.api.operationApi.surveySystem.getSurveyAnswersConnectList') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        answerId: answerId,
                    },
                    success: function (response) {
                        var answerQuestions = [];
                        $.each(response.response, function (i, answerQuestion) {
                            answerQuestions.push(answerQuestion.sorularId);
                        });
                        updateAnswerQuestions.val(answerQuestions);
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Cevaba Bağlı Soru Listesi Alınırken Serviste Bir Hata Oluştu.');
                    }
                });
                $.ajax({
                    async: false,
                    type: 'get',
                    url: '{{ route('user.api.operationApi.surveySystem.getSurveyAnswersProductConnectList') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        answerId: answerId,
                    },
                    success: function (response) {
                        var productCodes = [];
                        $.each(response.response, function (i, answerProduct) {
                            productCodes.push(answerProduct.urunKodu);
                        });
                        updateAnswerProducts.val(productCodes);
                        $('#update_answer_status_id').val(response.response[0] ? response.response[0].durumKodu : '');
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Cevaba Bağlı Ürün Listesi Alınırken Serviste Bir Hata Oluştu.');
                    }
                });
                $('#UpdateAnswerModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Cevap Verileri Alınırken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    }

    function deleteAnswer() {
        $('#AnswerTransactionsModal').modal('hide');
        $('#DeleteAnswerModal').modal('show');
    }

    getSurveyQuestions();
    getProducts();

    CreateQuestionButton.click(function () {
        var id = null;
        var question = $('#create_question_question').val();
        var typeId = $('#create_question_type').val();
        var additionalQuestion = 1;
        var order = $('#create_question_order').val();
        var surveyCode = parseInt('{{ $code }}');
        var description = $('#create_question_description').val();
        var required = $('#create_question_required').val();

        if (!order) {
            toastr.warning('Sıra Boş Olamaz!');
        } else if (!question) {
            toastr.warning('Soru Boş Olamaz!');
        } else if (!typeId) {
            toastr.warning('Soru Türü Seçimi Boş Olamaz!');
        } else if (!required) {
            toastr.warning('Zorunluluk Seçimi Boş Olamaz!');
        } else {
            $('#loader').show();
            $('#CreateQuestionModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyQuestions') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    question: question,
                    typeId: parseInt(typeId),
                    additionalQuestion: additionalQuestion,
                    order: parseInt(order),
                    surveyCode: surveyCode,
                    description: description,
                    required: parseInt(required),
                },
                success: function () {
                    getSurveyQuestions();
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
        var id = parseInt($('#selected_survey_question_id').val());
        var question = $('#update_question_question').val();
        var typeId = $('#update_question_type').val();
        var additionalQuestion = 1;
        var order = $('#update_question_order').val();
        var surveyCode = parseInt('{{ $code }}');
        var description = $('#update_question_description').val();
        var required = $('#update_question_required').val();

        if (!order) {
            toastr.warning('Sıra Boş Olamaz!');
        } else if (!question) {
            toastr.warning('Soru Boş Olamaz!');
        } else if (!typeId) {
            toastr.warning('Soru Türü Seçimi Boş Olamaz!');
        } else if (!required) {
            toastr.warning('Zorunluluk Seçimi Boş Olamaz!');
        } else {
            $('#loader').show();
            $('#UpdateQuestionModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyQuestions') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    question: question,
                    typeId: parseInt(typeId),
                    additionalQuestion: additionalQuestion,
                    order: parseInt(order),
                    surveyCode: surveyCode,
                    description: description,
                    required: parseInt(required),
                },
                success: function () {
                    getSurveyQuestions();
                    toastr.success('Soru Başarıyla Güncellendi.');
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
        var questionId = parseInt($('#selected_survey_question_id').val());
        $('#loader').show();
        $('#DeleteQuestionModal').hide();
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.surveySystem.setSurveyQuestionsDelete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                questionId: questionId,
            },
            success: function () {
                getSurveyQuestions();
                toastr.success('Soru Başarıyla Silindi.');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Soru Silinirken Serviste Bir Hata Oluştu.');
                $('#loader').hide();
            }
        });
    });

    CreateAnswerButton.click(function () {
        var id = null;
        var questionId = $('#selected_survey_question_id').val();
        var answer = $('#create_answer_answer').val();
        var order = $('#create_answer_order').val();
        var columns = $('#create_answer_columns').val().join(';');
        var statusId = $('#create_answer_status_id').val();

        if (!questionId) {
            toastr.warning('Soru Seçiminde Hata Var!');
        } else if (!order) {
            toastr.warning('Sıra Boş Olamaz!');
        } else if (!answer) {
            toastr.warning('Cevap Boş Olamaz!');
        } else {
            $('#loader').show();
            $('#CreateAnswerModal').modal('hide');
            var categoriesResponseStatus = 1;
            var questionsResponseStatus = 1;
            var productsResponseStatus = 1;

            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyAnswers') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    questionId: parseInt(questionId),
                    answer: answer,
                    order: parseInt(order),
                    columns: columns,
                },
                success: function (response) {
                    var newAnswerId = parseInt(response.response);
                    var categories = [];
                    var categoriesString = $('#create_answer_categories').val();
                    if (categoriesString) {
                        var categoriesArray = JSON.parse(categoriesString);
                        $.each(categoriesArray, function (i, category) {
                            categories.push({
                                kategori: category.value,
                                anketCevaplarId: newAnswerId,
                            });
                        });
                    }
                    $.ajax({
                        async: false,
                        type: 'post',
                        url: '{{ route('user.api.operationApi.surveySystem.setSurveyAnswersCategoryConnect') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            categories: categories,
                        },
                        success: function () {

                        },
                        error: function (error) {
                            categoriesResponseStatus = 0;
                            console.log(error);
                        }
                    });

                    var questions = [];
                    var questionsArray = createAnswerQuestions.val();
                    $.each(questionsArray, function (i, question) {
                        questions.push({
                            sorularId: parseInt(question),
                            cevaplarId: newAnswerId,
                        });
                    });
                    $.ajax({
                        async: false,
                        type: 'post',
                        url: '{{ route('user.api.operationApi.surveySystem.setSurveyAnswersConnect') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            questions: questions,
                        },
                        success: function () {

                        },
                        error: function (error) {
                            questionsResponseStatus = 0;
                            console.log(error);
                        }
                    });

                    var products = [];
                    var productsArray = createAnswerProducts.val();
                    $.each(productsArray, function (i, product) {
                        products.push({
                            urunKodu: `${product}`,
                            anketCevaplarId: newAnswerId,
                            durumKodu: statusId,
                        });
                    });
                    $.ajax({
                        type: 'post',
                        url: '{{ route('user.api.operationApi.surveySystem.setSurveyAnswersProductConnect') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            products: products,
                        },
                        success: function () {

                        },
                        error: function (error) {
                            productsResponseStatus = 0;
                            console.log(error);
                        }
                    });

                    getSurveyQuestionAnswers();

                    if (categoriesResponseStatus === 0) {
                        toastr.error('Cevap Kategori Bağlantısı Yapılırken Serviste Bir Hata Oluştu.');
                    }

                    if (questionsResponseStatus === 0) {
                        toastr.error('Cevap Alt Soru Bağlantısı Yapılırken Serviste Bir Hata Oluştu.');
                    }

                    if (productsResponseStatus === 0) {
                        toastr.error('Cevap Ürün Bağlantısı Yapılırken Serviste Bir Hata Oluştu.');
                    }

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
        var answerId = $('#selected_question_answer_id').val();
        var questionId = $('#selected_survey_question_id').val();
        var answer = $('#update_answer_answer').val();
        var order = $('#update_answer_order').val();
        var columns = $('#update_answer_columns').val().join(';');
        var statusId = $('#update_answer_status_id').val();

        if (!answerId) {
            toastr.warning('Cevap Seçiminde Hata Var!');
        } else if (!questionId) {
            toastr.warning('Soru Seçiminde Hata Var!');
        } else if (!order) {
            toastr.warning('Sıra Boş Olamaz!');
        } else if (!answer) {
            toastr.warning('Cevap Boş Olamaz!');
        } else {
            $('#loader').show();
            $('#UpdateAnswerModal').modal('hide');
            var categoriesResponseStatus = 1;
            var questionsResponseStatus = 1;
            var productsResponseStatus = 1;

            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyAnswers') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: parseInt(answerId),
                    questionId: parseInt(questionId),
                    answer: answer,
                    order: parseInt(order),
                    columns: columns,
                },
                success: function () {
                    var categories = [];
                    var categoriesString = $('#update_answer_categories').val();
                    if (categoriesString) {
                        var categoriesArray = JSON.parse(categoriesString);
                        $.each(categoriesArray, function (i, category) {
                            categories.push({
                                kategori: category.value,
                                anketCevaplarId: parseInt(answerId),
                            });
                        });
                    }
                    $.ajax({
                        async: false,
                        type: 'post',
                        url: '{{ route('user.api.operationApi.surveySystem.setSurveyAnswersCategoryConnect') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            categories: categories,
                        },
                        success: function () {

                        },
                        error: function (error) {
                            categoriesResponseStatus = 0;
                            console.log(error);
                        }
                    });

                    var questions = [];
                    var questionsArray = updateAnswerQuestions.val();
                    $.each(questionsArray, function (i, question) {
                        questions.push({
                            sorularId: parseInt(question),
                            cevaplarId: parseInt(answerId),
                        });
                    });
                    $.ajax({
                        async: false,
                        type: 'post',
                        url: '{{ route('user.api.operationApi.surveySystem.setSurveyAnswersConnect') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            questions: questions,
                        },
                        success: function () {

                        },
                        error: function (error) {
                            questionsResponseStatus = 0;
                            console.log(error);
                        }
                    });

                    var products = [];
                    var productsArray = updateAnswerProducts.val();
                    $.each(productsArray, function (i, product) {
                        products.push({
                            urunKodu: `${product}`,
                            anketCevaplarId: parseInt(answerId),
                            durumKodu: statusId,
                        });
                    });
                    $.ajax({
                        type: 'post',
                        url: '{{ route('user.api.operationApi.surveySystem.setSurveyAnswersProductConnect') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            products: products,
                        },
                        success: function () {

                        },
                        error: function (error) {
                            productsResponseStatus = 0;
                            console.log(error);
                        }
                    });

                    getSurveyQuestionAnswers();

                    if (categoriesResponseStatus === 0) {
                        toastr.error('Cevap Kategori Bağlantısı Yapılırken Serviste Bir Hata Oluştu.');
                    }

                    if (questionsResponseStatus === 0) {
                        toastr.error('Cevap Alt Soru Bağlantısı Yapılırken Serviste Bir Hata Oluştu.');
                    }

                    if (productsResponseStatus === 0) {
                        toastr.error('Cevap Ürün Bağlantısı Yapılırken Serviste Bir Hata Oluştu.');
                    }

                    toastr.success('Cevap Güncellendi.');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Cevap Oluşturulurken Serviste Bir Hata Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteAnswerButton.click(function () {
        var answerId = $('#selected_question_answer_id').val();

        if (!answerId) {
            toastr.warning('Cevap Seçiminde Hata Var!');
        } else {
            $('#loader').show();
            $('#DeleteAnswerModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyAnswersDelete') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    answerId: parseInt(answerId),
                },
                success: function () {
                    getSurveyQuestionAnswers();
                    toastr.success('Cevap Başarıyla Silindi!');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Cevap Silinirken Serviste Bir Hata Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

</script>
