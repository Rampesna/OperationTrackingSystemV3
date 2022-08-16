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

    var createProjectJobLandingCustomerId = $('#create_project_job_landing_customer_id');
    var updateProjectJobLandingCustomerId = $('#update_project_job_landing_customer_id');

    var createProjectJobTypeId = $('#create_project_job_type_id');
    var updateProjectJobTypeId = $('#update_project_job_type_id');

    var allLandingCustomers = [];

    function getLandingCustomers() {
        $.ajax({
            async: false,
            type: 'get',
            url: 'https://urun.ayssoft.com/api/user/customer/getAll',
            headers: {
                'Accept': 'application/json',
            },
            data: {},
            success: function (response) {
                console.log(response);
                allLandingCustomers = response.response;
                createProjectJobLandingCustomerId.empty();
                updateProjectJobLandingCustomerId.empty();
                $.each(response.response, function (i, landingCustomer) {
                    createProjectJobLandingCustomerId.append(`<option value="${landingCustomer.id}">${landingCustomer.name}</option>`);
                    updateProjectJobLandingCustomerId.append(`<option value="${landingCustomer.id}">${landingCustomer.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ürün Sistemi Kullanıcı Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getProjectJobTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.projectJobType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createProjectJobTypeId.empty();
                updateProjectJobTypeId.empty();
                $.each(response.response, function (i, projectJobType) {
                    createProjectJobTypeId.append(`<option value="${projectJobType.id}">${projectJobType.name}</option>`);
                    updateProjectJobTypeId.append(`<option value="${projectJobType.id}">${projectJobType.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Proje İş Türü Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getLandingCustomers();
    getProjectJobTypes();

    var projectJobs = $('#projectJobs');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');

    var CreateProjectJobButton = $('#CreateProjectJobButton');
    var UpdateProjectJobButton = $('#UpdateProjectJobButton');
    var DeleteProjectJobButton = $('#DeleteProjectJobButton');

    function createProjectJob() {
        createProjectJobTypeId.val('');
        createProjectJobLandingCustomerId.val('');
        $('#create_project_job_code').val('');
        $('#create_project_job_subject').val('');
        $('#create_project_job_end_date').val('');
        $('#create_project_job_description').val('');
        $('#CreateProjectJobModal').modal('show');
    }

    function updateProjectJob(id) {
        $('#loader').show();
        $('#update_project_job_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.projectJob.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateProjectJobTypeId.val(response.response.type_id).trigger('change');
                updateProjectJobLandingCustomerId.val(response.response.landing_customer_id).trigger('change');
                $('#update_project_job_code').val(response.response.code);
                $('#update_project_job_subject').val(response.response.subject);
                $('#update_project_job_end_date').val(response.response.end_date);
                $('#update_project_job_description').val(response.response.description);
                $('#UpdateProjectJobModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İş Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteProjectJob(id) {
        $('#delete_project_job_id').val(id);
        $('#DeleteProjectJobModal').modal('show');
    }

    function getJobs() {
        projectJobs.html(`<tr><td colspan="8" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var projectId = parseInt(`{{ $id }}`);
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.projectJob.getByProjectId') }}',
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
                projectJobs.empty();
                $.each(response.response.projectJobs, function (i, job) {
                    projectJobs.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${job.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${job.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateProjectJob(${job.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteProjectJob(${job.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${job.creator ? job.creator.name : ''}
                        </td>
                        <td>
                            ${job.landing_customer_id ? (allLandingCustomers.find(customers => parseInt(customers.id) === parseInt(job.landing_customer_id)).name ?? '') : ''}
                        </td>
                        <td>
                            ${job.type ? job.type.name : ''}
                        </td>
                        <td>
                            ${job.code ?? ''}
                        </td>
                        <td>
                            ${job.subject ?? ''}
                        </td>
                        <td>
                            ${job.start_date ? reformatDatetimeToDateForHuman(job.start_date) : ''}
                        </td>
                        <td>
                            ${job.end_date ? reformatDatetimeToDateForHuman(job.end_date) : ''}
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
                toastr.error('İşler Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getJobs();

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
        getJobs();
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

    CreateProjectJobButton.click(function () {
        var projectId = parseInt(`{{ $id }}`);
        var typeId = createProjectJobTypeId.val();
        var landingCustomerId = createProjectJobLandingCustomerId.val();
        var code = $('#create_project_job_code').val();
        var subject = $('#create_project_job_subject').val();
        var endDate = $('#create_project_job_end_date').val();
        var description = $('#create_project_job_description').val();

        if (!typeId) {
            toastr.warning('İş Türü Seçimi Yapılmadı!');
        } else if (!code) {
            toastr.warning('İş Kodu Girilmedi!');
        } else if (!subject) {
            toastr.warning('İş Konusu Girilmedi!');
        } else {
            CreateProjectJobButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.projectJob.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    projectId: projectId,
                    typeId: typeId,
                    landingCustomerId: landingCustomerId,
                    code: code,
                    subject: subject,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    toastr.success('İş Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#CreateProjectJobModal').modal('hide');
                    CreateProjectJobButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İş Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateProjectJobButton.attr('disabled', false).html(`Oluştur`);
                }
            });
        }
    });

    UpdateProjectJobButton.click(function () {
        var id = $('#update_project_job_id').val();
        var projectId = parseInt(`{{ $id }}`);
        var typeId = updateProjectJobTypeId.val();
        var landingCustomerId = updateProjectJobLandingCustomerId.val();
        var code = $('#update_project_job_code').val();
        var subject = $('#update_project_job_subject').val();
        var endDate = $('#update_project_job_end_date').val();
        var description = $('#update_project_job_description').val();

        if (!typeId) {
            toastr.warning('İş Türü Seçimi Yapılmadı!');
        } else if (!code) {
            toastr.warning('İş Kodu Girilmedi!');
        } else if (!subject) {
            toastr.warning('İş Konusu Girilmedi!');
        } else {
            UpdateProjectJobButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.projectJob.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    projectId: projectId,
                    typeId: typeId,
                    landingCustomerId: landingCustomerId,
                    code: code,
                    subject: subject,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    toastr.success('İş Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#UpdateProjectJobModal').modal('hide');
                    UpdateProjectJobButton.attr('disabled', false).html(`Güncelle`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İş Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdateProjectJobButton.attr('disabled', false).html(`Güncelle`);
                }
            });
        }
    });

    DeleteProjectJobButton.click(function () {
        var id = $('#delete_project_job_id').val();
        DeleteProjectJobButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.projectJob.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('İş Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#DeleteProjectJobModal').modal('hide');
                DeleteProjectJobButton.attr('disabled', false).html(`Sil`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('İş Silinirken Serviste Bir Sorun Oluştu!');
                DeleteProjectJobButton.attr('disabled', false).html(`Sil`);
            }
        });
    });

</script>
