<script>

    var projectsRow = $('#projects');

    function getProjects() {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.project.getByUserId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                var imageUrl = '{{ asset('assets/media/svg/brand-logos/xing-icon.svg') }}';
                projectsRow.empty();
                $.each(response.response, function (i, project) {
                    var overviewRoute = `{{ route('user.web.project.overview') }}/${project.id}`;
                    projectsRow.append(`
                    <div class="col-md-6 col-xl-4 mb-5">
                        <div class="card border-hover-primary">
                            <div class="card-header border-0 pt-9">
                                <div class="card-title m-0">
                                    <a href="${overviewRoute}" class="symbol symbol-50px w-50px bg-light">
                                        <img src="${imageUrl}" alt="image" class="p-3">
                                    </a>
                                </div>
                                <div class="card-toolbar">
                                    <span class="badge badge-light-${project.status ? project.status.color : 'info'} fw-bolder me-auto px-4 py-3">${project.status ? project.status.name : 'Test'}</span>
                                </div>
                            </div>
                            <div class="card-body p-9">
                                <a href="${overviewRoute}" class="fs-3 fw-bolder text-dark">${project.name}</a>
                                <p></p>
                                <div class="bg-primary rounded h-8px" role="progressbar" style="width: ${project.progress}%" aria-valuenow="${project.progress}" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="row">
                                    <div class="col-xl-12 mt-2 text-end">
                                        <span class="fw-bolder">${project.progress}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });

                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Projeler Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    getProjects();

</script>
