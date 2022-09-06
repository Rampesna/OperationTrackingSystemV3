<script>

    var employee = null;

    var employeeId = `{{ $id }}`;

    var employeeImageSpan = $('#employeeImageSpan');
    var employeeNameSpan = $('#employeeNameSpan');
    var employeeIdentitySpan = $('#employeeIdentitySpan');
    var employeeEmailSpan = $('#employeeEmailSpan');
    var employeePhoneSpan = $('#employeePhoneSpan');

    function getEmployeeById() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: employeeId,
            },
            success: function (response) {
                employee = response;
                if (response.response.image) employeeImageSpan.attr('src', `${baseAssetUrl}${response.response.image}`);
                employeeNameSpan.html(response.response.name);
                employeeIdentitySpan.html(`<i class="far fa-user-circle me-4"></i><span class="mt-n1">${response.response.identity}</span>`);
                employeeEmailSpan.html(`<i class="far fa-envelope me-4"></i><span class="mt-n1">${response.response.email}</span>`);
                employeePhoneSpan.html(`<i class="fas fa-phone-square-alt me-4"></i><span class="mt-n1">${response.response.phone}</span>`);
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                $('#loader').hide();
                toastr.error('Personel Bilgileri Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    getEmployeeById();

</script>

<script>

    var filesRow = $('#filesRow');
    var fileUploader = $('#fileUploadArea');
    var fileSelector = $('#fileSelector');

    function getFilesByEmployeeId() {
        var employeeId = parseInt(`{{ $id }}`);
        $.ajax({
            type: 'get',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            url: '{{ route('user.api.file.getByRelation') }}',
            data: {
                relationId: employeeId,
                relationType: 'App\\Models\\Eloquent\\Employee'
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

    getFilesByEmployeeId();

    function showFile(id) {
        $('#download_file_id').val(id);
        $('#delete_file_id').val(id);
        $('#ShowModal').modal('show');
    }

    function uploadFile(data) {
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
                getFilesByEmployeeId();
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

    function deleteFile() {
        $('#ShowModal').modal('hide');
        var id = $('#delete_file_id').val();
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.file.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Dosya Silindi');
                getFilesByEmployeeId();

            },
            error: function (error) {
                console.log(error);
                toastr.error('Dosya Silinirken Bir Sorun Oluştu.');
            }
        });
    }

    $(document).delegate('#fileUploadArea', 'click', function () {
        fileSelector.click();
    });

    $(document).delegate('.fileClicker', 'click', function () {

    });

    fileSelector.change(function () {
        var data = new FormData();
        data.append('relationType', 'App\\Models\\Eloquent\\Employee');
        data.append('relationId', '{{ $id }}');
        data.append('file', fileSelector[0].files[0]);
        data.append('filePath', 'uploads/employee/{{ $id }}/files/');
        uploadFile(data);
    });

</script>
