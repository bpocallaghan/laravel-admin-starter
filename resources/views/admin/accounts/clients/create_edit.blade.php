@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit ' . $item->fullname . '': 'Create a new User' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    @if(isset($item))
                        <div class="col-sm-12">
                            <div class=" well-sm well-toolbar">
                                <form action="/admin/accounts/clients/{{ $item->id }}/notify/forgot-password" accept-charset="UTF-8" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    <input type="hidden" name="email" value="{{ ($errors->any()? old('email') : $item->email) }}">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-small btn-primary btn-flat btn-submit pull-right">
                                                <i class="fa fa-refresh"></i> Send Forgot Password
                                                Instructions
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    <form id="form-edit" method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            <div class="row">
                                <div class="col col-6">
                                    <div class="form-group {{ form_error_class('firstname', $errors) }}">
                                        <label for="firstname">Firstname</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Please insert the Firstname" value="{{ ($errors && $errors->any()? old('firstname') : (isset($item)? $item->firstname : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        </div>
                                        {!! form_error_message('firstname', $errors) !!}
                                    </div>
                                </div>

                                <div class="col col-6">
                                    <div class="form-group {{ form_error_class('lastname', $errors) }}">
                                        <label for="lastname">Lastname</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Please insert the Lastname" value="{{ ($errors && $errors->any()? old('lastname') : (isset($item)? $item->lastname : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        </div>
                                        {!! form_error_message('lastname', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('cellphone', $errors) }}">
                                        <label for="cellphone">Cellphone</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="cellphone" name="cellphone" placeholder="Please insert the Cellphone" value="{{ ($errors && $errors->any()? old('cellphone') : (isset($item)? $item->cellphone : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                        </div>
                                        {!! form_error_message('cellphone', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('telephone', $errors) }}">
                                        <label for="telephone">Telephone</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Please insert the Telephone" value="{{ ($errors && $errors->any()? old('telephone') : (isset($item)? $item->telephone : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        </div>
                                        {!! form_error_message('telephone', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-6">
                                    <div class="form-group {{ form_error_class('email', $errors) }}">
                                        <label for="email">Email</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Please insert the Email" value="{{ ($errors && $errors->any()? old('email') : (isset($item)? $item->email : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        {!! form_error_message('email', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('born_at', $errors) }}">
                                        <label for="born_at">Date of Birth</label>
                                        <div class="input-group">
                                            <input id="born_at" type="text" class="form-control" name="born_at" placeholder="Select your birth date" value="{{ ($errors->any()? old('born_at') : $item->born_at) }}">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('born_at', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ form_error_class('roles', $errors) }}">
                                <label for="roles">Roles</label>
                                {!! form_select('roles[]', $roles, ($errors && $errors->any()? old('roles') : (isset($item)? $item->roles->pluck('id')->all() : '')), ['class' => 'select2 form-control', 'multiple']) !!}
                                {!! form_error_message('roles', $errors) !!}
                            </div>
                        </fieldset>

                        @include('admin.partials.form_footer')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function () {
            $("#born_at").datetimepicker({
                viewMode: 'years',
                format: 'YYYY-MM-DD'
            });
        })
    </script>
@endsection
