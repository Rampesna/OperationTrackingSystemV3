<script>

    var centralMissionTypes = $('#centralMissionTypes');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');

    var CreateCentralMissionTypeButton = $('#CreateCentralMissionTypeButton');
    var UpdateCentralMissionTypeButton = $('#UpdateCentralMissionTypeButton');
    var DeleteCentralMissionTypeButton = $('#DeleteCentralMissionTypeButton');

    var createCentralMissionTypeCompanyId = $('#create_central_mission_type_company_id');
    var updateCentralMissionTypeCompanyId = $('#update_central_mission_type_company_id');

    function createCentralMissionType() {
        $('#create_central_mission_type_name').val('');
        $('#CreateCentralMissionTypeModal').modal('show');
    }

    function updateCentralMissionType(id) {
        $('#loader').show();
        $('#update_central_mission_type_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.centralMissionType.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#update_central_mission_type_name').val(response.response.name);
                $('#UpdateCentralMissionTypeModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Merkezi Görev Türü Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteCentralMissionType(id) {
        $('#delete_central_mission_type_id').val(id);
        $('#DeleteCentralMissionTypeModal').modal('show');
    }

    function getCentralMissionTypes() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.centralMissionType.index') }}',
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
                centralMissionTypes.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.centralMissionTypes, function (i, centralMissionType) {
                    centralMissionTypes.append(`
                    <tr>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${centralMissionType.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${centralMissionType.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateCentralMissionType(${centralMissionType.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteCentralMissionType(${centralMissionType.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${centralMissionType.name}
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

    getCentralMissionTypes();

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
        getCentralMissionTypes();
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

    CreateCentralMissionTypeButton.click(function () {
        var name = $('#create_central_mission_type_name').val();

        if (!name) {
            toastr.warning('Merkezi Görev Türü Adı Zorunludur!');
        } else {
            $('#loader').show();
            $('#CreateCentralMissionTypeModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.centralMissionType.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    name: name,
                },
                success: function () {
                    toastr.success('Merkezi Görev Türü Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Merkezi Görev Türü Oluşturulurken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateCentralMissionTypeButton.click(function () {
        var id = $('#update_central_mission_type_id').val();
        var name = $('#update_central_mission_type_name').val();

        if (!name) {
            toastr.warning('Merkezi Görev Türü Adı Zorunludur!');
        } else {
            $('#loader').show();
            $('#UpdateCentralMissionTypeModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.centralMissionType.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    name: name,
                },
                success: function () {
                    toastr.success('Merkezi Görev Türü Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Merkezi Görev Türü Güncellenirken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteCentralMissionTypeButton.click(function () {
        var id = $('#delete_central_mission_type_id').val();
        $('#loader').show();
        $('#DeleteCentralMissionTypeModal').modal('hide');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.centralMissionType.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Merkezi Görev Türü Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Merkezi Görev Türü Silinirken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    });

</script>
