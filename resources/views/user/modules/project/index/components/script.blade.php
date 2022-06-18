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
                projectsRow.empty();
                $.each(response.response, function (i, project) {
                    projectsRow.append(`
                    <div class="col-md-6 col-xl-4 mb-5">
                        <a href="#" class="card border-hover-primary">
                            <div class="card-body p-9">
                                <div class="fs-3 fw-bolder text-dark">Fitnes App</div>
                                <p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">CRM App application to HR efficiency</p>
                                <div class="d-flex flex-wrap mb-5">
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                        <div class="fs-6 text-gray-800 fw-bolder">Nov 10, 2022</div>
                                        <div class="fw-bold text-gray-400">Due Date</div>
                                    </div>
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                        <div class="fs-6 text-gray-800 fw-bolder">$284,900.00</div>
                                        <div class="fw-bold text-gray-400">Budget</div>
                                    </div>
                                </div>
                                <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="" data-bs-original-title="This project 50% completed">
                                    <div class="bg-primary rounded h-4px" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="symbol-group symbol-hover">
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Emma Smith">
                                        <img alt="Pic" src="{{ asset('assets/media/avatars/300-6.jpg') }}">
                                    </div>
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Rudy Stone">
                                        <img alt="Pic" src="{{ asset('assets/media/avatars/300-1.jpg') }}">
                                    </div>
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="Susan Redwood">
                                        <span class="symbol-label bg-primary text-inverse-primary fw-bolder">S</span>
                                    </div>
                                </div>
                            </div>
                        </a>
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
