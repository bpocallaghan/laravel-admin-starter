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
                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('icon', $errors) }}">
                                        <label for="id-icon">Icon</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="id-icon" name="icon" placeholder="Please insert the Icon" value="{{ ($errors && $errors->any()? old('icon') : (isset($item)? $item->icon : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-desktop"></i></span>
                                        </div>
                                        {!! form_error_message('icon', $errors) !!}
                                    </section>
                                </div>

                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('title', $errors) }}">
                                        <label for="id-title">Title</label>
                                        <input type="text" class="form-control input-generate-slug" id="id-title" name="title" placeholder="Please insert the Title" value="{{ ($errors && $errors->any()? old('title') : (isset($item)? $item->title : '')) }}">
                                        {!! form_error_message('title', $errors) !!}
                                    </section>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('html_title', $errors) }}">
                                        <label for="id-html_title">Html Title</label>
                                        <input type="text" class="form-control" id="id-html_title" name="html_title" placeholder="Please insert the Html Title" value="{{ ($errors && $errors->any()? old('html_title') : (isset($item)? $item->html_title : '')) }}">
                                        {!! form_error_message('html_title', $errors) !!}
                                    </section>
                                </div>

                                <section class="col col-6">
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

                            <section class="form-group {{ form_error_class('description', $errors) }}">
                                <label for="id-description">Description</label>
                                <input type="text" class="form-control" id="id-description" name="description" placeholder="Please insert the Description" value="{{ ($errors && $errors->any()? old('description') : (isset($item)? $item->description : '')) }}">
                                {!! form_error_message('description', $errors) !!}
                            </section>

                            <section class="form-group {{ form_error_class('html_description', $errors) }}">
                                <label for="id-html_description">Html Description</label>
                                <input type="text" class="form-control" id="id-html_description" name="html_description" placeholder="Please insert the Html Description" value="{{ ($errors && $errors->any()? old('html_description') : (isset($item)? $item->html_description : '')) }}">
                                {!! form_error_message('html_description', $errors) !!}
                            </section>

                            <div class="row">
                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('description', $errors) }}">
                                        <label for="id-parent_id">Parent (navigation parent, under
                                            which navigation it will display)</label>
                                        {!! form_select('parent_id', ([0 => 'Please select a Parent'] + $parents), isset($item)? ($errors && $errors->any()? old('parent_id') : $item->parent_id) : old('parent_id'), ['class' => 'select2 form-control ']) !!}
                                        {!! form_error_message('parent_id', $errors) !!}
                                    </section>
                                </div>

                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('url_parent_id', $errors) }}">
                                        <label for="id-parent_id">Url Parent (parent that will be
                                            used to generate the url, same as parent if
                                            empty</label>
                                        {!! form_select('url_parent_id', ([0 => 'Please select a Url Parent'] + $parents), ($errors && $errors->any()? old('url_parent_id') : (isset($item)? $item->url_parent_id : '')), ['class' => 'select2 form-control']) !!}
                                        {!! form_error_message('url_parent_id', $errors) !!}
                                    </section>
                                </div>
                            </div>

                            <div class="row">
                                <section class="col col-2">
                                    <label class="checkbox">
                                        <input type="checkbox" name="is_main" {!! ($errors && $errors->any()? (old('is_main') == 'on'? 'checked':'') : (isset($item)? $item->is_main == 1? 'checked' : '' : 'checked')) !!}>
                                        <i></i>Is Main
                                    </label>
                                </section>

                                <section class="col col-2">
                                    <label class="checkbox">
                                        <input type="checkbox" name="is_footer" {!! ($errors && $errors->any()? (old('is_footer') == 'on'? 'checked':'') : (isset($item)? $item->is_footer == 1? 'checked' : '' : '')) !!}>
                                        <i></i>Is Footer
                                    </label>
                                </section>

                                <div class="col col-2">
                                    <label class="checkbox" style="margin-top: 5px">
                                        <input type="checkbox" name="is_hidden" {!! ($errors && $errors->any()? (old('is_hidden') == 'on'? 'checked':'') : (isset($item)? $item->is_hidden == 1? 'checked' : '' : '')) !!}>
                                        <i></i>Is Hidden
                                    </label>
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