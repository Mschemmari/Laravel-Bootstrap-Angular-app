@extends('layouts.default')
@section('content')
<div class=" encabezado">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1>Multimedia <span> | Videos</span></h1>
        <hr>
    </div>
</div>
<div class="container videos encabezado">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 video">
            <h1>Movento Plus se lanzó en el NEA</h1>
            <img src="{{URL::asset('images/test1.jpg');}}" class="img-responsive img-thumbnail">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 calificacion-Nota">
                <div class="col-xs-9 col-sm-8 col-md-8 col-lg-8 puntos">
                    <p>Calificar este video</p>
                    <ul class="list-inline">
                        <li><img src="{{URL::asset('images/estrella.jpg');}}"></li>
                        <li><img src="{{URL::asset('images/estrella.jpg');}}"></li>
                        <li><img src="{{URL::asset('images/estrella.jpg');}}"></li>
                        <li><img src="{{URL::asset('images/estrella_sin.jpg');}}"></li>
                        <li><img src="{{URL::asset('images/estrella_sin.jpg');}}"></li>
                    </ul>
                </div>
                <div class="col-xs-3 col-sm-4 col-md-4 col-lg-4">
                    <a href=""><span class="pull-right"><img src="{{URL::asset('images/volver.png');}}"></span><span class="pull-right">Volver</span></a>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 relacionados">
            <h3><span class="glyphicon glyphicon-link" aria-hidden="true"></span>Links relacionados</h3>
            <div class="novedad-thumb col-xs-5 col-sm-12 col-md-12 col-lg-12">
                <img src="{{URL::asset('images/test2.jpg');}}" class="img-responsive">
                <h4 class="text-center">Movento Plus se lanzó en el NEA</h4>
            </div>
            <div class="novedad-thumb col-xs-5 col-sm-12 col-md-12 col-lg-12">
                <img src="{{URL::asset('images/test2.jpg');}}" class="img-responsive">
                <h4 class="text-center">Movento Plus se lanzó en el NEA</h4>
            </div>
            <div class="novedad-thumb col-xs-5 col-sm-12 col-md-12 col-lg-12">
                <img src="{{URL::asset('images/test2.jpg');}}" class="img-responsive">
                <h4 class="text-center">Movento Plus se lanzó en el NEA</h4>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
      $('.slider1').bxSlider({
        slideWidth: 190,
        minSlides: 2,
        maxSlides: 3,
        slideMargin: 10,
        pager:false
      });
    });
</script>
@stop