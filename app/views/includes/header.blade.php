<nav class="navbar navbar-default nav-principal" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 reset">
        <img src="<?=asset('images/banner_header.jpg');?>" class="img-responsive">
    </div>
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
     <div class="collapse navbar-collapse navbar-ex1-collapse">
       <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-lg-offset-3 col-md-offset-2 col-sm-offset-1">
            <ul class="nav navbar-nav text-center">
                <li class=><a href="<?= url('/') ?>">Home</a></li>
                <li><a href="<?= url('novedades') ?>">Novedades</a></li>
                 <li class="dropdown">
                  <a href="<?= url('multimedia') ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Multimedia <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?= url('galeria_videos') ?>">Videos</a></li>
                    <li><a href="<?= url('galeria_imagenes') ?>">Imagenes creo</a></li>
                  </ul>
                </li>
            </ul>
        <span></span>
        </div>
    </div><!-- /.navbar-collapse -->
</nav>