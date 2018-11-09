@extends('layouts.website')

@section('content')
    <section class="content p-3">
        @include('website.partials.page_header')

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                @include('website.partials.breadcrumb')

                @include('alert::alert')

                <h2>Update my Information</h2>

                <div class="row">
                    <div class="col-md-12">
                        <form id="form-member-register" method="POST" action="{{ request()->url() }}" accept-charset="UTF-8">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group {{ form_error_class('firstname', $errors) }}">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="firstname" placeholder="Enter First Name" value="{{ ($errors->any()? old('firstname') : $user->firstname) }}">
                                        {!! form_error_message('firstname', $errors) !!}
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group {{ form_error_class('lastname', $errors) }}">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name" value="{{ ($errors->any()? old('lastname') : $user->lastname) }}">
                                        {!! form_error_message('lastname', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ form_error_class('cellphone', $errors) }}">
                                <label for="cellphone">Cellphone</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="cellphone" name="cellphone" placeholder="Please insert the Cellphone" value="{{ ($errors->any()? old('cellphone') : $user->cellphone) }}">
                                    <div class="input-group-append"><span class="input-group-text"><i class="fa fa-mobile"></i></span></div>
                                </div>
                                {!! form_error_message('cellphone', $errors) !!}
                            </div>

                            <div class="form-group {{ form_error_class('email', $errors) }}">
                                <label>Email Address</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="id-email" name="email" placeholder="Email Address" value="{{ ($errors->any()? old('email') : $user->email) }}">
                                    <div class="input-group-append"><span class="input-group-text"><i class="fa fa-envelope"></i></span></div>
                                </div>
                                {!! form_error_message('email', $errors) !!}
                            </div>

                            <div class="form-group {{ form_error_class('password', $errors) }}">
                                <label>Password (leave blank to keep it unchanged)</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="id-password" name="password" placeholder="Password" value="{{ old('password') }}">
                                    <div class="input-group-append"><span class="input-group-text"><i class="fa fa-lock"></i></span></div>
                                </div>
                                {!! form_error_message('password', $errors) !!}
                            </div>

                            <div class="form-group {{ form_error_class('password_confirmation', $errors) }}">
                                <label>Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="id-password_confirmation" name="password_confirmation" placeholder="Password Confirm" value="{{ old('password_confirmation') }}">
                                    <div class="input-group-append"><span class="input-group-text"><i class="fa fa-lock"></i></span></div>
                                </div>
                                {!! form_error_message('password_confirmation', $errors) !!}
                            </div>

                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary btn-submit">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @include('website.partials.page_side')
        </div>
    </section>
@endsection