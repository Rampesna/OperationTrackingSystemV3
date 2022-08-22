<script>

    var jobDepartmentTypes = $('#jobDepartmentTypes');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');

    var CreateJobDepartmentTypeButton = $('#CreateJobDepartmentTypeButton');
    var UpdateJobDepartmentTypeButton = $('#UpdateJobDepartmentTypeButton');
    var DeleteJobDepartmentTypeButton = $('#DeleteJobDepartmentTypeButton');

    var createJobDepartmentTypeCompanyId = $('#create_job_department_type_company_id');
    var updateJobDepartmentTypeCompanyId = $('#update_job_department_type_company_id');

    function createJobDepartmentType() {
        createJobDepartmentTypeCompanyId.val('');
        $('#create_job_department_type_name').val('');
        $('#CreateJobDepartmentTypeModal').modal('show');
    }

    function updateJobDepartmentType(id) {
        $('#loader').show();
        $('#update_job_department_type_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.jobDepartmentType.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateJobDepartmentTypeCompanyId.val(response.response.company_id);
                $('#update_job_department_type_name').val(response.response.name);
                $('#UpdateJobDepartmentTypeModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İş Departman Türü Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteJobDepartmentType(id) {
        $('#delete_job_department_type_id').val(id);
        $('#DeleteJobDepartmentTypeModal').modal('show');
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
                createJobDepartmentTypeCompanyId.empty();
                updateJobDepartmentTypeCompanyId.empty();
                $.each(response.response, function (i, company) {
                    createJobDepartmentTypeCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                    updateJobDepartmentTypeCompanyId.append($('<option>', {
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
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.jobDepartmentType.getByCompanyIds') }}',
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
                jobDepartmentTypes.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.jobDepartmentTypes, function (i, jobDepartmentType) {
                    jobDepartmentTypes.append(`
                    <tr>
                        <td>
                            ${jobDepartmentType.company ? jobDepartmentType.company.title : ''}
                        </td>
                        <td>
                            ${jobDepartmentType.name}
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${jobDepartmentType.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${jobDepartmentType.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateJobDepartmentType(${jobDepartmentType.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteJobDepartmentType(${jobDepartmentType.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
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
                toastr.error('İş Departman Türüler Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getCompanies();
    getJobDepartmentTypes();

    SelectedCompanies.change(function () {
        getJobDepartmentTypes();
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
        getJobDepartmentTypes();
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

    CreateJobDepartmentTypeButton.click(function () {
        var companyId = createJobDepartmentTypeCompanyId.val();
        var name = $('#create_job_department_type_name').val();

        if (!companyId) {
            toastr.warning('Şirket Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('İş Departman Türü Adı Zorunludur!');
        } else {
            $('#loader').show();
            $('#CreateJobDepartmentTypeModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.jobDepartmentType.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyId: companyId,
                    name: name
                },
                success: function () {
                    toastr.success('İş Departman Türü Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İş Departman Türü Oluşturulurken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateJobDepartmentTypeButton.click(function () {
        var id = $('#update_job_department_type_id').val();
        var companyId = updateJobDepartmentTypeCompanyId.val();
        var name = $('#update_job_department_type_name').val();

        if (!companyId) {
            toastr.warning('Şirket Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('İş Departman Türü Adı Zorunludur!');
        } else {
            $('#loader').show();
            $('#UpdateJobDepartmentTypeModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.jobDepartmentType.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    companyId: companyId,
                    name: name,
                },
                success: function () {
                    toastr.success('İş Departman Türü Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İş Departman Türü Güncellenirken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteJobDepartmentTypeButton.click(function () {
        var id = $('#delete_job_department_type_id').val();
        $('#loader').show();
        $('#DeleteJobDepartmentTypeModal').modal('hide');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.jobDepartmentType.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('İş Departman Türü Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İş Departman Türü Silinirken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    });

</script>
