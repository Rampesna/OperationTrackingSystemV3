<script>

    var applicationFilterer = $('#application_filter');

    applicationFilterer.keyup(function () {
        var keyword = $(this).val();
        var applications = $('.application');

        if (!keyword) {
            applications.show();
        } else {
            $.each(applications, function (i, application) {
                var applicationName = $(this).data('app-name');
                if (applicationName.toLowerCase().indexOf(keyword.toLowerCase()) === -1) {
                    $(application).hide();
                } else {
                    $(application).show();
                }
            });
        }
    });

</script>
