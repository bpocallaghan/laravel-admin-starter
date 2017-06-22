@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

            <div class="logo"><img src="/images/logo.png"/></div>

            <div class="body">
                <h4 class="auth-title">Reset Password</h4>

                <form method="POST" action="{{ url('/auth/password/reset') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <section class="form-group {{ form_error_class('email', $errors) }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $email or old('email') }}">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        </div>
                        {!! form_error_message('email', $errors) !!}
                    </section>

                    <section class="form-group {{ form_error_class('password', $errors) }}">
                        <div class="input-group">
                            <input type="password" class="form-control" id="id-password" name="password" placeholder="Password" value="">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                        {!! form_error_message('password', $errors) !!}
                    </section>

                    <section class="form-group {{ form_error_class('password_confirmation', $errors) }}">
                        <div class="input-group">
                            <input type="password" class="form-control" id="id-password_confirmation" name="password_confirmation" placeholder="Password Confirm" value="">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                        {!! form_error_message('password_confirmation', $errors) !!}
                    </section>

                    <hr/>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-submit pull-right">
                                <i class="fa fa-refresh"></i> Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
