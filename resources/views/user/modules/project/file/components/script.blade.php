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

    var filesRow = $('#filesRow');
    var fileUploader = $('#fileUploadArea');
    var fileSelector = $('#fileSelector');

    function getFilesByProjectId() {
        var projectId = parseInt(`{{ $id }}`);
        $.ajax({
            type: 'get',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            url: '{{ route('user.api.file.getByRelation') }}',
            data: {
                relationId: projectId,
                relationType: 'App\\Models\\Eloquent\\Project'
            },
            success: function (response) {
                var fileUploadSvg = `{{ asset('assets/media/svg/files/upload.svg') }}`;
                var fileSvg = `{{ asset('assets/media/icons/duotune/files/fil003.svg') }}`;
                filesRow.empty().append(`
                <div class="col-xl-2 mb-5">
                    <div class="card h-100 flex-center border-dashed p-8 cursor-pointer" id="fileUploadArea">
                        <img src="${fileUploadSvg}" class="mb-8" alt="" />
                        <a class="font-weight-bolder text-dark-75 mb-2">Yeni Dosya</a>
                        <div class="fs-7 fw-bold text-gray-400 mt-auto">Yüklemek İçin Tıklayın</div>
                    </div>
                </div>
                `);
                $.each(response.response, function (i, file) {
                    filesRow.append(`
                    <div class="col-xl-2 mb-5">
                        <div class="card h-100 flex-center text-center border-dashed p-8 cursor-pointer" onclick="showFile(${file.id})" data-id="${file.id}" id="file_${file.id}">
                            <img src="${fileSvg}" class="w-25 mb-8" alt="" />
                            <a class="font-weight-bolder text-dark-75 mb-2">${file.name}</a>
                        </div>
                    </div>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Dosyalar Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    getFilesByProjectId();

    function showFile(id) {
        $('#download_file_id').val(id);
        $('#delete_file_id').val(id);
        $('#ShowModal').modal('show');
    }

    function uploadFile(data) {
        toastr.info('Dosyanız Yükleniyor, Lütfen İşlem Tamamlanıncaya Kadar Bekleyiniz...');
        $.ajax({
            contentType: false,
            processData: false,
            type: 'post',
            url: '{{ route('user.api.file.upload') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: data,
            success: function () {
                toastr.success('Dosya Yüklendi');
                getFilesByProjectId();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Dosya Yüklenirken Bir Sorun Oluştu.');
            }
        });
    }

    function downloadFile() {
        $('#ShowModal').modal('hide');
        var id = $('#download_file_id').val();
        window.open(`{{ route('user.web.file.download') }}/${id}`, '_blank');
    }

    $(document).delegate('#fileUploadArea', 'click', function () {
        fileSelector.click();
    });

    $(document).delegate('.fileClicker', 'click', function () {

    });

    fileSelector.change(function () {
        var data = new FormData();
        data.append('relationType', 'App\\Models\\Eloquent\\Project');
        data.append('relationId', '{{ $id }}');
        data.append('file', fileSelector[0].files[0]);
        data.append('filePath', 'uploads/project/{{ $id }}/files/');
        uploadFile(data);
    });

</script>
