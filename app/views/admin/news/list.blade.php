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

        </div>

        <hr>
        <div class="table-responsive">
            <table class="table table-hover table-striped" cellspacing="0" width="100%" data-table>
                <thead>
                    <tr>
                        <th width="5%" class="text-center">
                            POS
                        </th>
                        <th>T&iacute;tlulo</th>
                        <th width="10%">Creado</th>
                        <th class="hidden-xs" width="10%">Actualizado</th>
                        <th width="5%">Publicado</th>
                        <th class="hidden-xs" width="10%">Acciones</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th width="7%" class="text-center">
                            POS
                        </th>
                        <th>T&iacute;tlulo</th>
                        <th width="10%">Creado</th>
                        <th class="hidden-xs" width="10%">Actualizado</th>
                        <th width="5%">Publicado</th>
                        <th class="hidden-xs" width="10%">Acciones</th>
                    </tr>
                </tfoot>

                <tbody>
                    @if (count($news))
                        @foreach ($news as $p)
                            <tr>
                                <td width="7%" class="text-center">
                                    <select class="position form-control" data-id="{{$p->id}}">
                                        @for($i = 1; $i < $countNews + 1; $i++)
                                            <option <?= $i == $p->position ? 'selected' : ''?>>#{{$i}}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td>
                                    <a href="<?=route('admin.news.get', ['id' => $p->id])?>">{{$p->title}}</a>
                                </td>
                                <td>{{ date("d/m/Y", strtotime($p->created_at)) }}</td>
                                <td class="hidden-xs" >{{ date("d/m/Y", strtotime($p->updated_at)) }}</td>
                                <td align="center">
                                    <button data-value="{{$p->active}}" data-id="{{$p->id}}" class="activateDeactivate btn glyphicon glyphicon-{{ $p->active == 'Y' ? 'ok color-green' : 'remove color-red'}}"></button>
                                </td>
                                <td width="15%">
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-primary"><a href="<?=route('admin.news.get', ['id' => $p->id])?>" style="color:#FFFFFF"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</a></button>
                                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?=route('admin.news.delete', ['id' => $p->id])?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Borrar</a></li>
                                      </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('scripts')
<script>
    $(function(){
        $(".activateDeactivate").click(function(){
            var button = $(this);
            var id = button.data("id");
            var value = button.data("value");
            $.ajax({
              method: 'POST',
              url: "http://local.adverit.com/bayer_comunicacion_interna/admin/novedades/activarDesactivar",
              data: {id : id}
            }).done(function() {
              if(value == 'Y'){
                    button.data("value", 'N');
                    button.removeClass('glyphicon-ok color-green').addClass('glyphicon-remove color-red btn-danger');
                    setTimeout(function(){
                        button.removeClass('btn-danger');
                    }, 400);
                }else{
                    button.data("value", 'Y');
                    button.removeClass('glyphicon-remove color-red').addClass('glyphicon-ok color-green btn-success');
                    setTimeout(function(){
                        button.removeClass('btn-success');
                    }, 400);
                }
            });
        });
    
        $(".position").on('change', function() {
          var select = $(this);
          var id = select.data('id');
          var selected = select.children("option:selected");
          var position = selected.val();
          $.ajax({
              method: 'POST',
              url: "http://local.adverit.com/bayer_comunicacion_interna/admin/novedades/actualizarPosicion",
              data: {id : id, position : position}
            }).done(function() {
              location.reload();
            });
        });

    });
</script>
@stop