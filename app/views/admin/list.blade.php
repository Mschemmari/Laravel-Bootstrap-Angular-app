@extends('backend::layout.master')

@section('title')
    {{ format_title('Administrators') }}
@stop

@section('content')
    <div class="row">

        @if (is_root() == true)
        <div class="col-sm-12">
            <a href="{{URL::route('backend.admin.create')}}" class="btn btn-success">
                <span class="glyphicon glyphicon-plus"></span> Add admin
            </a>
        </div>
        <hr>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-striped" cellspacing="0" width="100%" data-table>
                <thead>
                    <tr>
                        <th width="5%" class="text-center">ID</th>
                        <th width="10%">Username</th>
                        <th>Email</th>
                        <th>Manages Client</th>
                        <th width="10%">Created</th>
                        <th width="10%">Updated</th>
                        <th width="5%">Active</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($admins))
                        @foreach ($admins as $a)
                            <?php
                            $client = Client::find($a->client_id);
                            ?>
                            <tr>
                                <td width="5%" class="text-center">
                                    #{{ $a->admin_id }}
                                </td>
                                <td>
                                    <a href="{{ route('backend.admin.get', ['id' => $a->admin_id]) }}">{{$a->username}}</a>
                                </td>
                                <td>
                                    {{$a->email}}
                                </td>
                                <td>
                                    <a href="#">{{$client->name}} (#{{$client->client_id}})</a>
                                </td>
                                <td>{{$a->created_at->format('Y-m-d')}}</td>
                                <td >{{$a->updated_at->format('Y-m-d')}}</td>
                                <td align="center">
                                    <span title="{{$a->active}}"  class="glyphicon glyphicon-{{$a->active == 0 ? 'remove color-red' : 'ok color-green'}}">
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop