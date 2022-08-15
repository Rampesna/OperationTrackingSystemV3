<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var employeeSuggestions = $('#employeeSuggestions');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');

    var CreateEmployeeSuggestionButton = $('#CreateEmployeeSuggestionButton');
    var UpdateEmployeeSuggestionButton = $('#UpdateEmployeeSuggestionButton');
    var DeleteEmployeeSuggestionButton = $('#DeleteEmployeeSuggestionButton');

    function createEmployeeSuggestion() {
        $('#create_employee_suggestion_subject').val('');
        $('#create_employee_suggestion_description').val('');
        $('#CreateEmployeeSuggestionModal').modal('show');
    }

    function updateEmployeeSuggestion(id) {
        $('#loader').show();
        $('#update_employee_suggestion_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.employeeSuggestion.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#update_employee_suggestion_subject').val(response.response.subject);
                $('#update_employee_suggestion_description').val(response.response.description);
                $('#UpdateEmployeeSuggestionModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Öneri Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteEmployeeSuggestion(id) {
        $('#delete_employee_suggestion_id').val(id);
        $('#DeleteEmployeeSuggestionModal').modal('show');
    }

    function getEmployeeSuggestions() {
        employeeSuggestions.html(`<tr><td colspan="2" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.employeeSuggestion.getByEmployeeId') }}',
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
                employeeSuggestions.empty();
                $.each(response.response.employeeSuggestions, function (i, employeeSuggestion) {
                    employeeSuggestions.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${employeeSuggestion.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${employeeSuggestion.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateEmployeeSuggestion(${employeeSuggestion.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteEmployeeSuggestion(${employeeSuggestion.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${employeeSuggestion.subject ?? ''}
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
                toastr.error('Öneriler Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }
    getEmployeeSuggestions();

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
        getEmployeeSuggestions();
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

    CreateEmployeeSuggestionButton.click(function () {
        var subject = $('#create_employee_suggestion_subject').val();
        var description = $('#create_employee_suggestion_description').val();

        if (!subject) {
            toastr.warning('Öneri Konusu Boş Olamaz!');
        } else if (!description) {
            toastr.warning('Öneri Açıklaması Boş Olamaz!');
        } else {
            CreateEmployeeSuggestionButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('employee.api.employeeSuggestion.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    subject: subject,
                    description: description,
                },
                success: function () {
                    toastr.success('Öneri Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#CreateEmployeeSuggestionModal').modal('hide');
                    CreateEmployeeSuggestionButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Öneri Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateEmployeeSuggestionButton.attr('disabled', false).html(`Oluştur`);
                }
            });
        }
    });

    UpdateEmployeeSuggestionButton.click(function () {
        var id = $('#update_employee_suggestion_id').val();
        var subject = $('#update_employee_suggestion_subject').val();
        var description = $('#update_employee_suggestion_description').val();

        if (!subject) {
            toastr.warning('Öneri Konusu Boş Olamaz!');
        } else if (!description) {
            toastr.warning('Öneri Açıklaması Boş Olamaz!');
        } else {
            UpdateEmployeeSuggestionButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'put',
                url: '{{ route('employee.api.employeeSuggestion.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    subject: subject,
                    description: description,
                },
                success: function () {
                    toastr.success('Öneri Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#UpdateEmployeeSuggestionModal').modal('hide');
                    UpdateEmployeeSuggestionButton.attr('disabled', false).html(`Güncelle`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Öneri Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdateEmployeeSuggestionButton.attr('disabled', false).html(`Güncelle`);
                }
            });
        }
    });

    DeleteEmployeeSuggestionButton.click(function () {
        var id = $('#delete_employee_suggestion_id').val();
        DeleteEmployeeSuggestionButton.attr('disabled', true).html(`<i class="fas fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'delete',
            url: '{{ route('employee.api.employeeSuggestion.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Öneri Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#DeleteEmployeeSuggestionModal').modal('hide');
                DeleteEmployeeSuggestionButton.attr('disabled', false).html(`Sil`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Öneri Silinirken Serviste Bir Sorun Oluştu!');
                DeleteEmployeeSuggestionButton.attr('disabled', false).html(`Sil`);
            }
        });
    });

</script>
