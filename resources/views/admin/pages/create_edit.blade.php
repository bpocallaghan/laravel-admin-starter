@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->name . ' entry': 'Create a new Page' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('name', $errors) }}">
                                        <label for="name">Name (Navigation's hyperlink)</label>
                                        <input type="text" class="form-control input-generate-slug" id="name" name="name" placeholder="Please insert the Name" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->name : '')) }}">
                                        {!! form_error_message('name', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('slug', $errors) }}">
                                        <label for="slug">Slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Please insert the Slug" value="{{ ($errors && $errors->any()? old('slug') : (isset($item)? $item->slug : '')) }}">
                                        {!! form_error_message('slug', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group {{ form_error_class('title', $errors) }}">
                                        <label for="title">Meta Title (Browser tab title)</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Please insert the Title" value="{{ ($errors && $errors->any()? old('title') : (isset($item)? $item->title : '')) }}">
                                        {!! form_error_message('title', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ form_error_class('icon', $errors) }}">
                                        <label for="icon">Icon</label>
                                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Please insert the Icon" value="{{ ($errors && $errors->any()? old('icon') : (isset($item)? $item->icon : '')) }}">
                                        {!! form_error_message('icon', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ form_error_class('description', $errors) }}">
                                        <label for="description">Description (When you share the
                                            page)</label>
                                        <textarea name="description" id="description" cols="30" rows="2" class="form-control">{{ ($errors && $errors->any()? old('description') : (isset($item)? $item->description : '')) }}</textarea>
                                        {!! form_error_message('description', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-6">
                                    <div class="form-group {{ form_error_class('description', $errors) }}">
                                        <label for="id-parent_id">Parent (below which navigation
                                            item)</label>
                                        {!! form_select('parent_id', ([0 => 'Please select a Parent'] + $parents), isset($item)? ($errors && $errors->any()? old('parent_id') : $item->parent_id) : old('parent_id'), ['class' => 'select2 form-control ']) !!}
                                        {!! form_error_message('parent_id', $errors) !!}
                                    </div>
                                </div>

                                <div class="col col-6">
                                    <div class="form-group {{ form_error_class('url_parent_id', $errors) }}">
                                        <label for="id-parent_id">Url Parent (parent to generate the
                                            url, same as parent if empty)</label>
                                        {!! form_select('url_parent_id', ([0 => 'Please select an Url Parent'] + $parents), ($errors && $errors->any()? old('url_parent_id') : (isset($item)? $item->url_parent_id : '')), ['class' => 'select2 form-control']) !!}
                                        {!! form_error_message('url_parent_id', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ form_error_class('banners', $errors) }}">
                                        <label for="banners">Banners (leave empty to use the default
                                            banners)</label>
                                        {!! form_select('banners[]', $banners, ($errors && $errors->any()? old('banners') : (isset($item)? $item->banners->pluck('id')->all() : '')), ['class' => 'select2 form-control', 'multiple']) !!}
                                        {!! form_error_message('banners', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-2">
                                    <label class="checkbox">
                                        <input type="checkbox" name="is_header" {!! ($errors && $errors->any()? (old('is_header') == 'on'? 'checked':'') : (isset($item)? $item->is_header == 1? 'checked' : '' : 'checked')) !!}>
                                        <i></i>Is Header
                                    </label>
                                    {!! form_error_message('is_header', $errors) !!}
                                </div>

                                <div class="col col-2">
                                    <label class="checkbox">
                                        <input type="checkbox" name="is_footer" {!! ($errors && $errors->any()? (old('is_footer') == 'on'? 'checked':'') : (isset($item)? $item->is_footer == 1? 'checked' : '' : '')) !!}>
                                        <i></i>Is Footer
                                    </label>
                                    {!! form_error_message('is_footer', $errors) !!}
                                </div>

                                <div class="col col-2">
                                    <label class="checkbox" style="margin-top: 5px">
                                        <input type="checkbox" name="is_hidden" {!! ($errors && $errors->any()? (old('is_hidden') == 'on'? 'checked':'') : (isset($item)? $item->is_hidden == 1? 'checked' : '' : '')) !!}>
                                        <i></i>Is Hidden
                                    </label>
                                    {!! form_error_message('is_hidden', $errors) !!}
                                </div>

                                <div class="col col-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="is_featured" name="is_featured" {{ ($errors && $errors->any()? (old('is_featured')? 'checked="checked"':'') :  (isset($item) && $item->is_featured? 'checked="checked"':'')) }}>
                                            <i></i> Is Featured
                                        </label>
                                        {!! form_error_message('is_featured', $errors) !!}
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        @include('admin.partials.form_footer')
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(isset($item))
        @include('admin.pages.components.components', ['page' => $item, 'url' => "/admin/pages/{$item->id}/sections"])
    @endif
@endsection