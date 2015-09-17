@extends('layouts.default')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 reset">
            <div id="carousel-example-generic" class="carousel slide slider-home" data-ride="carousel">
              <!-- Indicators -->
              <!-- <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                  </ol> -->
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 slide-izq">
                      <img src="{{URL::asset('images/test1.jpg');}}" class="img-responsive" alt="...">
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                    <div class="text-izq">
                        <h3>Entrenamiento sobre Bayer SeedGrowth</h3>
                        <p> Entre los días 5 y 7 de octubre se realizó una capacitación 
                            técnica sobre Bayer SeedGrowth denominado “Train the 
                            Trainers”, en el cual participaron colaboradores de BCS 
                            de Argentina, Uruguay, Paraguay, Chile y Bolivia...
                        </p>
                        <span><a href="">Ver mas</a></span>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 slide-izq">
                      <img src="{{URL::asset('images/test1.jpg');}}" class="img-responsive" alt="...">
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">
                    <div class="text-izq">
                        <h3>Hola sobre Bayer SeedGrowth</h3>
                        <p> Entre los días 5 y 7 de octubre se realizó una capacitación 
                            técnica sobre Bayer SeedGrowth denominado “Train the 
                            Trainers”, en el cual participaron colaboradores de BCS 
                            de Argentina, Uruguay, Paraguay, Chile y Bolivia...
                        </p>
                        <span class="ver-mas"><a href="">Ver mas</a></span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Controls -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class=" flecha-left" aria-hidden="true"><img src="<?=asset('images/left.png');?>"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="flecha-right " aria-hidden="true"><img src="<?=asset('images/right.png');?>"></span>
                <span class="sr-only">Next</span>
              </a>
            </div> 
        </div><!-- Fin slider -->
    </div><!-- Fin row -->
    <!-- CUERPO -->
    <!-- SIDEBAR PARA MOBILE -->
        @include('includes.sidebar_mobile')
    <div class="row">
        <hr>
        <div class="col-xs-12 col-sm-8 col-md-7 col-lg-8 novedades">
            <button type="button" class="btn btn-primary">Novedades</button>
            <div class="novedad">
                <h3>Movento Plus se lanzó en el NEA</h3>
                <img src="http://placehold.it/690x180" class="img-responsive img-thumbnail">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <span><a href="">Ver mas</a></span>
            </div>
            <hr>
            <div class="novedad">
                <h3>Movento Plus se lanzó en el NEA</h3>
                <img src="http://placehold.it/690x180" class="img-responsive img-thumbnail">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <span><a href="">Ver mas</a></span>
            </div>
        </div>
        <!-- SIDEBAR -->
        <div class="xs-hidden col-sm-4 col-md-5 col-lg-4 novedades-sidebar hidden-xs">
            <button type="button" class="btn btn-primary">Multimedia</button>
            <div class="home-sidebar">
                <div class="botones-sidebar">
                    <button type="button" class="btn btn-primary videos activo">Videos</button>
                    <button type="button" class="btn btn-primary galeria">Imágenes</button>
                    <div class="posteos">
                        <div class="galeria-post">
                            <h4 class="text-center">El nuevo herbicida Sencorex Dúo</h4>
                            <img src="http://placehold.it/200x155" class="img-responsive img-thumbnail center-block ">
                        </div>
                        <hr>
                        <div class="galeria-post">
                            <h4 class="text-center">El nuevo herbicida Sencorex Dúo</h4>
                            <img src="http://placehold.it/200x155" class="img-responsive img-thumbnail center-block ">
                        </div>
                        <div class="mas-videos">
                            <button type="button" class="btn btn-primary  center-block">más videos</button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- fin sidebar -->
      
    </div>
</div>
@stop