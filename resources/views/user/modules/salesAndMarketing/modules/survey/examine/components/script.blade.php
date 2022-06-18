<script>

    const sellerRedirectionTypes = [
        {
            id: 1,
            name: 'Şehire Göre Satıcı Yönlendirme'
        },
        {
            id: 2,
            name: 'Özelden Satıcı Yönlendirme'
        }
    ];

    function getSurvey() {
        var id = parseInt('{{ $id }}');
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#surveyName').text(response.response.adi);
                $('#surveyStatus').text(response.response.durum);
                $('#surveyId').text(response.response.id);
                $('#surveyCode').text(response.response.kodu);
                $('#surveyCustomerInformation1').text(response.response.musteriBilgilendirme);
                $('#surveyCustomerInformation2').text(response.response.musteriBilgilendirme2);
                $('#surveyDescription').text(response.response.aciklama);
                $('#surveyServiceProduct').text(response.response.uyumCrmHizmetUrun);
                $('#surveyOpportunity').text(parseInt(response.response.uyumCrmFirsat) === 1 ? 'Evet' : 'Hayır');
                $('#surveyCall').text(parseInt(response.response.uyumCrmCagri) === 1 ? 'Evet' : 'Hayır');
                $('#surveyDialPlan').text(parseInt(response.response.uyumCrmAramaPlani) === 1 ? 'Evet' : 'Hayır');
                $('#surveyOpportunityRedirectToSeller').text(parseInt(response.response.uyumCrmFirsatSaticiyaYonlendir) === 1 ? 'Evet' : 'Hayır');
                $('#surveyDialPlanRedirectToSeller').text(parseInt(response.response.uyumCrmAramaPlaniSaticiyaYonlendir) === 1 ? 'Evet' : 'Hayır');
                $('#surveyAdditionalProductOpportunity').text(parseInt(response.response.uyumCrmEkUrunFirsat) === 1 ? 'Evet' : 'Hayır');
                $('#surveyAdditionalProductCallPlan').text(parseInt(response.response.uyumCrmEkUrunAramaPlani) === 1 ? 'Evet' : 'Hayır');
                $('#surveySellerRedirectionType').text(sellerRedirectionTypes.find(types => types.id === parseInt(response.response.uyumCrmSaticiKoduTurKodu)).name);
                $('#surveyJobResource').text(response.response.uyumCrmIsKaynagi);
                $('#surveyListCode').text(response.response.uyumCrmListeKod);
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Script Verileri Alınırken Sistemsel Bir Hata Oluştu!');
                $('#loader').hide();
            }
        });
    }

    getSurvey();

    var allQuestions = [];
    var questionsCard = $("#surveyQuestions");

    var SearchInArray = function (searchingArray, searchingData) {
        var returnKey = -1;
        $.each(searchingArray, function (index, data) {
            if (parseInt(data.id) === parseInt(searchingData)) {
                returnKey = index;
                return false;
            }
        });
        return returnKey;
    }

    function getQuestions() {
        var surveyCode = parseInt('{{ $code }}');

        $.ajax({
            async: false,
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
                var questions = response.response;
                questions.sort(function (a, b) {
                    var a1 = a.siraNo, b1 = b.siraNo;
                    if (parseInt(a1) === parseInt(b1)) return 0;
                    return a1 > b1 ? 1 : -1;
                });

                allQuestions = questions;

                questionsCard.html('');
                $.each(questions, function (index) {
                    questionsCard.append(`
                    <div class="row mb-2">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body py-2 cursor-pointer questionSelector" id="question_${questions[index].id}" data-id="${questions[index].id}">
                                    <i class="me-2 fa fa-at"></i><span>${questions[index].soru}</span>
                                </div>
                            </div>
                            <div style="display: none" id="question_${questions[index].id}_answers">

                            </div>
                        </div>
                    </div>
                    `);
                });

            },
            error: function (error) {
                toastr.error('Script Soruları Alınırken Sistemsel Bir Hata Oluştu!');
                console.log(error)
            }
        });
    }

    getQuestions();

    $(document).delegate('.questionSelector', 'click', function () {
        var id = $(this).data('id');
        var answersCard = $("#question_" + id + "_answers");

        if (answersCard.css('display') === 'none') {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.operationApi.surveySystem.getSurveyAnswersList') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    questionId: id,
                },
                success: function (response) {
                    var answers = response.response;
                    answersCard.html('');
                    answersCard.append(`
                    <div class="mt-2 ms-10">
                        <h6>Cevaplar</h6>
                    </div>
                    `);
                    $.each(answers, function (index) {
                        answersCard.append(`
                            <div class="card mt-2 ms-10">
                                <div class="card-body py-2 cursor-pointer answerSelector" id="answer_${answers[index].id}" data-id="${answers[index].id}">
                                    <i class="me-2 fa fa-at"></i><span>${answers[index].cevap}</span>
                                </div>
                            </div>
                            <div id="answer_${answers[index].id}_sub_questions" style="display: none">

                            </div>
                            <div id="answer_${answers[index].id}_products" style="display: none">

                            </div>
                        `);
                    });
                    answersCard.slideToggle();
                },
                error: function () {

                }
            });
        } else {
            answersCard.slideToggle();
        }
    });

    $(document).delegate('.answerSelector', 'click', function () {
        var id = $(this).data('id');
        var answerSubQuestionsCard = $("#answer_" + id + "_sub_questions");
        var answerProductsCard = $("#answer_" + id + "_products");

        if (answerSubQuestionsCard.css('display') === 'none') {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.operationApi.surveySystem.getSurveyAnswerEdit') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    answerId: id,
                },
                success: function (response) {

                    var answer = response.response;

                    if (answer.questions != null) {
                        answerSubQuestionsCard.html('');
                        answerSubQuestionsCard.append(`
                        <div class="mt-2 ms-20">
                            <h6>Alt Sorular</h6>
                        </div>
                        `);
                        $.each(answer.questions, function (index) {
                            answerSubQuestionsCard.append(`
                            <div class="card mt-2 ms-20">
                                <div class="card-body py-2">
                                    <i class="me-2 fa fa-at"></i><span>${allQuestions[SearchInArray(allQuestions, answer.questions[index].sorularId)].soru}</span>
                                </div>
                            </div>
                            `);
                        });
                        answerSubQuestionsCard.slideToggle();
                    }

                    if (answer.products != null) {
                        answerProductsCard.html('');
                        answerProductsCard.append(`
                        <div class="mt-2 ms-20">
                            <h6>Cevaba Bağlı Ürünler</h6>
                        </div>
                        `);
                        $.each(answer.products, function (index) {
                            answerProductsCard.append(`
                            <div class="card mt-2 ms-20">
                                <div class="card-body py-2">
                                    <i class="me-2 fa fa-at"></i><span>${answer.products[index].urunKodu}</span>
                                </div>
                            </div>
                            `);
                        });
                        answerProductsCard.slideToggle();
                    }
                },
                error: function () {

                }
            });
        } else {
            answerSubQuestionsCard.slideToggle();
        }
    });

</script>
