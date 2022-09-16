<script src="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var GetTimesheetsButton = $('#GetTimesheetsButton');

    function getTimesheets() {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        if (!startDate) {
            toastr.warning('Lütfen başlangıç tarihi seçiniz.');
        } else if (!endDate) {
            toastr.warning('Lütfen bitiş tarihi seçiniz.');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.timesheet.getDateBetween') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    startDate: startDate,
                    endDate: endDate
                },
                success: function (response) {

                    console.log(response);

                    var order = 1;
                    var users = [];
                    var dataSet = [];
                    $.each(response.response, function (i, timesheet) {
                        if (users.findIndex(user => parseInt(user.id) === parseInt(timesheet.starter.id)) === -1) {
                            users.push({
                                id: timesheet.starter.id,
                                name: timesheet.starter.name,
                                content: timesheet.starter.name,
                                order: order
                            });
                        }

                        dataSet.push({
                            id: timesheet.id,
                            group: timesheet.starter.id,
                            start: new Date(timesheet.start_time),
                            end: timesheet.end_time ? new Date(timesheet.end_time) : new Date(),
                            content: `<span class="fw-bolder">Proje: </span>${timesheet.task.board.project.name}, <span class="fw-bolder">Görev: </span>${timesheet.task.name}`,
                            type: "range",
                            progress: "100%",
                            color: timesheet.end_time ? "success" : "warning",
                            users: []
                        });

                        order++;
                    });

                    const element = document.querySelector("#activeTimesheets");
                    element.innerHTML = "";
                    var groups = new vis.DataSet(users),
                        items = new vis.DataSet(dataSet),
                        options = {
                            stack: 1,
                            progress: !1,
                            zoomable: 1,
                            moveable: 1,
                            selectable: !1,
                            margin: {
                                item: {
                                    horizontal: 10,
                                    vertical: 35
                                }
                            },
                            showCurrentTime: !1,
                            xss: {
                                disabled: !1,
                                filterOptions: {
                                    whiteList: {
                                        div: ["class", "style"],
                                        img: ["src", "alt"],
                                        a: ["href", "class"],
                                        span: ["class", "style"],
                                    }
                                }
                            },
                            template: function (e) {
                                return `
                            <div class="rounded-pill bg-light-${e.color} d-flex align-items-center position-relative h-40px w-100 p-2 overflow-hidden">
                                <div class="position-absolute rounded-pill d-block bg-${e.color} start-0 top-0 h-100 z-index-1" style="width: ${e.progress};"></div>
                                <div class="d-flex align-items-center position-relative z-index-2">
                                    <a href="#" class="ms-5 fw-bold text-white text-hover-dark">${e.content}</a>
                                </div>
                            </div>
                            `
                            }
                        };
                    const timelineVisualizer = new vis.Timeline(element, items, groups, options);
                    timelineVisualizer.on("currentTimeTick", (() => {
                        timelineVisualizer.off("currentTimeTick")
                    }))
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
    }

    GetTimesheetsButton.click(function () {
        getTimesheets();
    });

</script>
