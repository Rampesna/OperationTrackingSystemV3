<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var socialEvents = $('#socialEvents');
    var updateSocialEventImagesRow = $('#update_social_event_images_row');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');
    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    var keywordFilter = $('#keyword');

    var CreateSocialEventButton = $('#CreateSocialEventButton');
    var UpdateSocialEventButton = $('#UpdateSocialEventButton');
    var DeleteSocialEventButton = $('#DeleteSocialEventButton');

    function createSocialEvent() {
        $('#create_social_event_name').val('');
        $('#create_social_event_date').val('');
        $('#create_social_event_youtube_video_url').val('');
        $('#create_social_event_description').val('');
        $('#CreateSocialEventModal').modal('show');
    }

    function updateSocialEvent(id) {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.socialEvent.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $.ajax({
                    type: 'get',
                    url: '{{ route('user.api.file.getByRelation') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        relationId: response.response.id,
                        relationType: 'App\\Models\\Eloquent\\SocialEvent',
                    },
                    success: function (filesResponse) {
                        updateSocialEventImagesRow.empty();

                        $.each(filesResponse.response, function (i, file) {
                            updateSocialEventImagesRow.append(`
                            <div class="image-container col-xl-2" id="${file.id}_image_container">
                                <img src="${file.path}" style="width: 100%; height: auto;" alt="${file.name}">
                                <i class="fas fa-lg fa-times-circle close-icon text-danger" data-id="${file.id}" data-name="${file.name}"></i>
                            </div>
                            `);
                        });

                        $('#update_social_event_id').val(response.response.id);
                        $('#update_social_event_name').val(response.response.name);
                        $('#update_social_event_date').val(response.response.date);
                        $('#update_social_event_youtube_video_url').val(response.response.youtube_video_url);
                        $('#update_social_event_description').val(response.response.description);
                        $('#UpdateSocialEventModal').modal('show');
                        $('#loader').hide();
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
            },
            error: function (error) {
                console.log(error);
                $('#loader').hide();
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

    function deleteSocialEvent(id) {
        $('#update_social_event_id').val(id);
        $('#DeleteSocialEventModal').modal('show');
    }

    function getSocialEvents() {
        socialEvents.html(`<tr><td colspan="6" class="text-center fw-bolder"><i class="fa fa-lg fa-spinner fa-spin"></i></td></tr>`);
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.socialEvent.index') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
            },
            success: function (response) {
                socialEvents.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.socialEvents, function (i, socialEvent) {
                    socialEvents.append(`
                    <tr>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${socialEvent.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="${socialEvent.id}_Dropdown" style="width: 175px">
                                    <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateSocialEvent(${socialEvent.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                    <hr class="text-muted">
                                    <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteSocialEvent(${socialEvent.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${socialEvent.name ?? ''}
                        </td>
                        <td>
                            ${reformatDatetimeToDateForHuman(socialEvent.date) ?? ''}
                        </td>
                    </tr>
                    `);
                });

                checkScreen();

                if (response.response.totalCount <= (pageIndex + 1) * pageSize) {
                    pageUpButton.attr('disabled', true);
                } else {
                    pageUpButton.attr('disabled', false);
                }
            },
            error: function (error) {
                console.log(error);
                toastr.error('Kariyer Başvuruları Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getSocialEvents();

    keywordFilter.on('keypress', function (e) {
        if (e.which === 13) {
            changePage(1);
        }
    });

    function changePage(newPage) {
        if (newPage === 1) {
            pageDownButton.attr('disabled', true);
        } else {
            pageDownButton.attr('disabled', false);
        }

        page.html(newPage);
        getSocialEvents();
    }

    pageUpButton.click(function () {
        changePage(parseInt(page.html()) + 1);
    });

    pageDownButton.click(function () {
        changePage(parseInt(page.html()) - 1);
    });

    pageSizeSelector.change(function () {
        changePage(1);
    });

    FilterButton.click(function () {
        changePage(1);
    });

    ClearFilterButton.click(function () {
        keywordFilter.val('');
        changePage(1);
    });

    CreateSocialEventButton.click(function () {
        var name = $('#create_social_event_name').val();
        var date = $('#create_social_event_date').val();
        var youtubeVideoUrl = $('#create_social_event_youtube_video_url').val();
        var description = $('#create_social_event_description').val();
        var images = $('#create_social_event_images')[0].files;

        if (!name) {
            toastr.warning('Etkinlik Adı Boş Olamaz.');
        } else if (!date) {
            toastr.warning('Etkinlik Tarihi Boş Olamaz.');
        } else {
            CreateSocialEventButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.socialEvent.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    name: name,
                    date: date,
                    youtubeVideoUrl: youtubeVideoUrl,
                    description: description,
                },
                success: function (response) {
                    CreateSocialEventButton.attr('disabled', false).html('Oluştur');
                    toastr.success('Etkinlik Başarıyla Oluşturuldu.');
                    toastr.info('Etkinlik Resimleri Yükleniyor...');
                    $('#CreateSocialEventModal').modal('hide');
                    changePage(page.html());

                    var createSocialEventImagesCount = document.getElementById('create_social_event_images').files.length;
                    var formData = new FormData();
                    for (var index = 0; index < createSocialEventImagesCount; index++) {
                        formData.append("images[]", document.getElementById('create_social_event_images').files[index]);
                    }

                    $.ajax({
                        contentType: false,
                        processData: false,
                        type: 'post',
                        url: 'https://image.ayssoft.com/index.php',
                        headers: {},
                        data: formData,
                        success: function (uploadResponse) {
                            var fileList = [];
                            var decodedResponse = JSON.parse(uploadResponse);
                            $.each(decodedResponse.files, function (i, fileName) {
                                fileList.push({
                                    relationId: response.response.id,
                                    relationType: 'App\\Models\\Eloquent\\SocialEvent',
                                    type: 'image',
                                    icon: 'fa fa-image',
                                    name: fileName,
                                    path: `https://image.ayssoft.com/${fileName}`,
                                });
                            });

                            $.ajax({
                                type: 'post',
                                url: '{{ route('user.api.file.createBatch') }}',
                                headers: {
                                    'Accept': 'application/json',
                                    'Authorization': token
                                },
                                data: {
                                    fileList: fileList,
                                },
                                success: function (createResponse) {
                                    console.log(createResponse);
                                    toastr.success('Etkinlik Resimleri Başarıyla Yüklendi.');
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
                        },
                        error: function (error) {
                            console.log(error);
                            toastr.error('Dosyalar Sunucuya Yüklenirken Bir Sorun Oluştu.');
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                    CreateSocialEventButton.attr('disabled', false).html('Oluştur');
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
    });

    UpdateSocialEventButton.click(function () {
        var id = $('#update_social_event_id').val();
        var name = $('#update_social_event_name').val();
        var date = $('#update_social_event_date').val();
        var youtubeVideoUrl = $('#update_social_event_youtube_video_url').val();
        var description = $('#update_social_event_description').val();

        if (!name) {
            toastr.warning('Etkinlik Adı Boş Olamaz.');
        } else if (!date) {
            toastr.warning('Etkinlik Tarihi Boş Olamaz.');
        } else {
            UpdateSocialEventButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.socialEvent.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    name: name,
                    date: date,
                    youtubeVideoUrl: youtubeVideoUrl,
                    description: description,
                },
                success: function () {
                    UpdateSocialEventButton.attr('disabled', false).html('Güncelle');
                    toastr.success('Etkinlik Başarıyla Güncellendi.');
                    $('#UpdateSocialEventModal').modal('hide');
                    changePage(page.html());

                    var updateSocialEventImagesCount = document.getElementById('update_social_event_images').files.length;
                    var formData = new FormData();
                    for (var index = 0; index < updateSocialEventImagesCount; index++) {
                        formData.append("images[]", document.getElementById('update_social_event_images').files[index]);
                    }

                    $.ajax({
                        contentType: false,
                        processData: false,
                        type: 'post',
                        url: 'https://image.ayssoft.com/index.php',
                        headers: {},
                        data: formData,
                        success: function (uploadResponse) {
                            var fileList = [];
                            var decodedResponse = JSON.parse(uploadResponse);
                            $.each(decodedResponse.files, function (i, fileName) {
                                fileList.push({
                                    relationId: id,
                                    relationType: 'App\\Models\\Eloquent\\SocialEvent',
                                    type: 'image',
                                    icon: 'fa fa-image',
                                    name: fileName,
                                    path: `https://image.ayssoft.com/${fileName}`,
                                });
                            });

                            $.ajax({
                                type: 'post',
                                url: '{{ route('user.api.file.createBatch') }}',
                                headers: {
                                    'Accept': 'application/json',
                                    'Authorization': token
                                },
                                data: {
                                    fileList: fileList,
                                },
                                success: function (createResponse) {
                                    console.log(createResponse);
                                    toastr.success('Etkinlik Resimleri Başarıyla Yüklendi.');
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
                        },
                        error: function (error) {
                            console.log(error);
                            toastr.error('Dosyalar Sunucuya Yüklenirken Bir Sorun Oluştu.');
                        }
                    });
                },
                error: function (error) {
                    console.log(error);
                    UpdateSocialEventButton.attr('disabled', false).html('Güncelle');
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
    });

    DeleteSocialEventButton.click(function () {
        var id = $('#update_social_event_id').val();
        DeleteSocialEventButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.socialEvent.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                DeleteSocialEventButton.attr('disabled', false).html('Sil');
                toastr.success('Etkinlik Başarıyla Silindi.');
                $('#DeleteSocialEventModal').modal('hide');
                changePage(page.html());
            },
            error: function (error) {
                console.log(error);
                DeleteSocialEventButton.attr('disabled', false).html('Sil');
                if (parseInt(error.status) === 422) {
                    $.each(error.responseJSON.response, function (i, error) {
                        toastr.error(error[0]);
                    });
                } else {
                    toastr.error(error.responseJSON.message);
                }
            }
        });
    });

    $(document).delegate('.close-icon', 'click', function () {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');

        $(this).removeClass('fa-times-circle text-danger').addClass('fa-spinner fa-spin text-warning');

        $.ajax({
        	type: 'get',
        	url: `https://image.ayssoft.com/index.php?deleteImage=true&path=${name}`,
        	headers: {
        		'Accept': 'application/json',
                'Content-Type': 'application/json'
        	},
        	data: {},
        	success: function () {
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
                        $(`#${id}_image_container`).remove();
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
    });

</script>
