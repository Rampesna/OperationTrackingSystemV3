<script>

    var knowledgeBaseQuestionCategories = $('#knowledgeBaseQuestionCategories');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');

    var CreateKnowledgeBaseQuestionCategoryButton = $('#CreateKnowledgeBaseQuestionCategoryButton');
    var UpdateKnowledgeBaseQuestionCategoryButton = $('#UpdateKnowledgeBaseQuestionCategoryButton');
    var DeleteKnowledgeBaseQuestionCategoryButton = $('#DeleteKnowledgeBaseQuestionCategoryButton');

    function createKnowledgeBaseQuestionCategory() {
        $('#create_knowledge_base_question_category_name').val('');
        $('#CreateKnowledgeBaseQuestionCategoryModal').modal('show');
    }

    function updateKnowledgeBaseQuestionCategory(id) {
        $('#loader').show();
        $('#update_knowledge_base_question_category_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.knowledgeBaseQuestionCategory.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#update_knowledge_base_question_category_name').val(response.response.name);
                $('#UpdateKnowledgeBaseQuestionCategoryModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kategori Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteKnowledgeBaseQuestionCategory(id) {
        $('#delete_knowledge_base_question_category_id').val(id);
        $('#DeleteKnowledgeBaseQuestionCategoryModal').modal('show');
    }

    function getKnowledgeBaseQuestionCategories() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.knowledgeBaseQuestionCategory.index') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
            },
            success: function (response) {
                knowledgeBaseQuestionCategories.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.knowledgeBaseQuestionCategories, function (i, knowledgeBaseQuestionCategory) {
                    knowledgeBaseQuestionCategories.append(`
                    <tr>
                        <td class="">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${knowledgeBaseQuestionCategory.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${knowledgeBaseQuestionCategory.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateKnowledgeBaseQuestionCategory(${knowledgeBaseQuestionCategory.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteKnowledgeBaseQuestionCategory(${knowledgeBaseQuestionCategory.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${knowledgeBaseQuestionCategory.name}
                        </td>
                    </tr>
                    `);
                });

                if (response.response.totalCount <= (pageIndex + 1) * pageSize) {
                    pageUpButton.attr('disabled', true);
                } else {
                    pageUpButton.attr('disabled', false);
                }

                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kategoriler Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getKnowledgeBaseQuestionCategories();

    SelectedCompanies.change(function () {
        getKnowledgeBaseQuestionCategories();
    });

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
        getKnowledgeBaseQuestionCategories();
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

    CreateKnowledgeBaseQuestionCategoryButton.click(function () {
        var name = $('#create_knowledge_base_question_category_name').val();

        if (!name) {
            toastr.warning('Kategori Adı Zorunludur!');
        } else {
            $('#loader').show();
            $('#CreateKnowledgeBaseQuestionCategoryModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.knowledgeBaseQuestionCategory.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    name: name
                },
                success: function () {
                    toastr.success('Kategori Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Kategori Oluşturulurken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateKnowledgeBaseQuestionCategoryButton.click(function () {
        var id = $('#update_knowledge_base_question_category_id').val();
        var name = $('#update_knowledge_base_question_category_name').val();

        if (!name) {
            toastr.warning('Kategori Adı Zorunludur!');
        } else {
            $('#loader').show();
            $('#UpdateKnowledgeBaseQuestionCategoryModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.knowledgeBaseQuestionCategory.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    name: name,
                },
                success: function () {
                    toastr.success('Kategori Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Kategori Güncellenirken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteKnowledgeBaseQuestionCategoryButton.click(function () {
        var id = $('#delete_knowledge_base_question_category_id').val();
        $('#loader').show();
        $('#DeleteKnowledgeBaseQuestionCategoryModal').modal('hide');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.knowledgeBaseQuestionCategory.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Kategori Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kategori Silinirken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    });

</script>
