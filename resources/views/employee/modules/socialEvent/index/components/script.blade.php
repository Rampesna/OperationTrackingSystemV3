{{--<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplelightbox/2.14.2/simple-lightbox.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var timelineBody = $('#timelineBody');

    // var lightbox = $('.gallery a').simpleLightbox({
    //
    // });

    var lightbox = new SimpleLightbox('.gallery a', { /* options */ });

    // getSocialEvents();

</script>
