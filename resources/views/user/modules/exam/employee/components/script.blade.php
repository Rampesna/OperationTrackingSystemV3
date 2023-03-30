<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var examId = parseInt(`{{ $examId }}`);
    var selectedEmployeeGuid = null;

    var employees = $('#employees');
    var examResultReadingReplyListRow = $('#examResultReadingReplyListRow');
    var examResultReadingReplyListTableBody = $('#examResultReadingReplyListTableBody');

    var ReadingButton = $('#ReadingButton');

    function getExamResultReadingList() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.examSystem.getExamResultReadingList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                examId: examId,
            },
            success: function (response) {
                employees.empty();
                $.each(response.response, function (i, employee) {
                    employees.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${employee.kullanicilarId}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${employee.kullanicilarId}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="getExamResultReadingReplyList(${employee.kullanicilarId})" title="Değerlendir"><i class="fas fa-eye me-2 text-info"></i> <span class="text-dark">Değerlendir</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${employee.kullaniciAdSoyad ?? ''}
                        </td>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Sınava Giren Personel Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getExamResultReadingReplyList(employeeGuid) {
        selectedEmployeeGuid = employeeGuid;
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.examSystem.getExamResultReadingReplyList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                examId: examId,
                employeeGuid: employeeGuid,
            },
            success: function (response) {
                console.log(response);
                // examResultReadingReplyListRow.empty();
                examResultReadingReplyListTableBody.empty();
                $.each(response.response, function (i, examResultReadingReply) {
                    examResultReadingReplyListTableBody.append(`
                    <tr>
                        <td class="col-xl-5">${examResultReadingReply.soru}</td>
                        <td class="col-xl-5">${examResultReadingReply.cevapStr}</td>
                        <td class="col-xl-2 text-end">
                        <select class="form-select form-select-sm resultSelection" data-id="${examResultReadingReply.id}" data-hareketId="${examResultReadingReply.hareketId}" data-sinavHareketId="${examResultReadingReply.sinavHareketId}">
                            <option disabled hidden selected value="">Seçiniz</option>
                            <option value="1" ${parseInt(examResultReadingReply.durum) === 1 ? `selected` : ``}>Doğru</option>
                            <option value="0" ${parseInt(examResultReadingReply.durum) === 0 ? `selected` : ``}>Yanlış</option>
                        </select>
                        </td>
                    </tr>
                    `);
                });
                $('#loader').hide();
                $('#ReadingModal').modal('show');
            },
            error: function (error) {
                console.log(error);
                $('#loader').hide();
                toastr.error('Personel Sınav Verileri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getExamResultReadingList();

    ReadingButton.click(function () {
        ReadingButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        let checking = true;
        var resultSelections = $('.resultSelection');
        var resultSelectionsArray = [];
        var trueAnswerCount = 0;

        $.each(resultSelections, function (i, resultSelection) {
            if (resultSelection.value !== null && resultSelection.value !== '') {
                if (resultSelection.dataset.id !== null && resultSelection.dataset.id !== '' && resultSelection.dataset.id !== "null") {
                    if (resultSelection.value === '1') {
                        trueAnswerCount++;
                    }

                    resultSelectionsArray.push({
                        cevapId: resultSelection.dataset.id,
                        durum: resultSelection.value,
                        sinavId: examId,
                        kullaniciId: selectedEmployeeGuid,
                    });
                }
            } else {
                checking = false;
            }
        });

        $.each(resultSelectionsArray, function (i, resultSelection) {
            resultSelection.puan = trueAnswerCount * 100 / resultSelectionsArray.length;
        });

        if (checking) {
            console.log(resultSelectionsArray);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.examSystem.setExamResultReadingReply') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    answers: resultSelectionsArray,
                },
                success: function (response) {
                    console.log(response);
                    toastr.success('Sınav Sonuçları Başarıyla Kaydedildi!');
                    ReadingButton.attr('disabled', false).html('Kaydet');
                },
                error: function (error) {
                    ReadingButton.attr('disabled', false).html('Kaydet');
                    console.log(error);
                    if (parseInt(error.status) === 422) {
                        $.each(error.responseJSON.response, function (i, error) {
                            toastr.error(error[0]);
                        });
                    } else {
                        toastr.error(error.responseJSON.message);
                    }
                }
            });
        } else {
            toastr.warning('Lütfen Tüm Soruları Değerlendiriniz!');
            ReadingButton.attr('disabled', false).html('Kaydet');
        }
    });

</script>
