<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var prCalculateModal = $('#prCalculateModal');
    var prDepartment = $('#prDepartment');
    var prCards = $('#prCards');
    var selectedDepartmentId = $('#selectedDepartmentId');
    var selectedCardId = $('#selectedCardId');
    var calculateTypeInput = $('#calculateType');
    var prSeletedDate = $('#prSeletedDate');
    var CalculateButton = $('#CalculateButton');

    function prCalculateModalShow() {
        prCalculateModal.modal('show');
    }

    function getAllDepartment() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.jobDepartment.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: SelectedCompanies.val(),
                pageIndex: 0,
                pageSize: 1000,
            },
            success: function (response) {
                prDepartment.empty();
                $.each(response.response.jobDepartments, function (i, jobDepartment) {
                    prDepartment.append(`<option value="${jobDepartment.id}">${jobDepartment.name}</option>`);
                });
                selectedDepartmentId.val(response.response.jobDepartments[0].id);
                getPrCardsByJobDepartmentId();
            },
            error: function (error) {
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
    }

    function getPrCardsByJobDepartmentId() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.prCard.getByJobDepartmentId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                jobDepartmentId: prDepartment.val(),
            },
            success: function (response) {
                prCards.empty();
                $.each(response.response, function (i, prCard) {
                    prCards.append(`<option value="${prCard.id}">${prCard.name}</option>`);
                });
                selectedCardId.val(response.response[0].id);
            },
            error: function (error) {
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
    }

    getAllDepartment();

    prDepartment.change(function () {
        if (this.value) {
            // selectedDepartmentId.val(this.value);
            getPrCardsByJobDepartmentId();
        }
    });

    // prCards.change(function () {
    //     if (this.value) {
    //         selectedCardId.val(this.value);
    //     }
    // });



    function prCalculate() {

        /*$.ajax({
            type: 'post',
            url: '{{ route('user.api.prCalculate.calculate') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                prCardId: selectedCardId.val(),
                calculateType: calculateType.val(),
                date: prSeletedDate.val(),
            },
            success: function (response) {

                toastr.success(response.message);
                prCalculateModal.modal('hide');

            },
            error: function (error) {

                console.log(error);
                if (parseInt(error.status) === 422) {
                    $.each(error.responseJSON.response, function (i, error) {
                        toastr.error(error[0]);
                    });
                } else {
                    toastr.error(error.responseJSON.message);
                }
            }
        });*/
    }

    CalculateButton.click(function () {
        var cardId = prCards.val();
        var date = prSeletedDate.val();
        var calculateType = calculateTypeInput.val();

        if (!cardId) {
            toastr.warning('Lütfen kart seçiniz');
        } else if (!date) {
            toastr.warning('Lütfen tarih seçiniz');
        } else if (!calculateType) {
            toastr.warning('Lütfen hesaplama türü seçiniz');
        } else {
            CalculateButton.attr('disabled', 'disabled').html(`<i class="fa fa-spinner fa-spin"></i> Hesaplanıyor...`);
            toastr.info('İşlem Yapılıyor...');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.prCalculate.calculate') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    prCardId: cardId,
                    calculateType: calculateType,
                    date: date,
                },
                success: function (response) {
                    console.log(response);
                    CalculateButton.removeAttr('disabled').html(`Hesapla`);
                    toastr.success(response.message);
                    prCalculateModal.modal('hide');
                },
                error: function (error) {
                    CalculateButton.removeAttr('disabled').html(`Hesapla`);
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
        }
    });


</script>
