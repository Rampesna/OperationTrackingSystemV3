<script>

    var employee = null;

    var employeeId = `{{ $id }}`;

    var employeeImageSpan = $('#employeeImageSpan');
    var employeeNameSpan = $('#employeeNameSpan');
    var employeeIdentitySpan = $('#employeeIdentitySpan');
    var employeeEmailSpan = $('#employeeEmailSpan');
    var employeePhoneSpan = $('#employeePhoneSpan');

    function getEmployeeById() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: employeeId,
            },
            success: function (response) {
                employee = response;
                if (response.response.image) employeeImageSpan.attr('src', `${baseAssetUrl}${response.response.image}`);
                employeeNameSpan.html(response.response.name);
                employeeIdentitySpan.html(`<i class="far fa-user-circle me-4"></i><span class="mt-n1">${response.response.identity}</span>`);
                employeeEmailSpan.html(`<i class="far fa-envelope me-4"></i><span class="mt-n1">${response.response.email}</span>`);
                employeePhoneSpan.html(`<i class="fas fa-phone-square-alt me-4"></i><span class="mt-n1">${response.response.phone}</span>`);
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                $('#loader').hide();
                toastr.error('Personel Bilgileri Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    getEmployeeById();

</script>

<script>

    var punishments = $('#punishments');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var CreatePunishmentButton = $('#CreatePunishmentButton');
    var UpdatePunishmentButton = $('#UpdatePunishmentButton');
    var DeletePunishmentButton = $('#DeletePunishmentButton');

    var createPunishmentCategoryId = $('#create_punishment_category_id');
    var updatePunishmentCategoryId = $('#update_punishment_category_id');

    function createPunishment() {
        createPunishmentCategoryId.val('');
        $('#CreatePunishmentModal').modal('show');
    }

    function updatePunishment(id) {
        $('#loader').show();
        $('#update_punishment_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.punishment.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updatePunishmentTypeId.val(response.response.type_id);
                updatePunishmentStatusId.val(response.response.status_id);
                $('#update_punishment_start_date').val(reformatDatetimeForInput(response.response.start_date));
                $('#update_punishment_end_date').val(reformatDatetimeForInput(response.response.end_date));
                $('#update_punishment_description').val(response.response.description);
                $('#UpdatePunishmentModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İzin Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deletePunishment(id) {
        $('#delete_punishment_id').val(id);
        $('#DeletePunishmentModal').modal('show');
    }

    function getPunishmentTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.punishmentType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createPunishmentTypeId.empty();
                updatePunishmentTypeId.empty();
                typeIdFilter.empty();
                $.each(response.response, function (i, punishmentType) {
                    createPunishmentTypeId.append($('<option>', {
                        value: punishmentType.id,
                        text: punishmentType.name
                    }));
                    updatePunishmentTypeId.append($('<option>', {
                        value: punishmentType.id,
                        text: punishmentType.name
                    }));
                    typeIdFilter.append($('<option>', {
                        value: punishmentType.id,
                        text: punishmentType.name
                    }));
                });
                typeIdFilter.val('');
            },
            error: function (error) {
                console.log(error);
                toastr.error('İzin Türleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getPunishments() {
        punishments.html(`<tr><td colspan="7" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var employeeId = parseInt(`{{ $id }}`);
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var startDate = startDateFilter.val();
        var endDate = endDateFilter.val();
        var statusId = statusIdFilter.val();
        var typeId = typeIdFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.punishment.getByEmployeeId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: employeeId,
                pageIndex: pageIndex,
                pageSize: pageSize,
                startDate: startDate ? startDate + ' 00:00:00' : null,
                endDate: endDate ? endDate + ' 23:59:59' : null,
                statusId: statusId,
                typeId: typeId,
            },
            success: function (response) {
                punishments.empty();
                $.each(response.response.punishments, function (i, punishment) {
                    punishments.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${punishment.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${punishment.id}_Dropdown" style="width: 175px">
                                    ${updatePermission === 'true' ? `
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updatePunishment(${punishment.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    ` : ``}
                                    ${deletePermission === 'true' ? `
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deletePunishment(${punishment.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                    ` : ``}
                                </div>
                            </div>
                        </td>
                        <td>
                            ${punishment.employee ? punishment.employee.name : ''}
                        </td>
                        <td>
                            <span class="badge badge-${punishment.status ? punishment.status.color : ''}">${punishment.status ? punishment.status.name : ''}</span>
                        </td>
                        <td class="hideIfMobile">
                            ${punishment.type ? punishment.type.name : ''}
                        </td>
                        <td class="hideIfMobile">
                            ${reformatDatetimeToDatetimeForHuman(punishment.start_date)}
                        </td>
                        <td class="hideIfMobile">
                            ${reformatDatetimeToDatetimeForHuman(punishment.end_date)}
                        </td>
                        <td class="hideIfMobile">
                            ${minutesToString(getMinutesBetweenTwoDates(punishment.start_date, punishment.end_date))}
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
                toastr.error('İzinler Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getPunishmentTypes();
    getPunishments();

    SelectedCompanies.change(function () {
        getPunishments();
    });

    function changePage(newPage) {
        if (newPage === 1) {
            pageDownButton.attr('disabled', true);
        } else {
            pageDownButton.attr('disabled', false);
        }

        page.html(newPage);
        getPunishments();
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
        typeIdFilter.val('').trigger('change');
        statusIdFilter.val('').trigger('change');
        startDateFilter.val('');
        endDateFilter.val('');
        changePage(1);
    });

    CreatePunishmentButton.click(function () {
        var employeeId = parseInt(`{{ $id }}`);
        var typeId = createPunishmentTypeId.val();
        var statusId = createPunishmentStatusId.val();
        var startDate = $('#create_punishment_start_date').val();
        var endDate = $('#create_punishment_end_date').val();
        var description = $('#create_punishment_description').val();

        if (!employeeId) {
            toastr.warning('Personel Seçimi Zorunludur!');
        } else if (!typeId) {
            toastr.warning('İzin Türü Seçimi Zorunludur!');
        } else if (!statusId) {
            toastr.warning('İzin Durumu Seçimi Zorunludur!');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçimi Zorunludur!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçimi Zorunludur!');
        } else {
            CreatePunishmentButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.punishment.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    employeeId: employeeId,
                    typeId: typeId,
                    statusId: statusId,
                    startDate: startDate,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    toastr.success('İzin Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#CreatePunishmentModal').modal('hide');
                    CreatePunishmentButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İzin Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreatePunishmentButton.attr('disabled', false).html(`Oluştur`);
                }
            });
        }
    });

    UpdatePunishmentButton.click(function () {
        var id = $('#update_punishment_id').val();
        var employeeId = parseInt(`{{ $id }}`);
        var typeId = updatePunishmentTypeId.val();
        var statusId = updatePunishmentStatusId.val();
        var startDate = $('#update_punishment_start_date').val();
        var endDate = $('#update_punishment_end_date').val();
        var description = $('#update_punishment_description').val();

        if (!typeId) {
            toastr.warning('İzin Türü Seçimi Zorunludur!');
        } else if (!statusId) {
            toastr.warning('İzin Durumu Seçimi Zorunludur!');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçimi Zorunludur!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçimi Zorunludur!');
        } else {
            UpdatePunishmentButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.punishment.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    employeeId: employeeId,
                    typeId: typeId,
                    statusId: statusId,
                    startDate: startDate,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    toastr.success('İzin Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#UpdatePunishmentModal').modal('hide');
                    UpdatePunishmentButton.attr('disabled', false).html(`Güncelle`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İzin Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdatePunishmentButton.attr('disabled', false).html(`Güncelle`);
                }
            });
        }
    });

    DeletePunishmentButton.click(function () {
        var id = $('#delete_punishment_id').val();
        DeletePunishmentButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.punishment.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('İzin Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#DeletePunishmentModal').modal('hide');
                DeletePunishmentButton.attr('disabled', false).html(`Sil`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('İzin Silinirken Serviste Bir Sorun Oluştu!');
                DeletePunishmentButton.attr('disabled', false).html(`Sil`);
            }
        });
    });

</script>
