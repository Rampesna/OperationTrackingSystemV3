<script>

    var updateProjectCompanyId = $('#update_project_company_id');
    var updateProjectStatusId = $('#update_project_status_id');
    var updateProjectUserIds = $('#update_project_user_ids');

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
                updateProjectCompanyId.empty();
                $.each(response.response, function (i, company) {
                    updateProjectCompanyId.append($('<option>', {
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
                updateProjectStatusId.empty();
                $.each(response.response, function (i, status) {
                    updateProjectStatusId.append($('<option>', {
                        value: status.id,
                        text: status.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Proje Durumu Listesi Alınırken Serviste Bir Sorun Oluştu!');
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
                updateProjectUserIds.empty();
                $.each(response.response, function (i, user) {
                    updateProjectUserIds.append($('<option>', {
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

    getCompanies();
    getProjectStatuses();
    getUsers();
    getProject();
    getProjectSubTasks();

</script>

<script>

    var status1Span = $('#status_1_count');
    var status2Span = $('#status_2_count');
    var status3Span = $('#status_3_count');
    var status4Span = $('#status_4_count');
    var status5Span = $('#status_5_count');

    function updateProject() {
        var id = parseInt(`{{ $id }}`);
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
                updateProjectCompanyId.val(response.response.company_id);
                updateProjectStatusId.val(response.response.status_id);
                $('#update_project_name').val(response.response.name);
                $('#update_project_code').val(response.response.code);
                $('#update_project_start_date').val(response.response.start_date);
                $('#update_project_end_date').val(response.response.end_date);
                $('#update_project_description').val(response.response.description);
                $.ajax({
                    type: 'get',
                    url: '{{ route('user.api.project.getUsersByProjectId') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        projectId: id,
                    },
                    success: function (response) {
                        updateProjectUserIds.val(
                            $.map(response.response, function (user) {
                                return user.id;
                            })
                        );
                        $('#UpdateProjectModal').modal('show');
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Proje Kullanıcıları Alınırken Serviste Bir Sorun Oluştu!');
                    }
                });
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

    function getTicketsByRelation() {
        var relationType = 'App\\Models\\Eloquent\\Project';
        var relationId = parseInt(`{{ $id }}`);
        var pageIndex = 0;
        var pageSize = 99999;
        var keyword = '';
        var priorityIds = [];
        var statusIds = [];

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.ticket.getByRelation') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                relationType: relationType,
                relationId: relationId,
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
                priorityIds: priorityIds,
                statusIds: statusIds,
            },
            success: function (response) {
                var status1Count = 0;
                var status2Count = 0;
                var status3Count = 0;
                var status4Count = 0;
                var status5Count = 0;
                $.each(response.response.tickets, function (i, ticket) {
                    if (parseInt(ticket.status_id) === 1) status1Count++;
                    if (parseInt(ticket.status_id) === 2) status2Count++;
                    if (parseInt(ticket.status_id) === 3) status3Count++;
                    if (parseInt(ticket.status_id) === 4) status4Count++;
                    if (parseInt(ticket.status_id) === 5) status5Count++;
                });
                status1Span.text(status1Count);
                status2Span.text(status2Count);
                status3Span.text(status3Count);
                status4Span.text(status4Count);
                status5Span.text(status5Count);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Destek Talepleri Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getTicketsByRelation();

    var UpdateProjectButton = $('#UpdateProjectButton');

    UpdateProjectButton.click(function () {
        var id = parseInt(`{{ $id }}`);
        var companyId = updateProjectCompanyId.val();
        var statusId = updateProjectStatusId.val();
        var name = $('#update_project_name').val();
        var code = $('#update_project_code').val();
        var startDate = $('#update_project_start_date').val();
        var endDate = $('#update_project_end_date').val();
        var description = $('#update_project_description').val();

        if (!companyId) {
            toastr.warning('Firma Seçimi Yapılmamış!');
        } else if (!statusId) {
            toastr.warning('Proje Durumu Seçilmemiş!');
        } else if (!name) {
            toastr.warning('Proje Adı Girilmemiş!');
        } else {
            UpdateProjectButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.project.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    companyId: companyId,
                    statusId: statusId,
                    name: name,
                    code: code,
                    startDate: startDate,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    $.ajax({
                        type: 'post',
                        url: '{{ route('user.api.project.setUsersByProjectId') }}',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': token
                        },
                        data: {
                            projectId: id,
                            userIds: updateProjectUserIds.val()
                        },
                        success: function () {
                            toastr.success('Proje Başarıyla Güncellendi!');
                            $('#UpdateProjectModal').modal('hide');
                            getProject();
                            UpdateProjectButton.prop('disabled', false).html('Güncelle');
                        },
                        error: function (error) {
                            console.log(error);
                            toastr.error('Proje Güncellendi Ancak Kullanıcılar Bağlanırken Serviste Bir Sorun Oluştu!');
                            UpdateProjectButton.prop('disabled', false).html('Güncelle');
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Proje Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdateProjectButton.prop('disabled', false).html('Güncelle');
                }
            });
        }
    });

</script>
