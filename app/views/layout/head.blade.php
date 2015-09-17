    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <title>@yield('title', Config::get('backend::title'))</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! CSS !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!  -->

    <!-- boostrap -->
    {{ HTML::style('backend/js/bootstrap/css/bootstrap.css') }}

    <!-- ladda -->
    {{ HTML::style('backend/js/ladda/ladda.min.css') }}

    <!-- data tables -->
    {{ HTML::style('backend/js/datatables/css/dataTables.bootstrap.css') }}

    <!-- switchs -->
    {{ HTML::style('backend/js/switch/css/bootstrap-switch.min.css') }}

    <!-- bootstrap-select -->
    {{ HTML::style('backend/js/bootstrap-select/bootstrap-select.css')}}

    <!-- pnotify -->
    {{ HTML::style('backend/js/pnotify/pnotify.custom.min.css') }}

    <!-- modal -->
    {{ HTML::style('backend/js/modal/jquery.modal.css') }}

    <!-- main theme -->
    {{ HTML::style('backend/css/backend.theme.css') }}
    <!--crop plugin-->
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/cropper/0.9.1/cropper.min.css') }}
    <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! JAVASCRIPT !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!  -->

    <!-- jquery & bootstrap -->
    {{ HTML::script('backend/js/jquery/jquery.min.js') }}
    {{ HTML::script('backend/js/jquery/jquery.checkall.js') }}
    {{ HTML::script('backend/js/bootstrap/js/bootstrap.min.js') }}

    <!-- ladda -->
    {{ HTML::script('backend/js/ladda/spin.min.js') }}
    {{ HTML::script('backend/js/ladda/ladda.min.js') }}
    {{ HTML::script('backend/js/ladda/ladda.jquery.min.js') }}

    <!-- data tables -->
    {{ HTML::script('backend/js/datatables/jquery.dataTables.min.js') }}
    {{ HTML::script('backend/js/datatables/jquery.dataTables.bootstrap.js') }}

    <!-- switchs -->
    {{ HTML::script('backend/js/switch/js/bootstrap-switch.min.js') }}

    <!-- tinymce -->
    {{ HTML::script('backend/js/tinymce/tinymce.min.js') }}
    {{ HTML::script('backend/js/tinymce/jquery.tinymce.min.js') }}

    <!-- bootstrap-select -->
    {{ HTML::script('backend/js/bootstrap-select/bootstrap-select.js') }}

    <!-- pnotify -->
    {{ HTML::script('backend/js/pnotify/pnotify.custom.min.js') }}

    <!-- modal -->
    {{ HTML::script('backend/js/modal/jquery.modal.min.js') }}

    <!-- crop -->
    {{ HTML::script('https://cdnjs.cloudflare.com/ajax/libs/cropper/0.9.1/cropper.min.js') }}


    <!-- App config and functions -->
    <script>
    var app = {
        url: "{{URL::to('/')}}/admin/"
    }
    </script>
    {{ HTML::script('backend/app.js') }}
