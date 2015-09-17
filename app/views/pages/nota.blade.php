@extends('layouts.default')
@section('content')
<div class=" encabezado">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <small><strong>Novedades</strong></small> <small>| 12/22/2014 |</small><small> 9:27am</small> 
        <hr>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 nota-bajada">
            <h1>Movento Plus se lanzó en el NEA</h1>
            <p><strong>Movento Plus, el nuevo insecticida de Bayer para algodón, se presentó en dos encuentros 
            organizados para productores y técnicos del Noreste Argentino.</strong></p>  
            <img src="{{URL::asset('images/test1.jpg');}}" class="img-responsive img-thumbnail">
            <div class="imagenes-preview">
                <div class="slider1">
                  <div class="slide slide-thumb"><img src="{{URL::asset('images/test1.jpg');}}" class="img-responsive img-thumbnail"></div>
                  <div class="slide slide-thumb"><img src="{{URL::asset('images/test1.jpg');}}" class="img-responsive img-thumbnail"></div>
                  <div class="slide slide-thumb"><img src="{{URL::asset('images/test1.jpg');}}" class="img-responsive img-thumbnail"></div>
                  <div class="slide slide-thumb"><img src="{{URL::asset('images/test1.jpg');}}" class="img-responsive img-thumbnail"></div>
                  <div class="slide slide-thumb"><img src="{{URL::asset('images/test1.jpg');}}" class="img-responsive img-thumbnail"></div>
                  <div class="slide slide-thumb"><img src="{{URL::asset('images/test1.jpg');}}" class="img-responsive img-thumbnail"></div>
                  <div class="slide slide-thumb"><img src="{{URL::asset('images/test1.jpg');}}" class="img-responsive img-thumbnail"></div>
                  <div class="slide slide-thumb"><img src="{{URL::asset('images/test1.jpg');}}" class="img-responsive img-thumbnail"></div>
                  <div class="slide slide-thumb"><img src="{{URL::asset('images/test1.jpg');}}" class="img-responsive img-thumbnail"></div>
                </div>
            </div>
            <p class="nota-contenido">Movento Plus, el nuevo insecticida de Bayer para algodón, se presentó en dos encuentros 
                organizados para productores y técnicos del Noreste Argentino.

                El primer de ellos se desarrolló en la ciudad de Roque Sáenz Peña y el restante en Santiago 
                del Estero. Ambos encuentros contaron con la disertación del especialista en zoología agrícola, 
                Oscar Ayala, quien se refirió a la problemática de plagas en el cultivo de algodón. Luego el 
                responsable de insecticidas de BCS, Rubén Meoni, realizó la presentación de Movento Plus, 
                el nuevo producto de Bayer para el control de la mosca blanca y el pulgón algodonero, entro 
                otros insectos.

                Natalia Lavena, responsable del cultivo de algodón para Cono Sur, resaltó la importancia 
                de este lanzamiento: “La empresa busca fortalecer su portfolio de soluciones para un cultivo 
                cuya demanda se ha incrementado notablemente en los últimos años. Queremos seguir 
                ofreciendo innovación a los productores de algodón y acompañarlos en esta evolución 
                del negocio con una solución integrada”.

                Las jornadas finalizaron con una kermesse especialmente diseñada para resaltar los conceptos 
                fundamentales del nuevo insecticida. </p>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 calificacion-Nota">
                <div class="col-xs-9 col-sm-8 col-md-8 col-lg-8 puntos">
                    <p>Calificar esta noticia</p>
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