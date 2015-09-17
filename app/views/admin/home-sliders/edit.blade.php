@extends('layout.master')

@section('title')
    {{ $title }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <a href="{{URL::route('admin.home-sliders.create')}}" class="btn btn-success">
                <span class="glyphicon glyphicon-plus"></span> A&ntilde;adir Home Slider
            </a>
            <hr>

            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab-content-info" aria-controls="tab-content-info"  data-toggle="tab">General Info.</a>
                </li>
            </ul>

            <div class="tab-content">
                <br>
                <div class="tab-pane active" id="tab-content-info">
                    @include('admin.home-sliders.form', ['slider' => $slider, 'image' => $image])
                </div>

                
            </div>
        </div>


    </div>
@stop