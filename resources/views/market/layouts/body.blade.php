<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

    @include('market.layouts.navbar')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            @yield('subheader')
        </div>

        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>


    @include('market.layouts.footer')

</div>
