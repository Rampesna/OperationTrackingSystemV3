<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var setDataScanningTableName = $('#set_data_scanning_table_name');
    var setCallDataScanningSurveyId = $('#set_call_data_scanning_survey_id');

    function setJobsExcel() {
        $('#SetJobsExcelModal').modal('show');
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
                setDataScanningTableName.empty();
                $.each(response.response, function (i, table) {
                    setDataScanningTableName.append($('<option>', {
                        value: table.tabloAdi,
                        text: table.aciklama
                    }));
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
                console.log(response);
                setCallDataScanningSurveyId.empty();
                $.each(response.response, function (i, survey) {
                    setCallDataScanningSurveyId.append($('<option>', {
                        value: survey.id,
                        text: survey.adi
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
        $('#SetJobsClosedExcelModal').modal('show');
    }

    function setJobSuspend() {
        $('#SetJobSuspendModal').modal('show');
    }

    function setJobCaseWorkDelete() {
        $('#SetJobCaseWorkDeleteModal').modal('show');
    }

</script>
