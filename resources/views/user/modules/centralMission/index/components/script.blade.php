<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var centralMissionsRow = $('#centralMissions');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var relationTypeFilter = $('#relationTypeFilter');
    var relationIdFilter = $('#relationIdFilter');
    var typeIdsFilter = $('#typeIdsFilter');
    var statusIdsFilter = $('#statusIdsFilter');

    var CreateCentralMissionButton = $('#CreateCentralMissionButton');
    var UpdateCentralMissionButton = $('#UpdateCentralMissionButton');
    var DeleteCentralMissionButton = $('#DeleteCentralMissionButton');

    var createCentralMissionTypeId = $('#create_central_mission_type_id');
    var createCentralMissionStatusId = $('#create_central_mission_status_id');

    var updateCentralMissionTypeId = $('#update_central_mission_type_id');
    var updateCentralMissionStatusId = $('#update_central_mission_status_id');

    var GetCentralMissionsButton = $('#GetCentralMissionsButton');

    relationTypeFilter.change(function () {
        if (relationTypeFilter.val() === 'App\\Models\\Eloquent\\Employee') {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.employee.getByCompanyIds') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyIds: SelectedCompanies.val(),
                    pageIndex: 0,
                    pageSize: 1000,
                    leave: 0,
                },
                success: function (response) {
                    relationIdFilter.empty();
                    $.each(response.response.employees, function (i, employee) {
                        relationIdFilter.append(
                            $('<option>', {
                                value: employee.id,
                                text: employee.name
                            })
                        );
                    });
                    relationIdFilter.val('');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Görevli Listesi Alınırken Serviste Bir Sorun Oluştu!');
                }
            });
        } else if (relationTypeFilter.val() === 'App\\Models\\Eloquent\\User') {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.user.getAll') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyIds: SelectedCompanies.val(),
                    pageIndex: 0,
                    pageSize: 1000,
                    leave: 0,
                },
                success: function (response) {
                    relationIdFilter.empty();
                    $.each(response.response, function (i, user) {
                        relationIdFilter.append(
                            $('<option>', {
                                value: user.id,
                                text: user.name
                            })
                        );
                    });
                    relationIdFilter.val('');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Görevli Listesi Alınırken Serviste Bir Sorun Oluştu!');
                }
            });
        } else {
            toastr.warning('Geçersiz Bir Görevli Türü Seçtiniz!');
        }
    });

    function createCentralMission() {
        var relationType = relationTypeFilter.val();
        var relationId = relationIdFilter.val();

        if (!relationType) {
            toastr.warning('Görevli Türü Seçmelisiniz!');
        } else if (!relationId) {
            toastr.warning('Görevli Seçmelisiniz!');
        } else {
            createCentralMissionTypeId.val('').trigger('change');
            createCentralMissionStatusId.val('').trigger('change');
            $('#create_central_mission_title').val('');
            $('#create_central_mission_description').val('');
            $('#create_central_mission_start_date').val('');
            $('#create_central_mission_end_date').val('');
            $('#CreateCentralMissionModal').modal('show');
        }
    }

    function updateCentralMission(id) {
        $('#update_central_mission_id').val(id);
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.centralMission.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateCentralMissionTypeId.val(response.response.type_id).trigger('change');
                updateCentralMissionStatusId.val(response.response.status_id).trigger('change');
                $('#update_central_mission_title').val(response.response.title);
                $('#update_central_mission_description').val(response.response.description);
                $('#update_central_mission_start_date').val(response.response.start_date ? response.response.start_date : '');
                $('#update_central_mission_end_date').val(response.response.end_date ? response.response.end_date : '');
                $('#UpdateCentralMissionModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Görev Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteCentralMission(id) {
        $('#delete_central_mission_id').val(id);
        $('#DeleteCentralMissionModal').modal('show');
    }

    function getCentralMissionTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.centralMissionType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                typeIdsFilter.empty();
                createCentralMissionTypeId.empty();
                updateCentralMissionTypeId.empty();
                $.each(response.response, function (i, centralMissionType) {
                    typeIdsFilter.append(
                        $('<option>', {
                            value: centralMissionType.id,
                            text: centralMissionType.name
                        })
                    );
                    createCentralMissionTypeId.append(
                        $('<option>', {
                            value: centralMissionType.id,
                            text: centralMissionType.name
                        })
                    );
                    updateCentralMissionTypeId.append(
                        $('<option>', {
                            value: centralMissionType.id,
                            text: centralMissionType.name
                        })
                    );
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Görev Türleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getCentralMissionStatuses() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.centralMissionStatus.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                statusIdsFilter.empty();
                createCentralMissionStatusId.empty();
                updateCentralMissionStatusId.empty();
                $.each(response.response, function (i, centralMissionStatus) {
                    statusIdsFilter.append(
                        $('<option>', {
                            value: centralMissionStatus.id,
                            text: centralMissionStatus.name
                        })
                    );
                    createCentralMissionStatusId.append(
                        $('<option>', {
                            value: centralMissionStatus.id,
                            text: centralMissionStatus.name
                        })
                    );
                    updateCentralMissionStatusId.append(
                        $('<option>', {
                            value: centralMissionStatus.id,
                            text: centralMissionStatus.name
                        })
                    );
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Görev Durumları Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getCentralMissionTypes();
    getCentralMissionStatuses();

    function changePage(newPage) {
        if (newPage === 1) {
            pageDownButton.attr('disabled', true);
        } else {
            pageDownButton.attr('disabled', false);
        }

        page.html(newPage);
        getCentralMissionsByRelation();
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

    function getCentralMissionsByRelation() {
        var relationType = relationTypeFilter.val();
        var relationId = relationIdFilter.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var typeIds = typeIdsFilter.val();
        var statusIds = statusIdsFilter.val();

        if (!relationType) {
            toastr.warning('Görevli Türü Seçmediniz!');
        } else if (!relationId) {
            toastr.warning('Görevli Seçmediniz!');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.centralMission.getByRelation') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    relationType: relationType,
                    relationId: relationId,
                    pageIndex: pageIndex,
                    pageSize: pageSize,
                    typeIds: typeIds,
                    statusIds: statusIds,
                },
                success: function (response) {
                    centralMissionsRow.empty();
                    $.each(response.response.centralMissions, function (i, centralMission) {
                        centralMissionsRow.append(`
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${centralMission.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-th"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="${centralMission.id}_Dropdown" style="width: 175px">
                                        <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateCentralMission(${centralMission.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                        <hr class="text-muted">
                                        <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteCentralMission(${centralMission.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                ${centralMission.type ? centralMission.type.name : ''}
                            </td>
                            <td>
                                ${centralMission.title ?? ''}
                            </td>
                            <td>
                                ${centralMission.start_date ? reformatDatetimeToDateForHuman(centralMission.start_date) : ''}
                            </td>
                            <td>
                                ${centralMission.end_date ? reformatDatetimeToDateForHuman(centralMission.end_date) : ''}
                            </td>
                            <td>
                                ${centralMission.status ? centralMission.status.name : ''}
                            </td>
                        </tr>
                        `);
                    });
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Görev Listesi Alınırken Serviste Bir Sorun Oluştu!');
                }
            });
        }
    }

    GetCentralMissionsButton.click(function () {
        getCentralMissionsByRelation();
    });

    CreateCentralMissionButton.click(function () {
        var typeId = createCentralMissionTypeId.val();
        var statusId = createCentralMissionStatusId.val();
        var relationId = relationIdFilter.val();
        var relationType = relationTypeFilter.val();
        var title = $('#create_central_mission_title').val();
        var description = $('#create_central_mission_description').val();
        var startDate = $('#create_central_mission_start_date').val();
        var endDate = $('#create_central_mission_end_date').val();

        if (!typeId) {
            toastr.warning('Görev Türü Seçmediniz!');
        } else if (!statusId) {
            toastr.warning('Görev Durumu Seçmediniz!');
        } else if (!relationType) {
            toastr.warning('Görevli Türü Seçmediniz!');
        } else if (!relationId) {
            toastr.warning('Görevli Seçmediniz!');
        } else if (!title) {
            toastr.warning('Görev Başlığı Girmediniz!');
        } else {
            CreateCentralMissionButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.centralMission.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    typeId: typeId,
                    statusId: statusId,
                    relationId: relationId,
                    relationType: relationType,
                    title: title,
                    description: description,
                    startDate: startDate,
                    endDate: endDate,
                },
                success: function () {
                    toastr.success('Görevlendirme Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#CreateCentralMissionModal').modal('hide');
                    CreateCentralMissionButton.attr('disabled', false).html('Oluştur');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Görevlendirme Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateCentralMissionButton.attr('disabled', false).html('Oluştur');
                }
            });
        }
    });

    UpdateCentralMissionButton.click(function () {
        var id = $('#update_central_mission_id').val();
        var typeId = updateCentralMissionTypeId.val();
        var statusId = updateCentralMissionStatusId.val();
        var relationId = relationIdFilter.val();
        var relationType = relationTypeFilter.val();
        var title = $('#update_central_mission_title').val();
        var description = $('#update_central_mission_description').val();
        var startDate = $('#update_central_mission_start_date').val();
        var endDate = $('#update_central_mission_end_date').val();

        if (!typeId) {
            toastr.warning('Görev Türü Seçmediniz!');
        } else if (!statusId) {
            toastr.warning('Görev Durumu Seçmediniz!');
        } else if (!relationType) {
            toastr.warning('Görevli Türü Seçmediniz!');
        } else if (!relationId) {
            toastr.warning('Görevli Seçmediniz!');
        } else if (!title) {
            toastr.warning('Görev Başlığı Girmediniz!');
        } else {
            UpdateCentralMissionButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.centralMission.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    typeId: typeId,
                    statusId: statusId,
                    relationId: relationId,
                    relationType: relationType,
                    title: title,
                    description: description,
                    startDate: startDate,
                    endDate: endDate,
                },
                success: function () {
                    toastr.success('Görevlendirme Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#UpdateCentralMissionModal').modal('hide');
                    UpdateCentralMissionButton.attr('disabled', false).html('Güncelle');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Görevlendirme Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdateCentralMissionButton.attr('disabled', false).html('Güncelle');
                }
            });
        }
    });

    DeleteCentralMissionButton.click(function () {
        var id = $('#delete_central_mission_id').val();
        DeleteCentralMissionButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.centralMission.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Görevlendirme Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#DeleteCentralMissionModal').modal('hide');
                DeleteCentralMissionButton.attr('disabled', false).html('Sil');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Görevlendirme Silinirken Serviste Bir Sorun Oluştu!');
                DeleteCentralMissionButton.attr('disabled', false).html('Sil');
            }
        });
    });

</script>
