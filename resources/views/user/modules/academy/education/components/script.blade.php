<script>

    var academyEducations = $('#academyEducations');
    var academyEducationLessonsRow = $('#academyEducationLessonsRow');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');

    var CreateAcademyEducationButton = $('#CreateAcademyEducationButton');
    var UpdateAcademyEducationButton = $('#UpdateAcademyEducationButton');
    var CreateAcademyEducationLessonButton = $('#CreateAcademyEducationLessonButton');
    var DeleteAcademyEducationButton = $('#DeleteAcademyEducationButton');

    var createAcademyEducationCompanyId = $('#create_academy_education_company_id');
    var updateAcademyEducationCompanyId = $('#update_academy_education_company_id');

    var createAcademyEducationLessonAcademyEducationIdInput = $('#create_academy_education_lesson_academy_education_id');
    var createAcademyEducationLessonNameInput = $('#create_academy_education_lesson_name');
    var createAcademyEducationLessonDurationInMinutesInput = $('#create_academy_education_lesson_duration_in_minutes');

    function createAcademyEducation() {
        createAcademyEducationCompanyId.val('');
        $('#create_academy_education_name').val('');
        $('#CreateAcademyEducationModal').modal('show');
    }

    function updateAcademyEducation(id) {
        $('#loader').show();
        $('#update_academy_education_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.academyEducation.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateAcademyEducationCompanyId.val(response.response.company_id);
                $('#update_academy_education_name').val(response.response.name);
                $('#UpdateAcademyEducationModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Akademi Eğitimi Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function getAcademyEducationLessons(academyEducationId) {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.academyEducationLesson.getByAcademyEducationId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                academyEducationId: academyEducationId,
            },
            success: function (response) {
                createAcademyEducationLessonAcademyEducationIdInput.val(academyEducationId);
                createAcademyEducationLessonNameInput.val('');
                createAcademyEducationLessonDurationInMinutesInput.val('');
                academyEducationLessonsRow.empty();
                $.each(response.response, function (i, academyEducationLesson) {
                    addAcademyEducationLesson(academyEducationLesson.id, academyEducationLesson.name, academyEducationLesson.duration_in_minutes);
                });
                $('#AcademyEducationLessonsModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                $('#loader').hide();
                toastr.error('Ders Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function addAcademyEducationLesson(id, name, durationInMinutes) {
        academyEducationLessonsRow.append(`
        <div class="row mb-3" id="academyEducationLesson${id}">
            <div class="col-xl-8">
                <input type="text" class="form-control form-control-solid update_academy_education_lesson_name" data-id="${id}" value="${name}" aria-label="Ders Adı" placeholder="Ders Adı">
            </div>
            <div class="col-xl-3">
                <input type="number" class="form-control form-control-solid onlyNumber update_academy_education_lesson_duration_in_minutes" value="${durationInMinutes}" data-id="${id}" aria-label="Ders Süresi" placeholder="Ders Süresi(dk)">
            </div>
            <div class="col-xl-1">
                <button data-id="${id}" class="btn btn-icon btn-danger DeleteAcademyEducationLessonButton">
                    <i class="fa fa-trash-alt"></i>
                </button>
            </div>
        </div>
        `);
    }

    function deleteAcademyEducation(id) {
        $('#delete_academy_education_id').val(id);
        $('#DeleteAcademyEducationModal').modal('show');
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
                createAcademyEducationCompanyId.empty();
                updateAcademyEducationCompanyId.empty();
                $.each(response.response, function (i, company) {
                    createAcademyEducationCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                    updateAcademyEducationCompanyId.append($('<option>', {
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

    function getAcademyEducations() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.academyEducation.getByCompanyIds') }}',
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
                academyEducations.empty();
                $.each(response.response.academyEducations, function (i, academyEducation) {
                    academyEducations.append(`
                    <tr>
                        <td>
                            ${academyEducation.company ? academyEducation.company.title : ''}
                        </td>
                        <td>
                            ${academyEducation.name}
                        </td>
                        <td>
                            ${academyEducation.type ? academyEducation.type.name : ''}
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${academyEducation.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${academyEducation.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="getAcademyEducationLessons(${academyEducation.id})" title="Dersleri Düzenle"><i class="fas fa-book me-2 text-info"></i> <span class="text-dark">Dersleri Düzenle</span></a>
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateAcademyEducation(${academyEducation.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteAcademyEducation(${academyEducation.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
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
                toastr.error('Akademi Eğitimleri Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getCompanies();
    getAcademyEducations();

    SelectedCompanies.change(function () {
        getAcademyEducations();
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
        getAcademyEducations();
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

    CreateAcademyEducationButton.click(function () {
        var companyId = createAcademyEducationCompanyId.val();
        var name = $('#create_academy_education_name').val();

        if (!companyId) {
            toastr.warning('Şirket Seçimi Zorunludur!');
        } else {
            $('#loader').show();
            $('#CreateAcademyEducationModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.academyEducation.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyId: companyId,
                    name: name
                },
                success: function () {
                    toastr.success('Akademi Eğitimi Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Akademi Eğitimi Oluşturulurken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateAcademyEducationButton.click(function () {
        var id = $('#update_academy_education_id').val();
        var companyId = updateAcademyEducationCompanyId.val();
        var name = $('#update_academy_education_name').val();

        if (!companyId) {
            toastr.warning('Şirket Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('Akademi Eğitimi Adı Zorunludur!');
        } else {
            $('#loader').show();
            $('#UpdateAcademyEducationModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.academyEducation.update') }}',
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
                    toastr.success('Akademi Eğitimi Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Akademi Eğitimi Güncellenirken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    CreateAcademyEducationLessonButton.click(function () {
        var academyEducationId = createAcademyEducationLessonAcademyEducationIdInput.val();
        var name = createAcademyEducationLessonNameInput.val();
        var durationInMinutes = createAcademyEducationLessonDurationInMinutesInput.val();

        if (!academyEducationId) {
            toastr.warning('Seçilen Akademi Eğitiminde Hata Var! Sayfayı Yenileyip Tekrar Deneyin.');
        } else if (!name) {
            toastr.warning('Ders Adı Zorunludur!');
        } else if (!durationInMinutes) {
            toastr.warning('Ders Süresi Zorunludur!');
        } else {
            createAcademyEducationLessonNameInput.attr('disabled', true);
            createAcademyEducationLessonDurationInMinutesInput.attr('disabled', true);
            CreateAcademyEducationLessonButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);

            $.ajax({
                type: 'post',
                url: '{{ route('user.api.academyEducationLesson.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    academyEducationId: academyEducationId,
                    name: name,
                    durationInMinutes: durationInMinutes,
                },
                success: function (response) {
                    addAcademyEducationLesson(response.response.id, response.response.name, response.response.duration_in_minutes);
                    createAcademyEducationLessonNameInput.val('').attr('disabled', false);
                    createAcademyEducationLessonDurationInMinutesInput.val('').attr('disabled', false);
                    CreateAcademyEducationLessonButton.attr('disabled', false).html(`<i class="fa fa-plus-circle"></i>`);
                },
                error: function (error) {
                    console.log(error);
                    createAcademyEducationLessonNameInput.val('').attr('disabled', false);
                    createAcademyEducationLessonDurationInMinutesInput.val('').attr('disabled', false);
                    CreateAcademyEducationLessonButton.attr('disabled', false).html(`<i class="fa fa-plus-circle"></i>`);
                }
            });
        }
    });

    DeleteAcademyEducationButton.click(function () {
        var id = $('#delete_academy_education_id').val();
        $('#loader').show();
        $('#DeleteAcademyEducationModal').modal('hide');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.academyEducation.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Akademi Eğitimi Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Akademi Eğitimi Silinirken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    });

    $('.createAcademyEducationLessonInput').on('keypress', function (e) {
        if (e.which === 13) {
            CreateAcademyEducationLessonButton.click();
        }
    });

    $(document).delegate('.update_academy_education_lesson_name', 'focusout', function () {
        var id = $(this).attr('data-id');
        var parameters = [{
            attribute: 'name',
            value: $(this).val()
        }];

        $.ajax({
            type: 'put',
            url: '{{ route('user.api.academyEducationLesson.updateByParameters') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
                parameters: parameters,
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ders Güncellenirken Serviste Bir Sorun Oluştu!');
            }
        });
    });

    $(document).delegate('.update_academy_education_lesson_duration_in_minutes', 'focusout', function () {
        var id = $(this).attr('data-id');
        var parameters = [{
            attribute: 'duration_in_minutes',
            value: $(this).val()
        }];

        $.ajax({
            type: 'put',
            url: '{{ route('user.api.academyEducationLesson.updateByParameters') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
                parameters: parameters,
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ders Güncellenirken Serviste Bir Sorun Oluştu!');
            }
        });
    });

    $(document).delegate('.DeleteAcademyEducationLessonButton', 'click', function () {
        $(this).attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.academyEducationLesson.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                $(`#academyEducationLesson${id}`).remove();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ders Silinirken Serviste Bir Sorun Oluştu!');
            }
        });
    });

    SelectedCompanies.change(function () {
        getAcademyEducations();
    });

</script>
