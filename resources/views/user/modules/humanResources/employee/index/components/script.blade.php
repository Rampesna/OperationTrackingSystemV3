<script>

    var overviewPermission = `{{ checkUserPermission(111, $userPermissions) ? 'true' : 'false' }}`;

    var employees = $('#employees');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var keywordFilter = $('#keyword');
    var leaveFilter = $('#leave');
    var filterButton = $('#FilterButton');
    var clearFilterButton = $('#ClearFilterButton');
    var pageIndex = parseInt(page.html()) - 1;

    function getEmployeesByCompanyIds() {
        $('#loader').show();
        var companyIds = SelectedCompanies.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var keyword = keywordFilter.val();
        var leave = leaveFilter.val();

        $.ajax({
            type: 'get',
            url: '{{ route('user.api.employee.getByCompanyIds') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                companyIds: companyIds,
                pageIndex: pageIndex,
                pageSize: pageSize,
                keyword: keyword,
                leave: leave,
            },
            success: function (response) {
                employees.empty();
                $('#totalCountSpan').text(response.response.totalCount);
                $('#startCountSpan').text(parseInt(((pageIndex) * pageSize)) + 1);
                $('#endCountSpan').text(parseInt(parseInt(((pageIndex) * pageSize)) + 1) + parseInt(pageSize) > response.response.totalCount ? response.response.totalCount : parseInt(((pageIndex) * pageSize)) + 1 + parseInt(pageSize));
                $.each(response.response.employees, function (i, employee) {
                    var personalInformationRoute = `{{ route('user.web.humanResources.employee.personalInformation') }}/${employee.id}`;
                    employees.append(`
                    <tr>
                        <td>
                            <a ${overviewPermission === 'true' ? `href="${personalInformationRoute}"` : ``} class="cursor-pointer text-primary">${employee.name}</a>
                        </td>
                        <td>
                            ${employee.identity}
                        </td>
                        <td>
                            ${employee.email}
                        </td>
                        <td>
                            ${employee.phone}
                        </td>
                    </tr>
                    `);
                });

                if (response.response.totalCount <= (pageIndex + 1) * pageSize) {
                    pageUpButton.attr('disabled', true);
                } else {
                    pageUpButton.attr('disabled', false);
                }

                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('İş Departmanler Alınırken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    }

    getEmployeesByCompanyIds();

    SelectedCompanies.change(function () {
        getEmployeesByCompanyIds();
    });

    filterButton.click(function () {
       getEmployeesByCompanyIds();
    });

    console.log(pageIndex);
    clearFilterButton.click(function () {
        keywordFilter.val('');
        leaveFilter.val(0);
        pageIndex = 0;
        page.html(1);
        getEmployeesByCompanyIds();
    });

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
        getEmployeesByCompanyIds();
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

</script>
