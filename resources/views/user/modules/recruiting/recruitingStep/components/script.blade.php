<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    function controlMobile() {
        if (detectMobile()) {
            $('#recruitingStepSubStepsDrawer').attr('data-kt-drawer-width', '90%');
        } else {
            $('#recruitingStepSubStepsDrawer').attr('data-kt-drawer-width', '900px');
        }
    }

    controlMobile();

    var recruitingSteps = $('#recruitingSteps');
    var recruitingStepSubStepsRow = $('#recruitingStepSubStepsRow');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');

    var CreateRecruitingStepButton = $('#CreateRecruitingStepButton');
    var UpdateRecruitingStepButton = $('#UpdateRecruitingStepButton');
    var DeleteRecruitingStepButton = $('#DeleteRecruitingStepButton');

    var createRecruitingStepSubStepName = $('#create_recruiting_step_sub_step_name');

    var CreateRecruitingStepSubStepButton = $('#CreateRecruitingStepSubStepButton');

    function updateRecruitingStep(id) {
        $('#loader').show();
        $('#update_recruiting_step_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.recruitingStep.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#update_recruiting_step_sms').val(response.response.sms).trigger('change');
                $('#update_recruiting_step_message').val(response.response.message);
                $('#UpdateRecruitingStepModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşe Alım Aşaması Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function updateRecruitingStepSubSteps(id, click = true) {
        $('#create_recruiting_step_sub_step_recruiting_step_id').val(id);
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.recruitingStepSubStep.getAllByRecruitingStepId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                recruitingStepId: id,
            },
            success: function (response) {
                recruitingStepSubStepsRow.empty();
                $.each(response.response, function (i, recruitingStepSubStep) {
                    recruitingStepSubStepsRow.append(`
                    <div class="col-xl-12 mb-1">
                        <div class="input-group mb-5">
                            <button class="btn btn-icon btn-success updateRecruitingStepSubStepButton" data-id="${recruitingStepSubStep.id}">
                                <i class="fa fa-sm fa-save"></i>
                            </button>
                            <input type="text" class="form-control form-control-solid" id="${recruitingStepSubStep.id}_recruiting_step_sub_step_name" value="${recruitingStepSubStep.name}">
                            <button class="btn btn-icon btn-danger deleteRecruitingStepSubStepButton" data-id="${recruitingStepSubStep.id}">
                                <i class="fa fa-sm fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    `);
                });
                if (click === true) $('#recruitingStepSubStepsDrawerButton').click();
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşe Alım Aşaması Alt Aşaması Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function getRecruitingSteps() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.recruitingStep.index') }}',
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
                recruitingSteps.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.recruitingSteps, function (i, recruitingStep) {
                    recruitingSteps.append(`
                    <tr>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${recruitingStep.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${recruitingStep.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateRecruitingStep(${recruitingStep.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateRecruitingStepSubSteps(${recruitingStep.id})" title="Aşamaları Düzenle"><i class="fas fa-level-down-alt me-2 text-info"></i> <span class="text-dark">Aşamaları Düzenle</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-${recruitingStep.color ?? 'secondary'}">${recruitingStep.name}</span>
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
                toastr.error('Merkezi Görev Durumları Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getRecruitingSteps();

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
        getRecruitingSteps();
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

    UpdateRecruitingStepButton.click(function () {
        var id = $('#update_recruiting_step_id').val();
        var sms = $('#update_recruiting_step_sms').val();
        var message = $('#update_recruiting_step_message').val();
        UpdateRecruitingStepButton.attr('disabled', true).html('<i class="fa fa-spin fa-spinner"></i>');
        $('#UpdateRecruitingStepModal').modal('hide');
        $.ajax({
            type: 'put',
            url: '{{ route('user.api.recruitingStep.update') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
                sms: sms,
                message: message,
            },
            success: function () {
                toastr.success('İşe Alım Aşaması Başarıyla Güncellendi!');
                changePage(parseInt(page.html()));
                UpdateRecruitingStepButton.attr('disabled', false).html('Güncelle');
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşe Alım Aşaması Güncellenirken Serviste Bir Sorun Oluştu!');
                UpdateRecruitingStepButton.attr('disabled', false).html('Güncelle');
            }
        });
    });

    createRecruitingStepSubStepName.on('keypress', function (e) {
        if (e.which === 13) {
            CreateRecruitingStepSubStepButton.click();
        }
    });

    CreateRecruitingStepSubStepButton.click(function () {
        var recruitingStepId = $('#create_recruiting_step_sub_step_recruiting_step_id').val();
        var name = createRecruitingStepSubStepName.val();

        if (!name) {
            toastr.warning('Yeni Alt Aşama Adı Boş Olamaz!');
        } else {
            CreateRecruitingStepSubStepButton.attr('disabled', true).html('<i class="fa fa-spin fa-spinner"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.recruitingStepSubStep.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    recruitingStepId: recruitingStepId,
                    name: name,
                },
                success: function () {
                    CreateRecruitingStepSubStepButton.attr('disabled', false).html('<i class="fa fa-sm fa-plus-circle"></i>');
                    toastr.success('Yeni Alt Aşama Başarıyla Oluşturuldu!');
                    updateRecruitingStepSubSteps(recruitingStepId, false);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Yeni Alt Aşama Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateRecruitingStepSubStepButton.attr('disabled', false).html('<i class="fa fa-sm fa-plus-circle"></i>');
                }
            });
        }
    });

    $(document).delegate('.updateRecruitingStepSubStepButton', 'click', function () {
        var button = $(this);
        var id = $(this).data('id');
        var name = $(`#${id}_recruiting_step_sub_step_name`).val();
        var recruitingStepId = $('#create_recruiting_step_sub_step_recruiting_step_id').val();

        if (!name) {
            toastr.warning('Alt Aşama Adı Boş Olamaz!');
        } else {
            button.attr('disabled', true).html('<i class="fa fa-spin fa-spinner"></i>');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.recruitingStepSubStep.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    name: name,
                },
                success: function () {
                    toastr.success('Alt Aşama Başarıyla Güncellendi!');
                    updateRecruitingStepSubSteps(recruitingStepId, false);
                },
                error: function () {
                    button.attr('disabled', false).html('<i class="fa fa-sm fa-save"></i>');
                    toastr.error('Alt Aşama Güncellenirken Serviste Bir Sorun Oluştu!');
                }
            });
        }
    });

    $(document).delegate('.deleteRecruitingStepSubStepButton', 'click', function () {
        var button = $(this);
        var id = $(this).data('id');
        var recruitingStepId = $('#create_recruiting_step_sub_step_recruiting_step_id').val();
        button.attr('disabled', true).html('<i class="fa fa-spin fa-spinner"></i>');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.recruitingStepSubStep.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Alt Aşama Başarıyla Silindi!');
                updateRecruitingStepSubSteps(recruitingStepId, false);
            },
            error: function () {
                button.attr('disabled', false).html('<i class="fa fa-sm fa-trash"></i>');
                toastr.error('Alt Aşama Silinirken Serviste Bir Sorun Oluştu!');
            }
        });
    });

</script>
