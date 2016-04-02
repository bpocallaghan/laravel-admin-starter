@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">

            <div class="logo"><img src="/images/logo.png"/></div>

            <div class="body">
                <h4 class="auth-title">Register at <strong>{{ env('APP_TITLE') }}</strong></h4>

                <!--@include('admin.partials.errors')-->

                <form id="form-member-register" method="POST" action="{{ url('/auth/register') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="row">
                        <div class="col col-6">
                            <section class="form-group {{ form_error_class('firstname', $errors) }}">
                                <div class="input-group">
                                    <input type="text" name="firstname" class="form-control" placeholder="Firstname" value="{{ old('firstname') }}">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                </div>
                                {!! form_error_message('firstname', $errors) !!}
                            </section>
                        </div>

                        <div class="col col-6">
                            <section class="form-group {{ form_error_class('lastname', $errors) }}">
                                <div class="input-group">
                                    <input type="text" name="lastname" class="form-control" placeholder="Lastname" value="{{ old('lastname') }}">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                </div>
                                {!! form_error_message('lastname', $errors) !!}
                            </section>
                        </div>
                    </div>

                    <section class="form-group {{ form_error_class('email', $errors) }}">
                        <div class="input-group">
                            <input type="text" class="form-control" id="id-email" name="email" placeholder="Email Address" value="{{ isset($email)? $email : old('email') }}">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        </div>
                        {!! form_error_message('email', $errors) !!}
                    </section>

                    <section class="form-group {{ form_error_class('password', $errors) }}">
                        <div class="input-group">
                            <input type="password" class="form-control" id="id-password" name="password" placeholder="Password" value="{{ old('password') }}">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                        {!! form_error_message('password', $errors) !!}
                    </section>

                    <section class="form-group {{ form_error_class('password_confirmation', $errors) }}">
                        <div class="input-group">
                            <input type="password" class="form-control" id="id-password_confirmation" name="password_confirmation" placeholder="Password Confirm" value="{{ old('password_confirmation') }}">
                            <span class="input-group-addon"><i class="fa fa-sign-in"></i></span>
                        </div>
                        {!! form_error_message('password_confirmation', $errors) !!}
                    </section>

                    <section class="form-group">
                        <label>Gender</label>
                        <div class="inline-group">
                            <label class="radio" style="margin-top: 0px;">
                                <input type="radio" name="gender" value="male" checked="checked">
                                <i></i>Male
                            </label>
                            <label class="radio" style="margin-top: 0px;">
                                <input type="radio" name="gender" value="female">
                                <i></i>Female
                            </label>
                        </div>
                    </section>


                    <div class="form-footer" style="padding-bottom: 0px;">
                        <button type="submit" class="btn btn-primary btn-submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
