<!DOCTYPE html>
<html manifest="">
<head>
    @include('layout.head')
    @yield('scripts')
</head>
<body>
    <div class="row">
        <div class="absolute-wrapper"> </div>

        @include('layout.sidebar')

        <div class="container-fluid" style="background-color: #E8EBF0;">
            <nav id="top-menu" class="navbar navbar-default">
                <p class="navbar-text pull-left">
                    <a href="<?=url(Auth::user()->domain)?>?fs=b" target="_blank">
                        <span class="glyphicon glyphicon-chevron-right"></span> Visualizar sitio
                    </a>
                </p>
                <p class="navbar-text pull-right">Bienvenido, <strong><?=Auth::user()->username?></strong> <a href="<?=url('logout')?>">¿Cerrar sesi&oacute;n?</a></p>
            </nav>

            <div id="side-title">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <h1>{{$title or 'Dashboard'}}</h1>
                    </div>
                </div>
            </div>

            <div id="side-body">
                <div id="content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
</html>
