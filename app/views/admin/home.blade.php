@extends('layout.master')

@section('title')
    Dashboard
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <h4 class="text-uppercase">stats</h4>
        <hr>
    </div>
    <!-- products -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-asterisk btn-lg huge"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$news->count()}}</div>
                        <div class="text-uppercase">Novedades</div>
                    </div>
                </div>
            </div>
            <a href="">
                <div class="panel-footer">
                    <a href="{{route('admin.news.list')}}">
                        <span class="pull-left">View all</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-play-circle"></i></span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <!-- categories -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-picture btn-lg huge"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$albums->count()}}</div>
                        <div class="text-uppercase">Albumes</div>
                    </div>
                </div>
            </div>
            <a href="">
                <div class="panel-footer">
                    <a href="{{route('admin.albums.list')}}">
                        <span class="pull-left">View all</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-play-circle"></i></span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <!-- groups -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-play btn-lg huge"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$videos->count()}}</div>
                        <div class="text-uppercase">Videos</div>
                    </div>
                </div>
            </div>
            <a href="">
                <div class="panel-footer">
                    <a href="{{route('admin.videos.list')}}">
                        <span class="pull-left">View all</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-play-circle"></i></span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <!-- home sliders -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-th btn-lg huge"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$sliders->count()}}</div>
                        <div class="text-uppercase">Home Sliders</div>
                    </div>
                </div>
            </div>
            <a href="">
                <div class="panel-footer">
                    <a href="{{route('admin.home-sliders.list')}}">
                        <span class="pull-left">View</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-play-circle"></i></span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

     <!-- events -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="glyphicon glyphicon-time btn-lg huge"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$events->count()}}</div>
                        <div class="text-uppercase">Calendario</div>
                    </div>
                </div>
            </div>
            <a href="">
                <div class="panel-footer">
                    <a href="{{route('admin.events.list')}}">
                        <span class="pull-left">View</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-play-circle"></i></span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h4 class="text-uppercase"><!--last products updated--></h4>
        <table class="table table-hover">
            <?php
            /*$products = $products->take(15)->orderBy('updated_at', 'DESC');
            foreach ($products->get() as $p)*/
            ?>
            
            <tr>
                <td>
                    
                </td>
                <td>
                    
                </td>
            </tr>
           
        </table>

    </div>
</div>
@stop