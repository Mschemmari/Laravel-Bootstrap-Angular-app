@extends('layouts.default')
@section('content')
<div class=" encabezado">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1>Multimedia <span>| Galeria de imágenes</span></h1>
        <hr>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 encabezado">
        <h1>Movento Plus se lanzó en el NEA</span></h1>
    </div>
</div>
<div class=" row-novedades">
    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
        <div class="novedad-thumb">
            <a href="<?= url('imagen') ?>"><img src="{{URL::asset('images/test2.jpg');}}" class="img-responsive"></a>
        </div>
    </div>

    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
        <div class="novedad-thumb">
            <a href="<?= url('imagen') ?>"><img src="{{URL::asset('images/test2.jpg');}}" class="img-responsive"></a>
        </div>
    </div>

    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
        <div class="novedad-thumb">
            <a href="<?= url('imagen') ?>"><img src="{{URL::asset('images/test2.jpg');}}" class="img-responsive"></a>
        </div>
    </div>
</div>
<div class=" row-novedades">
    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
        <div class="novedad-thumb">
            <a href="<?= url('imagen') ?>"><img src="{{URL::asset('images/test2.jpg');}}" class="img-responsive"></a>
        </div>
    </div>

    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
        <div class="novedad-thumb">
            <a href="<?= url('imagen') ?>"><img src="{{URL::asset('images/test2.jpg');}}" class="img-responsive"></a>
        </div>
    </div>

    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
        <div class="novedad-thumb">
            <a href="<?= url('imagen') ?>"><img src="{{URL::asset('images/test2.jpg');}}" class="img-responsive"></a>
        </div>
    </div>
</div>
<div class=" row-novedades">
    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
        <div class="novedad-thumb">
            <a href="<?= url('imagen') ?>"><img src="{{URL::asset('images/test2.jpg');}}" class="img-responsive"></a>
        </div>
    </div>

    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
        <div class="novedad-thumb">
            <a href="<?= url('imagen') ?>"><img src="{{URL::asset('images/test2.jpg');}}" class="img-responsive"></a>
        </div>
    </div>

    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
        <div class="novedad-thumb">
            <a href="<?= url('imagen') ?>"><img src="{{URL::asset('images/test2.jpg');}}" class="img-responsive"></a>
        </div>
    </div>
</div>


@stop