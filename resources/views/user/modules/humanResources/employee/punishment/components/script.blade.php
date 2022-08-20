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
        $('#create_punishment_date').val('');
        $('#create_punishment_money_deduction').val('');
        $('#create_punishment_description').val('');
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
                updatePunishmentCategoryId.val(response.response.category_id).trigger('change');
                $('#update_punishment_date').val(response.response.date);
                $('#update_punishment_money_deduction').val(response.response.money_deduction);
                $('#update_punishment_description').val(response.response.description);
                $('#UpdatePunishmentModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ceza Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function createPdf(id) {
        var route = `{{ route('user.web.file.createPdf') }}`;
        window.location.href = `${route}/${id}`;
    }

    function deletePunishment(id) {
        $('#delete_punishment_id').val(id);
        $('#DeletePunishmentModal').modal('show');
    }

    function getPunishmentCategories() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.punishmentCategory.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createPunishmentCategoryId.empty();
                updatePunishmentCategoryId.empty();
                $.each(response.response, function (i, punishmentCategory) {
                    createPunishmentCategoryId.append($('<option>', {
                        value: punishmentCategory.id,
                        text: punishmentCategory.name
                    }));
                    updatePunishmentCategoryId.append($('<option>', {
                        value: punishmentCategory.id,
                        text: punishmentCategory.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ceza Türleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getPunishments() {
        punishments.html(`<tr><td colspan="7" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var employeeId = parseInt(`{{ $id }}`);
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();

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
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updatePunishment(${punishment.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="createPdf(${punishment.id})" title="Belge Oluştur"><i class="fas fa-file me-2 text-dark"></i> <span class="text-dark">Belge Oluştur</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deletePunishment(${punishment.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${punishment.category ? punishment.category.name : ''}
                        </td>
                        <td class="hideIfMobile">
                            ${punishment.date ? reformatDatetimeToDateForHuman(punishment.date) : ''}
                        </td>
                        <td class="hideIfMobile">
                            ${punishment.money_deduction ? `${reformatNumberToMoney(punishment.money_deduction)} ₺` : '--'}
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
                toastr.error('Cezalar Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getPunishmentCategories();
    getPunishments();

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

    CreatePunishmentButton.click(function () {
        var employeeId = parseInt(`{{ $id }}`);
        var categoryId = createPunishmentCategoryId.val();
        var date = $('#create_punishment_date').val();
        var moneyDeduction = $('#create_punishment_money_deduction').val();
        var description = $('#create_punishment_description').val();

        if (!employeeId) {
            toastr.warning('Personel Seçimi Zorunludur!');
        } else if (!categoryId) {
            toastr.warning('Ceza Kategorisi Seçimi Zorunludur!');
        } else if (!date) {
            toastr.warning('Ceza Tarihi Seçimi Zorunludur!');
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
                    categoryId: categoryId,
                    date: date,
                    moneyDeduction: moneyDeduction,
                    description: description
                },
                success: function () {
                    toastr.success('Ceza Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#CreatePunishmentModal').modal('hide');
                    CreatePunishmentButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Ceza Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreatePunishmentButton.attr('disabled', false).html(`Oluştur`);
                }
            });
        }
    });

    UpdatePunishmentButton.click(function () {
        var id = $('#update_punishment_id').val();
        var categoryId = updatePunishmentCategoryId.val();
        var date = $('#update_punishment_date').val();
        var moneyDeduction = $('#update_punishment_money_deduction').val();
        var description = $('#update_punishment_description').val();

        if (!id) {
            toastr.warning('Ceza Seçimi Zorunludur!');
        } else if (!categoryId) {
            toastr.warning('Ceza Kategorisi Seçimi Zorunludur!');
        } else if (!date) {
            toastr.warning('Ceza Tarihi Seçimi Zorunludur!');
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
                    categoryId: categoryId,
                    date: date,
                    moneyDeduction: moneyDeduction,
                    description: description
                },
                success: function () {
                    toastr.success('Ceza Başarıyla Güncellendi!');
                    changePage(1);
                    $('#UpdatePunishmentModal').modal('hide');
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
                toastr.success('Ceza Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#DeletePunishmentModal').modal('hide');
                DeletePunishmentButton.attr('disabled', false).html(`Sil`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ceza Silinirken Serviste Bir Sorun Oluştu!');
                DeletePunishmentButton.attr('disabled', false).html(`Sil`);
            }
        });
    });

</script>
