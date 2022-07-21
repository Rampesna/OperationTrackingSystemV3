<script>

    var specialReports = $('#specialReports');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');

    var createSpecialReportCompanyId = $('#create_shift_group_company_id');
    var updateSpecialReportCompanyId = $('#update_shift_group_company_id');

    var CreateSpecialReportButton = $('#CreateSpecialReportButton');
    var UpdateSpecialReportButton = $('#UpdateSpecialReportButton');
    var DeleteSpecialReportButton = $('#DeleteSpecialReportButton');

    function createSpecialReport() {

        $('#CreateSpecialReportModal').modal('show');
    }

    function updateSpecialReport(id) {
        $('#loader').show();
        $('#update_shift_group_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.specialReport.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                $('#UpdateSpecialReportModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Özel Rapor Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteSpecialReport(id) {
        $('#delete_shift_group_id').val(id);
        $('#DeleteSpecialReportModal').modal('show');
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
                createSpecialReportCompanyId.empty();
                updateSpecialReportCompanyId.empty();
                $.each(response.response, function (i, company) {
                    createSpecialReportCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                    updateSpecialReportCompanyId.append($('<option>', {
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

    function getSpecialReports() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.specialReport.getByCompanyIds') }}',
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
                specialReports.empty();
                $.each(response.response.specialReports, function (i, specialReport) {
                    specialReports.append(`
                    <tr>
                        <td>
                            ${specialReport.company ? specialReport.company.title : ''}
                        </td>
                        <td>
                            ${specialReport.name}
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${specialReport.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${specialReport.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateSpecialReport(${specialReport.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteSpecialReport(${specialReport.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
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
                toastr.error('Özel Raporlar Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getCompanies();
    getSpecialReports();

    SelectedCompanies.change(function () {
        getSpecialReports();
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
        getSpecialReports();
    }

    CreateSpecialReportButton.click(function () {
        var companyId = createSpecialReportCompanyId.val();

        if (!companyId) {
            toastr.warning('Firma Seçilmedi');
            CreateSpecialReportWizardStepper.goTo(1);
        } else {
            $('#loader').show();
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.specialReport.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyId: companyId,

                },
                success: function () {
                    changePage(1);
                    toastr.success('Özel Rapor Başarıyla Oluşturuldu');
                    $('#CreateSpecialReportModal').modal('hide');
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Özel Rapor Oluşturulurken Serviste Bir Hata Oluştu');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateSpecialReportButton.click(function () {
        var id = $('#update_shift_group_id').val();
        var companyId = updateSpecialReportCompanyId.val();

        if (!companyId) {
            toastr.warning('Firma Seçilmedi');
            UpdateSpecialReportWizardStepper.goTo(1);
        } else {
            $('#loader').show();
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.specialReport.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    companyId: companyId,
                },
                success: function () {
                    changePage(1);
                    toastr.success('Özel Rapor Başarıyla Güncellendi');
                    $('#UpdateSpecialReportModal').modal('hide');
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Özel Rapor Güncellenirken Serviste Bir Hata Oluştu');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteSpecialReportButton.click(function () {
        $('#loader').show();
        var id = $('#delete_shift_group_id').val();
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.specialReport.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                changePage(1);
                $('#DeleteSpecialReportModal').modal('hide');
                toastr.success('Özel Rapor Başarıyla Silindi.');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Özel Rapor Silinirken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    });

    pageUpButton.click(function () {
        changePage(parseInt(page.html()) + 1);
    });

    pageDownButton.click(function () {
        changePage(parseInt(page.html()) - 1);
    });

    pageSizeSelector.change(function () {
        changePage(1);
    });

</script>
