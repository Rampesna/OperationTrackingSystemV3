<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/locales-all-min.js') }}"></script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var academyEducationLessonsRow = $('#academyEducationLessonsRow');

    var createAcademyEducationPlanAcademyEducationId = $('#create_academy_education_plan_academy_education_id');

    var CreateAcademyEducationPlanButton = $('#CreateAcademyEducationPlanButton');

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

    getAcademyEducations();

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
            console.log(info);
            toastr.info(info.dateStr);
        },

        eventClick: function (info) {

        },

        events: function (info, successCallback) {
            var events = [];
            successCallback(events);
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
                },
                error: function (error) {
                    console.log(error);
                    CreateAcademyEducationPlanButton.prop('disabled', false).html('Oluştur');
                }
            });
        }
    });

    $('body').on('contextmenu', function () {
        transactions();
        return false;
    });

</script>
