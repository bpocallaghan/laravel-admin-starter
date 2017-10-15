@extends('layouts.auth')

@section('content')
    <div class="row body">
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <h2 class="page-header">Register</h2>

            <form id="form-member-register" method="POST" action="/auth/register" accept-charset="UTF-8">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" name="token" value="{{ $userInvite ? $userInvite->token : '' }}">

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group {{ form_error_class('firstname', $errors) }}">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="firstname" placeholder="Enter First Name" value="{{ old('firstname') }}">
                            {!! form_error_message('firstname', $errors) !!}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group {{ form_error_class('lastname', $errors) }}">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name" value="{{ old('lastname') }}">
                            {!! form_error_message('lastname', $errors) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group {{ form_error_class('email', $errors) }}">
                    <label>Email Address</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="id-email" name="email" placeholder="Email Address" value="{{ $userInvite ? $userInvite->email : old('email') }}">
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

                <div class="form-group {{ form_error_class('password_confirmation', $errors) }}">
                    <label>Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="id-password_confirmation" name="password_confirmation" placeholder="Password Confirm" value="{{ old('password_confirmation') }}">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    </div>
                    {!! form_error_message('password_confirmation', $errors) !!}
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <a class="btn btn-link padding-left-0" href="{{ route('login') }}">I have an account!</a>
                    </div>

                    <div class="col-xs-6 text-right">
                        <button type="submit" class="btn btn-primary btn-submit">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
