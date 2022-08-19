<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var examId = parseInt(`{{ $examId }}`);

    var employees = $('#employees');
    var examResultReadingReplyListRow = $('#examResultReadingReplyListRow');

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
                examResultReadingReplyListRow.empty();
                $.each(response.response, function (i, examResultReadingReply) {

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
    });

</script>
