<script>

    new Tagify(document.querySelector("#send_batch_sms_to_numbers_numbers"), { pattern: /^(([5-5]{1})(\d{2})(\d{3})(\d{2})(\d{2}))$/ });
    // new Tagify(document.querySelector("#send_batch_sms_to_numbers_numbers"), { pattern: /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/ });

    $(document).ready(function () {
        $('#loader').hide();
    });

    var SelectAllEmployeesButton = $('#SelectAllEmployeesButton');
    var UnSelectAllEmployeesButton = $('#UnSelectAllEmployeesButton');

    var sendBatchSmsToEmployeesEmployeeIds = $('#send_batch_sms_to_employees_employee_ids');

    var SendBatchSmsToEmployeesButton = $('#SendBatchSmsToEmployeesButton');
    var SendBatchSmsToNumbersButton = $('#SendBatchSmsToNumbersButton');

    function getEmployeesByCompanyIds() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: SelectedCompanies.val(),
                pageIndex: 0,
                pageSize: 1000,
                leave: 0,
            },
            success: function (response) {
                sendBatchSmsToEmployeesEmployeeIds.empty();
                $.each(response.response.employees, function (i, employee) {
                    sendBatchSmsToEmployeesEmployeeIds.append(`<option value="${employee.id}">${employee.name}</option>`);
                });
                sendBatchSmsToEmployeesEmployeeIds.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personel Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getEmployeesByCompanyIds();

    SelectedCompanies.change(function () {
        getEmployeesByCompanyIds();
    });

    SelectAllEmployeesButton.click(function () {
        sendBatchSmsToEmployeesEmployeeIds.selectpicker('selectAll');
    });

    UnSelectAllEmployeesButton.click(function () {
        sendBatchSmsToEmployeesEmployeeIds.selectpicker('deselectAll');
    });

    SendBatchSmsToEmployeesButton.click(function () {
        var employeeIds = sendBatchSmsToEmployeesEmployeeIds.val();
        var message = $('#send_batch_sms_to_employees_message').val();

        if (employeeIds.length === 0) {
            toastr.warning('Lütfen Personel Seçiniz!');
        } else if (!message) {
            toastr.warning('Lütfen Mesaj Giriniz!');
        } else {
            SendBatchSmsToEmployeesButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.batchSms.sendToEmployees') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    employeeIds: employeeIds,
                    message: message,
                },
                success: function () {
                    sendBatchSmsToEmployeesEmployeeIds.selectpicker('deselectAll');
                    $('#send_batch_sms_to_employees_message').val('');
                    toastr.success('Mesaj Başarıyla Gönderildi!');
                    SendBatchSmsToEmployeesButton.attr('disabled', false).html('SMS Gönder');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Mesaj Gönderilirken Serviste Bir Sorun Oluştu!');
                    SendBatchSmsToEmployeesButton.attr('disabled', false).html('SMS Gönder');
                }
            });
        }
    });

    SendBatchSmsToNumbersButton.click(function () {
        var numbersString = $('#send_batch_sms_to_numbers_numbers').val();
        var numbers = [];
        var message = $('#send_batch_sms_to_numbers_message').val();

        if (numbersString) {
            var numbersArray = JSON.parse(numbersString);
            $.each(numbersArray, function (i, number) {
                numbers.push(number.value);
            });
        }

        if (numbers.length === 0) {
            toastr.warning('Hiç Telefon Numarası Girilmedi!');
        } else if (!message) {
            toastr.warning('Lütfen Mesaj Giriniz!');
        } else {
            SendBatchSmsToNumbersButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.batchSms.sendToNumbers') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    numbers: numbers,
                    message: message,
                },
                success: function () {
                    $('#send_batch_sms_to_numbers_numbers').val('');
                    $('#send_batch_sms_to_numbers_message').val('');
                    toastr.success('Mesaj Başarıyla Gönderildi!');
                    SendBatchSmsToNumbersButton.attr('disabled', false).html('SMS Gönder');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Mesaj Gönderilirken Serviste Bir Sorun Oluştu!');
                    SendBatchSmsToNumbersButton.attr('disabled', false).html('SMS Gönder');
                }
            });
        }
    });

</script>
