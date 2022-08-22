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

    var devices = $('#devices');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');
    var categoryIdsFilter = $('#categoryIds');
    var statusIdsFilter = $('#statusIds');

    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');
    var CreateDeviceButton = $('#CreateDeviceButton');
    var UpdateDeviceButton = $('#UpdateDeviceButton');
    var DeleteDeviceButton = $('#DeleteDeviceButton');

    var createDeviceCompanyId = $('#create_device_company_id');
    var createDeviceCategoryId = $('#create_device_category_id');
    var createDeviceStatusId = $('#create_device_status_id');
    var createDeviceEmployeeId = $('#create_device_employee_id');

    var updateDeviceCompanyId = $('#update_device_company_id');
    var updateDeviceCategoryId = $('#update_device_category_id');
    var updateDeviceStatusId = $('#update_device_status_id');
    var updateDeviceEmployeeId = $('#update_device_employee_id');

    function createDevice() {
        createDeviceCompanyId.val('');
        createDeviceEmployeeId.val('');
        createDeviceCategoryId.val('');
        createDeviceStatusId.val('');
        $('#create_device_name').val('');
        $('#create_device_brand').val('');
        $('#create_device_model').val('');
        $('#create_device_serial_number').val('');
        $('#create_device_ip_address').val('');
        $('#CreateDeviceModal').modal('show');
    }

    function updateDevice(id) {
        $('#loader').show();
        $('#update_device_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.device.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateDeviceCompanyId.val(response.response.company_id);
                updateDeviceEmployeeId.val(response.response.employee_id);
                updateDeviceCategoryId.val(response.response.category_id);
                updateDeviceStatusId.val(response.response.status_id);
                $('#update_device_name').val(response.response.name);
                $('#update_device_brand').val(response.response.brand);
                $('#update_device_model').val(response.response.model);
                $('#update_device_serial_number').val(response.response.serial_number);
                $('#update_device_ip_address').val(response.response.ip_address);
                $('#UpdateDeviceModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Cihaz Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteDevice(id) {
        $('#delete_device_id').val(id);
        $('#DeleteDeviceModal').modal('show');
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
                createDeviceCompanyId.empty();
                updateDeviceCompanyId.empty();
                $.each(response.response, function (i, company) {
                    createDeviceCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                    updateDeviceCompanyId.append($('<option>', {
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
                createDeviceEmployeeId.empty();
                updateDeviceEmployeeId.empty();
                createDeviceEmployeeId.append($('<option>', {
                    value: 0,
                    text: '- Personel Yok -'
                }));
                updateDeviceEmployeeId.append($('<option>', {
                    value: 0,
                    text: '- Personel Yok -'
                }));
                $.each(response.response.employees, function (i, employee) {
                    createDeviceEmployeeId.append($('<option>', {
                        value: employee.id,
                        text: employee.name
                    }));
                    updateDeviceEmployeeId.append($('<option>', {
                        value: employee.id,
                        text: employee.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personeller Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getDeviceCategories() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.deviceCategory.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                categoryIdsFilter.empty();
                createDeviceCategoryId.empty();
                updateDeviceCategoryId.empty();
                $.each(response.response, function (i, deviceCategory) {
                    categoryIdsFilter.append($('<option>', {
                        value: deviceCategory.id,
                        text: deviceCategory.name
                    }));
                    createDeviceCategoryId.append($('<option>', {
                        value: deviceCategory.id,
                        text: deviceCategory.name
                    }));
                    updateDeviceCategoryId.append($('<option>', {
                        value: deviceCategory.id,
                        text: deviceCategory.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Cihaz Durumları Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getDeviceStatuses() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.deviceStatus.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                statusIdsFilter.empty();
                createDeviceStatusId.empty();
                updateDeviceStatusId.empty();
                $.each(response.response, function (i, deviceStatus) {
                    statusIdsFilter.append($('<option>', {
                        value: deviceStatus.id,
                        text: deviceStatus.name
                    }));
                    createDeviceStatusId.append($('<option>', {
                        value: deviceStatus.id,
                        text: deviceStatus.name
                    }));
                    updateDeviceStatusId.append($('<option>', {
                        value: deviceStatus.id,
                        text: deviceStatus.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Cihaz Kategorileri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getDevices() {
        $('#loader').show();
        var employeeId = parseInt(`{{ $id }}`);
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();
        var categoryIds = categoryIdsFilter.val();
        var statusIds = statusIdsFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.device.paginateByEmployeeId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeId: employeeId,
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
                categoryIds: categoryIds,
                statusIds: statusIds,
            },
            success: function (response) {
                console.log(response);
                devices.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.devices, function (i, device) {
                    devices.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${device.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${device.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateDevice(${device.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteDevice(${device.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${device.name ?? ''}
                        </td>
                        <td>
                            ${device.employee ? device.employee.name : ''}
                        </td>
                        <td>
                            <span class="badge badge-${device.status ? device.status.color : 'secondary'}">${device.status ? device.status.name : ''}</span>
                        </td>
                        <td>
                            ${device.package ? device.package.name : ''}
                        </td>
                        <td>
                            ${device.category ? device.category.name : ''}
                        </td>
                        <td>
                            ${device.serial_number ?? ''}
                        </td>
                        <td>
                            ${device.brand ?? ''}
                        </td>
                        <td>
                            ${device.model ?? ''}
                        </td>
                        <td>
                            ${device.ip_address ?? ''}
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
                toastr.error('Cihazlar Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getCompanies();
    getEmployeesByCompanyIds();
    getDeviceCategories();
    getDeviceStatuses();
    getDevices();

    SelectedCompanies.change(function () {
        getEmployeesByCompanyIds();
        getDevices();
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
        getDevices();
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
        categoryIdsFilter.val([]).trigger('change');
        statusIdsFilter.val([]).trigger('change');
        changePage(1);
    });

</script>
