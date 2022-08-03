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
                employee = response.response;
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

    var allBranches = [];
    var allDepartments = [];
    var allTitles = [];

    var positionsRow = $('#positions');

    var createPositionBranchId = $('#create_position_branch_id');
    var createPositionDepartmentId = $('#create_position_department_id');
    var createPositionTitleId = $('#create_position_title_id');
    var createPositionLeavingReasonId = $('#create_position_leaving_reason_id');

    var updatePositionBranchId = $('#update_position_branch_id');
    var updatePositionDepartmentId = $('#update_position_department_id');
    var updatePositionTitleId = $('#update_position_title_id');
    var updatePositionLeavingReasonId = $('#update_position_leaving_reason_id');

    var CreatePositionButton = $('#CreatePositionButton');
    var UpdatePositionButton = $('#UpdatePositionButton');
    var DeletePositionButton = $('#DeletePositionButton');

    function getBranches() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.branch.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                allBranches = response.response;
            },
            error: function (error) {
                console.log(error);
                toastr.error('Şube Listesi Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    function getDepartments() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.department.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                allDepartments = response.response;
            },
            error: function (error) {
                console.log(error);
                toastr.error('Departman Listesi Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    function getTitles() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.title.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                allTitles = response.response;
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ünvan Listesi Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    function getLeavingReasons() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.leavingReason.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createPositionLeavingReasonId.empty();
                updatePositionLeavingReasonId.empty();
                createPositionLeavingReasonId.append(
                    $('<option>', {
                        value: null,
                        text: `- Yok -`
                    })
                );
                updatePositionLeavingReasonId.append(
                    $('<option>', {
                        value: null,
                        text: `- Yok -`
                    })
                );
                $.each(response.response, function (i, leavingReason) {
                    createPositionLeavingReasonId.append(
                        $('<option>', {
                            value: leavingReason.id,
                            text: `${leavingReason.id}. ${leavingReason.name}`
                        })
                    );
                    updatePositionLeavingReasonId.append(
                        $('<option>', {
                            value: leavingReason.id,
                            text: `${leavingReason.id}. ${leavingReason.name}`
                        })
                    );
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ünvan Listesi Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    function getPositionsByEmployeeId() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.position.getByEmployeeId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: employeeId,
            },
            success: function (response) {
                positionsRow.empty();
                $.each(response.response, function (i, position) {
                    positionsRow.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${position.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${position.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updatePosition(${position.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deletePosition(${position.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${reformatDatetimeToDateForHuman(position.start_date)}
                        </td>
                        <td>
                            ${position.end_date ? reformatDatetimeToDateForHuman(position.end_date) : '--'}
                        </td>
                        <td class="hideIfMobile">
                            ${position.company ? position.company.title : ''}
                        </td>
                        <td class="hideIfMobile">
                            ${position.branch ? position.branch.name : ''}
                        </td>
                        <td class="hideIfMobile">
                            ${position.department ? position.department.name : ''}
                        </td>
                        <td class="hideIfMobile">
                            ${position.title ? position.title.name : ''}
                        </td>
                        <td class="hideIfMobile">
                            ${position.salary ? reformatNumberToMoney(position.salary) : ''} ₺
                        </td>
                    </tr>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Pozisyon Bilgileri Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    function createPosition() {
        createPositionBranchId.empty();
        createPositionDepartmentId.empty();
        createPositionTitleId.empty();
        $.each(allBranches, function (i, branch) {
            if (parseInt(branch.company_id) === parseInt(employee.company_id)) {
                createPositionBranchId.append(
                    $('<option>', {
                        value: branch.id,
                        text: branch.name
                    })
                );
            }
        });
        createPositionBranchId.val('').trigger('change');
        $('#create_position_start_date').val('');
        $('#create_position_end_date').val('');
        createPositionLeavingReasonId.val('').trigger('change');
        $('#create_position_salary_pay_type').val('').trigger('change');
        $('#create_position_salary').val('');
        $('#create_position_bounty').val('');
        $('#create_position_road_toll').val('');
        $('#CreatePositionModal').modal('show');
    }

    function updatePosition(id) {
        $('#update_position_id').val(id);
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.position.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updatePositionBranchId.empty();
                updatePositionDepartmentId.empty();
                updatePositionTitleId.empty();
                $.each(allBranches, function (i, branch) {
                    if (parseInt(branch.company_id) === parseInt(employee.company_id)) {
                        updatePositionBranchId.append(
                            $('<option>', {
                                value: branch.id,
                                text: branch.name
                            })
                        );
                    }
                });
                updatePositionBranchId.val(response.response.branch_id).trigger('change');
                $.each(allDepartments, function (i, department) {
                    if (parseInt(department.branch_id) === parseInt(updatePositionBranchId.val())) {
                        updatePositionDepartmentId.append(
                            $('<option>', {
                                value: department.id,
                                text: department.name
                            })
                        );
                    }
                });
                updatePositionDepartmentId.val(response.response.department_id).trigger('change');
                $.each(allTitles, function (i, title) {
                    if (parseInt(title.department_id) === parseInt(updatePositionDepartmentId.val())) {
                        updatePositionTitleId.append(
                            $('<option>', {
                                value: title.id,
                                text: title.name
                            })
                        );
                    }
                });
                updatePositionTitleId.val(response.response.title_id).trigger('change');
                $('#update_position_start_date').val(response.response.start_date);
                $('#update_position_end_date').val(response.response.end_date);
                updatePositionLeavingReasonId.val(response.response.leaving_reason_id).trigger('change');
                $('#update_position_salary_pay_type').val(response.response.salary_pay_type).trigger('change');
                $('#update_position_salary').val(response.response.salary);
                $('#update_position_bounty').val(response.response.bounty);
                $('#update_position_road_toll').val(response.response.road_toll);
                $('#UpdatePositionModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Pozisyon Bilgileri Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    function deletePosition(id) {
        $('#delete_position_id').val(id);
        $('#DeletePositionModal').modal('show');
    }

    getBranches();
    getDepartments();
    getTitles();
    getLeavingReasons();
    getPositionsByEmployeeId();

    createPositionBranchId.change(function () {
        createPositionDepartmentId.empty();
        createPositionTitleId.empty();
        $.each(allDepartments, function (i, department) {
            if (parseInt(department.branch_id) === parseInt(createPositionBranchId.val())) {
                createPositionDepartmentId.append(
                    $('<option>', {
                        value: department.id,
                        text: department.name
                    })
                );
            }
        });
        createPositionDepartmentId.val('').trigger('change');
    });

    createPositionDepartmentId.change(function () {
        createPositionTitleId.empty();
        $.each(allTitles, function (i, title) {
            if (parseInt(title.department_id) === parseInt(createPositionDepartmentId.val())) {
                createPositionTitleId.append(
                    $('<option>', {
                        value: title.id,
                        text: title.name
                    })
                );
            }
        });
        createPositionTitleId.val('').trigger('change');
    });

    updatePositionBranchId.change(function () {
        updatePositionDepartmentId.empty();
        updatePositionTitleId.empty();
        $.each(allDepartments, function (i, department) {
            if (parseInt(department.branch_id) === parseInt(updatePositionBranchId.val())) {
                updatePositionDepartmentId.append(
                    $('<option>', {
                        value: department.id,
                        text: department.name
                    })
                );
            }
        });
        updatePositionDepartmentId.val('').trigger('change');
    });

    updatePositionDepartmentId.change(function () {
        updatePositionTitleId.empty();
        $.each(allTitles, function (i, title) {
            if (parseInt(title.department_id) === parseInt(updatePositionDepartmentId.val())) {
                updatePositionTitleId.append(
                    $('<option>', {
                        value: title.id,
                        text: title.name
                    })
                );
            }
        });
        updatePositionTitleId.val('').trigger('change');
    });

    CreatePositionButton.click(function () {
        var employeeId = employee.id;
        var companyId = employee.company_id;
        var branchId = createPositionBranchId.val();
        var departmentId = createPositionDepartmentId.val();
        var titleId = createPositionTitleId.val();
        var startDate = $('#create_position_start_date').val();
        var endDate = $('#create_position_end_date').val();
        var leavingReasonId = createPositionLeavingReasonId.val();
        var salaryPayType = $('#create_position_salary_pay_type').val();
        var salary = $('#create_position_salary').val();
        var bounty = $('#create_position_bounty').val();
        var roadToll = $('#create_position_road_toll').val();

        if (!employeeId) {
            toastr.warning('Sistemsel Bir Sorun Oluştu! Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else if (!companyId) {
            toastr.warning('Sistemsel Bir Sorun Oluştu! Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else if (!branchId) {
            toastr.warning('Şube Seçimi Zorunludur!');
        } else if (!departmentId) {
            toastr.warning('Departman Seçimi Zorunludur!');
        } else if (!titleId) {
            toastr.warning('Ünvan Seçimi Zorunludur!');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Zorunludur!');
        } else {
            CreatePositionButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.position.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    employeeId: employeeId,
                    companyId: companyId,
                    branchId: branchId,
                    departmentId: departmentId,
                    titleId: titleId,
                    startDate: startDate,
                    endDate: endDate,
                    leavingReasonId: leavingReasonId,
                    salaryPayType: salaryPayType,
                    salary: salary,
                    bounty: bounty,
                    roadToll: roadToll
                },
                success: function () {
                    toastr.success('Pozisyon Başarıyla Oluşturuldu.');
                    getPositionsByEmployeeId();
                    $('#CreatePositionModal').modal('hide');
                    CreatePositionButton.attr('disabled', false).html('Oluştur');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Pozisyon Oluşturulurken Serviste Bir Sorun Oluştu.');
                    CreatePositionButton.attr('disabled', false).html('Oluştur');
                }
            });
        }
    });

    UpdatePositionButton.click(function () {
        var id = $('#update_position_id').val();
        var companyId = employee.company_id;
        var branchId = updatePositionBranchId.val();
        var departmentId = updatePositionDepartmentId.val();
        var titleId = updatePositionTitleId.val();
        var startDate = $('#update_position_start_date').val();
        var endDate = $('#update_position_end_date').val();
        var leavingReasonId = updatePositionLeavingReasonId.val();
        var salaryPayType = $('#update_position_salary_pay_type').val();
        var salary = $('#update_position_salary').val();
        var bounty = $('#update_position_bounty').val();
        var roadToll = $('#update_position_road_toll').val();

        if (!id) {
            toastr.warning('Sistemsel Bir Sorun Oluştu! Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else if (!companyId) {
            toastr.warning('Sistemsel Bir Sorun Oluştu! Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else if (!branchId) {
            toastr.warning('Şube Seçimi Zorunludur!');
        } else if (!departmentId) {
            toastr.warning('Departman Seçimi Zorunludur!');
        } else if (!titleId) {
            toastr.warning('Ünvan Seçimi Zorunludur!');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Zorunludur!');
        } else {
            UpdatePositionButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.position.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    companyId: companyId,
                    branchId: branchId,
                    departmentId: departmentId,
                    titleId: titleId,
                    startDate: startDate,
                    endDate: endDate,
                    leavingReasonId: leavingReasonId,
                    salaryPayType: salaryPayType,
                    salary: salary,
                    bounty: bounty,
                    roadToll: roadToll
                },
                success: function () {
                    toastr.success('Pozisyon Başarıyla Güncellendi.');
                    getPositionsByEmployeeId();
                    $('#UpdatePositionModal').modal('hide');
                    UpdatePositionButton.attr('disabled', false).html('Güncelle');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Pozisyon Güncellenirken Serviste Bir Sorun Oluştu.');
                    UpdatePositionButton.attr('disabled', false).html('Güncelle');
                }
            });
        }
    });

    DeletePositionButton.click(function () {
        var id = $('#delete_position_id').val();
        if (!id) {
            toastr.warning('Sistemsel Bir Sorun Oluştu! Sayfayı Yenilemeyi Deneyebilirsiniz.');
        } else {
            DeletePositionButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'delete',
                url: '{{ route('user.api.position.delete') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id
                },
                success: function () {
                    toastr.success('Pozisyon Başarıyla Silindi.');
                    getPositionsByEmployeeId();
                    $('#DeletePositionModal').modal('hide');
                    DeletePositionButton.attr('disabled', false).html('Sil');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Pozisyon Silinirken Serviste Bir Sorun Oluştu.');
                    DeletePositionButton.attr('disabled', false).html('Sil');
                }
            });
        }
    });

</script>
