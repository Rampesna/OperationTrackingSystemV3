<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var employeeQualityAssessments = $('#employeeQualityAssessments');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var createEmployeeQualityAssessmentParameters = $('#createEmployeeQualityAssessmentParameters');

    var createEmployeeQualityAssessmentEmployeeId = $('#create_employee_quality_assessment_employee_id');
    var createEmployeeQualityAssessmentQualityAssessmentListId = $('#create_employee_quality_assessment_quality_assessment_list_id');

    var CreateEmployeeQualityAssessmentButton = $('#CreateEmployeeQualityAssessmentButton');
    var DeleteEmployeeQualityAssessmentButton = $('#DeleteEmployeeQualityAssessmentButton');

    function createEmployeeQualityAssessment() {
        createEmployeeQualityAssessmentParameters.empty();
        createEmployeeQualityAssessmentEmployeeId.val('');
        createEmployeeQualityAssessmentQualityAssessmentListId.val('');
        $('#create_employee_quality_assessment_date').val('');
        $('#CreateEmployeeQualityAssessmentModal').modal('show');
    }

    function deleteEmployeeQualityAssessment(id) {
        $('#delete_employee_quality_assessment_id').val(id);
        $('#DeleteEmployeeQualityAssessmentModal').modal('show');
    }

    function getAllEmployees() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getAllWorkers') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createEmployeeQualityAssessmentEmployeeId.empty();
                $.each(response.response, function (i, employee) {
                    createEmployeeQualityAssessmentEmployeeId.append($('<option>', {
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

    function getQualityAssessmentLists() {
        var qualityAssessmentTypeId = 4;
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.qualityAssessmentList.getByQualityAssessmentTypeId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                qualityAssessmentTypeId: qualityAssessmentTypeId,
            },
            success: function (response) {
                createEmployeeQualityAssessmentQualityAssessmentListId.empty();
                $.each(response.response, function (i, qualityAssessmentList) {
                    createEmployeeQualityAssessmentQualityAssessmentListId.append($('<option>', {
                        value: qualityAssessmentList.id,
                        text: qualityAssessmentList.name
                    }));
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kalite Değerlendirme Listeleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getEmployeeQualityAssessments() {
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var qualityAssessmentTypeId = 4;
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employeeQualityAssessment.getByUserId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                pageIndex: pageIndex,
                pageSize: pageSize,
                qualityAssessmentTypeId: qualityAssessmentTypeId
            },
            success: function (response) {
                employeeQualityAssessments.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.employeeQualityAssessments, function (i, employeeQualityAssessment) {
                    employeeQualityAssessments.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${employeeQualityAssessment.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${employeeQualityAssessment.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateEmployeeQualityAssessment(${employeeQualityAssessment.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteEmployeeQualityAssessment(${employeeQualityAssessment.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${employeeQualityAssessment.employee ? employeeQualityAssessment.employee.name : ''}
                        </td>
                        <td class="hideIfMobile">
                            ${reformatDatetimeToDateForHuman(employeeQualityAssessment.date)}
                        </td>
                        <td>
                            ${employeeQualityAssessment.quality_assessment_list ? employeeQualityAssessment.quality_assessment_list.name : ''}
                        </td>
                        <td>
                            ${employeeQualityAssessment.point ?? ''}
                        </td>
                    </tr>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Değerlendirmeler Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getAllEmployees();
    getQualityAssessmentLists();
    getEmployeeQualityAssessments();

    function changePage(newPage) {
        if (newPage === 1) {
            pageDownButton.attr('disabled', true);
        } else {
            pageDownButton.attr('disabled', false);
        }

        page.html(newPage);
        getEmployeeQualityAssessments();
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

    createEmployeeQualityAssessmentQualityAssessmentListId.change(function () {
        var id = $(this).val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.qualityAssessmentList.getParametersById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                createEmployeeQualityAssessmentParameters.empty();
                $.each(response.response.parameters, function (i, qualityAssessmentListParameter) {
                    var input = ``;
                    if (parseInt(qualityAssessmentListParameter.type.is_input) === 1) {
                        input = `
                            <div class="col-xl-3 mb-3">
                                <div class="form-group">
                                    <label style="width: 100%">
                                        <input type="${qualityAssessmentListParameter.type.type}" class="form-control qualityAssessmentListParameterInput" data-parameter-id="${qualityAssessmentListParameter.id}" data-type="input">
                                    </label>
                                </div>
                            </div>
                            `;
                    } else {
                        values = ``;
                        $.each(qualityAssessmentListParameter.values, function (i, value) {
                            values += `<option value="${value.value}">${value.name}</option>`;
                        });
                        input = `
                            <div class="col-xl-3 mb-3">
                                <div class="form-group">
                                    <label style="width: 100%">
                                        <select class="form-select form-select-solid qualityAssessmentListParameterInput" ${qualityAssessmentListParameter.type.type} data-parameter-id="${qualityAssessmentListParameter.id}" data-type="input">
                                            ${values}
                                        </select>
                                    </label>
                                </div>
                            </div>
                            `;
                    }
                    createEmployeeQualityAssessmentParameters.append(`
                        <div class="row qualityAssessmentListParameterRow" data-parameter-id="${qualityAssessmentListParameter.id}">
                            <div class="col-xl-4 mb-3 mt-3">
                                <span class="font-weight-bolder">${qualityAssessmentListParameter.name}</span>
                            </div>
                            ${input}
                            <div class="col-xl-5 mb-3">
                                <div class="form-group">
                                    <label style="width: 100%">
                                        <input type="text" class="form-control form-control-solid" id="parameter_description_${qualityAssessmentListParameter.id}" placeholder="Açıklamalar...">
                                    </label>
                                </div>
                            </div>
                        </div>
                        `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kalite Değerlendirme Listesi Parametreleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    });

    CreateEmployeeQualityAssessmentButton.click(function () {
        var employeeId = createEmployeeQualityAssessmentEmployeeId.val();
        var date = $('#create_employee_quality_assessment_date').val();
        var qualityAssessmentListId = createEmployeeQualityAssessmentQualityAssessmentListId.val();
        var callNumber = '';
        var callUrl = '';
        var parameters = [];
        var qualityAssessmentListParameterInputs = $('.qualityAssessmentListParameterInput');

        $.each(qualityAssessmentListParameterInputs, function () {
            if ($(this).data('type') === 'input') {
                parameters.push({
                    id: $(this).data('parameter-id'),
                    value: $(this).val(),
                    description: $('#parameter_description_' + $(this).data('parameter-id')).val()
                });
            }
        });

        if (!employeeId) {
            toastr.warning('Personel Seçilmedi!');
        } else if (!date) {
            toastr.warning('Tarih Seçilmedi!');
        } else if (!qualityAssessmentListId) {
            toastr.warning('Değerlenirme Formu Seçilmedi!');
        } else {
            CreateEmployeeQualityAssessmentButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.employeeQualityAssessment.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    employeeId: employeeId,
                    date: date,
                    qualityAssessmentListId: qualityAssessmentListId,
                    callNumber: callNumber,
                    callUrl: callUrl,
                    parameters: parameters
                },
                success: function () {
                    toastr.success('Personel Kalite Değerlendirmesi Başarıyla Oluşturuldu!');
                    CreateEmployeeQualityAssessmentButton.attr('disabled', false).html('Değerlendir');
                    $('#CreateEmployeeQualityAssessmentModal').modal('hide');
                    changePage(parseInt(1));
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Personel Kalite Değerlendirmesi Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateEmployeeQualityAssessmentButton.attr('disabled', false).html('Değerlendir');
                }
            });
        }
    });

    DeleteEmployeeQualityAssessmentButton.click(function () {
        var id = $('#delete_employee_quality_assessment_id').val();
        DeleteEmployeeQualityAssessmentButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.employeeQualityAssessment.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Personel Kalite Değerlendirmesi Başarıyla Silindi!');
                $('#DeleteEmployeeQualityAssessmentModal').modal('hide');
                DeleteEmployeeQualityAssessmentButton.attr('disabled', false).html('Sil');
                changePage(parseInt(page.html()));
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Kalite Değerlendirmesi Silinirken Serviste Bir Sorun Oluştu!');
                DeleteEmployeeQualityAssessmentButton.attr('disabled', false).html('Sil');
            }
        });
    });

</script>
