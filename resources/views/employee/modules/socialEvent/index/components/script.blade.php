<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var timelineBody = $('#timelineBody');

    function getSocialEvents() {
        $.ajax({
        	type: 'get',
        	url: '{{ route('employee.api.socialEvent.getAllByDateOrderedWithImages') }}',
        	headers: {
        		'Accept': 'application/json',
        		'Authorization': token
        	},
        	data: {},
        	success: function (response) {
                console.log(response);
                timelineBody.empty();
                $.each(response.response, function (i, socialEvent) {
                    var images = ``;
                    $.each(socialEvent.images, function (i, image) {
                        images += `
                        <a href="${image.path}" target="_blank">
                            <img class="me-5 mb-5 rounded-3" src="${image.path}" alt="${image.name}" width="100" height="100">
                        </a>
                        `;
                    });
                    timelineBody.append(`
                    <div class="timeline-item">
                        <div class="timeline-line w-40px"></div>
                        <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                            <div class="symbol-label bg-light">
                                <i class="fa fa-flag"></i>
                            </div>
                        </div>
                        <div class="timeline-content mb-10 mt-n1">
                            <div class="pe-3 mb-5">
                                <div class="d-flex align-items-center fs-6">
                                    <div class="text-muted fw-bolder me-2 fs-7">${reformatDatetimeToDateForHuman(socialEvent.date)}</div>
                                </div>
                                <div class="fs-5 fw-bolder">${socialEvent.name}</div>
                            </div>
                            <div class="overflow-auto pb-5">
                                <p class="text-muted">
                                    ${socialEvent.description}
                                </p>
                                <div class="min-w-750px py-3 mb-5">
                                    ${images}
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });
        	},
        	error: function (error) {
        		console.log(error);
        		if (parseInt(error.status) === 422) {
        			$.each(error.responseJSON.response, function (i, error) {
        				toastr.error(error[0]);
        			});
        		} else {
        			toastr.error(error.responseJSON.message);
        		}
        	}
        });
    }

    // getSocialEvents();

</script>
