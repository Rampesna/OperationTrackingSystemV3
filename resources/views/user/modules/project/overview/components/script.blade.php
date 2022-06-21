<script>

    const primary = '#6993FF';
    const success = '#1BC5BD';
    const info = '#8950FC';
    const warning = '#FFA800';
    const danger = '#F64E60';
    const aqua = '#00fffb';
    const brown = '#704300';
    const darkRed = '#b90000';


    const boardTaskDistributionChartDiv = "#boardTaskDistributionChartDiv";
    var boardTaskDistributionChartOptions = {
        labels: [],
        series: [],
        chart: {
            width: 500,
            type: 'pie',
        },
        colors: [primary, success, warning, danger, info, aqua, darkRed]
    };
    var boardTaskDistributionChart = new ApexCharts(document.querySelector(boardTaskDistributionChartDiv), boardTaskDistributionChartOptions);
    boardTaskDistributionChart.render();

    const managementBoardTaskDistributionChartDiv = "#managementBoardTaskDistributionChartDiv";
    var managementBoardTaskDistributionChartOptions = {
        labels: [],
        series: [],
        chart: {
            width: 500,
            type: 'pie',
        },
        colors: [primary, success, warning, danger, info, aqua, darkRed]
    };
    var managementBoardTaskDistributionChart = new ApexCharts(document.querySelector(managementBoardTaskDistributionChartDiv), managementBoardTaskDistributionChartOptions);
    managementBoardTaskDistributionChart.render();

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

    function getProjectBoards() {
        var projectId = parseInt('{{ $id }}');
        var management = 0;
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.project.getBoardsByProjectId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                projectId: projectId,
                management: management,
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function getProjectManagementBoards() {
        var projectId = parseInt('{{ $id }}');
        var management = 1;
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.project.getBoardsByProjectId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                projectId: projectId,
                management: management,
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    getProject();
    getProjectSubTasks();
    getProjectBoards();
    getProjectManagementBoards();

</script>
