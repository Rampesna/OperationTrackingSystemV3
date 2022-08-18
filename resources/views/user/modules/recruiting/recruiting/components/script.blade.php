<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var allRecruitingSteps = [];

    var recruitings = $('#recruitings');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');
    var stepIdsFilter = $('#stepIds');

    var createRecruitingCompanyId = $('#create_recruiting_company_id');
    var updateRecruitingCompanyId = $('#update_recruiting_company_id');

    var createRecruitingDepartmentId = $('#create_recruiting_department_id');
    var updateRecruitingDepartmentId = $('#update_recruiting_department_id');

    var createRecruitingObstacle = $('#create_recruiting_obstacle');
    var updateRecruitingObstacle = $('#update_recruiting_obstacle');

    var setStepRecruitingStepId = $('#set_step_recruiting_step_id');

    var CreateRecruitingButton = $('#CreateRecruitingButton');
    var UpdateRecruitingButton = $('#UpdateRecruitingButton');
    var CancelRecruitingButton = $('#CancelRecruitingButton');
    var ReactivateRecruitingButton = $('#ReactivateRecruitingButton');
    var SetStepRecruitingButton = $('#SetStepRecruitingButton');
    var DeleteRecruitingButton = $('#DeleteRecruitingButton');

    function getRecruitingSteps() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.recruitingStep.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                allRecruitingSteps = response.response;
                stepIdsFilter.empty();
                $.each(response.response, function (i, recruitingStep) {
                    stepIdsFilter.append($('<option>', {
                        value: recruitingStep.id,
                        text: recruitingStep.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşe Alım Durum Listesi Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    function getRecruitingDepartments() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.recruitingDepartment.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createRecruitingDepartmentId.empty();
                updateRecruitingDepartmentId.empty();
                $.each(response.response, function (i, recruitingDepartment) {
                    createRecruitingDepartmentId.append($('<option>', {
                        value: recruitingDepartment.id,
                        text: recruitingDepartment.name
                    }));
                    updateRecruitingDepartmentId.append($('<option>', {
                        value: recruitingDepartment.id,
                        text: recruitingDepartment.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşe Alım Departmanı Listesi Alınırken Serviste Bir Hata Oluştu.');
            }
        });
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
                createRecruitingCompanyId.empty();
                updateRecruitingCompanyId.empty();
                $.each(response.response, function (i, company) {
                    createRecruitingCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                    updateRecruitingCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Şirket Listesi Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    getRecruitingSteps();
    getRecruitingDepartments();
    getCompanies();

    function createRecruiting() {
        createRecruitingCompanyId.val('').trigger('change');
        createRecruitingDepartmentId.val('').trigger('change');
        createRecruitingObstacle.val('').trigger('change');
        $('#create_recruiting_name').val('');
        $('#create_recruiting_identity').val('');
        $('#create_recruiting_email').val('');
        $('#create_recruiting_phone_number').val('');
        $('#create_recruiting_birth_date').val('');
        $('#create_recruiting_cv').val('');
        $('#CreateRecruitingModal').modal('show');
    }

    function updateRecruiting(id) {
        $('#loader').show();
        $('#update_recruiting_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.recruiting.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateRecruitingCompanyId.val(response.response.company_id).trigger('change');
                updateRecruitingDepartmentId.val(response.response.department_id).trigger('change');
                updateRecruitingObstacle.val(response.response.obstacle).trigger('change');
                $('#update_recruiting_name').val(response.response.name);
                $('#update_recruiting_identity').val(response.response.identity);
                $('#update_recruiting_email').val(response.response.email);
                $('#update_recruiting_phone_number').val(response.response.phone_number);
                $('#update_recruiting_birth_date').val(response.response.birth_date);
                $('#update_recruiting_cv').val('');
                $('#UpdateRecruitingModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşe Alım Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function downloadCv(id) {
        window.open(`{{ route('user.web.file.download') }}/${id}`, '_blank');
    }

    function cancelRecruiting(id) {
        $('#cancel_recruiting_id').val(id);
        $('#CancelRecruitingModal').modal('show');
    }

    function reactivateRecruiting(id) {
        $('#reactivate_recruiting_id').val(id);
        $('#ReactivateRecruitingModal').modal('show');
    }

    function setStepRecruiting(id) {
        $('#set_step_recruiting_id').val(id);
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.recruiting.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                setStepRecruitingStepId.empty();
                $.each(allRecruitingSteps, function (i, recruitingStep) {
                    if (parseInt(recruitingStep.id) < parseInt(response.response.step_id)) {
                        setStepRecruitingStepId.append($('<option>', {
                            value: recruitingStep.id,
                            text: recruitingStep.name
                        }));
                    }
                });
                setStepRecruitingStepId.val('').trigger('change');
                $('#SetStepRecruitingModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşe Alım Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteRecruiting(id) {
        $('#delete_recruiting_id').val(id);
        $('#DeleteRecruitingModal').modal('show');
    }

    function getRecruitings() {
        recruitings.html(`<tr><td colspan="9" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();
        var stepIds = stepIdsFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.recruiting.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
                stepIds: stepIds,
            },
            success: function (response) {
                recruitings.empty();
                var wizardUrl = `{{ route('user.web.recruiting.wizard') }}`;
                $.each(response.response.recruitings, function (i, recruiting) {
                    recruitings.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${recruiting.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${recruiting.id}_Dropdown" style="width: 225px">
                                    <a href="${wizardUrl}/${recruiting.id}" target="_blank" class="dropdown-item cursor-pointer mb-2 py-3 ps-6" title="İlerleme"><i class="fas fa-forward me-2 text-info"></i> <span class="text-dark">İlerleme</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateRecruiting(${recruiting.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="downloadCv(${recruiting.cv})" title="CV İndir"><i class="fas fa-download me-2 text-info"></i> <span class="text-dark">CV İndir</span></a>
                                    ${recruiting.cancel === 0 ? `
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="cancelRecruiting(${recruiting.id})" title="İptal Et"><i class="fas fa-times-circle me-2 text-danger"></i> <span class="text-dark">İptal Et</span></a>
                                    ` : ``}
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="reactivateRecruiting(${recruiting.id})" title="Tekrar Havuza Aktar"><i class="fas fa-check-circle me-2 text-warning"></i> <span class="text-dark">Tekrar Havuza Aktar</span></a>
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="setStepRecruiting(${recruiting.id})" title="Aşama Seçimi"><i class="fas fa-redo-alt me-2 text-dark"></i> <span class="text-dark">Aşama Seçimi</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteRecruiting(${recruiting.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-${parseInt(recruiting.cancel) === 1 ? 'danger' : `${recruiting.step ? recruiting.step.color : 'secondary'}`}">${parseInt(recruiting.cancel) === 1 ? 'İptal Edildi' : `${recruiting.step ? recruiting.step.name : ''}`}</span>
                        </td>
                        <td>
                            ${recruiting.name ?? ''}
                        </td>
                        <td>
                            ${recruiting.department ? recruiting.department.name : ''}
                        </td>
                        <td>
                            ${recruiting.email ?? ''}
                        </td>
                        <td>
                            ${recruiting.phone_number ?? ''}
                        </td>
                        <td>
                            ${recruiting.identity ?? ''}
                        </td>
                        <td>
                            ${recruiting.birth_date ? reformatDatetimeToDateForHuman(recruiting.birth_date) : ''}
                        </td>
                        <td>
                            ${parseInt(recruiting.obstacle) === 1 ? 'Var' : 'Yok'}
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
                toastr.error('İşe Alım Listesi Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getRecruitings();

    SelectedCompanies.change(function () {
        getRecruitings();
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
        getRecruitings();
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
        stepIdsFilter.val([]).trigger('change');
        changePage(1);
    });

    CreateRecruitingButton.click(function () {
        var companyId = createRecruitingCompanyId.val();
        var departmentId = createRecruitingDepartmentId.val();
        var name = $('#create_recruiting_name').val();
        var identity = $('#create_recruiting_identity').val();
        var email = $('#create_recruiting_email').val();
        var phoneNumber = $('#create_recruiting_phone_number').val();
        var birthDate = $('#create_recruiting_birth_date').val();
        var obstacle = createRecruitingObstacle.val();
        var cv = $('#create_recruiting_cv')[0].files[0];
        var filePath = 'uploads/recruitings/cv/';

        if (!companyId) {
            toastr.warning('Firma Seçimi Zorunludur!');
        } else if (!departmentId) {
            toastr.warning('Departman Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('Ad Soyad Zorunludur!');
        } else if (!identity) {
            toastr.warning('TCKN Zorunludur!');
        } else if (!email) {
            toastr.warning('E-Posta Zorunludur!');
        } else if (!phoneNumber) {
            toastr.warning('Telefon Numarası Zorunludur!');
        } else if (!birthDate) {
            toastr.warning('Doğum Tarihi Zorunludur!');
        } else if (!obstacle) {
            toastr.warning('Engellilik Durumu Seçimi Zorunludur!');
        } else if (!cv) {
            toastr.warning('CV Seçimi Zorunludur!');
        } else {
            var formData = new FormData();
            formData.append('companyId', companyId);
            formData.append('departmentId', departmentId);
            formData.append('name', name);
            formData.append('identity', identity);
            formData.append('email', email);
            formData.append('phoneNumber', phoneNumber);
            formData.append('birthDate', birthDate);
            formData.append('obstacle', obstacle);
            formData.append('cv', cv);
            formData.append('filePath', filePath);

            CreateRecruitingButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                processData: false,
                contentType: false,
                type: 'post',
                url: '{{ route('user.api.recruiting.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: formData,
                success: function (response) {
                    toastr.success('İşe Alım Başarıyla Oluşturuldu.');
                    changePage(1);
                    CreateRecruitingButton.attr('disabled', false).html('Oluştur');
                    $('#CreateRecruitingModal').modal('hide');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İşe Alım Oluşturulurken Serviste Bir Sorun Oluştu.');
                    CreateRecruitingButton.attr('disabled', false).html('Oluştur');
                }
            });
        }
    });

    UpdateRecruitingButton.click(function () {
        var id = $('#update_recruiting_id').val();
        var companyId = updateRecruitingCompanyId.val();
        var departmentId = updateRecruitingDepartmentId.val();
        var name = $('#update_recruiting_name').val();
        var identity = $('#update_recruiting_identity').val();
        var email = $('#update_recruiting_email').val();
        var phoneNumber = $('#update_recruiting_phone_number').val();
        var birthDate = $('#update_recruiting_birth_date').val();
        var obstacle = updateRecruitingObstacle.val();
        var cv = $('#update_recruiting_cv')[0].files[0];
        var filePath = 'uploads/recruitings/cv/';

        if (!companyId) {
            toastr.warning('Firma Seçimi Zorunludur!');
        } else if (!departmentId) {
            toastr.warning('Departman Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('Ad Soyad Zorunludur!');
        } else if (!identity) {
            toastr.warning('TCKN Zorunludur!');
        } else if (!email) {
            toastr.warning('E-Posta Zorunludur!');
        } else if (!phoneNumber) {
            toastr.warning('Telefon Numarası Zorunludur!');
        } else if (!birthDate) {
            toastr.warning('Doğum Tarihi Zorunludur!');
        } else if (!obstacle) {
            toastr.warning('Engellilik Durumu Seçimi Zorunludur!');
        } else {
            var formData = new FormData();
            formData.append('id', id);
            formData.append('companyId', companyId);
            formData.append('departmentId', departmentId);
            formData.append('name', name);
            formData.append('identity', identity);
            formData.append('email', email);
            formData.append('phoneNumber', phoneNumber);
            formData.append('birthDate', birthDate);
            formData.append('obstacle', obstacle);
            formData.append('cv', cv);
            formData.append('filePath', filePath);

            UpdateRecruitingButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                processData: false,
                contentType: false,
                type: 'post',
                url: '{{ route('user.api.recruiting.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: formData,
                success: function (response) {
                    toastr.success('İşe Alım Başarıyla Güncellendi.');
                    changePage(parseInt(page.html()));
                    UpdateRecruitingButton.attr('disabled', false).html('Güncelle');
                    $('#UpdateRecruitingModal').modal('hide');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İşe Alım Oluşturulurken Serviste Bir Sorun Oluştu.');
                    UpdateRecruitingButton.attr('disabled', false).html('Güncelle');
                }
            });
        }
    });

    ReactivateRecruitingButton.click(function () {
        var id = $('#reactivate_recruiting_id').val();
        ReactivateRecruitingButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'put',
            url: '{{ route('user.api.recruiting.reactivate') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id
            },
            success: function () {
                toastr.success('İşe Alım Başarıyla Havuza Aktarıldı.');
                changePage(parseInt(page.html()));
                $('#ReactivateRecruitingModal').modal('hide');
                ReactivateRecruitingButton.attr('disabled', false).html('Havuza Aktar');
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşe Alım Havuza Aktarılırken Serviste Bir Sorun Oluştu.');
                ReactivateRecruitingButton.attr('disabled', false).html('Havuza Aktar');
            }
        });
    });

    SetStepRecruitingButton.click(function () {
        var id = $('#set_step_recruiting_id').val();
        var stepId = setStepRecruitingStepId.val();

        if (!stepId) {
            toastr.warning('Aşama Seçimi Zorunludur!');
        } else {
            SetStepRecruitingButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.recruiting.setStep') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    stepId: stepId
                },
                success: function () {
                    toastr.success('Aşama Seçimi Başarıyla Yapıldı.');
                    changePage(parseInt(page.html()));
                    $('#SetStepRecruitingModal').modal('hide');
                    SetStepRecruitingButton.attr('disabled', false).html('Güncelle');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Aşama Seçimi Yapılırken Serviste Bir Sorun Oluştu.');
                    SetStepRecruitingButton.attr('disabled', false).html('Güncelle');
                }
            });
        }
    });

    CancelRecruitingButton.click(function () {
        var id = $('#cancel_recruiting_id').val();
        CancelRecruitingButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'put',
            url: '{{ route('user.api.recruiting.cancel') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id
            },
            success: function () {
                toastr.success('İşe Alım Başarıyla İptal Edildi.');
                changePage(parseInt(page.html()));
                $('#CancelRecruitingModal').modal('hide');
                CancelRecruitingButton.attr('disabled', false).html('İptal Et');
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşe Alım İptal Edilirken Serviste Bir Sorun Oluştu.');
                CancelRecruitingButton.attr('disabled', false).html('İptal Et');
            }
        });
    });

    DeleteRecruitingButton.click(function () {
        var id = $('#delete_recruiting_id').val();
        DeleteRecruitingButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.recruiting.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id
            },
            success: function () {
                toastr.success('İşe Alım Başarıyla Silindi.');
                changePage(parseInt(page.html()));
                $('#DeleteRecruitingModal').modal('hide');
                DeleteRecruitingButton.attr('disabled', false).html('Sil');
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşe Alım Silinirken Serviste Bir Sorun Oluştu.');
                DeleteRecruitingButton.attr('disabled', false).html('Sil');
            }
        });
    });

</script>
