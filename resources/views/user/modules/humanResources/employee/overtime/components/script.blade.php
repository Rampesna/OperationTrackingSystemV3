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
