<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var employeeMonitoringTypeSelector = $('#employeeMonitoringType');
    var employeeMonitoringCompanyIdsSelector = $('#employeeMonitoringCompanyIds');
    var employeeMonitoringJobDepartmentTypeIdsSelector = $('#employeeMonitoringJobDepartmentTypeIds');

    var achievementMonitoringTypeSelector = $('#achievementMonitoringType');
    var achievementMonitoringCompanyIdsSelector = $('#achievementMonitoringCompanyIds');
    var achievementMonitoringJobDepartmentTypeIdsSelector = $('#achievementMonitoringJobDepartmentTypeIds');

    var EmployeeMonitoringSettingsButton = $('#EmployeeMonitoringSettingsButton');
    var AchievementMonitoringSettingsButton = $('#AchievementMonitoringSettingsButton');

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
                employeeMonitoringCompanyIdsSelector.empty();
                achievementMonitoringCompanyIdsSelector.empty();
                $.each(response.response, function (i, company) {
                    employeeMonitoringCompanyIdsSelector.append(`<option value="${company.id}">${company.title}</option>`);
                    achievementMonitoringCompanyIdsSelector.append(`<option value="${company.id}">${company.title}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Firma Listesi Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    function getJobDepartmentTypesByCompanyIds() {
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
            },
            success: function (response) {
                employeeMonitoringJobDepartmentTypeIdsSelector.empty();
                achievementMonitoringJobDepartmentTypeIdsSelector.empty();
                $.each(response.response, function (i, jobDepartmentType) {
                    employeeMonitoringJobDepartmentTypeIdsSelector.append(`<option value="${jobDepartmentType.id}">${jobDepartmentType.name}</option>`);
                    achievementMonitoringJobDepartmentTypeIdsSelector.append(`<option value="${jobDepartmentType.id}">${jobDepartmentType.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Departman Türü Listesi Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    function employeeMonitoringSettings() {
        employeeMonitoringTypeSelector.val('');
        employeeMonitoringCompanyIdsSelector.val([]);
        employeeMonitoringJobDepartmentTypeIdsSelector.val([]);
        $('#employeeMonitoringCompanyIdsColumn').hide();
        $('#employeeMonitoringJobDepartmentTypeIdsColumn').hide();
        $('#EmployeeMonitoringSettingsModal').modal('show');
    }

    function achievementMonitoringSettings() {
        achievementMonitoringTypeSelector.val('');
        achievementMonitoringCompanyIdsSelector.val([]);
        achievementMonitoringJobDepartmentTypeIdsSelector.val([]);
        $('#achievementMonitoringCompanyIdsColumn').hide();
        $('#achievementMonitoringJobDepartmentTypeIdsColumn').hide();
        $('#AchievementMonitoringSettingsModal').modal('show');
    }

    getCompanies();
    getJobDepartmentTypesByCompanyIds();

    SelectedCompanies.change(function () {
        getJobDepartmentTypesByCompanyIds();
    });

    employeeMonitoringTypeSelector.change(function () {
        if (parseInt($(this).val()) === 1) {
            $('#employeeMonitoringCompanyIdsColumn').show();
            $('#employeeMonitoringJobDepartmentTypeIdsColumn').hide();
        } else if (parseInt($(this).val()) === 2) {
            $('#employeeMonitoringCompanyIdsColumn').hide();
            $('#employeeMonitoringJobDepartmentTypeIdsColumn').show();
        }
    });

    achievementMonitoringTypeSelector.change(function () {
        if (parseInt($(this).val()) === 1) {
            $('#achievementMonitoringCompanyIdsColumn').show();
            $('#achievementMonitoringJobDepartmentTypeIdsColumn').hide();
        } else if (parseInt($(this).val()) === 2) {
            $('#achievementMonitoringCompanyIdsColumn').hide();
            $('#achievementMonitoringJobDepartmentTypeIdsColumn').show();
        }
    });

    EmployeeMonitoringSettingsButton.click(function () {
        var employeeMonitoringType = employeeMonitoringTypeSelector.val();
        var employeeMonitoringCompanyIds = employeeMonitoringCompanyIdsSelector.val();
        var employeeMonitoringJobDepartmentTypeIds = employeeMonitoringJobDepartmentTypeIdsSelector.val();

        if (!employeeMonitoringType) {
            toastr.warning('Personel Listesi Türü Seçilmedi!');
        } else if (parseInt(employeeMonitoringType) === 1 && employeeMonitoringCompanyIds.length === 0) {
            toastr.warning('En Az Bir Firma Seçilmelidir!');
        } else if (parseInt(employeeMonitoringType) === 2 && employeeMonitoringJobDepartmentTypeIds.length === 0) {
            toastr.warning('En Az Bir Departman Türü Seçilmelidir!');
        } else {
            $('#EmployeeMonitoringSettingsModal').modal('hide');
            window.open(`{{ route('user.web.santralMonitoring.monitor.employee') }}?employeeMonitoringType=${employeeMonitoringType}&employeeMonitoringCompanyIds=${employeeMonitoringCompanyIds}&employeeMonitoringJobDepartmentTypeIds=${employeeMonitoringJobDepartmentTypeIds}`, '_blank');
        }
    });

    AchievementMonitoringSettingsButton.click(function () {
        var achievementMonitoringType = achievementMonitoringTypeSelector.val();
        var achievementMonitoringCompanyIds = achievementMonitoringCompanyIdsSelector.val();
        var achievementMonitoringJobDepartmentTypeIds = achievementMonitoringJobDepartmentTypeIdsSelector.val();

        if (!achievementMonitoringType) {
            toastr.warning('Personel Listesi Türü Seçilmedi!');
        } else if (parseInt(achievementMonitoringType) === 1 && achievementMonitoringCompanyIds.length === 0) {
            toastr.warning('En Az Bir Firma Seçilmelidir!');
        } else if (parseInt(achievementMonitoringType) === 2 && achievementMonitoringJobDepartmentTypeIds.length === 0) {
            toastr.warning('En Az Bir Departman Türü Seçilmelidir!');
        } else {
            $('#AchievementMonitoringSettingsModal').modal('hide');
            window.open(`{{ route('user.web.santralMonitoring.monitor.achievement') }}?achievementMonitoringType=${achievementMonitoringType}&achievementMonitoringCompanyIds=${achievementMonitoringCompanyIds}&achievementMonitoringJobDepartmentTypeIds=${achievementMonitoringJobDepartmentTypeIds}`, '_blank');
        }
    });

</script>
