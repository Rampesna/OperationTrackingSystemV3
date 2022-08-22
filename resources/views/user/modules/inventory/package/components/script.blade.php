<script>

    var updatePermission = `{{ checkUserPermission(156, $userPermissions) ? 'true' : 'false' }}`;
    var deletePermission = `{{ checkUserPermission(157, $userPermissions) ? 'true' : 'false' }}`;

    var allDevices = [];

    var devicePackages = $('#devicePackages');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');

    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');
    var CreateDevicePackageButton = $('#CreateDevicePackageButton');
    var UpdateDevicePackageButton = $('#UpdateDevicePackageButton');
    var UpdateDevicePackageDevicesButton = $('#UpdateDevicePackageDevicesButton');
    var UpdateDevicePackageEmployeeButton = $('#UpdateDevicePackageEmployeeButton');
    var DeleteDevicePackageButton = $('#DeleteDevicePackageButton');

    var createDevicePackageCompanyId = $('#create_device_package_company_id');
    var updateDevicePackageCompanyId = $('#update_device_package_company_id');

    var updateDevicePackageDeviceIds = $('#update_device_package_device_ids');

    var updateDevicePackageEmployeeEmployeeId = $('#update_device_package_employee_employee_id');

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
                updateDevicePackageEmployeeEmployeeId.empty();
                $.each(response.response.employees, function (i, employee) {
                    updateDevicePackageEmployeeEmployeeId.append(
                        $('<option>', {
                            value: employee.id,
                            text: employee.name
                        })
                    );
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personeller Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getDevicesByCompanyIds() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.device.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: SelectedCompanies.val(),
                pageIndex: 0,
                pageSize: 100000,
            },
            success: function (response) {
                allDevices = response.response.devices;
            },
            error: function (error) {
                console.log(error);
                toastr.error('Cihaz Listesi Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    function createDevicePackage() {
        createDevicePackageCompanyId.val('');
        $('#create_device_package_name').val('');
        $('#CreateDevicePackageModal').modal('show');
    }

    function updateDevicePackage(id) {
        $('#loader').show();
        $('#update_device_package_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.devicePackage.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateDevicePackageCompanyId.val(response.response.company_id);
                $('#update_device_package_name').val(response.response.name);
                $('#UpdateDevicePackageModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Cihaz Grubu Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function updateDevicePackageDevices(devicePackageId) {
        $('#update_device_package_devices_id').val(devicePackageId);
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.devicePackage.getDevices') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: devicePackageId,
            },
            success: function (response) {
                updateDevicePackageDeviceIds.empty();
                $.each(allDevices, function (i, device) {
                    if (device.package_id == null || parseInt(device.package_id) === parseInt(devicePackageId)) {
                        updateDevicePackageDeviceIds.append($('<option>', {
                            value: device.id,
                            text: device.name
                        }));
                    }
                });
                updateDevicePackageDeviceIds.val($.map(response.response, function (devicePackageDevice) {
                    return devicePackageDevice.id;
                })).trigger('change');
                $('#UpdateDevicePackageDevicesModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Cihaz Grubu Cihazları Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function updateDevicePackageEmployee(devicePackageId) {
        $('#update_device_package_employee_id').val(devicePackageId);
        updateDevicePackageEmployeeEmployeeId.val('');
        $('#UpdateDevicePackageEmployeeModal').modal('show');
    }

    function deleteDevicePackage(id) {
        $('#delete_device_package_id').val(id);
        $('#DeleteDevicePackageModal').modal('show');
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
                createDevicePackageCompanyId.empty();
                updateDevicePackageCompanyId.empty();
                $.each(response.response, function (i, company) {
                    createDevicePackageCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                    updateDevicePackageCompanyId.append($('<option>', {
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

    function getDevicePackages() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.devicePackage.getByCompanyIds') }}',
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
                devicePackages.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.devicePackages, function (i, devicePackage) {
                    devicePackages.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${devicePackage.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${devicePackage.id}_Dropdown" style="width: 250px">
                                    ${updatePermission === 'true' ? `
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateDevicePackage(${devicePackage.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateDevicePackageDevices(${devicePackage.id})" title="Cihaz Listesi"><i class="fas fa-desktop me-2 text-info"></i> <span class="text-dark">Cihaz Listesi</span></a>
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateDevicePackageEmployee(${devicePackage.id})" title="Cihazları Personele Ata"><i class="fas fa-user-alt me-2 text-dark"></i> <span class="text-dark">Cihazları Personele Ata</span></a>
                                    ` : ``}
                                    ${deletePermission === 'true' ? `
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteDevicePackage(${devicePackage.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                    ` : ``}
                                </div>
                            </div>
                        </td>
                        <td>
                            ${devicePackage.company ? devicePackage.company.title : ''}
                        </td>
                        <td>
                            ${devicePackage.name ?? ''}
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
                toastr.error('Cihaz Grubular Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getCompanies();
    getDevicePackages();
    getDevicesByCompanyIds();
    getEmployeesByCompanyIds();

    SelectedCompanies.change(function () {
        getDevicePackages();
        getDevicesByCompanyIds();
        getEmployeesByCompanyIds();
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
        getDevicePackages();
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

    CreateDevicePackageButton.click(function () {
        var companyId = createDevicePackageCompanyId.val();
        var name = $('#create_device_package_name').val();

        if (!companyId) {
            toastr.warning('Şirket Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('Cihaz Grubu Adı Zorunludur!');
        } else {
            CreateDevicePackageButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.devicePackage.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyId: companyId,
                    name: name,
                },
                success: function () {
                    toastr.success('Cihaz Grubu Başarıyla Oluşturuldu!');
                    changePage(1);
                    CreateDevicePackageButton.attr('disabled', false).html('Oluştur');
                    $('#CreateDevicePackageModal').modal('hide');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Cihaz Grubu Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateDevicePackageButton.attr('disabled', false).html('Oluştur');
                }
            });
        }
    });

    UpdateDevicePackageButton.click(function () {
        var id = $('#update_device_package_id').val();
        var companyId = updateDevicePackageCompanyId.val();
        var name = $('#update_device_package_name').val();

        if (!companyId) {
            toastr.warning('Şirket Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('Cihaz Grubu Adı Zorunludur!');
        } else {
            UpdateDevicePackageButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.devicePackage.update') }}',
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
                    toastr.success('Cihaz Grubu Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    UpdateDevicePackageButton.attr('disabled', false).html('Güncelle');
                    $('#UpdateDevicePackageModal').modal('hide');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Cihaz Grubu Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdateDevicePackageButton.attr('disabled', false).html('Güncelle');
                }
            });
        }
    });

    UpdateDevicePackageDevicesButton.click(function () {
        var devicePackageId = $('#update_device_package_devices_id').val();
        var deviceIdsList = updateDevicePackageDeviceIds.val();
        var deviceIds = [];
        $.each(deviceIdsList, function (i, deviceId) {
            deviceIds.push(parseInt(deviceId));
        });
        UpdateDevicePackageDevicesButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.devicePackage.setDevices') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                devicePackageId: devicePackageId,
                deviceIds: deviceIds,
            },
            success: function () {
                toastr.success('Cihaz Grubu Cihazları Başarıyla Güncellendi!');
                $('#UpdateDevicePackageDevicesModal').modal('hide');
                UpdateDevicePackageDevicesButton.attr('disabled', false).html('Güncelle');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Cihaz Grubu Cihazlarını Güncellenirken Serviste Bir Sorun Oluştu!');
                UpdateDevicePackageDevicesButton.attr('disabled', false).html('Güncelle');
            }
        });
    });

    UpdateDevicePackageEmployeeButton.click(function () {
        var devicePackageId = $('#update_device_package_employee_id').val();
        var employeeId = updateDevicePackageEmployeeEmployeeId.val();
        UpdateDevicePackageEmployeeButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.devicePackage.updateEmployee') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                devicePackageId: devicePackageId,
                employeeId: employeeId,
            },
            success: function () {
                toastr.success('Cihaz Grubu Personeli Başarıyla Güncellendi!');
                $('#UpdateDevicePackageEmployeeModal').modal('hide');
                UpdateDevicePackageEmployeeButton.attr('disabled', false).html('Güncelle');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Cihaz Grubu Personeli Güncellenirken Serviste Bir Sorun Oluştu!');
                UpdateDevicePackageEmployeeButton.attr('disabled', false).html('Güncelle');
            }
        });
    });

    DeleteDevicePackageButton.click(function () {
        var id = $('#delete_device_package_id').val();
        DeleteDevicePackageButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.devicePackage.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Cihaz Grubu Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                DeleteDevicePackageButton.attr('disabled', false).html('Sil');
                $('#DeleteDevicePackageModal').modal('hide');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Cihaz Grubu Silinirken Serviste Bir Sorun Oluştu!');
                DeleteDevicePackageButton.attr('disabled', false).html('Sil');
            }
        });
    });

</script>
