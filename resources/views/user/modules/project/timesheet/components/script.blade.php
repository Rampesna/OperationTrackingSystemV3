<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var users = $('#users');

    var userIdsInput = $('#userIds');
    var projectIdsInput = $('#projectIds');

    var FilterButton = $('#FilterButton');
    var ClearFilterButton = $('#ClearFilterButton');

    function getAllUsersByTypeId() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.user.getAllByTypeId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                typeId: 2,
            },
            success: function (response) {
                userIdsInput.empty();
                $.each(response.response, function (i, user) {
                    userIdsInput.append(`<option value="${user.id}">${user.name}</option>`);
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

    function getAllProjects() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.project.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                projectIdsInput.empty();
                $.each(response.response, function (i, project) {
                    projectIdsInput.append(`<option value="${project.id}">${project.name}</option>`);
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

    function getUsers() {
        var userIds = userIdsInput.val();
        var projectIds = projectIdsInput.val();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.user.getAllWithTimesheets') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                typeId: 2,
                userIds: userIds,
                projectIds: projectIds,
            },
            success: function (response) {
                console.log(response);
                users.empty();
                $.each(response.response, function (i, user) {
                    users.append(`
                    <tr class="text-start text-gray-600 fw-bold fs-6">
                        <td class="">${user.name}</td>
                        <td class="">${user.timesheets.length > 0 ? user.timesheets[0].task.board.project.name : '--'}</td>
                        <td class="">${user.timesheets.length > 0 ? user.timesheets[0].task.name : '--'}</td>
                        <td class="hideIfMobile">${user.timesheets.length > 0 ? reformatDatetimeToDatetimeForHuman(user.timesheets[0].start_time) : '--'}</td>
                        <td class="hideIfMobile">${user.timesheets.length > 0 ? (user.timesheets[0].task.end_date ? reformatDatetimeToDateForHuman(user.timesheets[0].task.end_date) : '--') : '--'}</td>
                    </tr>
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

    getAllUsersByTypeId();
    getAllProjects();
    getUsers();

    FilterButton.click(function () {
        getUsers();
    });

    ClearFilterButton.click(function () {
        userIdsInput.val('').trigger('change');
        projectIdsInput.val('').trigger('change');
        getUsers();
    });

</script>
