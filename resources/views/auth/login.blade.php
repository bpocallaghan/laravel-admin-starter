@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

            <div class="logo"><img src="/images/logo.png"/></div>

            <div class="body">
                <h4 class="auth-title">Sign in to <strong>{{ config('app.name') }}</strong></h4>

                @include('alert::alert')
                @include('admin.partials.errors')

                <form action="{{ url('/auth/login') }}" method="post" class="admin">
                    {!! csrf_field() !!}

                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                    <label class="checkbox">
                        <input type="checkbox" name="remember" checked="checked">
                        <i></i>Stay signed in
                    </label>

                    <div class="row margin-top-10">
                        <div class="col-xs-8">
                            <a class="btn btn-link" href="{{ url('/auth/password/forgot') }}" style="padding-left: 0;">Forgot Password?</a>
                        </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat btn-submit">
                                Sign In
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
