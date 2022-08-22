<script>

    var centralMissionStatuses = $('#centralMissionStatuses');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');

    var CreateCentralMissionStatusButton = $('#CreateCentralMissionStatusButton');
    var UpdateCentralMissionStatusButton = $('#UpdateCentralMissionStatusButton');
    var DeleteCentralMissionStatusButton = $('#DeleteCentralMissionStatusButton');

    var createCentralMissionStatusCompanyId = $('#create_central_mission_status_company_id');
    var updateCentralMissionStatusCompanyId = $('#update_central_mission_status_company_id');

    function createCentralMissionStatus() {
        $('#create_central_mission_status_name').val('');
        $('#CreateCentralMissionStatusModal').modal('show');
    }

    function updateCentralMissionStatus(id) {
        $('#loader').show();
        $('#update_central_mission_status_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.centralMissionStatus.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#update_central_mission_status_name').val(response.response.name);
                $('#UpdateCentralMissionStatusModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Merkezi Görev Durumu Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteCentralMissionStatus(id) {
        $('#delete_central_mission_status_id').val(id);
        $('#DeleteCentralMissionStatusModal').modal('show');
    }

    function getCentralMissionStatuses() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.centralMissionStatus.index') }}',
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
                centralMissionStatuses.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.centralMissionStatuses, function (i, centralMissionStatus) {
                    centralMissionStatuses.append(`
                    <tr>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${centralMissionStatus.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${centralMissionStatus.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateCentralMissionStatus(${centralMissionStatus.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteCentralMissionStatus(${centralMissionStatus.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${centralMissionStatus.name}
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

    getCentralMissionStatuses();

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
        getCentralMissionStatuses();
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

    CreateCentralMissionStatusButton.click(function () {
        var name = $('#create_central_mission_status_name').val();

        if (!name) {
            toastr.warning('Merkezi Görev Durumu Adı Zorunludur!');
        } else {
            $('#loader').show();
            $('#CreateCentralMissionStatusModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.centralMissionStatus.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    name: name,
                },
                success: function () {
                    toastr.success('Merkezi Görev Durumu Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Merkezi Görev Durumu Oluşturulurken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateCentralMissionStatusButton.click(function () {
        var id = $('#update_central_mission_status_id').val();
        var name = $('#update_central_mission_status_name').val();

        if (!name) {
            toastr.warning('Merkezi Görev Durumu Adı Zorunludur!');
        } else {
            $('#loader').show();
            $('#UpdateCentralMissionStatusModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.centralMissionStatus.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    name: name,
                },
                success: function () {
                    toastr.success('Merkezi Görev Durumu Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Merkezi Görev Durumu Güncellenirken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteCentralMissionStatusButton.click(function () {
        var id = $('#delete_central_mission_status_id').val();
        $('#loader').show();
        $('#DeleteCentralMissionStatusModal').modal('hide');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.centralMissionStatus.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Merkezi Görev Durumu Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Merkezi Görev Durumu Silinirken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    });

</script>
