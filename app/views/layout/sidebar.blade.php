<?php
function is_active($route, $class = 'active')
{
    if (is_array($route)) {
        foreach ($route as $r) {
            if (Request::is($r)) {
                return $class;
            }
        }

        return '';
    }

    return Request::is($route) ? $class : '';
}
?>
        <!-- Menu -->
        <div id="side-menu">

            <nav class="navbar navbar-backend" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <div class="brand-wrapper">
                        <!-- Hamburger -->
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Brand -->
                        <div class="brand-name-wrapper">
                            <a class="navbar-brand" href="#">
                                ADMIN
                            </a>
                            <br><small style="color:#FFFFFF">Esto est&aacute; pasando</small>
                        </div>
                    </div>
                </div>

                <!-- Main Menu -->
                <div id="side-menu-container">
                    <ul class="nav navbar-nav">

                        <li class="<?=is_active('admin')?>"><a href="<?=route('backend.home')?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>

                        <!-- Novedades-->
                        <li class="<?=is_active('admin/novedades/*')?>"><a href="<?=route('admin.news.list')?>"><span class="glyphicon glyphicon-asterisk"></span> Novedades</a></li>

                        <!-- Albums-->
                        <li class="<?=is_active('admin/galeria-imagenes/*')?>"><a href="<?=route('admin.albums.list')?>"><span class="glyphicon glyphicon-picture"></span> Galer&iacute;as de Im&aacute;genes</a></li>

                        <!-- Videos-->
                        <li class="<?=is_active('admin/galeria-videos/*')?>"><a href="<?=route('admin.videos.list')?>"><span class="glyphicon glyphicon-play"></span> Galer&iacute;as de Videos</a></li>

                        <!-- Home Sliders-->
                        <li class="<?=is_active('admin/home-sliders/*')?>"><a href="<?=route('admin.home-sliders.list')?>"><span class="glyphicon glyphicon-th"></span> Home Sliders</a></li>

                        <!-- Events-->
                        <li class="<?=is_active('admin/calendario-eventos/*')?>"><a href="<?=route('admin.events.list')?>"><span class="glyphicon glyphicon-time"></span> Calendario</a></li>
                    

                        

                        
                        <!-- System -->
                        <!--<li class="panel panel-default <?=is_active(['admin/client*', 'admin/admin*'])?>" id="dropdown">
                            <a data-toggle="collapse" href="#dropdown-system">
                                <span class="glyphicon glyphicon-cog"></span> System <span class="caret"></span>
                            </a>

                            <div id="dropdown-system" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li class="<?=is_active('admin/admin*')?>"><a href="<?/*=route('backend.admins')*/?>">Admins</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>-->
                        
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>

        </div>