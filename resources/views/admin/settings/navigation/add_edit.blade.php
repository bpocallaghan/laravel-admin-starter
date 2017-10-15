@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->title . ' entry': 'Add a new ' . ucfirst($resource) }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">
                    @include('admin.partials.info')

                    <form id="form-edit" method="post" action="{{ $selectedNavigation->url . (isset($item)? '/' . $item->id : '') }}">
                        {!! csrf_field() !!}
                        {!! method_field(isset($item)? 'put':'post') !!}

                        <fieldset>
                            <div class="row">
                                <section class="col col-3">
                                    <section class="form-group {{ form_error_class('icon', $errors) }}">
                                        <label for="id-icon">Icon</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="id-icon" name="icon" placeholder="Please insert the Icon" value="{{ ($errors && $errors->any()? old('icon') : (isset($item)? $item->icon : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-desktop"></i></span>
                                        </div>
                                        {!! form_error_message('icon', $errors) !!}
                                    </section>
                                </section>

                                <section class="col col-6">
                                    <section class="form-group {{ form_error_class('title', $errors) }}">
                                        <label for="id-title">Title</label>
                                        <input type="text" class="form-control input-generate-slug" id="id-title" name="title" placeholder="Please insert the Title" value="{{ ($errors && $errors->any()? old('title') : (isset($item)? $item->title : '')) }}">
                                        {!! form_error_message('title', $errors) !!}
                                    </section>
                                </section>

                                <section class="col col-3">
                                    <section class="form-group {{ form_error_class('slug', $errors) }}">
                                        <label for="id-slug">Slug</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="id-slug" name="slug" placeholder="Please insert the Slug" value="{{ ($errors && $errors->any()? old('slug') : (isset($item)? $item->slug : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        </div>
                                        {!! form_error_message('slug', $errors) !!}
                                    </section>
                                </section>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <section class="form-group {{ form_error_class('description', $errors) }}">
                                        <label for="id-description">Description</label>
                                        <input type="text" class="form-control" id="id-description" name="description" placeholder="Please insert the Description" value="{{ ($errors && $errors->any()? old('description') : (isset($item)? $item->description : '')) }}">
                                        {!! form_error_message('description', $errors) !!}
                                    </section>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('roles', $errors) }}">
                                        <label for="roles">Roles (which user roles have access to navigation)</label>
                                        {!! form_select('roles[]', $roles, ($errors && $errors->any()? old('roles') : (isset($item)? $item->roles->pluck('id')->all() : '')), ['class' => 'select2 form-control', 'multiple']) !!}
                                        {!! form_error_message('roles', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-2">
                                    <section>
                                        <label for="id-is_hidden">Is {{ $resource }} hidden</label>
                                        <label class="checkbox" style="margin-top: 5px">
                                            <input type="checkbox" name="is_hidden" {!! ($errors && $errors->any()? (old('is_hidden') == 'on'? 'checked':'') : (isset($item)? $item->is_hidden == 1? 'checked' : '' : '')) !!}>
                                            <i></i>Is Hidden
                                        </label>
                                    </section>
                                </div>

                                <div class="col col-5">
                                    <section class="form-group {{ form_error_class('parent_id', $errors) }}">
                                        <label for="id-parent_id">Parent (navigation parent, under
                                            which navigation it will display)</label>
                                        {!! form_select('parent_id', ([0 => 'Please select a Parent'] + $parents), isset($item)? ($errors && $errors->any()? old('parent_id') : $item->parent_id) : old('parent_id'), ['class' => 'select2 form-control ']) !!}
                                        {!! form_error_message('parent_id', $errors) !!}
                                    </section>
                                </div>

                                <div class="col col-5">
                                    <section class="form-group {{ form_error_class('url_parent_id', $errors) }}">
                                        <label for="id-parent_id">Url Parent (parent that will be
                                            used to generate the url, same as parent if
                                            empty)</label>
                                        {!! form_select('url_parent_id', ([0 => 'Please select a Url Parent'] + $parents), ($errors && $errors->any()? old('url_parent_id') : (isset($item)? $item->url_parent_id : '')), ['class' => 'select2 form-control']) !!}
                                        {!! form_error_message('url_parent_id', $errors) !!}
                                    </section>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-3">
                                    <section class="form-group {{ form_error_class('help_index_title', $errors) }}">
                                        <label for="id-help_index_title">Help Index Title</label>
                                        <input type="text" class="form-control" id="id-help_index_title" name="help_index_title" placeholder="Please insert the Help Index Title" value="{{ ($errors && $errors->any()? old('help_index_title') : (isset($item)? $item->help_index_title : '')) }}">
                                        {!! form_error_message('help_index_title', $errors) !!}
                                    </section>
                                </div>

                                <div class="col col-9">
                                    <section class="form-group {{ form_error_class('help_index_content', $errors) }}">
                                        <label for="id-help_index_content">Help Index
                                            Content</label>
                                        <input type="text" class="form-control" id="id-help_index_content" name="help_index_content" placeholder="Please insert the Help Index Content" value="{{ ($errors && $errors->any()? old('help_index_content') : (isset($item)? $item->help_index_content : '')) }}">
                                        {!! form_error_message('help_index_content', $errors) !!}
                                    </section>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-3">
                                    <section class="form-group {{ form_error_class('help_create_title', $errors) }}">
                                        <label for="id-help_create_title">Help Create Title</label>
                                        <input type="text" class="form-control" id="id-help_create_title" name="help_create_title" placeholder="Please insert the Help Create Title" value="{{ ($errors && $errors->any()? old('help_create_title') : (isset($item)? $item->help_create_title : '')) }}">
                                        {!! form_error_message('help_create_title', $errors) !!}
                                    </section>
                                </div>

                                <div class="col col-9">
                                    <section class="form-group {{ form_error_class('help_create_content', $errors) }}">
                                        <label for="id-help_create_content">Help Create
                                            Content</label>
                                        <input type="text" class="form-control" id="id-help_create_content" name="help_create_content" placeholder="Please insert the Help Create Content" value="{{ ($errors && $errors->any()? old('help_create_content') : (isset($item)? $item->help_create_content : '')) }}">
                                        {!! form_error_message('help_create_content', $errors) !!}
                                    </section>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-3">
                                    <section class="form-group {{ form_error_class('help_edit_title', $errors) }}">
                                        <label for="id-help_edit_title">Help Edit Title</label>
                                        <input type="text" class="form-control" id="id-help_edit_title" name="help_edit_title" placeholder="Please insert the Help Edit Title" value="{{ ($errors && $errors->any()? old('help_edit_title') : (isset($item)? $item->help_edit_title : '')) }}">
                                        {!! form_error_message('help_edit_title', $errors) !!}
                                    </section>
                                </div>

                                <div class="col col-9">
                                    <section class="form-group {{ form_error_class('help_edit_content', $errors) }}">
                                        <label for="id-help_edit_content">Help Edit Content</label>
                                        <input type="text" class="form-control" id="id-help_edit_content" name="help_edit_content" placeholder="Please insert the Help Edit Content" value="{{ ($errors && $errors->any()? old('help_edit_content') : (isset($item)? $item->help_edit_content : '')) }}">
                                        {!! form_error_message('help_edit_content', $errors) !!}
                                    </section>
                                </div>
                            </div>
                        </fieldset>

                        @include('admin.partials.form_footer')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection