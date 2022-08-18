<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    function controlMobile() {
        if (detectMobile()) {
            $('#recruitingEvaluationParametersDrawer').attr('data-kt-drawer-width', '90%');
        } else {
            $('#recruitingEvaluationParametersDrawer').attr('data-kt-drawer-width', '900px');
        }
    }

    controlMobile();

    var recruitingId = parseInt(`{{ $id }}`);

    var wizard = $('#wizard');
    var recruitingEvaluationParametersRow = $('#recruitingEvaluationParametersRow');
    var createRecruitingEvaluationParameterParameter = $('#create_recruiting_evaluation_parameter_parameter');

    var SendSmsButton = $('#SendSmsButton');
    var CreateRecruitingEvaluationParameterButton = $('#CreateRecruitingEvaluationParameterButton');

    function sendSms() {
        $('#send_sms_message').val('');
        $('#SendSmsModal').modal('show');
    }

    function getRecruitingWiard() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.recruiting.wizard') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: recruitingId,
            },
            success: function (response) {
                console.log(response);
                $('#nameSpan').html(response.response.recruiting.name);
                $('#identitySpan').html(`<span class="fw-bolder">TCKN: ${response.response.recruiting.identity}</span>`);
                $('#emailSpan').html(`<span class="fw-bolder">E-posta: ${response.response.recruiting.email}</span>`);
                $('#phoneNumberSpan').html(`<span class="fw-bolder">Telefon: ${response.response.recruiting.phone_number}</span>`);
                wizard.empty();
                $.each(response.response.recruitingSteps, function (i, recruitingStep) {
                    if (parseInt(recruitingStep.recruitingStepId) <= parseInt(response.response.recruiting.step_id)) {
                        var recruitingStepSubSteps = ``;
                        var checkCount = Object.keys(recruitingStep.recruitingStepSubStepChecks).length;
                        var checked = 0;
                        $.each(recruitingStep.recruitingStepSubStepChecks, function (j, recruitingStepSubStepCheck) {
                            recruitingStepSubSteps += `
                            <div class="col-xl-12 mb-5">
                                <i data-id="${recruitingStepSubStepCheck.id}" class="cursor-pointer fa fa-lg fa-check-circle text-${recruitingStepSubStepCheck.check === 1 ? `success` : `secondary`} ${parseInt(recruitingStep.recruitingStepId) === parseInt(response.response.recruiting.step_id) ? `recruitingStepSubStepChecker` : ``}"></i><span class="ms-2">${recruitingStepSubStepCheck.recruiting_step_sub_step.name}</span>
                            </div>
                            `;
                            if (recruitingStepSubStepCheck.check === 1) {
                                checked++;
                            }
                        });

                        var nextStep = parseInt(checked) === parseInt(checkCount) ? 1 : 0;

                        wizard.append(`
                        <div class="col-xl-3 mb-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-9 mt-3">
                                            <h5>
                                            ${parseInt(recruitingStep.recruitingStepId) === parseInt(response.response.recruiting.step_id) ? `
                                            <span class="svg-icon svg-icon-1 svg-icon-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                    <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF"></path>
                                                    <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white"></path>
                                                </svg>
                                            </span>
                                            ` : ``}
                                            ${recruitingStep.recruitingStepName}
                                            </h5>
                                        </div>
                                        <div class="col-xl-3 text-end">
                                            ${parseInt(recruitingStep.recruitingStepId) === parseInt(response.response.recruiting.step_id) && parseInt(recruitingStep.recruitingStepId) !== 8 ? `
                                            <button class="btn btn-sm btn-icon btn-secondary" id="${recruitingStep.recruitingStepId}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-th"></i>
                                            </button>
                                            <ul class="dropdown-menu p-3" aria-labelledby="${recruitingStep.recruitingStepId}_Dropdown">
                                                ${nextStep === 1 ? `
                                                <li><a class="dropdown-item cursor-pointer" id="NextStepButton">Sonraki Aşamaya Geç</a></li>
                                                <hr class="text-muted">
                                                ` : ``}
                                                <li><a class="dropdown-item cursor-pointer" onclick="sendSms()">SMS Gönder</a></li>
                                            </ul>
                                            ` : ``}
                                        </div>
                                    </div>
                                    <hr class="text-muted">
                                    <div class="row pt-3">
                                        ${recruitingStepSubSteps}
                                    </div>
                                </div>
                            </div>
                        </div>
                        `);
                    }
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşe Alım İlerlemesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getRecruitingEvaluationParameters(click = true) {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.recruitingEvaluationParameter.getAllByRecruitingId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                recruitingId: recruitingId,
            },
            success: function (response) {
                recruitingEvaluationParametersRow.empty();
                $.each(response.response, function (i, recruitingEvaluationParameter) {
                    recruitingEvaluationParametersRow.append(`
                    <div class="col-xl-12 mb-1">
                        <div class="input-group input-group-sm mb-5">
                            <button class="btn btn-icon btn-${recruitingEvaluationParameter.check === 1 ? `success` : `warning`} checkRecruitingEvaluationParameterButton" data-id="${recruitingEvaluationParameter.id}">
                                <i class="fa fa-sm fa-check"></i>
                            </button>
                            <input type="text" class="form-control form-control-sm form-control-solid" id="${recruitingEvaluationParameter.id}_recruiting_evaluation_parameter_parameter" value="${recruitingEvaluationParameter.parameter}">
                            <button class="btn btn-icon btn-danger deleteRecruitingEvaluationParameterButton" data-id="${recruitingEvaluationParameter.id}">
                                <i class="fa fa-sm fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    `);
                });
                if (click === true) $('#recruitingEvaluationParametersDrawerButton').click();
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Değerlendirme Parametreleri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    getRecruitingWiard();

    $('#nameSpan').click(function () {
        getRecruitingEvaluationParameters();
    });

    SendSmsButton.click(function () {
        var message = $('#send_sms_message').val();
        if (!message) {
            toastr.warning('Mesaj Boş Olamaz!');
        } else {
            SendSmsButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.recruiting.sendSms') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: recruitingId,
                    message: message,
                },
                success: function () {
                    toastr.success('Mesaj Başarıyla Gönderildi!');
                    $('#SendSmsModal').modal('hide');
                    SendSmsButton.attr('disabled', false).html('Gönder');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Mesaj Gönderilirken Serviste Bir Sorun Oluştu!');
                    SendSmsButton.attr('disabled', false).html('Gönder');
                }
            });
        }
    });

    $(document).delegate('.recruitingStepSubStepChecker', 'click', function () {
        $('#loader').show();
        var id = $(this).attr('data-id');
        $.ajax({
            type: 'put',
            url: '{{ route('user.api.recruitingStepSubStepCheck.updateCheck') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                getRecruitingWiard();
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşlem Yapılırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    });

    $(document).delegate('#NextStepButton', 'click', function () {
        $('#loader').show();
        $.ajax({
            type: 'put',
            url: '{{ route('user.api.recruiting.nextStep') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: recruitingId,
            },
            success: function () {
                getRecruitingWiard();
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşlem Yapılırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    });

    $(document).delegate('.checkRecruitingEvaluationParameterButton', 'click', function () {
        var button = $(this);
        var id = button.attr('data-id');
        button.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'put',
            url: '{{ route('user.api.recruitingEvaluationParameter.check') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                getRecruitingEvaluationParameters(false);
                button.attr('disabled', false).html('<i class="fa fa-check"></i>');
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşlem Yapılırken Serviste Bir Sorun Oluştu!');
                button.attr('disabled', false).html('<i class="fa fa-check"></i>');
            }
        });
    });

    $(document).delegate('.deleteRecruitingEvaluationParameterButton', 'click', function () {
        var button = $(this);
        var id = button.attr('data-id');
        button.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.recruitingEvaluationParameter.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                getRecruitingEvaluationParameters(false);
                button.attr('disabled', false).html('<i class="fa fa-sm fa-trash"></i>');
            },
            error: function (error) {
                console.log(error);
                toastr.error('İşlem Yapılırken Serviste Bir Sorun Oluştu!');
                button.attr('disabled', false).html('<i class="fa fa-sm fa-trash"></i>');
            }
        });
    });

    createRecruitingEvaluationParameterParameter.on('keypress', function (e) {
        if (e.which === 13) {
            CreateRecruitingEvaluationParameterButton.click();
        }
    });

    CreateRecruitingEvaluationParameterButton.click(function () {
        var parameter = createRecruitingEvaluationParameterParameter.val();
        if (!parameter) {
            toastr.warning('Parametre Boş Olamaz!');
        } else {
            CreateRecruitingEvaluationParameterButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.recruitingEvaluationParameter.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    recruitingId: recruitingId,
                    parameter: parameter,
                },
                success: function () {
                    getRecruitingEvaluationParameters(false);
                    createRecruitingEvaluationParameterParameter.val('');
                    CreateRecruitingEvaluationParameterButton.attr('disabled', false).html('<i class="fa fa-sm fa-plus-circle"></i>');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İşlem Yapılırken Serviste Bir Sorun Oluştu!');
                    CreateRecruitingEvaluationParameterButton.attr('disabled', false).html('<i class="fa fa-sm fa-plus-circle"></i>');
                }
            });
        }
    });

</script>
