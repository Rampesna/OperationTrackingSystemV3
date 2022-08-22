<script>

    var competences = $('#competences');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');

    var CreateCompetenceButton = $('#CreateCompetenceButton');
    var UpdateCompetenceButton = $('#UpdateCompetenceButton');
    var DeleteCompetenceButton = $('#DeleteCompetenceButton');

    var createCompetenceCompanyId = $('#create_competence_company_id');
    var updateCompetenceCompanyId = $('#update_competence_company_id');

    function createCompetence() {
        createCompetenceCompanyId.val('');
        $('#create_competence_name').val('');
        $('#CreateCompetenceModal').modal('show');
    }

    function updateCompetence(id) {
        $('#loader').show();
        $('#update_competence_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.competence.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateCompetenceCompanyId.val(response.response.company_id);
                $('#update_competence_name').val(response.response.name);
                $('#UpdateCompetenceModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Yetkinlik Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteCompetence(id) {
        $('#delete_competence_id').val(id);
        $('#DeleteCompetenceModal').modal('show');
    }

    function getCompanies() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.getCompanies') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createCompetenceCompanyId.empty();
                updateCompetenceCompanyId.empty();
                $.each(response.response, function (i, company) {
                    createCompetenceCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                    updateCompetenceCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Şirketler Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getCompetences() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.competence.getByCompanyIds') }}',
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
                competences.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.competences, function (i, competence) {
                    competences.append(`
                    <tr>
                        <td>
                            ${competence.company ? competence.company.title : ''}
                        </td>
                        <td>
                            ${competence.name}
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${competence.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${competence.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateCompetence(${competence.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteCompetence(${competence.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
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
                toastr.error('Yetkinlikler Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getCompanies();
    getCompetences();

    SelectedCompanies.change(function () {
        getCompetences();
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
        getCompetences();
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

    CreateCompetenceButton.click(function () {
        var companyId = createCompetenceCompanyId.val();
        var name = $('#create_competence_name').val();

        if (!companyId) {
            toastr.warning('Şirket Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('Yetkinlik Adı Zorunludur!');
        } else {
            $('#loader').show();
            $('#CreateCompetenceModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.competence.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyId: companyId,
                    name: name
                },
                success: function () {
                    toastr.success('Yetkinlik Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Yetkinlik Oluşturulurken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateCompetenceButton.click(function () {
        var id = $('#update_competence_id').val();
        var companyId = updateCompetenceCompanyId.val();
        var name = $('#update_competence_name').val();

        if (!companyId) {
            toastr.warning('Şirket Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('Yetkinlik Adı Zorunludur!');
        } else {
            $('#loader').show();
            $('#UpdateCompetenceModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.competence.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    companyId: companyId,
                    name: name,
                },
                success: function () {
                    toastr.success('Yetkinlik Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Yetkinlik Güncellenirken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteCompetenceButton.click(function () {
        var id = $('#delete_competence_id').val();
        $('#loader').show();
        $('#DeleteCompetenceModal').modal('hide');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.competence.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Yetkinlik Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Yetkinlik Silinirken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    });

</script>
