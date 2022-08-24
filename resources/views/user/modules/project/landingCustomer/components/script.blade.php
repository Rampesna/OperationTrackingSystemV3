<script>

    function getProject() {
        var id = parseInt('{{ $id }}');
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.project.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#projectNameSpan').text(response.response.name);
                $('#projectStatusBadge').text(response.response.status ? response.response.status.name : '--').addClass(`badge-light-${response.response.status ? response.response.status.color : 'info'}`);
                $('#projectDescription').html(response.response.description ?? '');
                $('#projectEndDateSpan').text(response.response.end_date ? reformatDatetimeToDateForHuman(response.response.end_date) : '--');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                if (parseInt(error.status) === 404) {
                    toastr.error('Proje Bulunamadı!');
                } else {
                    toastr.error('Proje Bilgileri Alınırken Serviste Bir Sorun Oluştu!');
                }
                $('#loader').hide();
            }
        });
    }

    function getProjectSubTasks() {
        var projectId = parseInt('{{ $id }}');
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.project.getSubtasksByProjectId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                projectId: projectId,
            },
            success: function (response) {
                var waitingSubTasks = 0;
                $.each(response.response, function (i, subTask) {
                    if (parseInt(subTask.checked) === 0) {
                        waitingSubTasks++;
                    }
                });
                $('#projectWaitingTasksSpan').text(waitingSubTasks);
            },
            error: function (error) {
                console.log(error);
                if (parseInt(error.status) === 404) {
                    toastr.error('Proje Bulunamadı!');
                } else {
                    toastr.error('Proje Bilgileri Alınırken Serviste Bir Sorun Oluştu!');
                }
            }
        });
    }

    getProject();
    getProjectSubTasks();

</script>

<script>

    var landingCustomerIds = $('#landing_customer_ids');

    var UpdateLandingCustomersButton = $('#UpdateLandingCustomersButton');

    function getLandingCustomers() {
        $.ajax({
            async: false,
            type: 'get',
            url: 'https://urun.ayssoft.com/api/user/customer/getAll',
            headers: {
                'Accept': 'application/json',
            },
            data: {},
            success: function (response) {
                landingCustomerIds.empty();
                $.each(response.response, function (i, landingCustomer) {
                    landingCustomerIds.append(`<option value="${landingCustomer.id}">${landingCustomer.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ürün Sistemi Kullanıcı Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getProjectLandingCustomers() {
        var projectId = parseInt(`{{ $id }}`);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.projectLandingCustomer.getAllByProjectId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                projectId: projectId,
            },
            success: function (response) {
                console.log(response);
                landingCustomerIds.val($.map(response.response, function (landingCustomer) {
                    return landingCustomer.customer_id;
                })).trigger('change');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Projeye Bağlı Ürün Kullanıcıları Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getLandingCustomers();
    getProjectLandingCustomers();

    UpdateLandingCustomersButton.click(function () {
        var projectId = parseInt(`{{ $id }}`);
        var customerIds = landingCustomerIds.val();
        UpdateLandingCustomersButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'post',
            url: '{{ route('user.api.projectLandingCustomer.updateByProjectId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                projectId: projectId,
                customerIds: customerIds,
            },
            success: function () {
                toastr.success('Proje Ürün Kullanıcıları Başarıyla Güncellendi!');
                UpdateLandingCustomersButton.prop('disabled', false).html('Güncelle');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Proje Ürün Kullanıcıları Güncellenirken Serviste Bir Sorun Oluştu!');
                UpdateLandingCustomersButton.prop('disabled', false).html('Güncelle');
            }
        });
    });

</script>
