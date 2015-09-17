<form method="POST" enctype="multipart/form-data" action="{{ (empty($event->id)) ?URL::route('admin.events.create') : URL::route('admin.events.get', ['id' => $event->id]) }}">
    @if ($errors->has())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <span class="glyphicon glyphicon-info-sign"></span> {{ $error }}<br>
        @endforeach
    </div>
    @endif

    @if (Session::get('message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-info-sign"></span> {{ Session::get('message') }}
        </div>
    @endif

    <!-- Text input-->
    <div class="form-group">
        <label for="title">T&iacute;tulo*</label>
        <input id="title" name="title" type="text" class="form-control"  value="{{ (Input::old('title') ? Input::old('title') : $event->title ) }}">
    </div>

    <!-- Text input-->
    <div class="form-group">
        <label for="date">Fecha*</label>
        <input id="date" name="date" type="date" class="form-control"  value="{{ (Input::old('date') ? Input::old('date') : $event->date ) }}">
    </div>

    <!-- Textarea -->
    <div class="form-group">
        <label for="crest">Copete*</label>
        <textarea id="crest" name="crest" class="form-control" data-rich-text >{{ (Input::old('crest') ? Input::old('crest') : $event->crest ) }}</textarea>
         <p class="help-block">
            Máximo 250 caracteres. <br>
        </p>
    </div>

    <!-- Textarea -->
    <div class="form-group">
        <label for="text">Texto</label>
        <textarea id="text" name="text" class="form-control" data-rich-text >{{ (Input::old('text') ? Input::old('text') : $event->text ) }}</textarea>
    </div>

    <div class="form-group">
        <label for="">Published</label>
        <input type="checkbox" name="active" id="active" data-switch data-size="small" data-off-color="danger" data-on-color="success" {{ $event->active == 'Y' ? 'checked' : ''}}>
    </div>

    <!-- Button (Double) -->
    <div class="form-group clearfix">
        <div class="pull-right">
            <a name="cancel" class="btn btn-danger" href="{{route('admin.events.list')}}">Cancelar</a>
            <button id="save" name="save" class="btn btn-primary" type="submit">Guardar</button>
        </div>
    </div>
</form>