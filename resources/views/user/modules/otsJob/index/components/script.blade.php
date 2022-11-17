<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var setDataScanningTableName = $('#set_data_scanning_table_name');
    var setCallDataScanningSurveyId = $('#set_call_data_scanning_survey_id');

    var SetJobsExcelButton = $('#SetJobsExcelButton');
    var SetJobsWithIdButton = $('#SetJobsWithIdButton');
    var SetDataScanningButton = $('#SetDataScanningButton');
    var SetCallDataScanningButton = $('#SetCallDataScanningButton');
    var SetJobsClosedExcelButton = $('#SetJobsClosedExcelButton');
    var SetJobSuspendButton = $('#SetJobSuspendButton');
    var SetJobCaseWorkDeleteButton = $('#SetJobCaseWorkDeleteButton');

    var setJobsExcelType = $('#set_jobs_excel_type');
    var setJobsWithIdTypeId = $('#set_jobs_with_id_type_id');
    var setJobsExcelCommercialCompanyId = $('#set_jobs_excel_commercial_company_id');
    var setJobsWithIdCommercialCompanyId = $('#set_jobs_with_id_commercial_company_id');
    var setJobsClosedExcelCommercialCompanyId = $('#set_jobs_closed_excel_commercial_company_id');

    function getCommercialCompanies() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.commercialCompany.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                setJobsExcelCommercialCompanyId.empty();
                setJobsWithIdCommercialCompanyId.empty();
                setJobsClosedExcelCommercialCompanyId.empty();
                $.each(response.response, function (i, commercialCompany) {
                    setJobsExcelCommercialCompanyId.append(`<option value="${commercialCompany.id}">${commercialCompany.name}</option>`);
                    setJobsWithIdCommercialCompanyId.append(`<option value="${commercialCompany.id}">${commercialCompany.name}</option>`);
                    setJobsClosedExcelCommercialCompanyId.append(`<option value="${commercialCompany.id}">${commercialCompany.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kurumsal Firma Listesi Alınırken Serviste Bir Hata Oluştu!');
            }
        });
    }

    getCommercialCompanies();

    function setJobsExcel() {
        $('#set_jobs_excel_file').val('');
        setJobsExcelType.val('');
        setJobsExcelCommercialCompanyId.val('');
        $('#SetJobsExcelModal').modal('show');
    }

    function setJobsWithId() {
        $('#set_jobs_with_id_job_id').val('');
        $('#set_jobs_with_id_priority').val('');
        $('#set_jobs_with_id_code').val('');
        setJobsWithIdTypeId.val('');
        setJobsWithIdCommercialCompanyId.val('');
        $('#SetJobsWithIdModal').modal('show');
    }

    function setDataScanning() {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.dataScanning.getDataScanTables') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                $('#set_data_scanning_file').val('');
                setDataScanningTableName.empty();
                $.each(response.response, function (i, table) {
                    setDataScanningTableName.append(`<option data-group-code="${table.grupKodu}" value="${table.tabloAdi}">${table.aciklama}</option>`);
                });
                setDataScanningTableName.val('');
                $('#SetDataScanningModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Tablo Listesi Alınırken Serviste Hata Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function setCallDataScanning() {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                $('#set_call_data_scanning_file').val('');
                setCallDataScanningSurveyId.empty();
                $.each(response.response, function (i, survey) {
                    setCallDataScanningSurveyId.append($('<option>', {
                        value: survey.id,
                        text: `(${survey.kodu}) - ${survey.adi}`
                    }));
                });
                setCallDataScanningSurveyId.val('');
                $('#SetCallDataScanningModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Anket Listesi Alınırken Serviste Hata Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function setJobsClosedExcel() {
        $('#set_jobs_closed_excel_file').val('');
        setJobsClosedExcelCommercialCompanyId.val('');
        $('#SetJobsClosedExcelModal').modal('show');
    }

    function setJobSuspend() {
        $('#SetJobSuspendModal').modal('show');
    }

    function setJobCaseWorkDelete() {
        $('#set_job_case_work_delete_id').val('');
        $('#SetJobCaseWorkDeleteModal').modal('show');
    }

    SetJobsExcelButton.click(function () {
        var file = $('#set_jobs_excel_file')[0].files[0];
        var type = setJobsExcelType.val();
        var commercialCompanyId = setJobsExcelCommercialCompanyId.val();

        if (!file) {
            toastr.warning('Dosya Seçilmedi!');
        } else if (!type) {
            toastr.warning('İş Türü Seçilmedi!');
        } else if (!commercialCompanyId) {
            toastr.warning('Firma Türü Seçilmedi!');
        } else {
            $('#loader').show();
            $('#SetJobsExcelModal').modal('hide');
            var formData = new FormData();
            formData.append('file', file);
            formData.append('type', type);
            formData.append('commercialCompanyId', commercialCompanyId);
            $.ajax({
                processData: false,
                contentType: false,
                type: 'post',
                url: '{{ route('user.api.operationApi.jobsSystem.setJobsExcel') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: formData,
                success: function (response) {
                    console.log(response);
                    $('#loader').hide();
                    toastr.success('İşler Başarıyla Aktarıldı');
                },
                error: function (error) {
                    console.log(error);
                    if (parseInt(error.status) === 422) {
                        var errors = error.responseJSON.response;
                        $.each(errors, function (key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('İş Aktarılırken Serviste Bir Hata Oluştu!');
                    }
                    $('#loader').hide();
                }
            });
        }
    });

    SetJobsWithIdButton.click(function () {
        var id = $('#set_jobs_with_id_job_id').val();
        var priority = $('#set_jobs_with_id_priority').val();
        var code = $('#set_jobs_with_id_code').val();
        var typeId = setJobsWithIdTypeId.val();
        var commercialCompanyId = setJobsWithIdCommercialCompanyId.val();

        if (!id) {
            toastr.warning('İş ID Girilmedi!');
        } else if (!priority) {
            toastr.warning('Öncelik Girilmedi!');
        } else if (!code) {
            toastr.warning('Kullanıcı Yapılacak İşler Kodu Girilmedi!');
        } else if (!typeId) {
            toastr.warning('İş Türü Seçilmedi!');
        } else if (!commercialCompanyId) {
            toastr.warning('Firma Seçilmedi!');
        } else {
            SetJobsWithIdButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.jobsSystem.setJobsWithId') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    priority: priority,
                    code: code,
                    typeId: typeId,
                    commercialCompanyId: commercialCompanyId
                },
                success: function (response) {
                    console.log(response);
                    SetJobsWithIdButton.attr('disabled', false).html('Aktar');
                    $('#SetJobsWithIdModal').modal('hide');
                    toastr.success('İş Başarıyla Aktarıldı');
                },
                error: function (error) {
                    SetJobsWithIdButton.attr('disabled', false).html('Aktar');
                    console.log(error);
                    if (parseInt(error.status) === 422) {
                        var errors = error.responseJSON.response;
                        $.each(errors, function (key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('İş Aktarılırken Serviste Bir Hata Oluştu!');
                    }
                    $('#loader').hide();
                }
            });
        }
    });

    SetDataScanningButton.click(function () {
        var file = $('#set_data_scanning_file')[0].files[0];
        var tableName = setDataScanningTableName.val();
        var groupCode = setDataScanningTableName.find('option:selected').data('group-code');
        var processName = $('#set_data_scanning_process_name').val();
        var priority = $('#set_data_scanning_priority').val();

        if (!file) {
            toastr.warning('Dosya Seçilmedi!');
        } else if (!tableName) {
            toastr.warning('Tablo Seçilmedi!');
        } else if (!groupCode) {
            toastr.warning('Seçili Tablonun Grup Kodu Hatalı!');
        } else if (!processName) {
            toastr.warning('İşlem Adı Girilmedi!');
        } else if (!priority) {
            toastr.warning('Öncelik Değeri Girilmedi');
        } else {
            $('#loader').show();
            $('#SetDataScanningModal').modal('hide');
            var formData = new FormData();
            formData.append('file', file);
            formData.append('tableName', tableName);
            formData.append('groupCode', groupCode);
            formData.append('processName', processName);
            formData.append('priority', priority);
            $.ajax({
                processData: false,
                contentType: false,
                type: 'post',
                url: '{{ route('user.api.operationApi.dataScanning.setDataScanning') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: formData,
                success: function (response) {
                    $('#loader').hide();
                    toastr.success('Data Taramalar Başarıyla Aktarıldı');
                },
                error: function (error) {
                    console.log(error);
                    if (parseInt(error.status) === 422) {
                        var errors = error.responseJSON.response;
                        $.each(errors, function (key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('Data Tarama Listesi Alınırken Serviste Bir Hata Oluştu!');
                    }
                    $('#loader').hide();
                }
            });
        }
    });

    SetCallDataScanningButton.click(function () {
        var file = $('#set_call_data_scanning_file')[0].files[0];
        var surveyId = setCallDataScanningSurveyId.val();

        if (!file) {
            toastr.warning('Dosya Seçilmedi!');
        } else if (!surveyId) {
            toastr.warning('Anket Seçilmedi!');
        } else {
            $('#loader').show();
            $('#SetCallDataScanningModal').modal('hide');
            var formData = new FormData();
            formData.append('file', file);
            formData.append('surveyId', surveyId);
            $.ajax({
                processData: false,
                contentType: false,
                type: 'post',
                url: '{{ route('user.api.operationApi.dataScanning.setCallDataScanning') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: formData,
                success: function (response) {
                    console.log(response);
                    $('#loader').hide();
                    toastr.success('Çağrı Taramalar Başarıyla Aktarıldı');
                },
                error: function (error) {
                    console.log(error);
                    if (parseInt(error.status) === 422) {
                        var errors = error.responseJSON.response;
                        $.each(errors, function (key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('Çağrı Tarama Listesi Alınırken Serviste Bir Hata Oluştu!');
                    }
                    $('#loader').hide();
                }
            });
        }
    });

    SetJobsClosedExcelButton.click(function () {
        var file = $('#set_jobs_closed_excel_file')[0].files[0];
        var commercialCompanyId = setJobsClosedExcelCommercialCompanyId.val();

        if (!file) {
            toastr.warning('Dosya Seçilmedi!');
        } else if (!commercialCompanyId) {
            toastr.warning('Firma Türü Seçilmedi!');
        } else {
            $('#loader').show();
            $('#SetJobsClosedExcelModal').modal('hide');
            var formData = new FormData();
            formData.append('file', file);
            formData.append('commercialCompanyId', commercialCompanyId);
            $.ajax({
                processData: false,
                contentType: false,
                type: 'post',
                url: '{{ route('user.api.operationApi.jobsSystem.setJobsClosedExcel') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: formData,
                success: function (response) {
                    $('#loader').hide();
                    toastr.success('Kapanış İşleri Başarıyla Aktarıldı');
                },
                error: function (error) {
                    console.log(error);
                    if (parseInt(error.status) === 422) {
                        var errors = error.responseJSON.response;
                        $.each(errors, function (key, value) {
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('Kapanış İşleri Alınırken Serviste Bir Hata Oluştu!');
                    }
                    $('#loader').hide();
                }
            });
        }
    });

    SetJobSuspendButton.click(function () {
        $('#loader').show();
        $('#SetJobSuspendModal').modal('hide');
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.operationApi.jobsSystem.setJobSuspend') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function () {
                toastr.success('Askıdaki İşler Başarıyla Aktif Edildi');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                var errors = error.responseJSON.response;
                $.each(errors, function (key, value) {
                    toastr.error(value[0]);
                });
                $('#loader').hide();
            }
        });
    });

    SetJobCaseWorkDeleteButton.click(function () {
        var id = $('#set_job_case_work_delete_id').val();

        if (!id) {
            toastr.warning('Faaliyet ID Girilmedi!');
        } else {
            $('#loader').show();
            $('#SetJobCaseWorkDeleteModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.jobsSystem.setJobCaseWorkDelete') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                },
                success: function () {
                    toastr.success('Faaliyet Başarıyla Silindi');
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    var errors = error.responseJSON.response;
                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                    $('#loader').hide();
                }
            });
        }
    });

</script>
