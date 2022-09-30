<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var subheaderQuestionArea = $('#subheaderQuestionArea');
    var questionArea = $('#questionArea');
    var categoryArea = $('#categoryArea');
    var answerArea = $('#answerArea');

    var knowledgeBaseQuestionId = parseInt(`{{ $id }}`);

    function getKnowledgeBaseQuestion() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.knowledgeBaseQuestion.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: knowledgeBaseQuestionId,
            },
            success: function (response) {
                var backUrl = `{{ route('employee.web.knowledgeBase.index') }}`;
                subheaderQuestionArea.html(`<a href="${backUrl}" class="fas fa-lg fa-backward cursor-pointer me-5"></a> Bilgi Bankası / ${response.response.question}`);
                questionArea.html(response.response.question);
                categoryArea.html(response.response.category ? `<span class="badge badge-secondary">${response.response.category.name}</span>` : ``);
                answerArea.html(response.response.answer);
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

    getKnowledgeBaseQuestion();

</script>
