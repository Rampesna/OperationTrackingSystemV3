<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var pageIndex = 0;
    var pageSize = 10;

    var keywordInput = $('#keyword');

    var FilterButton = $('#FilterButton');

    var knowledgeBaseCategoriesRow = $('#knowledgeBaseCategoriesRow');

    function getKnowledgeBaseQuestionCategories() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.knowledgeBaseQuestionCategory.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                knowledgeBaseCategoriesRow.empty();
                $.each(response.response, function (i, knowledgeBaseQuestionCategory) {
                    knowledgeBaseCategoriesRow.append(`
                    <div class="col-xl-12 mb-5">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input knowledgeBaseQuestionCategory" type="checkbox" value="${knowledgeBaseQuestionCategory.id}" id="knowledgeBaseQuestionCategory_${knowledgeBaseQuestionCategory.id}"/>
                            <label class="form-check-label" for="knowledgeBaseQuestionCategory_${knowledgeBaseQuestionCategory.id}">${knowledgeBaseQuestionCategory.name}</label>
                        </div>
                    </div>
                    `);
                });
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

    function getKnowledgeBaseQuestions() {
        var keyword = keywordInput.val();
        var categoryIds = [];
        var knowledgeBaseQuestionCategories = $('.knowledgeBaseQuestionCategory');
        $.each(knowledgeBaseQuestionCategories, function (i, knowledgeBaseQuestionCategory) {
            if ($(knowledgeBaseQuestionCategory).is(':checked')) {
                categoryIds.push($(knowledgeBaseQuestionCategory).val());
            }
        });

        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.knowledgeBaseQuestionCategory.search') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                pageIndex: pageIndex,
                pageSize: pageSize,
                categoryIds: categoryIds,
                keyword: keyword
            },
            success: function (response) {
                console.log(response);
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

    getKnowledgeBaseQuestionCategories();

    FilterButton.click(function () {
        pageIndex = 0;
        getKnowledgeBaseQuestions();
    });

    keywordInput.keyup(function (e) {
        if (parseInt(e.keyCode) === 13) {
            pageIndex = 0;
            getKnowledgeBaseQuestions();
        }
    });

</script>
