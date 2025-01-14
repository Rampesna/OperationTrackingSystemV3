<script>

    var overviewPermission = `{{ checkUserPermission(142, $userPermissions) ? 'true' : 'false' }}`

    var projectsRow = $('#projects');
    var keywordFilter = $('#keyword');
    var statusIdsFilter = $('#statusIds');

    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var CreateProjectButton = $('#CreateProjectButton');

    var createProjectCompanyId = $('#create_project_company_id');
    var createProjectUserIds = $('#create_project_user_ids');

    function createProject() {
        createProjectCompanyId.val('').trigger('change');
        createProjectUserIds.val([]).trigger('change');
        $('#create_project_name').val('');
        $('#create_project_code').val('');
        $('#create_project_start_date').val('');
        $('#create_project_end_date').val('');
        $('#create_project_description').val('');
        $('#CreateProjectModal').modal('show');
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
                createProjectCompanyId.empty();
                $.each(response.response, function (i, company) {
                    createProjectCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Firma Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getUsers() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.user.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createProjectUserIds.empty();
                $.each(response.response, function (i, user) {
                    createProjectUserIds.append($('<option>', {
                        value: user.id,
                        text: user.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kullanıcı Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getProjectStatuses() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.projectStatus.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                statusIdsFilter.empty();
                $.each(response.response, function (i, projectStatus) {
                    statusIdsFilter.append(
                        $('<option>', {
                            value: projectStatus.id,
                            text: projectStatus.name
                        })
                    );
                });
                statusIdsFilter.trigger('change');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Proje Durumları Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getCompanies();
    getUsers();
    getProjectStatuses();

    function getProjects() {
        $('#loader').show();
        var keyword = keywordFilter.val();
        var statusIds = statusIdsFilter.val();
        var ticketStatusIds = [1,2];

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.project.getByUserId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                keyword: keyword,
                statusIds: statusIds,
                ticketStatusIds: ticketStatusIds
            },
            success: function (response) {
                var imageUrl = '{{ asset('assets/media/svg/brand-logos/xing-icon.svg') }}';
                projectsRow.empty();
                $.each(response.response, function (i, project) {
                    var overviewRoute = `{{ route('user.web.project.overview') }}/${project.id}`;
                    projectsRow.append(`
                    <div class="col-md-6 col-xl-4 mb-5">
                        <div class="card border-hover-primary">
                            <div class="card-header border-0 pt-9 d-flex">
                                <div class="card-title m-0">
                                    <a ${overviewPermission === 'true' ? `href="${overviewRoute}"` : ``} class="symbol symbol-50px w-50px bg-light">
                                        <img src="${imageUrl}" alt="image" class="p-3">
                                    </a>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 p-0 m-0">
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="fs-4 fw-bolder" id="waitingTicketsCount_${project.id}">${project.tickets.length}</div>
                                            </div>
                                            <div class="fw-bold fs-6 text-gray-400">Bekleyen Talepler</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-9">
                                <a ${overviewPermission === 'true' ? `href="${overviewRoute}"` : ``} class="fs-3 fw-bolder text-dark">${project.name}</a>
                                <p></p>
                                <div class="bg-primary rounded h-8px" role="progressbar" style="width: ${project.progress}%" aria-valuenow="${project.progress}" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="row">
                                    <div class="col-xl-12 mt-2 text-end">
                                        <span class="fw-bolder">${project.progress}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });

                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Projeler Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    getProjects();

    FilterButton.click(function () {
        getProjects();
    });

    ClearFilterButton.click(function () {
        keywordFilter.val('');
        statusIdsFilter.val([]).trigger('change');
        getProjects();
    });

    keywordFilter.on('keypress', function (e) {
        if (e.which === 13) {
            getProjects();
        }
    });

    CreateProjectButton.click(function () {
        var companyId = createProjectCompanyId.val();
        var name = $('#create_project_name').val();
        var code = $('#create_project_code').val();
        var startDate = $('#create_project_start_date').val();
        var endDate = $('#create_project_end_date').val();
        var description = $('#create_project_description').val();

        if (!companyId) {
            toastr.warning('Firma Seçimi Yapılmamış!');
        } else if (!name) {
            toastr.warning('Proje Adı Girilmemiş!');
        } else {
            CreateProjectButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.project.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyId: companyId,
                    name: name,
                    code: code,
                    startDate: startDate,
                    endDate: endDate,
                    description: description,
                },
                success: function (response) {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('user.api.project.setUsersByProjectId') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            projectId: response.response.id,
                            userIds: createProjectUserIds.val()
                        },
                        success: function () {
                            toastr.success('Proje Başarıyla Oluşturuldu!');
                            $('#CreateProjectModal').modal('hide');
                            getProjects();
                            CreateProjectButton.prop('disabled', false).html('Oluştur');
                        },
                        error: function (error) {
                            console.log(error);
                            toastr.error('Proje Oluşturuldu Ancak Kullanıcılar Bağlanırken Serviste Bir Sorun Oluştu!');
                            CreateProjectButton.prop('disabled', false).html('Oluştur');
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Proje Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateProjectButton.prop('disabled', false).html('Oluştur');
                }
            });
        }
    });

</script>
