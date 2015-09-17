@extends('layout.basic')

@section('title')
    Login
@stop

@section('content')
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                <h1>Log in with your email account</h1>

                    @if ($errors->has('message'))
                        <div class="alert alert-danger">
                        {{ $errors->first('message') }}
                        </div>
                    @endif
                    <form action="<?=route('backend.login.post')?>" id="login-form" method="POST">
                       <div class="form-group{{ $errors->has() ? ' has-error' : '' }}">
                            <label for="username" class="sr-only">username</label>
                            <input type="username" name="username" id="username" class="form-control" placeholder="username">
                        </div>
                        <div class="form-group{{ $errors->has() ? ' has-error' : '' }}">
                            <label for="key" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>

                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
                    </form>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</section>

<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>Powered by <strong><a href="http://www.adverit.com" target="_blank">Adverit</a></strong></p>
            </div>
        </div>
    </div>
</footer>
@stop