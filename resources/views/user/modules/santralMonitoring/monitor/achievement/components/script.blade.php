<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var achievementsRow = $('#achievementsRow');

    function getAchievements() {
        var typeId = parseInt('{{ $achievementMonitoringType }}');
        var companyIdsString = '{{ $achievementMonitoringCompanyIds }}';
        var companyIds = companyIdsString.split(',').map(function (companyId) {
            return parseInt(companyId);
        });
        var jobDepartmentTypeIdsString = '{{ $achievementMonitoringJobDepartmentTypeIds }}';
        var jobDepartmentTypeIds = jobDepartmentTypeIdsString.split(',').map(function (achievementMonitoringJobDepartmentTypeId) {
            return parseInt(achievementMonitoringJobDepartmentTypeId);
        });

        console.log({
            companyIds: companyIds,
        })

        if (typeId === 1) {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.employee.getByCompanies') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyIds: companyIds,
                    pageIndex: 0,
                    pageSize: 1000,
                    leave: 0
                },
                success: function (response) {
                    console.log(response);
                    var employeeGuids = $.map(response.response, function (employee) {
                        return parseInt(employee.guid);
                    });
                    setAchievements(employeeGuids);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        } else if (typeId === 2) {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.employee.getByJobDepartmentTypeIds') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    jobDepartmentTypeIds: jobDepartmentTypeIds,
                },
                success: function (response) {
                    var employeeGuids = $.map(response.response, function (employee) {
                        return parseInt(employee.guid);
                    });
                    setAchievements(employeeGuids);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        } else {
            toastr.error('Personel Listesi Türü Geçersiz!');
        }
    }

    function setAchievements(employeeGuids) {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.personReport.getPersonnelAchievementRanking') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                employeeGuids: employeeGuids,
            },
            success: function (response) {
                achievementsRow.empty();
                var successBgCount = parseInt(Object.keys(response.response).length * 15 / 100);
                console.log(successBgCount);
                var counter = 1;
                $.each(response.response, function (i, achievement) {
                    var employeeName = achievement.kullaniciAdSoyad;
                    if (employeeName.length >= 18) {
                        employeeName = employeeName.substring(0, 15) + '...';
                    }

                    achievementsRow.append(`
                    <div class="col-7">
                        <div class="d-flex align-items-center rounded p-5 mb-7" style="background-color: ${counter < successBgCount ? 'darkgreen' : 'orangered'}">
                            <div class="flex-grow-1 me-2">
                                <span class="text-white fw-bolder fs-2">${achievement.row_num}.</span>
                                <span class="text-white fw-bolder fs-3 ms-2">${employeeName}</span>
                            </div>
                            <span class="fw-bolder text-white py-1">${achievement.puan ?? 0}</span>
                        </div>
                    </div>
                    `);
                    counter++;
                });
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    getAchievements();

    setInterval(function () {
        getAchievements();
    }, 60000);

</script>
