@extends('layouts.website')

@section('content')
    <div class="row mt-4 body">
        <div class="col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-8 col-sm-offset-2">
            <div class="margin-top-20">
                @include('alert::alert')
            </div>

            <h2 class="page-header mb-4">Reset Password</h2>

            <form action="/auth/password/reset" accept-charset="UTF-8" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input type="hidden" name="token" value="{{ $token }}">

                <section class="form-group {{ form_error_class('email', $errors) }}">
                    <label>Email Address</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $email or old('email') }}">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    </div>
                    {!! form_error_message('email', $errors) !!}
                </section>

                <section class="form-group {{ form_error_class('password', $errors) }}">
                    <label>Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="id-password" name="password" placeholder="Password" value="">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    </div>
                    {!! form_error_message('password', $errors) !!}
                </section>

                <section class="form-group {{ form_error_class('password_confirmation', $errors) }}">
                    <label>Confirm Password</label>
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
@endsection
