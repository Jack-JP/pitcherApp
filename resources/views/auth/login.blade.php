@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- NIEUWE LOGIN    -->













<div class="row">
  <div class="container" style="margin-top:30px">
<div class="col-md-4 col-md-offset-4">
  <div class="panel panel-default">
    <div class="panel-body">
      <form role="form">
        <div class="form-group">
          <label for="exampleInputEmail1" class="sr-only">Email address</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="email" class="form-control" id="exampleInputEmail1"
              placeholder="Enter username or email">
          </div>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1" class="sr-only">Password</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" class="form-control" id="exampleInputPassword1"
              placeholder="Password">
          </div>
          <a href="#" class="pull-right small">Forgot password?</a>
        </div>
        <div class="checkbox">
          <label>
          <input type="checkbox"> Stay signed in
          </label>
        </div>
        <button type="button" onclick="window.location.href='http://www.polysnipp.com/main_category/bootstrap-snippets'" class="btn btn-success btn-sm">Sign in</button>
        <button type="button" onclick="window.location.href='http://www.polysnipp.com/main_category/bootstrap-snippets'" class="btn btn-primary btn-sm">Create account</button>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>












@endsection
