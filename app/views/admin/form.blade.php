<form method="POST" action="{{ (empty($admin->admin_id)) ?URL::route('backend.admin.create') : URL::route('backend.admin.get', ['id' => $admin->admin_id]) }}">
    @if ($errors->has())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <span class="glyphicon glyphicon-info-sign"></span> {{ $error }}<br>
        @endforeach
    </div>
    @endif

    @if (Session::get('error'))
        <div class="alert alert-danger">
            <span class="glyphicon glyphicon-info-sign"></span> {{ Session::get('error') }}
        </div>
    @endif

    @if (Session::get('message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-info-sign"></span> {{ Session::get('message') }}
        </div>
    @endif

    <!-- Text input-->
    <div class="form-group">
        <label for="email">E-mail</label>
        <input id="email" name="email" type="text" placeholder="" class="form-control"  value="{{ (Input::old('email') ? Input::old('email') : $admin->email ) }}">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" placeholder="" class="form-control"  value="{{ (Input::old('username') ? Input::old('username') : $admin->username ) }}">
        <p class="help-block">Full username of admin</p>
    </div>

    <!-- Text input-->
    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" name="password" type="text" placeholder="New password" class="form-control"  value="">
    </div>

    <div class="form-group">
        <label for="client_id">Client</label>
        <select id="client_id" name="client_id" class="form-control" data-select >
            <option value="" selected="">Select a client</option>
            <?php
                $default_client_id = Input::old('client_id') ? Input::old('client_id') : $admin->client_id;
            ?>
            @foreach ($clients as $c)
                <option value="{{$c->client_id}}"
                        {{$c->client_id == $admin->client_id ? 'selected' : ''}}
                        data-icon="pull-right glyphicon glyphicon-{{ $c->active == 1 ? 'ok-circle color-green' : 'ban-circle color-red'}}">
                    {{$c->name}}
                </option>
                <!-- <option  value="{{$c->client_id}}"
                        {{$c->client_id == $default_client_id ? 'selected' : ''}}
                        {{$c->client_id != null ? 'disabled' : ''}}>
                    {{$c->name}} {{$c->client_id != null && $c->client_id != $admin->client_id ? '(this already assigned)' : ''}}
                </option> -->
            @endforeach
        </select>
    </div>

    @if ($admin->client_id != 1)
    <div class="form-group">
        <label for="">Active</label>
        <input type="checkbox" name="active" id="active" data-switch data-size="small" data-off-color="danger" data-on-color="success" {{ $admin->active == 1 ? 'checked' : ''}}>
        <p class="help-block">This option would leave the admin as "deleted"</p>
    </div>
    @endif

    <!-- Button (Double) -->
    <div class="form-group clearfix">
        <div class="pull-right">
            <a name="cancel" class="btn btn-danger" href="{{route('backend.admins')}}">Cancel</a>
            <button id="save" name="save" class="btn btn-primary" type="submit">Save</button>
        </div>
    </div>
</form>