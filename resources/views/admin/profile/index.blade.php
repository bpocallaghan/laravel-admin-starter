@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-user"></i></span>
                        <span>{{ user()->fullname }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    {!! Form::open(['method' => 'put', 'url' => $selectedNavigation->url . user()->id , 'files' => true]) !!}

                    <fieldset>
                        <div class="row">
                            <div class="col col-6">
                                <section class="form-group {{ form_error_class('firstname', $errors) }}">
                                    <label for="firstname">Firstname</label>
                                    <div class="input-group">
                                        <input type="text" name="firstname" class="form-control" placeholder="Firstname" value="{{ ($errors->any()? old('firstname') : user()->firstname) }}">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    </div>
                                    {!! form_error_message('firstname', $errors) !!}
                                </section>
                            </div>

                            <div class="col col-6">
                                <section class="form-group {{ form_error_class('lastname', $errors) }}">
                                    <label for="email">Lastname</label>
                                    <div class="input-group">
                                        <input type="text" name="lastname" class="form-control" placeholder="Lastname" value="{{ ($errors->any()? old('lastname') : user()->lastname) }}">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    </div>
                                    {!! form_error_message('lastname', $errors) !!}
                                </section>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-6">
                                <section class="form-group {{ form_error_class('email', $errors) }}">
                                    <label for="email">Email Address</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ ($errors->any()? old('email') : user()->email) }}">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    {!! form_error_message('email', $errors) !!}
                                </section>
                            </div>

                            <div class="col col-6">
                                <section class="form-group {{ form_error_class('cellphone', $errors) }}">
                                    <label for="cellphone">Cellphone</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cellphone" name="cellphone" placeholder="Cellphone" value="{{ ($errors->any()? old('cellphone') : user()->cellphone) }}">
                                        <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                    </div>
                                    {!! form_error_message('cellphone', $errors) !!}
                                </section>
                            </div>
                        </div>

                        <section class="form-group {{ form_error_class('password', $errors) }}">
                            <label for="password">Password (readonly)</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="*******" readonly>
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            </div>
                            {!! form_error_message('password', $errors) !!}
                        </section>

                        <section class="form-group">
                            <label>Gender</label>
                            <div class="inline-group">
                                <label class="radio" style="margin-top: 0px;">
                                    <input type="radio" name="gender" value="male" {{ ($errors->any() && old('gender') == 'male'? 'checked="checked"' : user()->gender == 'male'? 'checked="checked"':'') }}>
                                    <i></i>Male
                                </label>
                                <label class="radio" style="margin-top: 0px;">
                                    <input type="radio" name="gender" value="female" {{ ($errors->any() && old('gender') == 'female'? 'checked="checked"' : user()->gender == 'female'? 'checked="checked"':'') }}>
                                    <i></i>Female
                                </label>
                            </div>
                        </section>

                        <section class="form-group {{ form_error_class('photo', $errors) }}">
                            <label>Profile image (160 x 160)</label>
                            <div class="input-group input-group-sm">
                                <input id="photo-label" type="text" class="form-control" readonly placeholder="Browse for an image">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-info" onclick="document.getElementById('photo').click();">Browse</button>
                                </span>
                                <input id="photo" style="display: none" accept="{{ get_file_extensions('image') }}" type="file" name="photo" onchange="document.getElementById('photo-label').value = this.value">
                            </div>
                            {!! form_error_message('photo', $errors) !!}
                        </section>

                        <section>
                            <img src="{{ profile_image() }}" style="max-height: 300px;">
                            <input type="hidden" name="image" value="{{ user()->image }}">
                        </section>
                    </fieldset>

                    @include('admin.partials.form_footer')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection