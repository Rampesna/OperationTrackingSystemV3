<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/locales-all-min.js') }}"></script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var createFoodListCompanyId = $('#create_food_list_company_id');

    var CreateFoodListButton = $('#CreateFoodListButton');
    var UpdateFoodListButton = $('#UpdateFoodListButton');
    var DeleteFoodListButton = $('#DeleteFoodListButton');

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
            createFoodListCompanyId.val('');
            $('#create_food_list_name').val('');
            $('#create_food_list_description').val('');
            $('#create_food_list_date').val(info.dateStr);
            $('#CreateFoodListModal').modal('show');
        },

        eventClick: function (info) {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.foodList.getById') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: info.event._def.extendedProps._id,
                },
                success: function (response) {
                    $('#update_food_list_id').val(response.response.id);
                    $('#update_food_list_name').val(response.response.name);
                    $('#update_food_list_description').val(response.response.description);
                    $('#UpdateFoodListModal').modal('show');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Yemek verileri Alınırken Serviste Bir Hata Oluştu.');
                }
            });
        },

        events: function (info, successCallback) {
            $('#loader').show();
            var companyIds = SelectedCompanies.val();
            $.ajax({
                url: '{{ route('user.api.foodList.getDateBetween') }}',
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
                    $.each(response.response, function (i, foodList) {
                        events.push({
                            _id: foodList.id,
                            id: foodList.id,
                            title: `${foodList.name}`,
                            start: reformatDateForCalendar(foodList.date),
                            end: reformatDateForCalendar(foodList.date),
                            type: 'foodList',
                            classNames: 'bg-primary text-white cursor-pointer ms-1 me-1',
                            backgroundColor: 'white',
                            food_list_id: `${foodList.id}`
                        });
                    });
                    successCallback(events);
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Yemek Listesi Alınırken Serviste Bir sorun Oluştu!');
                    $('#loader').hide();
                }
            });
        },
    });

    calendar.render();

    function getCompanies() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.getCompanies') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createFoodListCompanyId.empty();
                $.each(response.response, function (i, company) {
                    createFoodListCompanyId.append(
                        $('<option>', {
                            value: company.id,
                            text: company.title
                        })
                    );
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Şirketler Alınırken Serviste Bir Hata Oluştu.');
            }
        });
    }

    getCompanies();

    SelectedCompanies.change(function () {
        calendar.refetchEvents();
    });

    CreateFoodListButton.click(function () {
        var companyId = createFoodListCompanyId.val();
        var name = $('#create_food_list_name').val();
        var description = $('#create_food_list_description').val();
        var date = $('#create_food_list_date').val();

        if (!date) {
            toastr.warning('Tarih Seçmediniz!');
        } else if (!companyId) {
            toastr.warning('Firma Seçimi Zorunludur!');
        } else if (!name) {
            toastr.warning('Yemek Adı Zorunludur!');
        } else {
            CreateFoodListButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.foodList.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyId: companyId,
                    name: name,
                    description: description,
                    date: date,
                },
                success: function () {
                    toastr.success('Yemek Listesi Başarıyla Oluşturuldu!');
                    calendar.refetchEvents();
                    $('#CreateFoodListModal').modal('hide');
                    CreateFoodListButton.attr('disabled', false).html(`Oluştur`);
                },
                error: function (error) {
                    console.log(error);
                    CreateFoodListButton.attr('disabled', false).html(`Oluştur`);
                    if (parseInt(error.status) === 406) {
                        toastr.error('Bu Firma İçin Bu Tarihte Zaten Yemek Girilmiş!');
                    } else {
                        toastr.error('Yemek Listesi Oluşturulurken Serviste Bir Hata Oluştu.');
                    }
                }
            });
        }
    });

    UpdateFoodListButton.click(function () {
        var id = $('#update_food_list_id').val();
        var name = $('#update_food_list_name').val();
        var description = $('#update_food_list_description').val();

        if (!name) {
            toastr.warning('Yemek Adı Zorunludur!');
        } else {
            UpdateFoodListButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.foodList.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    name: name,
                    description: description,
                },
                success: function () {
                    toastr.success('Yemek Listesi Başarıyla Güncellendi!');
                    calendar.refetchEvents();
                    $('#UpdateFoodListModal').modal('hide');
                    UpdateFoodListButton.attr('disabled', false).html(`Güncelle`);
                },
                error: function (error) {
                    console.log(error);
                    UpdateFoodListButton.attr('disabled', false).html(`Güncelle`);
                    toastr.error('Yemek Listesi Güncellenirken Serviste Bir Hata Oluştu.');
                }
            });
        }
    });

    DeleteFoodListButton.click(function () {
        var id = $('#update_food_list_id').val();
        DeleteFoodListButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.foodList.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Yemek Listesi Başarıyla Silindi!');
                calendar.refetchEvents();
                $('#UpdateFoodListModal').modal('hide');
                DeleteFoodListButton.attr('disabled', false).html(`Sil`);
            },
            error: function (error) {
                console.log(error);
                DeleteFoodListButton.attr('disabled', false).html(`Sil`);
                toastr.error('Yemek Listesi Silinirken Serviste Bir Hata Oluştu.');
            }
        });
    });

</script>
