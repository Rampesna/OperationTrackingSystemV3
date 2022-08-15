<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var achievementsRow = $('#achievementsRow');

    function getAchievements() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.operationApi.personReport.getPersonnelAchievementRanking') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                achievementsRow.empty();
                var successBgCount = parseInt(Object.keys(response.response).length * 15 / 100);
                var counter = 1;
                $.each(response.response, function (i, achievement) {
                    var employeeName = achievement.kullaniciAdSoyad;
                    if (employeeName.length >= 18) {
                        employeeName = employeeName.substring(0, 15) + '...';
                    }

                    achievementsRow.append(`
                    <div class="col-xl-3">
                        <div class="d-flex align-items-center rounded p-2 mb-3" style="background-color: ${counter < successBgCount ? 'darkgreen' : 'orangered'}">
                            <div class="flex-grow-1 me-2">
                                <span class="text-white fw-bolder fs-2">${achievement.row_num}.</span>
                                <span class="text-white fw-bolder fs-5 ms-2">${employeeName}</span>
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
                toastr.error('Başarı Listesi Alınırken Serviste Bir Hata Oluştu!');
            }
        });
    }

    getAchievements();

</script>
