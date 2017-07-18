@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->title . ' entry': 'Create a new Role' }}</span>
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
                                    <section class="form-group {{ form_error_class('name', $errors) }}">
                                        <label for="id-title">Name</label>
                                        <input type="text" class="form-control input-generate-slug" id="id-name" name="name" placeholder="Please insert the Name" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->name : '')) }}">
                                        {!! form_error_message('name', $errors) !!}
                                    </section>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('slug', $errors) }}">
                                        <label for="id-slug">Slug</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="id-slug" name="slug" placeholder="Please insert the Slug" value="{{ ($errors && $errors->any()? old('slug') : (isset($item)? $item->slug : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        </div>
                                        {!! form_error_message('slug', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('icon', $errors) }}">
                                        <label for="icon">Icon</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">fa fa-</span>
                                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Please insert the Icon" value="{{ ($errors && $errors->any()? old('icon') : (isset($item)? $item->icon : '')) }}">
                                        </div>
                                        {!! form_error_message('icon', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('keyword', $errors) }}">
                                        <label for="keyword">Keyword</label>
                                        <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Please insert the Keyword" value="{{ ($errors && $errors->any()? old('keyword') : (isset($item)? $item->keyword : '')) }}">
                                        {!! form_error_message('keyword', $errors) !!}
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
@endsection