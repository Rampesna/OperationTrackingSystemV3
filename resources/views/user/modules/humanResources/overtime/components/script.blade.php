<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var overtimes = $('#overtimes');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');
    var typeIdFilter = $('#typeId');
    var statusIdFilter = $('#statusId');
    var startDateFilter = $('#startDate');
    var endDateFilter = $('#endDate');

    var CreateOvertimeButton = $('#CreateOvertimeButton');
    var UpdateOvertimeButton = $('#UpdateOvertimeButton');
    var DeleteOvertimeButton = $('#DeleteOvertimeButton');

    var createOvertimeEmployeeId = $('#create_overtime_employee_id');
    var updateOvertimeEmployeeId = $('#update_overtime_employee_id');

    var createOvertimeTypeId = $('#create_overtime_type_id');
    var updateOvertimeTypeId = $('#update_overtime_type_id');

    var createOvertimeStatusId = $('#create_overtime_status_id');
    var updateOvertimeStatusId = $('#update_overtime_status_id');

    function createOvertime() {
        createOvertimeEmployeeId.val('');
        createOvertimeTypeId.val('');
        createOvertimeStatusId.val('');
        $('#create_overtime_start_date').val('');
        $('#create_overtime_end_date').val('');
        $('#create_overtime_description').val('');
        $('#CreateOvertimeModal').modal('show');
    }

    function updateOvertime(id) {
        $('#loader').show();
        $('#update_overtime_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.overtime.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateOvertimeEmployeeId.val(response.response.employee_id);
                updateOvertimeTypeId.val(response.response.type_id);
                updateOvertimeStatusId.val(response.response.status_id);
                $('#update_overtime_start_date').val(reformatDatetimeForInput(response.response.start_date));
                $('#update_overtime_end_date').val(reformatDatetimeForInput(response.response.end_date));
                $('#update_overtime_description').val(response.response.description);
                $('#UpdateOvertimeModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Mesai Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteOvertime(id) {
        $('#delete_overtime_id').val(id);
        $('#DeleteOvertimeModal').modal('show');
    }

    function getEmployeesByCompanyIds() {
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
                createOvertimeEmployeeId.empty();
                $.each(response.response.employees, function (i, employee) {
                    createOvertimeEmployeeId.append(`<option value="${employee.id}">${employee.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getOvertimeTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.overtimeType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createOvertimeTypeId.empty();
                updateOvertimeTypeId.empty();
                typeIdFilter.empty();
                $.each(response.response, function (i, overtimeType) {
                    createOvertimeTypeId.append($('<option>', {
                        value: overtimeType.id,
                        text: overtimeType.name
                    }));
                    updateOvertimeTypeId.append($('<option>', {
                        value: overtimeType.id,
                        text: overtimeType.name
                    }));
                    typeIdFilter.append($('<option>', {
                        value: overtimeType.id,
                        text: overtimeType.name
                    }));
                });
                typeIdFilter.val('');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Mesai Türleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getOvertimes() {
        overtimes.html(`<tr><td colspan="7" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();
        var startDate = startDateFilter.val();
        var endDate = endDateFilter.val();
        var statusId = statusIdFilter.val();
        var typeId = typeIdFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.overtime.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
                startDate: startDate ? startDate + ' 00:00:00' : null,
                endDate: endDate ? endDate + ' 23:59:59' : null,
                statusId: statusId,
                typeId: typeId,
            },
            success: function (response) {
                overtimes.empty();
                $.each(response.response.overtimes, function (i, overtime) {
                    overtimes.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${overtime.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${overtime.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateOvertime(${overtime.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteOvertime(${overtime.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${overtime.employee ? overtime.employee.name : ''}
                        </td>
                        <td>
                            <span class="badge badge-${overtime.status ? overtime.status.color : ''}">${overtime.status ? overtime.status.name : ''}</span>
                        </td>
                        <td class="hideIfMobile">
                            ${overtime.type ? overtime.type.name : ''}
                        </td>
                        <td class="hideIfMobile">
                            ${reformatDatetimeToDatetimeForHuman(overtime.start_date)}
                        </td>
                        <td class="hideIfMobile">
                            ${reformatDatetimeToDatetimeForHuman(overtime.end_date)}
                        </td>
                        <td class="hideIfMobile">
                            ${minutesToString(getMinutesBetweenTwoDatesForOvertime(overtime.start_date, overtime.end_date))}
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
                toastr.error('Mesailer Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getEmployeesByCompanyIds();
    getOvertimeTypes();
    getOvertimes();

    SelectedCompanies.change(function () {
        getEmployeesByCompanyIds();
        getOvertimes();
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
        getOvertimes();
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
        typeIdFilter.val('').trigger('change');
        statusIdFilter.val('').trigger('change');
        startDateFilter.val('');
        endDateFilter.val('');
        changePage(1);
    });

    CreateOvertimeButton.click(function () {
        var employeeId = createOvertimeEmployeeId.val();
        var typeId = createOvertimeTypeId.val();
        var statusId = createOvertimeStatusId.val();
        var startDate = $('#create_overtime_start_date').val();
        var endDate = $('#create_overtime_end_date').val();
        var description = $('#create_overtime_description').val();

        if (!employeeId) {
            toastr.warning('Personel Seçimi Zorunludur!');
        } else if (!typeId) {
            toastr.warning('Mesai Türü Seçimi Zorunludur!');
        } else if (!statusId) {
            toastr.warning('Mesai Durumu Seçimi Zorunludur!');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçimi Zorunludur!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçimi Zorunludur!');
        } else {
            CreateOvertimeButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.overtime.create') }}',
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
                    toastr.success('Mesai Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#CreateOvertimeModal').modal('hide');
                    CreateOvertimeButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Mesai Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateOvertimeButton.attr('disabled', false).html(`Oluştur`);
                }
            });
        }
    });

    UpdateOvertimeButton.click(function () {
        var id = $('#update_overtime_id').val();
        var employeeId = updateOvertimeEmployeeId.val();
        var typeId = updateOvertimeTypeId.val();
        var statusId = updateOvertimeStatusId.val();
        var startDate = $('#update_overtime_start_date').val();
        var endDate = $('#update_overtime_end_date').val();
        var description = $('#update_overtime_description').val();

        if (!typeId) {
            toastr.warning('Mesai Türü Seçimi Zorunludur!');
        } else if (!statusId) {
            toastr.warning('Mesai Durumu Seçimi Zorunludur!');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçimi Zorunludur!');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçimi Zorunludur!');
        } else {
            UpdateOvertimeButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.overtime.update') }}',
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
                    toastr.success('Mesai Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#UpdateOvertimeModal').modal('hide');
                    UpdateOvertimeButton.attr('disabled', false).html(`Güncelle`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Mesai Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdateOvertimeButton.attr('disabled', false).html(`Güncelle`);
                }
            });
        }
    });

    DeleteOvertimeButton.click(function () {
        var id = $('#delete_overtime_id').val();
        DeleteOvertimeButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.overtime.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Mesai Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#DeleteOvertimeModal').modal('hide');
                DeleteOvertimeButton.attr('disabled', false).html(`Sil`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Mesai Silinirken Serviste Bir Sorun Oluştu!');
                DeleteOvertimeButton.attr('disabled', false).html(`Sil`);
            }
        });
    });

</script>
