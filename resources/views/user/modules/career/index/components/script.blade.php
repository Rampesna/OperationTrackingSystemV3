<script>

    var downloadCvPermission = `{{ checkUserPermission(188, $userPermissions) ? 'true' : 'false' }}`;

    $(document).ready(function () {
        $('#loader').hide();
    });

    var careers = $('#careers');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');

    var SendBatchSmsButton = $('#SendBatchSmsButton');

    function transactions() {
        $('#TransactionsModal').modal('show');
    }

    function sendBatchSms() {
        $('#TransactionsModal').modal('hide');
        $('#send_batch_sms_message').val('');
        $('#SendBatchSmsModal').modal('show');
    }

    function downloadCv(id) {
        window.open(`{{ route('user.web.file.download') }}/${id}`, '_blank');
    }

    function getCareers() {
        careers.html(`<tr><td colspan="6" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.career.index') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
            },
            success: function (response) {
                careers.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.careers, function (i, career) {
                    careers.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${career.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${career.id}_Dropdown" style="width: 175px">
                                    ${downloadCvPermission === 'true' ? `
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="downloadCv('${career.cv}')" title="CV İndir"><i class="fas fa-file-download me-2 text-primary"></i> <span class="text-dark">CV İndir</span></a>
                                    ` : ``}
                                </div>
                            </div>
                        </td>
                        <td>
                            ${career.name ?? ''}
                        </td>
                        <td>
                            ${career.department ?? ''}
                        </td>
                        <td>
                            ${career.identity ?? ''}
                        </td>
                        <td>
                            ${career.email ?? ''}
                        </td>
                        <td>
                            ${career.phone ?? ''}
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
                toastr.error('Kariyer Başvuruları Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getCareers();

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
        getCareers();
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

    SendBatchSmsButton.click(function () {
        var message = $('#send_batch_sms_message').val();

        if (!message) {
            toastr.warning('Lütfen Mesajınızı Giriniz.');
        } else {
            SendBatchSmsButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.career.sendBatchSms') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    message: message,
                },
                success: function () {
                    toastr.success('Mesaj Başarıyla Gönderildi.');
                    $('#SendBatchSmsModal').modal('hide');
                    SendBatchSmsButton.attr('disabled', false).html('Gönder');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Mesaj Gönderilirken Serviste Bir Sorun Oluştu.');
                    SendBatchSmsButton.attr('disabled', false).html('Gönder');
                }
            });
        }
    });

</script>
