<script>

    var jobDepartments = $('#jobDepartments');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');

    var CreateJobDepartmentButton = $('#CreateJobDepartmentButton');
    var UpdateJobDepartmentButton = $('#UpdateJobDepartmentButton');
    var DeleteJobDepartmentButton = $('#DeleteJobDepartmentButton');

    var createJobDepartmentCompanyId = $('#create_job_department_company_id');
    var updateJobDepartmentCompanyId = $('#update_job_department_company_id');

    var createJobDepartmentTypeId = $('#create_job_department_type_id');
    var updateJobDepartmentTypeId = $('#update_job_department_type_id');

    function createJobDepartment() {
        createJobDepartmentCompanyId.val('');
        createJobDepartmentTypeId.val('');
        $('#create_job_department_name').val('');
        $('#CreateJobDepartmentModal').modal('show');
    }

    function updateJobDepartment(id) {
        $('#loader').show();
        $('#update_job_department_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.jobDepartment.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateJobDepartmentCompanyId.val(response.response.company_id);
                updateJobDepartmentTypeId.val(response.response.type_id);
                $('#update_job_department_name').val(response.response.name);
                $('#UpdateJobDepartmentModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İş Departmanı Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteJobDepartment(id) {
        $('#delete_job_department_id').val(id);
        $('#DeleteJobDepartmentModal').modal('show');
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
                createJobDepartmentCompanyId.empty();
                updateJobDepartmentCompanyId.empty();
                $.each(response.response, function (i, company) {
                    createJobDepartmentCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                    updateJobDepartmentCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Şirketler Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getJobDepartmentTypes() {
        var companyIds = SelectedCompanies.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.jobDepartmentType.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: 0,
                pageSize: 1000,
            },
            success: function (response) {
                console.log(response);
                createJobDepartmentTypeId.empty();
                updateJobDepartmentTypeId.empty();
                $.each(response.response.jobDepartmentTypes, function (i, jobDepartmentType) {
                    createJobDepartmentTypeId.append($('<option>', {
                        value: jobDepartmentType.id,
                        text: jobDepartmentType.name
                    }));
                    updateJobDepartmentTypeId.append($('<option>', {
                        value: jobDepartmentType.id,
                        text: jobDepartmentType.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('İş Departmanı Türleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getJobDepartments() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.jobDepartment.getByCompanyIds') }}',
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
                jobDepartments.empty();
                $.each(response.response.jobDepartments, function (i, jobDepartment) {
                    jobDepartments.append(`
                    <tr>
                        <td>
                            ${jobDepartment.company ? jobDepartment.company.title : ''}
                        </td>
                        <td>
                            ${jobDepartment.name}
                        </td>
                        <td>
                            ${jobDepartment.type ? jobDepartment.type.name : ''}
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${jobDepartment.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${jobDepartment.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateJobDepartment(${jobDepartment.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteJobDepartment(${jobDepartment.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
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
                toastr.error('İş Departmanler Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getCompanies();
    getJobDepartmentTypes();
    getJobDepartments();

    SelectedCompanies.change(function () {
        getJobDepartments();
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
        getJobDepartments();
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

    CreateJobDepartmentButton.click(function () {
        var companyId = createJobDepartmentCompanyId.val();
        var typeId = createJobDepartmentTypeId.val();
        var name = $('#create_job_department_name').val();

        if (!companyId) {
            toastr.warning('Şirket Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('İş Departmanı Adı Zorunludur!');
        } else {
            $('#loader').show();
            $('#CreateJobDepartmentModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.jobDepartment.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyId: companyId,
                    typeId: typeId,
                    name: name
                },
                success: function () {
                    toastr.success('İş Departmanı Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İş Departmanı Oluşturulurken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateJobDepartmentButton.click(function () {
        var id = $('#update_job_department_id').val();
        var companyId = updateJobDepartmentCompanyId.val();
        var typeId = updateJobDepartmentTypeId.val();
        var name = $('#update_job_department_name').val();

        if (!companyId) {
            toastr.warning('Şirket Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('İş Departmanı Adı Zorunludur!');
        } else {
            $('#loader').show();
            $('#UpdateJobDepartmentModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.jobDepartment.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    companyId: companyId,
                    typeId: typeId,
                    name: name,
                },
                success: function () {
                    toastr.success('İş Departmanı Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İş Departmanı Güncellenirken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteJobDepartmentButton.click(function () {
        var id = $('#delete_job_department_id').val();
        $('#loader').show();
        $('#DeleteJobDepartmentModal').modal('hide');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.jobDepartment.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('İş Departmanı Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İş Departmanı Silinirken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    });

</script>
