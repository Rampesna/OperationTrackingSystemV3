<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/locales-all-min.js') }}"></script>

<script>

    function controlMobile() {
        if (detectMobile()) {
            $('#updateAcademyEducationPlanDrawer').attr('data-kt-drawer-width', '90%');
        } else {
            $('#updateAcademyEducationPlanDrawer').attr('data-kt-drawer-width', '900px');
        }
    }

    controlMobile();

    var academyEducationLessonsRow = $('#academyEducationLessonsRow');
    var academyEducationPlanParticipantsRow = $('#academyEducationPlanParticipantsRow');

    var createAcademyEducationPlanAcademyEducationId = $('#create_academy_education_plan_academy_education_id');
    var updateAcademyEducationPlanEmployeeIds = $('#update_academy_education_plan_employee_ids');

    var updateAcademyEducationPlanDrawerButton = $('#updateAcademyEducationPlanDrawerButton');
    var CreateAcademyEducationPlanButton = $('#CreateAcademyEducationPlanButton');
    var UpdateAcademyEducationPlanButton = $('#UpdateAcademyEducationPlanButton');
    var DeleteAcademyEducationPlanModalButton = $('#DeleteAcademyEducationPlanModalButton');
    var DeleteAcademyEducationPlanButton = $('#DeleteAcademyEducationPlanButton');
    var ParticipantsAcademyEducationPlanButton = $('#ParticipantsAcademyEducationPlanButton');

    function getAcademyEducations() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.academyEducation.getByCompanyIds') }}',
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
                createAcademyEducationPlanAcademyEducationId.empty();
                $.each(response.response.academyEducations, function (i, academyEducation) {
                    createAcademyEducationPlanAcademyEducationId.append(`
                        <option value="${academyEducation.id}">${academyEducation.name}</option>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Akademi Eğitimleri Alınırken Serviste Bir Sorun Oluştu! Lütfen Geliştiri Ekibi İle İletişime Geçin!');
            }
        });
    }

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
                leave: 0
            },
            success: function (response) {
                updateAcademyEducationPlanEmployeeIds.empty();
                $.each(response.response.employees, function (i, employee) {
                    updateAcademyEducationPlanEmployeeIds.append(`
                        <option value="${employee.id}">${employee.name}</option>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Personeller Alınırken Serviste Bir Sorun Oluştu! Lütfen Geliştiri Ekibi İle İletişime Geçin!');
            }
        });
    }

    function getAcademyEducationPlanParticipants() {
        var academyEducationPlanId = $('#update_academy_education_plan_id').val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.academyEducationPlanParticipant.getByAcademyEducationPlanId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                academyEducationPlanId: academyEducationPlanId,
            },
            success: function (response) {
                academyEducationPlanParticipantsRow.empty();
                $.each(response.response, function (i, academyEducationPlanParticipant) {
                    academyEducationPlanParticipantsRow.append(`
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="input-group mb-5">
                                <button class="btn btn-sm btn-icon btn-${parseInt(academyEducationPlanParticipant.attendance) === 1 ? `success` : `warning`} setAttendanceButton" data-id="${academyEducationPlanParticipant.id}" data-attendance="${academyEducationPlanParticipant.attendance}">
                                    <i class="fa fa-check-circle"></i>
                                </button>
                                <input type="text" class="form-control form-control-sm form-control-solid" value="${academyEducationPlanParticipant.employee ? academyEducationPlanParticipant.employee.name : ``}" aria-label="${academyEducationPlanParticipant.employee ? academyEducationPlanParticipant.employee.name : ``}" readonly />
                            </div>
                        </div>
                    </div>
                    `);
                });
                $('#AcademyEducationPlanParticipantsModal').modal('show');
            },
            error: function () {

            }
        });
    }

    getAcademyEducations();
    getEmployeesByCompanyIds();

    function transactions() {
        $('#TransactionsModal').modal('show');
    }

    function academyEducation() {
        $('#TransactionsModal').modal('hide');
        window.open(`{{ route('user.web.academy.education') }}`, '_blank');
    }

    function createAcademyEducationPlan() {
        $('#TransactionsModal').modal('hide');
        createAcademyEducationPlanAcademyEducationId.val('');
        academyEducationLessonsRow.empty();
        CreateAcademyEducationPlanButton.attr('disabled', true);
        $('#CreateAcademyEducationPlanModal').modal('show');
    }

    function deleteAcademyEducationPlan() {
        $('#DeleteAcademyEducationPlanModal').modal('show');
    }

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
            $('#loader').show();
            $('.fc-popover-close').click();
            var id = info.event._def.extendedProps._id;
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.academyEducationPlan.getById') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                },
                success: function (response) {
                    $('#update_academy_education_plan_id').val(response.response.id);
                    $('#updateAcademyEducationPlanLessonNameSpan').html(response.response.academy_education_lesson.name);
                    $('#update_academy_education_plan_start_datetime').val(reformatDatetimeForInput(response.response.start_datetime));
                    $('#update_academy_education_plan_educationist').val(response.response.educationist);
                    $('#update_academy_education_plan_academy_education_plan_type_id').val(response.response.academy_education_plan_type_id).trigger('change');
                    $('#update_academy_education_plan_location').val(response.response.location);
                    updateAcademyEducationPlanDrawerButton.trigger('click');
                    $('#loader').hide();

                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Eğitim Planı Verileri Alınırken Serviste Bir Sorun Oluştu! Lütfen Geliştiri Ekibi İle İletişime Geçin!');
                    $('#loader').hide();
                }
            });
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.academyEducationPlanParticipant.getByAcademyEducationPlanId') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    academyEducationPlanId: id,
                },
                success: function (response) {
                    updateAcademyEducationPlanEmployeeIds.val(
                        $.map(response.response, function (academyEducationPlanParticipant) {
                            return parseInt(academyEducationPlanParticipant.employee_id);
                        })
                    ).trigger('change');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Eğitim Planı Verileri Alınırken Serviste Bir Sorun Oluştu! Lütfen Geliştiri Ekibi İle İletişime Geçin!');
                    $('#loader').hide();
                }
            });
        },

        events: function (info, successCallback) {
            $('#loader').show();
            var companyIds = SelectedCompanies.val();
            $.ajax({
                url: '{{ route('user.api.academyEducationPlan.getDateBetweenByCompanyIds') }}',
                dataType: 'json',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    startDate: info.startStr.valueOf(),
                    endDate: info.endStr.valueOf(),
                    companyIds: companyIds,
                },
                success: function (response) {
                    var events = [];
                    $.each(response.response, function (i, academyEducationPlan) {
                        events.push({
                            _id: academyEducationPlan.id,
                            id: academyEducationPlan.id,
                            title: `${academyEducationPlan.academy_education_lesson ? academyEducationPlan.academy_education_lesson.name : ''}`,
                            start: reformatDateForCalendar(academyEducationPlan.start_datetime),
                            end: reformatDateForCalendar(academyEducationPlan.start_datetime),
                            type: 'academyEducationPlan',
                            classNames: 'bg-primary text-white cursor-pointer ms-1 me-1',
                            backgroundColor: 'white',
                            academy_education_plan_id: `${academyEducationPlan.id}`
                        });
                    });
                    successCallback(events);
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Eğitim Planları Alınırken Serviste Bir sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        },
    });

    calendar.render();

    createAcademyEducationPlanAcademyEducationId.change(function () {
        var academyEducationId = $(this).val();
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.academyEducationLesson.getByAcademyEducationId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                academyEducationId: academyEducationId,
            },
            success: function (response) {
                academyEducationLessonsRow.empty();
                $.each(response.response, function (i, academyEducationLesson) {
                    academyEducationLessonsRow.append(`
                    <div class="row academyEducationLessonCreating" data-id="${academyEducationLesson.id}">
                        <div class="col-xl-12 mb-3">
                            <div class="form-check form-check-success form-check-solid">
                                <input class="form-check-input" checked="checked" type="checkbox" id="is_active_${academyEducationLesson.id}" />
                                <label class="form-check-label fw-bolder" for="is_active_${academyEducationLesson.id}">
                                    ${academyEducationLesson.name}
                                </label>
                            </div>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <div class="row">
                                <div class="col-xl-5 mb-3">
                                    <select class="form-select" data-live-search="true" title="Eğitim Türü" id="type_id_${academyEducationLesson.id}">
                                        <option value="1">Yüzyüze</option>
                                        <option value="2">Online</option>
                                    </select>
                                </div>
                                <div class="col-xl-7 mb-3">
                                    <input type="datetime-local" class="form-control" placeholder="Ders Zamanı" id="start_datetime_${academyEducationLesson.id}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 mb-3">
                            <label style="width: 100%">
                                <input type="text" class="form-control" placeholder="Eğitmen" id="educationist_${academyEducationLesson.id}">
                            </label>
                        </div>
                        <div class="col-xl-5 mb-3">
                            <label style="width: 100%">
                                <input type="text" class="form-control" placeholder="Eğitim Adresi" id="location_${academyEducationLesson.id}">
                            </label>
                        </div>
                    </div>
                    <hr class="text-muted">
                    `);
                });
                $('#loader').hide();
                CreateAcademyEducationPlanButton.prop('disabled', false);
            },
            error: function (error) {
                console.log(error);
                $('#loader').hide();
                toastr.error('Eğitim Dersleri Alınırken Serviste Bir Sorun Oluştu! Lütfen Geliştiri Ekibi İle İletişime Geçin!');
            }
        });
    });

    CreateAcademyEducationPlanButton.click(function () {
        var academyEducationPlans = [];
        var academyEducationLessonCreating = $('.academyEducationLessonCreating');
        var checking = true;
        $.each(academyEducationLessonCreating, function () {
            var id = $(this).data('id');
            if ($(`#is_active_${id}`).is(':checked')) {
                var academyEducationLessonId = id;
                var academyEducationPlanTypeId = $(`#type_id_${id}`).val();
                var startDatetime = $(`#start_datetime_${id}`).val();
                var educationist = $(`#educationist_${id}`).val();
                var location = $(`#location_${id}`).val();

                if (!academyEducationPlanTypeId) {
                    toastr.warning('Seçili Derslerde Eğitim Türü Boş Alan Var!');
                    checking = false;
                    return false;
                } else if (!startDatetime) {
                    toastr.warning('Seçili Derslerde Ders Zamanı Boş Alan Var!');
                    checking = false;
                    return false;
                } else if (!educationist) {
                    toastr.warning('Seçili Derslerde Eğitmen Adı Boş Alan Var!');
                    checking = false;
                    return false;
                } else if (!location) {
                    toastr.warning('Seçili Derslerde Eğitim Adresi Boş Alan Var!');
                    checking = false;
                    return false;
                } else {
                    academyEducationPlans.push({
                        academyEducationLessonId: academyEducationLessonId,
                        academyEducationPlanTypeId: academyEducationPlanTypeId,
                        startDatetime: startDatetime,
                        educationist: educationist,
                        location: location
                    });
                }
            }
        });
        if (checking) {
            CreateAcademyEducationPlanButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.academyEducationPlan.createBatch') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    academyEducationPlans: academyEducationPlans,
                },
                success: function () {
                    $('#CreateAcademyEducationPlanModal').modal('hide');
                    CreateAcademyEducationPlanButton.prop('disabled', false).html('Oluştur');
                    toastr.success('Eğitim Planları Başarıyla Oluşturuldu!');
                    calendar.refetchEvents();
                },
                error: function (error) {
                    console.log(error);
                    CreateAcademyEducationPlanButton.prop('disabled', false).html('Oluştur');
                }
            });
        }
    });

    UpdateAcademyEducationPlanButton.click(function () {
        var id = $('#update_academy_education_plan_id').val();
        var startDatetime = $('#update_academy_education_plan_start_datetime').val();
        var educationist = $('#update_academy_education_plan_educationist').val();
        var academyEducationPlanTypeId = $('#update_academy_education_plan_academy_education_plan_type_id').val();
        var location = $('#update_academy_education_plan_location').val();

        if (!startDatetime) {
            toastr.warning('Eğitim Başlangıcı Boş Olamaz!');
        } else if (!educationist) {
            toastr.warning('Eğitmen Boş Olamaz!');
        } else if (!academyEducationPlanTypeId) {
            toastr.warning('Eğitim Türü Boş Olamaz!');
        } else if (!location) {
            toastr.warning('Eğitim Adresi Boş Olamaz!');
        } else {
            UpdateAcademyEducationPlanButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.academyEducationPlan.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    startDatetime: startDatetime,
                    educationist: educationist,
                    academyEducationPlanTypeId: academyEducationPlanTypeId,
                    location: location,
                },
                success: function () {
                    UpdateAcademyEducationPlanButton.prop('disabled', false).html('Güncelle');
                    toastr.success('Eğitim Planı Başarıyla Güncellendi!');
                    calendar.refetchEvents();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Eğitim Planı Güncellenirken Serviste Bir Sorun Oluştu! Lütfen Geliştiri Ekibi İle İletişime Geçin!');
                    UpdateAcademyEducationPlanButton.prop('disabled', false).html('Güncelle');
                }
            });
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.academyEducationPlanParticipant.syncAcademyEducationPlanParticipants') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    academyEducationPlanId: id,
                    employeeIds: updateAcademyEducationPlanEmployeeIds.val() ?? []
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Katılımcı Listesi Güncellenirken Serviste Bir Sorun Oluştu! Lütfen Geliştiri Ekibi İle İletişime Geçin!');
                }
            });
        }
    });

    DeleteAcademyEducationPlanModalButton.click(function () {
        deleteAcademyEducationPlan();
    });

    DeleteAcademyEducationPlanButton.click(function () {
        var id = $('#update_academy_education_plan_id').val();
        DeleteAcademyEducationPlanButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.academyEducationPlan.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Eğitim Planı Başarıyla Silindi!');
                DeleteAcademyEducationPlanButton.prop('disabled', false).html('Sil');
                updateAcademyEducationPlanDrawerButton.trigger('click');
                $('#DeleteAcademyEducationPlanModal').modal('hide');
                calendar.refetchEvents();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Eğitim Planı Silinirken Serviste Bir Sorun Oluştu! Lütfen Geliştiri Ekibi İle İletişime Geçin!');
                DeleteAcademyEducationPlanButton.prop('disabled', false).html('Sil');
            }
        });
    });

    ParticipantsAcademyEducationPlanButton.click(function () {
        getAcademyEducationPlanParticipants();
    });

    $(document).delegate('.setAttendanceButton', 'click', function () {
        var id = $(this).data('id');
        var attendance = parseInt($(this).data('attendance')) === 1 ? 0 : 1;
        var attendanceButton = $(this);
        attendanceButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'put',
            url: '{{ route('user.api.academyEducationPlanParticipant.setAttendance') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
                attendance: attendance,
            },
            success: function () {
                getAcademyEducationPlanParticipants();
                attendanceButton.attr('disabled', false);
                attendance === 1 ? attendanceButton.removeClass('btn-warning').addClass('btn-success') : attendanceButton.removeClass('btn-success').addClass('btn-warning');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Durum Güncellenirken Serviste Bir Sorun Oluştu! Lütfen Geliştiri Ekibi İle İletişime Geçin!');
                attendanceButton.attr('disabled', false).html('<i class="fa fa-check-circle"></i>');
            }
        });
    });

    $('body').on('contextmenu', function () {
        transactions();
        return false;
    });

    SelectedCompanies.change(function () {
        calendar.refetchEvents();
        getAcademyEducations();
        getEmployeesByCompanyIds();
    });

</script>
