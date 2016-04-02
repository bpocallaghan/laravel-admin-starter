@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

            <div class="logo"><img src="/images/logo.png"/></div>

            <div class="body">
                <h4 class="auth-title">Forgot Password for <strong>{{ env('APP_TITLE') }}</strong></h4>

                <form method="POST" action="{{ url('/auth/password/email') }}">
                    {!! csrf_field() !!}

                    <section class="form-group {{ form_error_class('email', $errors) }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" placeholder="Please insert the Email" value="{{ old('email') }}">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        </div>
                        {!! form_error_message('email', $errors) !!}
                    </section>

                    <div class="form-footer" style="padding-bottom: 0px;">
                        <div class="note">
                            <a href="{{ url('/auth/login') }}">I remembered my password!</a>
                        </div>

                        <button type="submit" class="btn btn-primary btn-submit">
                            <i class="fa fa-refresh"></i> Send Instructions
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
