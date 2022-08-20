<script>

    var queues = $('#queues');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');

    var CreateQueueButton = $('#CreateQueueButton');
    var UpdateQueueButton = $('#UpdateQueueButton');
    var DeleteQueueButton = $('#DeleteQueueButton');

    var createQueueCompanyId = $('#create_queue_company_id');
    var updateQueueCompanyId = $('#update_queue_company_id');

    function createQueue() {
        createQueueCompanyId.val('');
        $('#create_queue_name').val('');
        $('#create_queue_short').val('');
        $('#create_queue_group_code').val('');
        $('#create_queue_ots_code').val('');
        $('#CreateQueueModal').modal('show');
    }

    function updateQueue(id) {
        $('#loader').show();
        $('#update_queue_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.queue.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateQueueCompanyId.val(response.response.company_id);
                $('#update_queue_name').val(response.response.name);
                $('#update_queue_short').val(response.response.short);
                $('#update_queue_group_code').val(response.response.group_code);
                $('#update_queue_ots_code').val(response.response.ots_code);
                $('#UpdateQueueModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Santral Kuyruğu Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteQueue(id) {
        $('#delete_queue_id').val(id);
        $('#DeleteQueueModal').modal('show');
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
                createQueueCompanyId.empty();
                updateQueueCompanyId.empty();
                $.each(response.response, function (i, company) {
                    createQueueCompanyId.append($('<option>', {
                        value: company.id,
                        text: company.title
                    }));
                    updateQueueCompanyId.append($('<option>', {
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

    function getQueues() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.queue.getByCompanyIds') }}',
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
                console.log(response);
                queues.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize));
                $.each(response.response.queues, function (i, queue) {
                    queues.append(`
                    <tr>
                        <td>
                            ${queue.company ? queue.company.title : ''}
                        </td>
                        <td>
                            ${queue.name}
                        </td>
                        <td>
                            ${queue.short}
                        </td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${queue.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${queue.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateQueue(${queue.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteQueue(${queue.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
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
                toastr.error('Santral Kuyrukları Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getCompanies();
    getQueues();

    SelectedCompanies.change(function () {
        getQueues();
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
        getQueues();
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

    CreateQueueButton.click(function () {
        var companyId = createQueueCompanyId.val();
        var name = $('#create_queue_name').val();
        var short = $('#create_queue_short').val();
        var groupCode = $('#create_queue_group_code').val();
        var otsCode = $('#create_queue_ots_code').val();

        if (!companyId) {
            toastr.warning('Şirket Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('Kuyruk Adı Zorunludur!');
        } else if (!short) {
            toastr.warning('Santral Kodu Zorunludur!');
        } else {
            $('#loader').show();
            $('#CreateQueueModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.queue.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyId: companyId,
                    name: name,
                    short: short,
                    groupCode: groupCode,
                    otsCode: otsCode,
                },
                success: function () {
                    toastr.success('Santral Kuyruğu Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Santral Kuyruğu Oluşturulurken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateQueueButton.click(function () {
        var id = $('#update_queue_id').val();
        var companyId = updateQueueCompanyId.val();
        var name = $('#update_queue_name').val();
        var short = $('#update_queue_short').val();
        var groupCode = $('#update_queue_group_code').val();
        var otsCode = $('#update_queue_ots_code').val();

        if (!companyId) {
            toastr.warning('Şirket Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('Kuyruk Adı Zorunludur!');
        } else if (!short) {
            toastr.warning('Santral Kodu Zorunludur!');
        } else {
            $('#loader').show();
            $('#UpdateQueueModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.queue.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    companyId: companyId,
                    name: name,
                    short: short,
                    groupCode: groupCode,
                    otsCode: otsCode,
                },
                success: function () {
                    toastr.success('Santral Kuyruğu Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Santral Kuyruğu Güncellenirken Serviste Bir Sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteQueueButton.click(function () {
        var id = $('#delete_queue_id').val();
        $('#loader').show();
        $('#DeleteQueueModal').modal('hide');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.queue.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Santral Kuyruğu Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Santral Kuyruğu Silinirken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    });

</script>
