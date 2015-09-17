@extends('layout.master')

@section('title')
    {{ $title }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <a href="{{URL::route('admin.news.create')}}" class="btn btn-success">
                <span class="glyphicon glyphicon-plus"></span> A&ntilde;adir Noticia
            </a>
            <hr>

            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab-content-info" aria-controls="tab-content-info"  data-toggle="tab">General Info.</a>
                </li>
                @if (! empty($news->id))
                <!--<li>
                    <a href="#tab-content-features" aria-controls="tab-content-features"  data-toggle="tab">Features</a>
                </li>-->
                @endif
            </ul>

            <div class="tab-content">
                <br>
                <div class="tab-pane active" id="tab-content-info">
                    @include('admin.news.form', ['news' => $news, 'images' => $images, 'file' => $file, 'countNews' => $countNews])
                </div>

                
            </div>
        </div>


    </div>
@stop