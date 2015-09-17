@extends('backend::layout.master')


@section('title')
    @if (! empty($admin->admin_id))
        {{ format_title('Edit '. $admin->username) }}
    @else
        {{ format_title('Create admin') }}
    @endif
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">

            <ol class="breadcrumb">
                <li>
                    <a href="<?=route('backend.admins')?>">Admins</a>
                </li>
                <li class="active">
                    <a href="<?=route('backend.admin.get', ['id' => $admin->admin_id])?>">{{$admin->username}}</a>
                </li>
            </ol>
            <hr>

            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab-content-info" aria-controls="tab-content-info"  data-toggle="tab">General Info.</a>
                </li>
            </ul>

            <div class="tab-content">
                <br>
                <div class="tab-pane active" id="tab-content-info">
                    @include('backend::admin.form', ['admin' => $admin, 'clients' => $clients])
                </div>
            </div>
        </div>


    </div>
@stop