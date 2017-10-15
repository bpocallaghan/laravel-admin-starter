@extends('layouts.auth')

@section('content')
    <div class="row body">
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="margin-top-20">
                @include('alert::alert')
            </div>

            <h2 class="page-header">Sign In</h2>

            <form action="/auth/login" accept-charset="UTF-8" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                <div class="form-group {{ form_error_class('email', $errors) }}">
                    <label>Email Address</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="id-email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    </div>
                    {!! form_error_message('email', $errors) !!}
                </div>

                <div class="form-group {{ form_error_class('password', $errors) }}">
                    <label>Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="id-password" name="password" placeholder="Password" value="{{ old('password') }}">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    </div>
                    {!! form_error_message('password', $errors) !!}
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="checkbox">
                            <label class="checkbox">
                                <input type="checkbox" name="remember" checked="checked">
                                <i></i>Stay signed in
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <a class="btn btn-link padding-left-0" href="{{ route('forgot-password') }}">Forgot
                            Password?</a>
                    </div>
                    <div class="col-xs-4 text-right">
                        <button type="submit" class="btn btn-primary btn-flat btn-submit">
                            Sign In
                            <i class="fa fa-sign-in"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
