<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var allQueues = [];

    var waitingCallsDiv = $('#waitingCalls');
    var missedCallsDiv = $('#missedCalls');
    var waitingJobsDiv = $('#waitingJobs');

    function getAllCompanies() {
        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('user.api.getCompanies') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                SelectedCompanies.empty();
                $.each(response.response, function (i, company) {
                    SelectedCompanies.append(`<option value="${company.id}">${company.title}</option>`);
                });

            },
            error: function (error) {
                console.log(error);
                toastr.error('Firmalar Alınırken Serviste Bir Hata Oluştu!');
            }
        });
    }

    function getSelectedCompanies() {
        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('user.api.getSelectedCompanies') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                SelectedCompanies.val($.map(response.response, function (company) {
                    return company.id;
                }));
            },
            error: function () {
                console.log(error);
                toastr.error('Seçili Firmalar Getirilirken Hata Oluştu! Lütfen Geliştirici Ekibi İle İletişime Geçin.');
            }
        });
    }

    function getQueuesByCompanies() {
        var companyIds = SelectedCompanies.val();
        $.ajax({
            async: false,
            type: 'get',
            url: '{{ route('user.api.queue.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
            },
            success: function (response) {
                allQueues = response.response;
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kuyruklar Alınırken Serviste Bir Hata Oluştu!');
            }
        });
    }

    function getSantral() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.netsantralApi.getSantral') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                waitingCallsDiv.empty();
                missedCallsDiv.empty();

                var queuesFromApi = response.response.kuyruklar;
                var totalWaitingCalls = 0;
                var totalMissedCalls = 0;

                $.each(allQueues, function (i, queue) {
                    var queueFromApi = queuesFromApi.find(function (apiQueue) {
                        return queue.short === apiQueue.ad;
                    });

                    if (queueFromApi) {
                        var missedCallCount = (queueFromApi.terkedilmis - queueFromApi.callback) <= 0 ? 0 : (queueFromApi.terkedilmis - queueFromApi.callback);

                        totalWaitingCalls = totalWaitingCalls + queueFromApi.bekleyen;
                        totalMissedCalls = totalMissedCalls + missedCallCount;

                        waitingCallBackground = 'dark';
                        missedCallBackground = 'dark';

                        if (queueFromApi.bekleyen >= 5) {
                            waitingCallBackground = 'warning';
                        }

                        if (missedCallCount >= 5) {
                            missedCallBackground = 'warning';
                        }

                        waitingCallsDiv.append(`
                        <div class="col-xl-6 mb-5">
                            <div class="card">
                                <div class="card-body card-rounded bg-${waitingCallBackground}">
                                    <div class="row">
                                        <div class="col-xl-12 text-center text-white">
                                            <div class="d-flex flex-column">
                                                <h1 class="text-light fs-2x">${queue.name}</h1>
                                                <h1 class="text-light fs-2x">${queueFromApi.bekleyen}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `);

                        missedCallsDiv.append(`
                        <div class="col-xl-6 mb-5">
                            <div class="card">
                                <div class="card-body card-rounded bg-${missedCallBackground}">
                                    <div class="row">
                                        <div class="col-xl-12 text-center text-white">
                                            <div class="d-flex flex-column">
                                                <h1 class="text-light fs-2x">${queue.name}</h1>
                                                <h1 class="text-light fs-2x">${missedCallCount}</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `);
                    }
                });

                $('#totalWaitingCalls').text(totalWaitingCalls);
                $('#totalMissedCalls').text(totalMissedCalls);

                $('#totalWaitingCallsCard').removeClass('bg-secondary bg-waiting').addClass(totalWaitingCalls >= 50 ? 'bg-warning' : 'bg-secondary');
                $('#totalMissedCallsCard').removeClass('bg-secondary bg-missed').addClass(totalMissedCalls >= 50 ? 'bg-warning' : 'bg-secondary');
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function getJobs() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.tvScreen.getJobList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                console.log(response);

                waitingJobsDiv.empty();

                var totalWaitingJobs = 0;

                $.each(response.response, function (i, job) {
                    if (
                        job.baslik === "İ-Dönüşüm Yeni" ||
                        job.baslik === "Eko Cari Yeni" ||
                        job.baslik === "İys Yeni" ||
                        job.baslik === "Uyum Yedek Yeni"
                    ) {
                        if (job.sayi > 0) {
                            waitingJobBackground = 'warning';
                        } else {
                            waitingJobBackground = 'dark';
                        }
                    } else {
                        waitingJobBackground = 'dark';
                    }

                    if (job.durum === 'True') {
                        totalWaitingJobs = totalWaitingJobs + job.sayi;
                    }
                    waitingJobsDiv.append(`
                    <div class="col-xl-6 mb-5">
                        <div class="card">
                            <div class="card-body card-rounded bg-${waitingJobBackground}">
                                <div class="row">
                                    <div class="col-xl-12 text-center text-white">
                                        <div class="d-flex flex-column">
                                            <h1 class="text-light fs-2x">${job.baslik}</h1>
                                            <h1 class="text-light fs-2x">${job.sayi}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });

                $('#totalWaitingJobs').text(totalWaitingJobs);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    getAllCompanies();
    getSelectedCompanies();
    getQueuesByCompanies();
    getSantral();
    getJobs();

    setInterval(function () {
        getSantral();
    }, 10000);

    setInterval(function () {
        getSantral();
    }, 30000);

</script>
