<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var recruitings = $('#recruitings');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');

    var CreatePermitButton = $('#CreatePermitButton');
    var UpdatePermitButton = $('#UpdatePermitButton');
    var DeletePermitButton = $('#DeletePermitButton');

    function createPermit() {
        createPermitEmployeeId.val('');
        createPermitTypeId.val('');
        createPermitStatusId.val('');
        $('#create_permit_start_date').val('');
        $('#create_permit_end_date').val('');
        $('#create_permit_description').val('');
        $('#CreatePermitModal').modal('show');
    }

    function updateRecruiting(id) {
        $('#loader').show();
        $('#update_permit_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.permit.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updatePermitEmployeeId.val(response.response.employee_id);
                updatePermitTypeId.val(response.response.type_id);
                updatePermitStatusId.val(response.response.status_id);
                $('#update_permit_start_date').val(reformatDatetimeForInput(response.response.start_date));
                $('#update_permit_end_date').val(reformatDatetimeForInput(response.response.end_date));
                $('#update_permit_description').val(response.response.description);
                $('#UpdatePermitModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İzin Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteRecruiting(id) {
        $('#delete_permit_id').val(id);
        $('#DeletePermitModal').modal('show');
    }

    function getRecruitings() {
        recruitings.html(`<tr><td colspan="9" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.recruiting.getByCompanyIds') }}',
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
                recruitings.empty();
                $.each(response.response.recruitings, function (i, recruiting) {
                    recruitings.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${recruiting.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${recruiting.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateRecruiting(${recruiting.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteRecruiting(${recruiting.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-${recruiting.step ? recruiting.step.color : ''}">${recruiting.step ? recruiting.step.name : ''}</span>
                        </td>
                        <td>
                            ${recruiting.name ?? ''}
                        </td>
                        <td>
                            ${recruiting.department ? recruiting.department.name : ''}
                        </td>
                        <td>
                            ${recruiting.email ?? ''}
                        </td>
                        <td>
                            ${recruiting.phone_number ?? ''}
                        </td>
                        <td>
                            ${recruiting.identity ?? ''}
                        </td>
                        <td>
                            ${recruiting.birth_date ? reformatDatetimeToDateForHuman(recruiting.birth_date) : ''}
                        </td>
                        <td>
                            ${parseInt(recruiting.obstacle) === 1 ? 'Var' : 'Yok'}
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
                toastr.error('İşe Alım Listesi Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getRecruitings();

    SelectedCompanies.change(function () {
        getRecruitings();
    });

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
        getRecruitings();
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

</script>
