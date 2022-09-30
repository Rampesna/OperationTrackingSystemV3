<script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var createKnowledgeBaseQuestionAnswerEditor = null;
    var updateKnowledgeBaseQuestionAnswerEditor = null;

    ClassicEditor.create(document.querySelector('#create_knowledge_base_question_answer'), {
        ckfinder: {
            uploadUrl: '',
        }
    }).then(editor => {
        createKnowledgeBaseQuestionAnswerEditor = editor;
    }).catch(error => {
        console.error(error);
    });

    ClassicEditor.create(document.querySelector('#update_knowledge_base_question_answer'), {
        ckfinder: {
            uploadUrl: '',
        }
    }).then(editor => {
        updateKnowledgeBaseQuestionAnswerEditor = editor;
    }).catch(error => {
        console.error(error);
    });

    var knowledgeBaseQuestions = $('#knowledgeBaseQuestions');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');
    var categoryIdFilter = $('#categoryId');

    var CreateKnowledgeBaseQuestionButton = $('#CreateKnowledgeBaseQuestionButton');
    var UpdateKnowledgeBaseQuestionButton = $('#UpdateKnowledgeBaseQuestionButton');
    var DeleteKnowledgeBaseQuestionButton = $('#DeleteKnowledgeBaseQuestionButton');

    var createKnowledgeBaseQuestionCategoryId = $('#create_knowledge_base_question_category_id');
    var updateKnowledgeBaseQuestionCategoryId = $('#update_knowledge_base_question_category_id');

    function createKnowledgeBaseQuestion() {
        createKnowledgeBaseQuestionCategoryId.val('');
        $('#create_knowledge_base_question_question').val('');
        $('#create_knowledge_base_question_description').val('');
        createKnowledgeBaseQuestionAnswerEditor.setData('');
        $('#CreateKnowledgeBaseQuestionModal').modal('show');
    }

    function updateKnowledgeBaseQuestion(id) {
        $('#loader').show();
        $('#update_knowledge_base_question_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.knowledgeBaseQuestion.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateKnowledgeBaseQuestionCategoryId.val(response.response.category_id);
                $('#update_knowledge_base_question_question').val(response.response.question);
                $('#update_knowledge_base_question_description').val(response.response.description);
                updateKnowledgeBaseQuestionAnswerEditor.setData(response.response.answer);
                $('#UpdateKnowledgeBaseQuestionModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Soru Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteKnowledgeBaseQuestion(id) {
        $('#delete_knowledge_base_question_id').val(id);
        $('#DeleteKnowledgeBaseQuestionModal').modal('show');
    }

    function getKnowledgeBaseQuestionCategories() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.knowledgeBaseQuestionCategory.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createKnowledgeBaseQuestionCategoryId.empty();
                updateKnowledgeBaseQuestionCategoryId.empty();
                categoryIdFilter.empty();
                $.each(response.response, function (i, knowledgeBaseQuestionCategory) {
                    createKnowledgeBaseQuestionCategoryId.append($('<option>', {
                        value: knowledgeBaseQuestionCategory.id,
                        text: knowledgeBaseQuestionCategory.name
                    }));
                    updateKnowledgeBaseQuestionCategoryId.append($('<option>', {
                        value: knowledgeBaseQuestionCategory.id,
                        text: knowledgeBaseQuestionCategory.name
                    }));
                    categoryIdFilter.append($('<option>', {
                        value: knowledgeBaseQuestionCategory.id,
                        text: knowledgeBaseQuestionCategory.name
                    }));
                });
                categoryIdFilter.val('');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Soru Kategorileri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getKnowledgeBaseQuestions() {
        knowledgeBaseQuestions.html(`<tr><td colspan="4" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();
        var categoryId = categoryIdFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.knowledgeBaseQuestion.search') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
                categoryIds: categoryId ? [categoryId] : [],
            },
            success: function (response) {
                knowledgeBaseQuestions.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.knowledgeBaseQuestions, function (i, knowledgeBaseQuestion) {
                    knowledgeBaseQuestions.append(`
                    <tr>
                        <td class="w-50px">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${knowledgeBaseQuestion.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${knowledgeBaseQuestion.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateKnowledgeBaseQuestion(${knowledgeBaseQuestion.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteKnowledgeBaseQuestion(${knowledgeBaseQuestion.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${knowledgeBaseQuestion.question}
                        </td>
                        <td class="">
                            ${knowledgeBaseQuestion.category ? knowledgeBaseQuestion.category.name : ''}
                        </td>
                        <td class="hideIfMobile">
                            ${knowledgeBaseQuestion.view_count}
                        </td>
                    </tr>
                    `);
                });

                checkScreen();

                if (response.response.totalCount <= (pageIndex + 1) * pageSize) {
                    pageUpButton.attr('disabled', true);
                } else {
                    pageUpButton.attr('disabled', false);
                }
            },
            error: function (error) {
                console.log(error);
                toastr.error('Sorular Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getKnowledgeBaseQuestionCategories();
    getKnowledgeBaseQuestions();

    keywordFilter.on('keypress', function (e) {
        if (e.which === 13) {
            changePage(1);
        }
    });

    function changePage(newPage) {
        if (newPage === 1) {
            pageDownButton.attr('disabled', true);
        } else {
            pageDownButton.attr('disabled', false);
        }

        page.html(newPage);
        getKnowledgeBaseQuestions();
    }

    pageUpButton.click(function () {
        changePage(parseInt(page.html()) + 1);
    });

    pageDownButton.click(function () {
        changePage(parseInt(page.html()) - 1);
    });

    pageSizeSelector.change(function () {
        changePage(1);
    });

    FilterButton.click(function () {
        changePage(1);
    });

    ClearFilterButton.click(function () {
        keywordFilter.val('');
        categoryIdFilter.val('').trigger('change');
        changePage(1);
    });

    CreateKnowledgeBaseQuestionButton.click(function () {
        var categoryId = createKnowledgeBaseQuestionCategoryId.val();
        var question = $('#create_knowledge_base_question_question').val();
        var description = $('#create_knowledge_base_question_description').val();
        var answer = createKnowledgeBaseQuestionAnswerEditor.getData();

        if (!question) {
            toastr.warning('Soru Başlığı Boş Bırakılamaz!');
        } else {
            CreateKnowledgeBaseQuestionButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.knowledgeBaseQuestion.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    categoryId: categoryId,
                    question: question,
                    description: description,
                    answer: answer,
                },
                success: function () {
                    toastr.success('Soru Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#CreateKnowledgeBaseQuestionModal').modal('hide');
                    CreateKnowledgeBaseQuestionButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Soru Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateKnowledgeBaseQuestionButton.attr('disabled', false).html(`Oluştur`);
                }
            });
        }
    });

    UpdateKnowledgeBaseQuestionButton.click(function () {
        var id = $('#update_knowledge_base_question_id').val();
        var categoryId = updateKnowledgeBaseQuestionCategoryId.val();
        var question = $('#update_knowledge_base_question_question').val();
        var description = $('#update_knowledge_base_question_description').val();
        var answer = updateKnowledgeBaseQuestionAnswerEditor.getData();

        if (!question) {
            toastr.warning('Soru Başlığı Boş Bırakılamaz!');
        } else {
            UpdateKnowledgeBaseQuestionButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.knowledgeBaseQuestion.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    categoryId: categoryId,
                    question: question,
                    description: description,
                    answer: answer,
                },
                success: function () {
                    toastr.success('Soru Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#UpdateKnowledgeBaseQuestionModal').modal('hide');
                    UpdateKnowledgeBaseQuestionButton.attr('disabled', false).html(`Güncelle`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Soru Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdateKnowledgeBaseQuestionButton.attr('disabled', false).html(`Güncelle`);
                }
            });
        }
    });

    DeleteKnowledgeBaseQuestionButton.click(function () {
        var id = $('#delete_knowledge_base_question_id').val();
        DeleteKnowledgeBaseQuestionButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.knowledgeBaseQuestion.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Soru Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#DeleteKnowledgeBaseQuestionModal').modal('hide');
                DeleteKnowledgeBaseQuestionButton.attr('disabled', false).html(`Sil`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Soru Silinirken Serviste Bir Sorun Oluştu!');
                DeleteKnowledgeBaseQuestionButton.attr('disabled', false).html(`Sil`);
            }
        });
    });

</script>
