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

    function controlMobile() {
        if (detectMobile()) {
            $('#updateTaskDrawer').attr('data-kt-drawer-width', '90%');
        } else {
            $('#updateTaskDrawer').attr('data-kt-drawer-width', '900px');
        }
    }

    controlMobile();

    var updateTaskDrawerButton = $('#updateTaskDrawerButton');
    var CreateSubTaskSelectedTaskButton = $('#CreateSubTaskSelectedTaskButton');
    var CreateSubTaskSelectedTaskInput = $('#CreateSubTaskSelectedTaskInput');

    var selectedTaskSubTasksRow = $('#selectedTaskSubTasksRow');

    $(document).delegate('.kanban-item', 'mouseover', function () {
        $(this).css({
            cursor: 'default'
        });
    });

    var updateTaskNameInput = $('#update_task_name');

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
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
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
                var boards = [];
                $.each(allBoards, function (i, board) {
                    boards.push({
                        id: parseInt(board.dataset.id),
                        order: parseInt(board.dataset.order)
                    });
                });
                $.ajax({
                    type: 'post',
                    url: '{{ route('user.api.board.updateOrder') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        _token: '{{ csrf_token() }}',
                        boards: boards
                    },
                    success: function (response) {
                        var addBoard = kanban.findBoard('0');
                        if (addBoard == null) {
                            kanban.addBoards([
                                {
                                    id: '0',
                                    order: 99999,
                                    title: `
                                    <div class="row">
                                        <div id="CreateBoardButton" class="col-xl-12 bg-light-dark bg-hover-secondary text-center cursor-pointer" style="border-radius: 2rem">
                                            <span class="form-control mt-1 font-weight-bold text-dark-75" type="text" style="font-size: 12px; border: none; background: transparent">
                                                <i class="fa fa-plus fa-sm mr-2"></i>
                                                <span class="ms-2">Yeni Pano</span>
                                            </span>
                                        </div>
                                    </div>
                                    `,
                                    dragBoards: false,
                                    dragItems: false,
                                }
                            ]);
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        },
        dragendEl: function (el) {
            var allTasks = kanban.getBoardElements(el.parentNode.parentNode.dataset.id);
            var tasks = [];
            $.each(allTasks, function (i, task) {
                tasks.push({
                    id: parseInt(task.dataset.eid),
                    order: i + 1
                });
            });
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.task.updateOrder') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    _token: '{{ csrf_token() }}',
                    tasks: tasks
                },
                success: function (response) {
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
            url: '{{ route('user.api.project.getBoardsByProjectId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                projectId: parseInt('{{ $id }}'),
                management: 0
            },
            success: function (response) {
                $('.kanban-container').html('');

                var boardsList = [];
                $.each(response.response, function (i, board) {

                    var taskList = [];
                    $.each(board.tasks, function (j, task) {

                        var subTaskList = ``;
                        $.each(task.sub_tasks, function (k, subTask) {
                            var subTaskClass = subTask.checked === 1 ? 'fa fa-check-circle text-success' : 'fa fa-dot-circle text-warning';
                            subTaskList = subTaskList + `
                            <div class="col-xl-12 m-1" id="sub_task_id_${subTask.id}">
                                <i id="sub_task_icon_id_${subTask.id}" class="${subTaskClass}"></i>
                                <span class="ms-3" id="sub_task_name_id_${subTask.id}">${subTask.name}</span>
                            </div>
                            `;
                        });

                        taskList.push({
                            id: `${task.id}`,
                            class: task.priority ? ['border', `border-${task.priority.color}`] : [],
                            title: `
                                <div class="row">
                                    <div class="col-xl-10">
                                       <i class="fa fa-check-circle text-success"></i><span data-id="${task.id}" class="taskTitle cursor-pointer ms-2">${task.name}</span>
                                    </div>
                                    <div class="col-xl-1 text-right">
                                        <i class="fas fa-sort-amount-down cursor-pointer sublistToggleIcon" data-id="${task.id}"></i>
                                    </div>
                                </div>
                                <div id="sublist_${task.id}" class="taskSublist" style="display: none">
                                    <hr>
                                    <div class="row" id="task_sublist_control_${task.id}">
                                        ${subTaskList}
                                    </div>
                                </div>
                                `,
                            order: '' + task.order + '',
                            draggable: true
                        });
                    });

                    taskList.push({
                        id: 'board_' + board.id + '_task_adder',
                        title: `
                                <div class="row mt-n3 mb-n3 taskAdderSelector">
                                    <div class="col-xl-12 pl-1 pr-0">
                                       <input data-board-id="${board.id}" type="text" class="form-control form-control-sm boardTaskAdder" placeholder="+ Görev Ekle" style="border: none">
                                    </div>
                                </div>
                                `,
                        order: '' + 99999 + '',
                        draggable: false,
                        class: ['opacity-60']
                    });

                    boardsList.push({
                        id: `${board.id}`,
                        title: `
                        <div class="row">
                            <div class="col-xl-1">
                               <i class="far fa-circle fa-sm mt-5 moveTaskIcon"></i>
                            </div>
                            <div class="col-xl-9">
                               <input data-id="${board.id}" class="form-control font-weight-bold moveTaskIcon editBoardTitle" type="text" value="${board.name ?? ''}" style="color:gray; font-size: 15px; border: none; background: transparent">
                            </div>
                            <div class="col-xl-1 text-right">
                                <div class="dropdown dropdown-inline">
                                    <i class="fas fa-grip-horizontal fa-sm mt-5 cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="navi navi-hover">
                                            <li class="navi-item mt-n2 mb-n2">
                                                <a href="#" class="navi-link deleteBoard" data-id="${board.id}">
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
                        order: `${board.order}`
                    });
                });
                kanban.addBoards(boardsList);
                kanban.addBoards([
                    {
                        id: '0',
                        order: 99999,
                        title: `
                        <div class="row">
                            <div id="CreateBoardButton" class="col-xl-12 bg-light-dark bg-hover-secondary text-center cursor-pointer" style="border-radius: 2rem">
                                <span class="form-control mt-1 font-weight-bold text-dark-75" type="text" style="font-size: 12px; border: none; background: transparent">
                                    <i class="fa fa-plus fa-sm mr-2"></i>
                                    <span class="ms-2">Yeni Pano</span>
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

    function getTaskPriorities() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.taskPriority.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {

            },
            error: function () {

            }
        });
    }

    getTaskPriorities();

    // ------------------- Selected Task Functions Start -------------------

    function getSelectedTask() {
        $('#loader').show();
        var id = $('#selected_task_id').val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.task.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#update_task_name').val(response.response.name);
                $('#update_task_start_date').val(reformatDatetimeTo_YYYY_MM_DD(response.response.start_date));
                $('#update_task_end_date').val(reformatDatetimeTo_YYYY_MM_DD(response.response.end_date));
                $('#update_task_priority_id').val(response.response.priority_id);
                $('#update_task_requester_id').val(response.response.requester_id);
                $('#update_task_description').val(response.response.description);
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                $('#loader').hide();
                toastr.error('Görev Verileri Alınırken Serviste Bir Sorun Olutşu!');
                updateTaskDrawerButton.trigger('click');
            }
        });
    }

    function getSelectedTaskFiles() {
        var id = $('#selected_task_id').val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.task.getFilesById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Görev Dosyaları Alınırken Serviste Bir Sorun Olutşu!');
            }
        });
    }

    function getSelectedTaskSubTasks() {
        var id = $('#selected_task_id').val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.task.getSubTasksById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                console.log(response);

                selectedTaskSubTasksRow.empty();
                $.each(response.response, function (i, subTask) {
                    selectedTaskSubTasksRow.append(`
                    <div class="col-xl-12 mb-5">
                        <div class="input-group">
                            <button class="btn btn-icon btn-sm btn-${parseInt(subTask.checked) === 1 ? 'success' : 'warning'} setCheckedSubTaskButton" data-sub-task-id="${subTask.id}" data-sub-task-checked="${subTask.checked}">
                                <i class="fa fa-xs fa-check-circle"></i>
                            </button>
                            <input type="text" class="form-control form-control-sm form-control-solid selectedTaskSubTaskInput" data-sub-task-id="${subTask.id}" value="${subTask.name}" ${parseInt(subTask.checked) === 1 ? 'disabled' : ''} aria-label="Alt Görev Başlığı" style="border: none">
                            <button class="btn btn-icon btn-sm btn-danger deleteSubTaskButton" data-sub-task-id="${subTask.id}">
                                <i class="fa fa-sm fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Göreve Ait Alt Görevler Alınırken Serviste Bir Sorun Olutşu!');
            }
        });
    }

    function getSelectedTaskComments() {
        var id = $('#selected_task_id').val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.task.getCommentsById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Göreve Ait Yorumlar Alınırken Serviste Bir Sorun Olutşu!');
            }
        });
    }

    // ------------------- Selected Task Functions End -------------------



    // ------------------- Selected Task Transactions Start -------------------

    $(document).delegate('.taskTitle', 'click', function () {
        var taskId = $(this).data('id');
        $('#selected_task_id').val(taskId);
        getSelectedTask();
        getSelectedTaskFiles();
        getSelectedTaskSubTasks();
        getSelectedTaskComments();
        updateTaskDrawerButton.trigger('click');
    });

    updateTaskNameInput.focusout(function () {
        var id = $('#selected_task_id').val();
        var name = $(this).val();

        console.log({
            id: id,
            name: name
        });
    });

    updateTaskNameInput.keypress(function (e) {
        var id = $('#selected_task_id').val();
        var name = $(this).val();

        if (e.which === 13) {
            console.log({
                id: id,
                name: name
            });
        }
    });

    $(document).delegate(".sublistToggleIcon", "click", function () {
        $("#sublist_" + $(this).data('id')).slideToggle();
    });

    // ------------------- Selected Task Transactions End -------------------



    // ------------------- Sub Task Transactions Start -------------------

    CreateSubTaskSelectedTaskButton.click(function () {
        var taskId = $('#selected_task_id').val();
        var name = CreateSubTaskSelectedTaskInput.val();

        if (!name) {
            toastr.warning('Alt Görev Adı Boş Olamaz!');
        } else {
            CreateSubTaskSelectedTaskInput.attr('disabled', true);
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.subTask.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    taskId: taskId,
                    name: name,
                },
                success: function () {
                    CreateSubTaskSelectedTaskInput.val('');
                    CreateSubTaskSelectedTaskInput.attr('disabled', false);
                    fetchBoards();
                    getSelectedTaskSubTasks();
                },
                error: function (error) {
                    console.log(error);
                    CreateSubTaskSelectedTaskInput.attr('disabled', true);
                    toastr.error('Yeni Alt Görev Oluşturulurken Serviste Bir Sorun Olutşu!');
                }
            });
        }
    });

    $(document).delegate('.setCheckedSubTaskButton', 'click', function () {
        $(this).attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);
        var id = $(this).data('sub-task-id');
        var checked = $(this).data('sub-task-checked');
        $.ajax({
            type: 'put',
            url: '{{ route('user.api.subTask.setChecked') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
                checked: parseInt(checked) === 1 ? 0 : 1,
            },
            success: function () {
                fetchBoards();
                getSelectedTaskSubTasks();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Alt Görev Silinirken Serviste Bir Sorun Olutşu!');
            }
        });
    });

    $(document).delegate('.selectedTaskSubTaskInput', 'focusout', function () {
        var id = $(this).data('sub-task-id');
        var name = $(this).val();

        if (!name) {
            toastr.warning('Alt Görev Adı Boş Olamaz! Değişiklikler Kaydedilmedi!');
        } else {
            $(this).attr('disabled', true);
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.subTask.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    name: name,
                },
                success: function () {
                    fetchBoards();
                    getSelectedTaskSubTasks();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Alt Görev Güncellenirken Serviste Bir Sorun Olutşu!');
                }
            });
        }
    });

    $(document).delegate('.selectedTaskSubTaskInput', 'keypress', function (e) {
        if (e.which === 13) {
            var id = $(this).data('sub-task-id');
            var name = $(this).val();

            if (!name) {
                toastr.warning('Alt Görev Adı Boş Olamaz! Değişiklikler Kaydedilmedi!');
            } else {
                $(this).attr('disabled', true);
                $.ajax({
                    type: 'put',
                    url: '{{ route('user.api.subTask.update') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        id: id,
                        name: name,
                    },
                    success: function () {
                        fetchBoards();
                        getSelectedTaskSubTasks();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Alt Görev Güncellenirken Serviste Bir Sorun Olutşu!');
                    }
                });
            }
        }
    });

    $(document).delegate('.deleteSubTaskButton', 'click', function () {
        $(this).attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);
        var id = $(this).data('sub-task-id');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.subTask.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                fetchBoards();
                getSelectedTaskSubTasks();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Alt Görev Silinirken Serviste Bir Sorun Olutşu!');
            }
        });
    });

    CreateSubTaskSelectedTaskInput.on('keypress', function (e) {
        if (e.which === 13) {
            CreateSubTaskSelectedTaskButton.trigger('click');
        }
    });

    // ------------------- Sub Task Transactions End -------------------

</script>
