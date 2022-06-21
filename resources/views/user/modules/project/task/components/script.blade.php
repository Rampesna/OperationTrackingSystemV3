<script src="{{ asset('assets/plugins/custom/jkanban/jkanban.bundle.js') }}"></script>

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

    $('.tooltipData').tooltip();

    function reformatDatetime(date) {
        var formattedDate = new Date(date);
        return String(formattedDate.getDate()).padStart(2, '0') + '.' +
            String(formattedDate.getMonth() + 1).padStart(2, '0') + '.' +
            formattedDate.getFullYear() + ', ' +
            String(formattedDate.getHours()).padStart(2, '0') + ':' +
            String(formattedDate.getMinutes()).padStart(2, '0') + ' ';
    }

    $(document).delegate('.kanban-item', 'mouseover', function () {
        $(this).css({
            cursor: 'default'
        });
    });

    var taskId = $('#task_id');
    var boardId = $('#board_id');
    var commentsRow = $('#commentsRow');
    var filesRow = $('#filesRow');
    var editTaskSubtasks = $('#edit_task_subtasks');
    var editTaskPriorityId = $('#edit_task_priority_id');
    var editTaskMilestoneId = $('#edit_task_milestone_id');
    var CreateTaskButton = $("#CreateTaskButton");
    var SubmitCommentButton = $('#SubmitCommentButton');
    var requester_id = $('#edit_task_requester_id');

    // Kanban Definitions

    var kanban = new jKanban({
        element: '#boards',
        gutter: '0',
        widthBoard: '290px',
        dragBoards: true,
        click: function (el) {
            taskId.val(el.dataset.eid);
        },
        dragEl: function (el, source) {
            if (el.dataset.draggable === 'false') {
                kanban.drake.cancel();
            }
        },
        dropEl: function (el, source) {
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.task.updateBoard') }}',
                data: {
                    taskId: el.dataset.eid,
                    boardId: el.parentNode.parentNode.dataset.id
                }
            });
        },
        dragBoard: function (el, source) {
            if (el.dataset.id === '0') {
                board.drag.stop;
            } else {
                kanban.removeBoard('0');
            }
        },
        dragendBoard: function (el) {
            var allBoards = document.querySelectorAll('.kanban-board');
            if (allBoards.length > 0) {
                var list = [];
                for (var i = 0; i < allBoards.length; i++) {
                    list[allBoards[i].dataset.id] = allBoards[i].dataset.order
                }
                $.ajax({
                    type: 'post',
                    url: '{{ route('ajax.board.updateOrder') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        list: list
                    },
                    success: function () {
                        var addBoard = kanban.findBoard('0');
                        if (addBoard == null) {
                            kanban.addBoards([
                                {
                                    id: '0',
                                    order: 99999,
                                    title: `
                                    <div class="row">
                                        <div id="CreateBoardButton" class="col-xl-12 bg-dark-75-o-25 bg-hover-secondary text-center cursor-pointer" style="border-radius: 2rem">
                                            <span class="form-control mt-1 font-weight-bold text-dark-75" type="text" style="font-size: 12px; border: none; background: transparent">
                                                <i class="fa fa-plus fa-sm mr-2"></i>Yeni Pano
                                            </span>
                                        </div>
                                    </div>
                                    `,
                                    dragBoards: false,
                                    dragItems: false,
                                }
                            ]);
                        }
                    }
                });
            }
        },
        dragendEl: function (el) {
            var tasks = kanban.getBoardElements(el.parentNode.parentNode.dataset.id);
            var list = [];
            $.each(tasks, function (index) {
                list[tasks[index].dataset.eid] = index + 1
            });
            $.ajax({
                type: 'post',
                url: '{{ route('ajax.task.updateOrder') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    list: list
                },
                success: function () {
                    fetchBoards();
                },
                error: function (error) {
                    console.log(error)
                }
            });
        },
        boards: []
    });

    function fetchBoards() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.board.index') }}',
            data: {
                project_id: '{{ $id }}',
                management: 0
            },
            success: function (response) {
                $('.kanban-container').html('');

                var boardsList = [];
                $.each(response, function (board) {

                    var taskList = [];
                    $.each(response[board].tasks, function (task) {

                        var subTaskList = ``;
                        $.each(response[board].tasks[task].sub_tasks, function (subTask) {
                            var subTaskClass = response[board].tasks[task].sub_tasks[subTask].checked === 1 ? 'fa fa-check-circle text-success' : 'fa fa-dot-circle text-warning';
                            subTaskList = subTaskList + `
                            <div class="col-xl-12 m-1" id="sub_task_id_${response[board].tasks[task].sub_tasks[subTask].id}">
                                <i id="sub_task_icon_id_${response[board].tasks[task].sub_tasks[subTask].id}" class="${subTaskClass}"></i>
                                <span class="ml-3" id="sub_task_name_id_${response[board].tasks[task].sub_tasks[subTask].id}">${response[board].tasks[task].sub_tasks[subTask].name}</span>
                            </div>
                            `;
                        });

                        taskList.push({
                            id: '' + response[board].tasks[task].id + '',
                            class: response[board].tasks[task].priority ? ['border', `border-${response[board].tasks[task].priority.color}`] : [],
                            title: `
                                <div class="row">
                                    <div class="col-xl-10">
                                       <i class="fa fa-check-circle text-success mr-3"></i><span data-id="${response[board].tasks[task].id}" class="taskTitle cursor-pointer">${response[board].tasks[task].name}</span>
                                    </div>
                                    <div class="col-xl-1 text-right">
                                        <i class="fas fa-sort-amount-down cursor-pointer sublistToggleIcon" data-id="${response[board].tasks[task].id}"></i>
                                    </div>
                                </div>
                                <div id="sublist_${response[board].tasks[task].id}" class="taskSublist" style="display: none">
                                    <hr>
                                    <div class="row" id="task_sublist_control_${response[board].tasks[task].id}">
                                        ${subTaskList}
                                    </div>
                                </div>
                                `,
                            order: '' + response[board].tasks[task].order + '',
                            draggable: true
                        });
                    });

                    taskList.push({
                        id: 'board_' + response[board].id + '_task_adder',
                        title: `
                                <div class="row mt-n3 mb-n3 taskAdderSelector">
                                    <div class="col-xl-12 pl-1 pr-0">
                                       <input data-board-id="${response[board].id}" type="text" class="form-control form-control-sm boardTaskAdder" placeholder="+ Görev Ekle" style="border: none">
                                    </div>
                                </div>
                                `,
                        order: '' + 99999 + '',
                        draggable: false,
                        class: ['opacity-60']
                    });

                    boardsList.push({
                        id: '' + response[board].id + '',
                        title: `
                        <div class="row">
                            <div class="col-xl-1">
                               <i class="far fa-circle fa-sm mt-5 moveTaskIcon"></i>
                            </div>
                            <div class="col-xl-9">
                               <input data-id="${response[board].id}" class="form-control font-weight-bold moveTaskIcon editBoardTitle" type="text" value="${response[board].name ?? ''}" style="color:gray; font-size: 15px; border: none; background: transparent">
                            </div>
                            <div class="col-xl-1 text-right">
                                <div class="dropdown dropdown-inline">
                                    <i class="fas fa-grip-horizontal fa-sm mt-5 cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="navi navi-hover">
                                            <li class="navi-item mt-n2 mb-n2">
                                                <a href="#" class="navi-link deleteBoard" data-id="${response[board].id}">
                                                    <span class="navi-icon">
                                                        <i class="fas fa-trash fa-sm text-danger"></i>
                                                    </span>
                                                    <span class="navi-text font-size-xs">
                                                        Panoyu Sil
                                                    </span>
                                                </a>
                                            </li>
                                         </ul>
                                     </div>
                                </div>
                           </div>
                        </div>
                        `,
                        item: taskList,
                        order: '' + response[board].order + ''
                    });
                });
                kanban.addBoards(boardsList);
                kanban.addBoards([
                    {
                        id: '0',
                        order: 99999,
                        title: `
                        <div class="row">
                            <div id="CreateBoardButton" class="col-xl-12 bg-dark-75-o-25 bg-hover-secondary text-center cursor-pointer" style="border-radius: 2rem">
                                <span class="form-control mt-1 font-weight-bold text-dark-75" type="text" style="font-size: 12px; border: none; background: transparent">
                                    <i class="fa fa-plus fa-sm mr-2"></i>Yeni Pano
                                </span>
                            </div>
                        </div>
                        `,
                        dragBoards: false,
                        dragItems: false,
                    }
                ]);
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    fetchBoards();

    // General Functions

    function getPriorities() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.taskPriority.index') }}',
            data: {},
            success: function (priorities) {
                editTaskPriorityId.empty();
                $.each(priorities, function (i, priority) {
                    editTaskPriorityId.append(`<option value="${priority.id}">${priority.name}</option>`);
                });
                editTaskPriorityId.selectpicker('refresh');
            },
            error: function () {

            }
        });
    }

    function getMilestones() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.milestone.index') }}',
            data: {
                project_id: '{{ $id }}'
            },
            success: function (priorities) {
                editTaskMilestoneId.empty();
                $.each(priorities, function (i, priority) {
                    editTaskMilestoneId.append(`<option value="${priority.id}">${priority.name}</option>`);
                });
                editTaskMilestoneId.selectpicker('refresh');
            },
            error: function (error) {
                console.log(error)
            }
        });
    }

    function getUsers() {
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.user.index') }}',
            data: {},
            success: function (users) {
                requester_id.empty();
                requester_id.append(`<optgroup label=""><option value="">Seçim Yok</option></optgroup>`);
                $.each(users, function (i, user) {
                    requester_id.append(`<option value="${user.id}">${user.name}</option>`);
                });
                requester_id.selectpicker('refresh');
            },
            error: function () {

            }
        });
    }

    getPriorities();
    getMilestones();
    getUsers();

    // Board Transactions

    $(document).delegate("#CreateBoardButton", "click", function (e) {
        var project_id = '{{ $id }}';
        console.log(project_id);
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.board.save') }}',
            data: {
                _token: '{{ csrf_token() }}',
                project_id: project_id,
                name: '',
                management: 0
            },
            success: function (taskStatus) {
                fetchBoards();
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    $(document).delegate('.editBoardTitle', 'focusout', function () {
        var id = $(this).data('id');
        var name = $(this).val();

        $.ajax({
            type: 'post',
            url: '{{ route('ajax.board.updateName') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                name: name
            }
        });
    });

    $(document).delegate(".deleteBoard", "click", function (e) {
        boardId.val($(this).data('id'));
        $('#DeleteBoardModal').modal('show');
    });

    $(document).delegate("#DeleteBoardButton", "click", function () {
        $.ajax({
            type: 'delete',
            url: '{{ route('ajax.board.drop') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: boardId.val()
            },
            success: function (response) {
                console.log(response)
                $('#DeleteBoardModal').modal('hide');
                fetchBoards();
            },
            error: function (error) {
                console.log(error)
            }
        });
    });

    // Task Transactions

    var EditTaskRightBar = function () {
        var _element;
        var _offcanvasObject;

        var _init = function () {
            var header = KTUtil.find(_element, '.offcanvas-header');
            var content = KTUtil.find(_element, '.offcanvas-content');

            _offcanvasObject = new KTOffcanvas(_element, {
                overlay: true,
                baseClass: 'offcanvas',
                placement: 'right',
                closeBy: 'edit_task_rightbar_close',
                toggleBy: 'edit_task_rightbar_toggle'
            });

            KTUtil.scrollInit(content, {
                disableForMobile: true,
                resetHeightOnDestroy: true,
                handleWindowResize: true,
                height: function () {
                    var height = parseInt(KTUtil.getViewPort().height);

                    if (header) {
                        height = height - parseInt(KTUtil.actualHeight(header));
                        height = height - parseInt(KTUtil.css(header, 'marginTop'));
                        height = height - parseInt(KTUtil.css(header, 'marginBottom'));
                    }

                    if (content) {
                        height = height - parseInt(KTUtil.css(content, 'marginTop'));
                        height = height - parseInt(KTUtil.css(content, 'marginBottom'));
                    }

                    height = height - parseInt(KTUtil.css(_element, 'paddingTop'));
                    height = height - parseInt(KTUtil.css(_element, 'paddingBottom'));

                    height = height - 2;

                    return height;
                }
            });
        }

        // Public methods
        return {
            init: function () {
                _element = KTUtil.getById('EditTaskRightBar');

                if (!_element) {
                    return;
                }

                // Initialize
                _init();
            },

            getElement: function () {
                return _element;
            }
        };
    }();
    EditTaskRightBar.init();

    $(document).delegate('.boardTaskAdder', 'keypress', function (e) {
        if (e.which === 13) {
            var board_id = $(this).data('board-id');
            var name = $(this).val();

            if (board_id == null || board_id === '') {
                toastr.error('Pano Seçiminde Bir Hata Oluştu. Sayfayı Yenileyip Tekrar Deneyin');
            } else if (name == null || name === '') {

            } else {
                $.ajax({
                    type: 'post',
                    url: '{{ route('ajax.task.save') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        auth_user_id: '{{ auth()->id() }}',
                        board_id: board_id,
                        name: name
                    },
                    success: function (response) {
                        // console.log(response)
                        fetchBoards();
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            }
        }
    });

    $('#edit_task_name').focusout(function () {
        var name = $(this).val();
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.task.update') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: taskId.val(),
                params: {
                    name: name
                }
            },
            success: function () {
                fetchBoards();
            },
            error: function (error) {
                console.log(error)
            }
        });
    });

    $('#edit_task_start_date').focusout(function () {
        var start_date = $(this).val();
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.task.update') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: taskId.val(),
                params: {
                    start_date: start_date
                }
            }
        });
    });

    $('#edit_task_end_date').focusout(function () {
        var end_date = $(this).val();
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.task.update') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: taskId.val(),
                params: {
                    end_date: end_date
                }
            }
        });
    });

    editTaskPriorityId.change(function () {
        var priority_id = $(this).val();
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.task.update') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: taskId.val(),
                params: {
                    priority_id: priority_id
                }
            },
            success: function () {
                fetchBoards();
            }
        });
    });

    editTaskMilestoneId.change(function () {
        var milestone_id = $(this).val();
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.task.update') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: taskId.val(),
                params: {
                    milestone_id: milestone_id
                }
            }
        });
    });

    requester_id.change(function () {
        var requester_type = 'App\\Models\\User';
        var requester_id = $(this).val();
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.task.update') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: taskId.val(),
                params: {
                    requester_type: requester_type,
                    requester_id: requester_id,
                }
            }
        });
    });

    $('#edit_task_description').focusout(function () {
        var description = $(this).val();
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.task.update') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: taskId.val(),
                params: {
                    description: description
                }
            }
        });
    });

    $(document).delegate('.taskTitle', 'click', function () {
        $('#edit_task_rightbar_toggle').click();
        $('.rightBarLoader').show();
        $('.rightBarContent').hide();
        $.ajax({
            type: 'get',
            url: '{{ route('ajax.task.show') }}',
            data: {
                id: taskId.val()
            },
            success: function (response) {
                var avatar = '{{ asset('assets/media/logos/avatar.jpg') }}';
                var baseAsset = '{{ asset('') }}';
                $('#edit_task_name').val(response.name);
                $('#edit_task_start_date').val(response.start_date);
                $('#edit_task_end_date').val(response.end_date);
                editTaskPriorityId.val(response.priority_id).selectpicker('refresh');
                editTaskMilestoneId.val(response.milestone_id).selectpicker('refresh');
                $('#edit_task_creator').html(response.creator ? response.creator.name : '--');
                requester_id.val(response.requester_id).selectpicker('refresh');
                $('#edit_task_description').val(response.description);
                editTaskSubtasks.empty();
                $.each(response.sub_tasks, function (subTask) {
                    editTaskSubtasks.append(`
                    <div class="row mt-n3" id="sub_task_row_${response.sub_tasks[subTask].id}">
                        <div class="col-xl-1">
                            <label class="checkbox checkbox-circle checkbox-success">
                                <input type="checkbox" class="SubTaskCheckbox" data-id="${response.sub_tasks[subTask].id}" ${response.sub_tasks[subTask].checked === 1 ? 'checked' : ''}/>
                                <span></span>
                            </label>
                        </div>
                        <div class="col-xl-9 ml-n6 mt-2">
                            <input id="sub_task_input_${response.sub_tasks[subTask].id}" style="color:gray; font-size: 15px; border: none; background: transparent" type="text" class="form-control form-control-sm SubTaskInput" data-id="${response.sub_tasks[subTask].id}" value="${response.sub_tasks[subTask].name}">
                        </div>
                       <div class="col-xl-2 mt-6 ml-n5">
                           <i class="fa fa-times-circle text-danger cursor-pointer SubTaskDelete" data-id="${response.sub_tasks[subTask].id}"></i>
                       </div>
                    </div>
                    `);
                });
                commentsRow.empty();
                $.each(response.comments, function (i, comment) {
                    commentsRow.append(`
                        <div class="mb-10">
                        	<div class="d-flex align-items-center">
                        		<div class="symbol symbol-45 symbol-light mr-5">
                        			<img src="${avatar}" class="h-50 align-self-center" alt="" />
                        		</div>
                        		<div class="d-flex flex-column flex-grow-1">
                        			<a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">${comment.creator.name}</a>
                        			<span class="text-muted font-weight-bold">${reformatDatetime(comment.created_at)}</span>
                        		</div>
                        	</div>
                        	<p class="text-dark-50 m-0 pt-5 font-weight-normal">${comment.comment}</p>
                        </div>
                        `);
                });
                filesRow.empty();
                $.each(response.files, function (i, file) {
                    filesRow.append(`
                    <div class="card ml-3 p-0" id="file_${file.id}">
                        <div class="card-body p-0">
                            <i class="fa fa-times-circle ml-6 mt-n2 text-danger cursor-pointer fileDeleteIcon" style="position: absolute" data-id="${file.id}"></i>
                            <a href="${baseAsset}${file.path}/${file.name}" title="${file.name}" download="">
                                <i class="${file.icon} fa-3x" data-toggle="tooltip" data-placement="top"></i>
                            </a>
                        </div>
                    </div>
                    `);
                });
                $('.rightBarLoader').hide();
                $('.rightBarContent').show();
            },
            error: function (error) {
                console.log(error)
            }
        });
    });

    $('#DeleteTaskButton').click(function () {
        $.ajax({
            type: 'delete',
            url: '{{ route('ajax.task.drop') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: taskId.val()
            },
            success: function () {
                $('#edit_task_rightbar_toggle').click();
                fetchBoards();
            }
        });
    });

    SubmitCommentButton.click(function () {
        var creator_id = '{{ auth()->id() }}';
        var creator_type = 'App\\Models\\User';
        var relation_id = taskId.val();
        var relation_type = 'App\\Models\\Task';
        var comment = $('#comment').val();

        $.ajax({
            type: 'post',
            url: '{{ route('ajax.project.comment.create') }}',
            data: {
                creator_id: creator_id,
                creator_type: creator_type,
                relation_id: relation_id,
                relation_type: relation_type,
                comment: comment,
            },
            success: function (comment) {
                var avatar = '{{ asset('assets/media/logos/avatar.jpg') }}';
                commentsRow.prepend(`
                        <div class="mb-10">
                        	<div class="d-flex align-items-center">
                        		<div class="symbol symbol-45 symbol-light mr-5">
                        			<img src="${avatar}" class="h-50 align-self-center" alt="" />
                        		</div>
                        		<div class="d-flex flex-column flex-grow-1">
                        			<a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">${comment.creator.name}</a>
                        			<span class="text-muted font-weight-bold">${reformatDatetime(comment.created_at)}</span>
                        		</div>
                        	</div>
                        	<p class="text-dark-50 m-0 pt-5 font-weight-normal">${comment.comment}</p>
                        </div>
                        `);
                $("#comment").val(null);
                toastr.success('Başarıyla Yorum Yapıldı');
            },
            error: function () {

            }
        });
    });

    $(document).delegate('#taskFileAddIcon', 'click', function () {
        $('#taskFile').trigger('click');
    });

    $(document).delegate('#taskFile', 'change', function () {
        var data = new FormData();
        data.append('uploader_id', '{{ auth()->id() }}');
        data.append('uploader_type', 'App\\Models\\User');
        data.append('relation_id', taskId.val());
        data.append('relation_type', 'App\\Models\\Task');
        data.append('file', $('#taskFile')[0].files[0] ?? null);

        $.ajax({
            processData: false,
            contentType: false,
            type: 'post',
            url: '{{ route('ajax.file.create') }}',
            data: data,
            success: function (file) {
                var baseAsset = '{{ asset('') }}';
                filesRow.append(`
                    <div class="card ml-3 p-0" id="file_${file.id}">
                        <div class="card-body p-0">
                            <i class="fa fa-times-circle ml-6 mt-n2 text-danger cursor-pointer fileDeleteIcon" style="position: absolute" data-id="${file.id}"></i>
                            <a href="${baseAsset}${file.path}/${file.name}" title="${file.name}" download="">
                                <i class="${file.icon} fa-3x" data-toggle="tooltip" data-placement="top"></i>
                            </a>
                        </div>
                    </div>
                    `);
            },
            error: function (error) {
                toastr.error('Dosya Yüklenirken Sistemsel Bir Hata Oluştu!');
                console.log(error)
            }
        });
    });

    $(document).delegate('.fileDeleteIcon', 'click', function () {
        var id = $(this).data('id');
        $.ajax({
            type: 'delete',
            url: '{{ route('ajax.file.drop') }}',
            data: {
                id: id
            },
            success: function () {
                $(`#file_${id}`).remove();
            },
            error: function (error) {
                console.log(error)
            }
        });
    });

    // SubTask Transactions

    $('#CreateSubTaskIcon').click(function () {
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.subTask.save') }}',
            data: {
                _token: '{{ csrf_token() }}',
                task_id: taskId.val(),
                name: ''
            },
            success: function (response) {
                editTaskSubtasks.append(`
                    <div class="row mt-n3" id="sub_task_row_${response.id}">
                        <div class="col-xl-1">
                            <label class="checkbox checkbox-circle checkbox-success">
                                <input type="checkbox" class="SubTaskCheckbox" data-id="${response.id}" ${response.checked === 1 ? 'checked' : ''}/>
                                <span></span>
                            </label>
                        </div>
                        <div class="col-xl-9 ml-n8 mt-2">
                            <input id="sub_task_input_${response.id}" style="color:gray; font-size: 15px; border: none; background: transparent" type="text" class="form-control form-control-sm SubTaskInput" data-id="${response.id}" value="${response.name ?? ''}">
                        </div>
                       <div class="col-xl-2 mt-6 ml-n5">
                           <i class="fa fa-times-circle text-danger cursor-pointer SubTaskDelete" data-id="${response.id}"></i>
                       </div>
                    </div>
                    `);
                var subTaskClass = response.checked === 1 ? 'fa fa-check-circle text-success' : 'fa fa-dot-circle text-warning';
                $('#task_sublist_control_' + response.task_id).append(`
                    <div class="col-xl-12 m-1" id="sub_task_id_${response.id}">
                        <i id="sub_task_icon_id_${response.id}" class="${subTaskClass}"></i>
                        <span class="ml-3" id="sub_task_name_id_${response.id}">${response.name ?? ''}</span>
                    </div>
                `);
                $('#sub_task_input_' + response.id).focus();
            },
            error: function (error) {
                console.log(error)
            }
        });
    });

    $(document).delegate('.SubTaskInput', 'focusout', function () {
        var id = $(this).data('id');
        var name = $(this).val();
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.subTask.updateName') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                name: name
            },
            success: function () {
                $('#sub_task_name_id_' + id).html(name);
            }
        });
    });

    $(document).delegate('.SubTaskCheckbox', 'click', function () {
        var id = $(this).data('id')
        $.ajax({
            type: 'post',
            url: '{{ route('ajax.subTask.setChecked') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id
            },
            success: function (response) {
                $('#sub_task_icon_id_' + id).removeClass().addClass(
                    response.checked === true || response.checked === 1 ?
                        'fa fa-check-circle text-success' :
                        'fa fa-dot-circle text-warning'
                );
            },
            error: function (error) {
                console.log(error)
            }
        });
    });

    $(document).delegate('.SubTaskDelete', 'click', function () {
        var id = $(this).data('id')
        $.ajax({
            type: 'delete',
            url: '{{ route('ajax.subTask.delete') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id: id
            },
            success: function () {
                $('#sub_task_id_' + id).remove();
                $('#sub_task_row_' + id).remove();
            }
        });
    });

    $(document).delegate(".sublistToggleIcon", "click", function () {
        $("#sublist_" + $(this).data('id')).slideToggle();
    });

</script>
