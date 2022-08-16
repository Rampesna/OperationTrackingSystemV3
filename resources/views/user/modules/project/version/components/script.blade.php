<script>

    function getProject() {
        var id = parseInt('{{ $id }}');
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.project.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#projectNameSpan').text(response.response.name);
                $('#projectStatusBadge').text(response.response.status ? response.response.status.name : '--').addClass(`badge-light-${response.response.status ? response.response.status.color : 'info'}`);
                $('#projectDescription').html(response.response.description ?? '');
                $('#projectEndDateSpan').text(response.response.end_date ? reformatDatetimeToDateForHuman(response.response.end_date) : '--');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                if (parseInt(error.status) === 404) {
                    toastr.error('Proje Bulunamadı!');
                } else {
                    toastr.error('Proje Bilgileri Alınırken Serviste Bir Sorun Oluştu!');
                }
                $('#loader').hide();
            }
        });
    }

    function getProjectSubTasks() {
        var projectId = parseInt('{{ $id }}');
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.project.getSubtasksByProjectId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                projectId: projectId,
            },
            success: function (response) {
                var waitingSubTasks = 0;
                $.each(response.response, function (i, subTask) {
                    if (parseInt(subTask.checked) === 0) {
                        waitingSubTasks++;
                    }
                });
                $('#projectWaitingTasksSpan').text(waitingSubTasks);
            },
            error: function (error) {
                console.log(error);
                if (parseInt(error.status) === 404) {
                    toastr.error('Proje Bulunamadı!');
                } else {
                    toastr.error('Proje Bilgileri Alınırken Serviste Bir Sorun Oluştu!');
                }
            }
        });
    }

    getProject();
    getProjectSubTasks();

</script>

<script>

    var projectVersions = $('#projectVersions');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');

    var CreateProjectVersionButton = $('#CreateProjectVersionButton');
    var UpdateProjectVersionButton = $('#UpdateProjectVersionButton');
    var DeleteProjectVersionButton = $('#DeleteProjectVersionButton');

    function createProjectVersion() {
        $('#create_project_version_title').val('');
        $('#create_project_version_version').val('');
        $('#create_project_version_description').val('');
        $('#CreateProjectVersionModal').modal('show');
    }

    function updateProjectVersion(id) {
        $('#loader').show();
        $('#update_project_version_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.projectVersion.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#update_project_version_title').val(response.response.title);
                $('#update_project_version_version').val(response.response.version);
                $('#update_project_version_description').val(response.response.description);
                $('#UpdateProjectVersionModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Versiyon Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteProjectVersion(id) {
        $('#delete_project_version_id').val(id);
        $('#DeleteProjectVersionModal').modal('show');
    }

    function getVersions() {
        projectVersions.html(`<tr><td colspan="3" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var projectId = parseInt(`{{ $id }}`);
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.projectVersion.getByProjectId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                projectId: projectId,
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
            },
            success: function (response) {
                console.log(response);
                projectVersions.empty();
                $.each(response.response.projectVersions, function (i, version) {
                    projectVersions.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${version.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${version.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateProjectVersion(${version.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteProjectVersion(${version.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${version.version ?? ''}
                        </td>
                        <td>
                            ${version.title ?? ''}
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
                toastr.error('Versiyonler Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getVersions();

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
        getVersions();
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
        changePage(1);
    });

    CreateProjectVersionButton.click(function () {
        var projectId = parseInt(`{{ $id }}`);
        var title = $('#create_project_version_title').val();
        var version = $('#create_project_version_version').val();
        var description = $('#create_project_version_description').val();

        if (!title) {
            toastr.warning('Başlık Zorunludur!');
        } else if (!version) {
            toastr.warning('Versiyon Zorunludur!');
        } else {
            CreateProjectVersionButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.projectVersion.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    projectId: projectId,
                    title: title,
                    version: version,
                    description: description,
                },
                success: function () {
                    toastr.success('Versiyon Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#CreateProjectVersionModal').modal('hide');
                    CreateProjectVersionButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Versiyon Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateProjectVersionButton.attr('disabled', false).html(`Oluştur`);
                }
            });
        }
    });

    UpdateProjectVersionButton.click(function () {
        var id = $('#update_project_version_id').val();
        var title = $('#update_project_version_title').val();
        var version = $('#update_project_version_version').val();
        var description = $('#update_project_version_description').val();

        if (!title) {
            toastr.warning('Başlık Zorunludur!');
        } else if (!version) {
            toastr.warning('Versiyon Zorunludur!');
        } else {
            UpdateProjectVersionButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.projectVersion.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    title: title,
                    version: version,
                    description: description,
                },
                success: function () {
                    toastr.success('Versiyon Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#UpdateProjectVersionModal').modal('hide');
                    UpdateProjectVersionButton.attr('disabled', false).html(`Güncelle`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Versiyon Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdateProjectVersionButton.attr('disabled', false).html(`Güncelle`);
                }
            });
        }
    });

    DeleteProjectVersionButton.click(function () {
        var id = $('#delete_project_version_id').val();
        DeleteProjectVersionButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.projectVersion.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Versiyon Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#DeleteProjectVersionModal').modal('hide');
                DeleteProjectVersionButton.attr('disabled', false).html(`Sil`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Versiyon Silinirken Serviste Bir Sorun Oluştu!');
                DeleteProjectVersionButton.attr('disabled', false).html(`Sil`);
            }
        });
    });

</script>
