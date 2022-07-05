<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/locales-all-min.js') }}"></script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var createPermitTypeId = $('#create_permit_type_id');
    var updatePermitTypeId = $('#update_permit_type_id');
    var createOvertimeTypeId = $('#create_overtime_type_id');
    var updateOvertimeTypeId = $('#update_overtime_type_id');
    var createPaymentTypeId = $('#create_payment_type_id');
    var updatePaymentTypeId = $('#update_payment_type_id');

    var CreatePermitButton = $('#CreatePermitButton');
    var UpdatePermitButton = $('#UpdatePermitButton');
    var CreateOvertimeButton = $('#CreateOvertimeButton');
    var UpdateOvertimeButton = $('#UpdateOvertimeButton');
    var CreatePaymentButton = $('#CreatePaymentButton');
    var UpdatePaymentButton = $('#UpdatePaymentButton');

    var EditPermitButton = $('#EditPermitButton');
    var EditOvertimeButton = $('#EditOvertimeButton');
    var EditPaymentButton = $('#EditPaymentButton');

    const element = document.getElementById("calendar");

    var todayDate = moment().startOf("day");
    var YM = todayDate.format("YYYY-MM");
    var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
    var TODAY = todayDate.format("YYYY-MM-DD");
    var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");

    var calendarEl = document.getElementById("calendar");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'tr',
        themeSystem: 'bootstrap5',
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        },

        nowIndicator: true,
        now: TODAY + "T{{ date('H:i:s') }}",

        initialView: "dayGridMonth",
        initialDate: TODAY,

        editable: false,
        dayMaxEvents: true,
        navLinks: true,

        dateClick: function (info) {

        },

        eventClick: function (info) {
            var type = info.event._def.extendedProps.type;
            var id = info.event._def.extendedProps._id;

            $('.fc-popover-close').click();

            if (type === 'shift') {
                $('#loader').show();
                $.ajax({
                    type: 'get',
                    url: '{{ route('employee.api.shift.getById') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        id: id
                    },
                    success: function (response) {
                        $('#show_shift_shift_group_name_span').html(response.response.shift_group ? response.response.shift_group.name : '--');
                        $('#show_shift_start_date_span').html(reformatDatetimeToDatetimeForHuman(response.response.start_date));
                        $('#show_shift_end_date_span').html(reformatDatetimeToDatetimeForHuman(response.response.end_date));
                        $('#ShowShiftModal').modal('show');
                        $('#loader').hide();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Vardiya Detayları Alınırken Serviste Bir Sorun Oluştu!');
                        $('#loader').hide();
                    }
                });
            } else if (type === 'permit') {
                $('#loader').show();
                $.ajax({
                    type: 'get',
                    url: '{{ route('employee.api.permit.getById') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        id: id
                    },
                    success: function (response) {
                        $('#update_permit_id').val(response.response.id);
                        updatePermitTypeId.val(response.response.type_id);
                        $('#update_permit_start_date').val(reformatDateForCalendar(response.response.start_date));
                        $('#update_permit_end_date').val(reformatDateForCalendar(response.response.end_date));
                        $('#update_permit_description').val(response.response.description);
                        $('#show_permit_type_name_span').html(response.response.type ? response.response.type.name : '--');
                        $('#show_permit_status_badge_span').html(response.response.status ? response.response.status.name : '--').removeClass().addClass(`badge badge-${response.response.status ? response.response.status.color : 'secondary'}`);
                        $('#show_permit_start_date_span').html(reformatDatetimeToDatetimeForHuman(response.response.start_date));
                        $('#show_permit_end_date_span').html(reformatDatetimeToDatetimeForHuman(response.response.end_date));
                        $('#show_permit_description_input').val(response.response.description);
                        parseInt(response.response.status_id) === 1 ? EditPermitButton.show() : EditPermitButton.hide();
                        $('#ShowPermitModal').modal('show');
                        $('#loader').hide();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('İzin Detayları Alınırken Serviste Bir Sorun Oluştu!');
                        $('#loader').hide();
                    }
                });
            } else if (type === 'overtime') {
                $('#loader').show();
                $.ajax({
                    type: 'get',
                    url: '{{ route('employee.api.overtime.getById') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        id: id
                    },
                    success: function (response) {
                        $('#update_overtime_id').val(response.response.id);
                        updateOvertimeTypeId.val(response.response.type_id);
                        $('#update_overtime_start_date').val(reformatDateForCalendar(response.response.start_date));
                        $('#update_overtime_end_date').val(reformatDateForCalendar(response.response.end_date));
                        $('#update_overtime_description').val(response.response.description);
                        $('#show_overtime_type_name_span').html(response.response.type ? response.response.type.name : '--');
                        $('#show_overtime_status_badge_span').html(response.response.status ? response.response.status.name : '--').removeClass().addClass(`badge badge-${response.response.status ? response.response.status.color : 'secondary'}`);
                        $('#show_overtime_start_date_span').html(reformatDatetimeToDatetimeForHuman(response.response.start_date));
                        $('#show_overtime_end_date_span').html(reformatDatetimeToDatetimeForHuman(response.response.end_date));
                        $('#show_overtime_description_input').val(response.response.description);
                        parseInt(response.response.status_id) === 1 ? EditOvertimeButton.show() : EditOvertimeButton.hide();
                        $('#ShowOvertimeModal').modal('show');
                        $('#loader').hide();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Fazla Mesai Detayları Alınırken Serviste Bir Sorun Oluştu!');
                        $('#loader').hide();
                    }
                });
            } else if (type === 'payment') {
                $('#loader').show();
                $.ajax({
                    type: 'get',
                    url: '{{ route('employee.api.payment.getById') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        id: id
                    },
                    success: function (response) {
                        $('#update_payment_id').val(response.response.id);
                        updatePaymentTypeId.val(response.response.type_id);
                        $('#update_payment_date').val(response.response.date);
                        $('#update_payment_amount').val(response.response.amount);
                        $('#update_payment_description').val(response.response.description);
                        $('#show_payment_type_name_span').html(response.response.type ? response.response.type.name : '--');
                        $('#show_payment_status_badge_span').html(response.response.status ? response.response.status.name : '--').removeClass().addClass(`badge badge-${response.response.status ? response.response.status.color : 'secondary'}`);
                        $('#show_payment_date_span').html(reformatDatetimeToDateForHuman(response.response.date));
                        $('#show_payment_amount_span').html(`${response.response.amount} ₺`);
                        $('#show_payment_description_input').val(response.response.description);
                        parseInt(response.response.status_id) === 1 ? EditPaymentButton.show() : EditPaymentButton.hide();
                        $('#ShowPaymentModal').modal('show');
                        $('#loader').hide();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Ödeme Detayları Alınırken Serviste Bir Sorun Oluştu!');
                        $('#loader').hide();
                    }
                });
            } else if (type === 'foodListCheck') {
                $('#ShowFoodListCheckModal').modal('show');
            } else {
                console.log(info.event._def);
            }
        },

        datesSet: function (info) {
            getShifts();
            getPermits();
            getOvertimes();
            getPayments();
            getFoodListChecks();
        },

        events: [],
    });

    calendar.render();

    function getPermitTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.permitType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createPermitTypeId.empty();
                updatePermitTypeId.empty();
                $.each(response.response, function (i, permitType) {
                    createPermitTypeId.append(`<option value="${permitType.id}">${permitType.name}</option>`);
                    updatePermitTypeId.append(`<option value="${permitType.id}">${permitType.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('İzin Türleri Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    function getOvertimeTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.overtimeType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createOvertimeTypeId.empty();
                updateOvertimeTypeId.empty();
                $.each(response.response, function (i, overtimeType) {
                    createOvertimeTypeId.append(`<option value="${overtimeType.id}">${overtimeType.name}</option>`);
                    updateOvertimeTypeId.append(`<option value="${overtimeType.id}">${overtimeType.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Fazla Mesai Türleri Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    function getPaymentTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.paymentType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createPaymentTypeId.empty();
                updatePaymentTypeId.empty();
                $.each(response.response, function (i, paymentType) {
                    createPaymentTypeId.append(`<option value="${paymentType.id}">${paymentType.name}</option>`);
                    updatePaymentTypeId.append(`<option value="${paymentType.id}">${paymentType.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ödeme Türleri Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    function getShifts() {
        var startDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.start);
        var endDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.end);

        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.shift.getDateBetweenByEmployeeId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                startDate: startDate,
                endDate: endDate,
            },
            success: function (response) {
                $.each(calendar.getEvents(), function (i, event) {
                    if (event._def.extendedProps.type === 'shift') {
                        event.remove();
                    }
                });
                calendar.addEventSource({
                    events: $.map(response.response, function (shift) {
                        return {
                            _id: shift.id,
                            id: shift.id,
                            title: `Vardiya`,
                            start: reformatDateForCalendar(shift.start_date),
                            end: reformatDateForCalendar(shift.end_date),
                            type: 'shift',
                            classNames: `bg-primary text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            shift_id: `${shift.id}`
                        };
                    }),
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Vardiya Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getPermits() {
        var startDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.start);
        var endDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.end);

        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.permit.getDateBetween') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                startDate: startDate,
                endDate: endDate,
            },
            success: function (response) {
                $.each(calendar.getEvents(), function (i, event) {
                    if (event._def.extendedProps.type === 'permit') {
                        event.remove();
                    }
                });
                calendar.addEventSource({
                    events: $.map(response.response, function (permit) {
                        return {
                            _id: permit.id,
                            id: permit.id,
                            title: `İzin`,
                            start: reformatDateForCalendar(permit.start_date),
                            end: reformatDateForCalendar(permit.end_date),
                            type: 'permit',
                            classNames: `bg-${permit.status.color} text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            permit_id: `${permit.id}`
                        };
                    }),
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('İzin Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getOvertimes() {
        var startDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.start);
        var endDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.end);

        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.overtime.getDateBetween') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                startDate: startDate,
                endDate: endDate,
            },
            success: function (response) {
                $.each(calendar.getEvents(), function (i, event) {
                    if (event._def.extendedProps.type === 'overtime') {
                        event.remove();
                    }
                });
                calendar.addEventSource({
                    events: $.map(response.response, function (overtime) {
                        return {
                            _id: overtime.id,
                            id: overtime.id,
                            title: `Mesai`,
                            start: reformatDateForCalendar(overtime.start_date),
                            end: reformatDateForCalendar(overtime.end_date),
                            type: 'overtime',
                            classNames: `bg-${overtime.status.color} text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            overtime_id: `${overtime.id}`
                        };
                    }),
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Fazla Mesai Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getPayments() {
        var startDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.start);
        var endDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.end);

        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.payment.getDateBetween') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                startDate: startDate,
                endDate: endDate,
            },
            success: function (response) {
                $.each(calendar.getEvents(), function (i, event) {
                    if (event._def.extendedProps.type === 'payment') {
                        event.remove();
                    }
                });
                calendar.addEventSource({
                    events: $.map(response.response, function (payment) {
                        return {
                            _id: payment.id,
                            id: payment.id,
                            title: `Ödeme`,
                            start: reformatDateForCalendar(payment.date),
                            end: reformatDateForCalendar(payment.date),
                            type: 'payment',
                            classNames: `bg-${payment.status.color} text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            payment_id: `${payment.id}`
                        };
                    }),
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ödeme Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getFoodListChecks() {
        var startDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.start);
        var endDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.end);

        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.foodListCheck.getDateBetween') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                startDate: startDate,
                endDate: endDate,
            },
            success: function (response) {
                $.each(calendar.getEvents(), function (i, event) {
                    if (event._def.extendedProps.type === 'foodListCheck') {
                        event.remove();
                    }
                });
                calendar.addEventSource({
                    events: $.map(response.response, function (foodListCheck) {
                        return {
                            _id: foodListCheck.id,
                            id: foodListCheck.id,
                            title: `${foodListCheck.food_list.name}`,
                            start: reformatDateForCalendar(foodListCheck.food_list.date),
                            end: reformatDateForCalendar(foodListCheck.food_list.date),
                            type: 'foodListCheck',
                            classNames: `bg-${foodListCheck.checked == null ? 'warning' : (foodListCheck.checked === 1 ? 'success' : 'danger')} text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            food_list_check_id: `${foodListCheck.id}`
                        };
                    }),
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Yemek Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getPermits();
    getOvertimes();
    getPayments();
    getFoodListChecks();
    getPermitTypes();
    getOvertimeTypes();
    getPaymentTypes();

    function createPermit() {
        createPermitTypeId.val('');
        $('#create_permit_start_date').val('');
        $('#create_permit_end_date').val('');
        $('#create_permit_description').val('');
        $('#CreatePermitModal').modal('show');
    }

    function updatePermit() {
        $('#ShowPermitModal').modal('hide');
        $('#UpdatePermitModal').modal('show');
    }

    function createOvertime() {
        createOvertimeTypeId.val('');
        $('#create_overtime_start_date').val('');
        $('#create_overtime_end_date').val('');
        $('#create_overtime_description').val('');
        $('#CreateOvertimeModal').modal('show');
    }

    function updateOvertime() {
        $('#ShowOvertimeModal').modal('hide');
        $('#UpdateOvertimeModal').modal('show');
    }

    function createPayment() {
        createPaymentTypeId.val('');
        $('#create_payment_date').val('');
        $('#create_payment_amount').val('');
        $('#create_payment_description').val('');
        $('#CreatePaymentModal').modal('show');
    }

    function updatePayment() {
        $('#ShowPaymentModal').modal('hide');
        $('#UpdatePaymentModal').modal('show');
    }

    CreatePermitButton.click(function () {
        var typeId = createPermitTypeId.val();
        var startDate = $('#create_permit_start_date').val();
        var endDate = $('#create_permit_end_date').val();
        var description = $('#create_permit_description').val();

        if (!typeId) {
            toastr.warning('İzin Türü Seçimi Zorunludur.');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçimi Zorunludur.');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçimi Zorunludur.');
        } else if (!description) {
            toastr.warning('Açıklama Zorunludur.');
        } else {
            $('#loader').show();
            $('#CreatePermitModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('employee.api.permit.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    typeId: typeId,
                    startDate: startDate,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    toastr.success('İzin Talebiniz Başarıyla Oluşturuldu.');
                    getPermits();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İzin Talebi Oluşturulurken Serviste Bir Sorun Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdatePermitButton.click(function () {
        var id = $('#update_permit_id').val();
        var typeId = updatePermitTypeId.val();
        var startDate = $('#update_permit_start_date').val();
        var endDate = $('#update_permit_end_date').val();
        var description = $('#update_permit_description').val();

        if (!typeId) {
            toastr.warning('İzin Türü Seçimi Zorunludur.');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçimi Zorunludur.');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçimi Zorunludur.');
        } else if (!description) {
            toastr.warning('Açıklama Zorunludur.');
        } else {
            $('#loader').show();
            $('#UpdatePermitModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('employee.api.permit.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    typeId: typeId,
                    startDate: startDate,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    toastr.success('İzin Talebiniz Başarıyla Güncellendi.');
                    getPermits();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İzin Talebi Güncellenirken Serviste Bir Sorun Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    CreateOvertimeButton.click(function () {
        var typeId = createOvertimeTypeId.val();
        var startDate = $('#create_overtime_start_date').val();
        var endDate = $('#create_overtime_end_date').val();
        var description = $('#create_overtime_description').val();

        if (!typeId) {
            toastr.warning('Fazla Mesai Türü Seçimi Zorunludur.');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçimi Zorunludur.');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçimi Zorunludur.');
        } else if (!description) {
            toastr.warning('Açıklama Zorunludur.');
        } else {
            $('#loader').show();
            $('#CreateOvertimeModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('employee.api.overtime.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    typeId: typeId,
                    startDate: startDate,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    toastr.success('Fazla Mesai Talebiniz Başarıyla Oluşturuldu.');
                    getOvertimes();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Fazla Mesai Talebi Oluşturulurken Serviste Bir Sorun Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateOvertimeButton.click(function () {
        var id = $('#update_overtime_id').val();
        var typeId = updateOvertimeTypeId.val();
        var startDate = $('#update_overtime_start_date').val();
        var endDate = $('#update_overtime_end_date').val();
        var description = $('#update_overtime_description').val();

        if (!typeId) {
            toastr.warning('Fazla Mesai Türü Seçimi Zorunludur.');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçimi Zorunludur.');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçimi Zorunludur.');
        } else if (!description) {
            toastr.warning('Açıklama Zorunludur.');
        } else {
            $('#loader').show();
            $('#UpdateOvertimeModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('employee.api.overtime.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    typeId: typeId,
                    startDate: startDate,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    toastr.success('Fazla Mesai Talebiniz Başarıyla Güncellendi.');
                    getOvertimes();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Fazla Mesai Talebi Güncellenirken Serviste Bir Sorun Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    CreatePaymentButton.click(function () {
        var typeId = createPaymentTypeId.val();
        var date = $('#create_payment_date').val();
        var amount = $('#create_payment_amount').val();
        var description = $('#create_payment_description').val();

        if (!typeId) {
            toastr.warning('Ödeme Türü Seçimi Zorunludur.');
        } else if (!date) {
            toastr.warning('Tarih Seçimi Zorunludur.');
        } else if (!amount) {
            toastr.warning('İstenilen Miktar Boş Olamaz.');
        } else if (!description) {
            toastr.warning('Açıklama Zorunludur.');
        } else {
            $('#loader').show();
            $('#CreatePaymentModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('employee.api.payment.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    typeId: typeId,
                    date: date,
                    amount: amount,
                    description: description,
                },
                success: function () {
                    toastr.success('Ödeme Talebiniz Başarıyla Oluşturuldu.');
                    getPayments();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Ödeme Talebi Oluşturulurken Serviste Bir Sorun Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdatePaymentButton.click(function () {
        var id = $('#update_payment_id').val();
        var typeId = updatePaymentTypeId.val();
        var date = $('#update_payment_date').val();
        var amount = $('#update_payment_amount').val();
        var description = $('#update_payment_description').val();

        if (!typeId) {
            toastr.warning('Ödeme Türü Seçimi Zorunludur.');
        } else if (!date) {
            toastr.warning('Tarih Seçimi Zorunludur.');
        } else if (!amount) {
            toastr.warning('İstenilen Miktar Boş Olamaz.');
        } else if (!description) {
            toastr.warning('Açıklama Zorunludur.');
        } else {
            $('#loader').show();
            $('#UpdatePaymentModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('employee.api.payment.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    typeId: typeId,
                    date: date,
                    amount: amount,
                    description: description,
                },
                success: function () {
                    toastr.success('Ödeme Talebiniz Başarıyla Güncellendi.');
                    getPayments();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Ödeme Talebi Güncellenirken Serviste Bir Sorun Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    EditPermitButton.click(function () {
        updatePermit();
    });

    EditOvertimeButton.click(function () {
        updateOvertime();
    });

    EditPaymentButton.click(function () {
        updatePayment();
    });

</script>
