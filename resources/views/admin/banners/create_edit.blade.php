@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->title . ' entry': 'Create a new Banner' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group {{ form_error_class('name', $errors) }}">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Please insert the Name" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->name : '')) }}">
                                        {!! form_error_message('name', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="name">Hide Name?</label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="hide_name" name="hide_name" {{ ($errors && $errors->any()? (old('hide_name')? 'checked="checked"':'') :  (isset($item) && $item->hide_name? 'checked="checked"':'')) }}>
                                            <i></i> Hide Name
                                        </label>
                                        {!! form_error_message('hide_name', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="name">Add to All Pages?</label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="is_website" name="is_website" {{ ($errors && $errors->any()? (old('is_website')? 'checked="checked"':'') :  (!isset($item) ? 'checked="checked"': $item->is_website? 'checked="checked"':'')) }}>
                                            <i></i> Is Website Visibility
                                        </label>
                                        {!! form_error_message('is_website', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ form_error_class('summary', $errors) }}">
                                        <label for="summary">Summary</label>
                                        <textarea name="summary" id="summary" cols="30" rows="2" class="form-control">{{ ($errors && $errors->any()? old('summary') : (isset($item)? $item->summary : '')) }}</textarea>
                                        {!! form_error_message('summary', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('action_name', $errors) }}">
                                        <label for="id-action_name">Action Name</label>
                                        <input type="text" class="form-control" id="id-action_name" name="action_name" placeholder="Please insert the Button Name" value="{{ ($errors && $errors->any()? old('action_name') : (isset($item)? $item->action_name : '')) }}">
                                        {!! form_error_message('action_name', $errors) !!}
                                    </section>
                                </div>

                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('action_url', $errors) }}">
                                        <label for="id-action_url">Action Url</label>
                                        <input type="text" class="form-control" id="id-action_url" name="action_url" placeholder="Please insert the Action Url" value="{{ ($errors && $errors->any()? old('action_url') : (isset($item)? $item->action_url : '')) }}">
                                        {!! form_error_message('action_url', $errors) !!}
                                    </section>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('active_from', $errors) }}">
                                        <label for="active_from">Active From</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="active_from" name="active_from" data-date-format="YYYY-MM-DD HH:mm:ss" placeholder="Please insert the Active From" value="{{ ($errors && $errors->any()? old('active_from') : (isset($item)? $item->active_from : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('active_from', $errors) !!}
                                    </section>
                                </div>

                                <div class="col col-6">
                                    <section class="form-group {{ form_error_class('active_to', $errors) }}">
                                        <label for="active_to">Active To</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="active_to" data-date-format="YYYY-MM-DD HH:mm:ss" name="active_to" placeholder="Please insert the Active To" value="{{ ($errors && $errors->any()? old('active_to') : (isset($item)? $item->active_to : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('active_to', $errors) !!}
                                    </section>
                                </div>
                            </div>

                            <section class="form-group {{ form_error_class('photo', $errors) }}">
                                <label>Browse for an Image (1600 x 500)</label>
                                <div class="input-group input-group-sm">
                                    <input id="photo-label" type="text" class="form-control" readonly placeholder="Browse for an image">
                                    <span class="input-group-btn">
                                  <button type="button" class="btn btn-default" onclick="document.getElementById('photo').click();">Browse</button>
                                </span>
                                    <input id="photo" style="display: none" accept="{{ get_file_extensions('image') }}" type="file" name="photo" onchange="document.getElementById('photo-label').value = this.value">
                                </div>
                                {!! form_error_message('photo', $errors) !!}
                            </section>

                            @if(isset($item) && $item && $item->image)
                                <section>
                                    <img src="{{ uploaded_images_url($item->image) }}" style="max-width: 100%; max-height: 300px;">
                                    <input type="hidden" name="image" value="{{ $item->image }}">
                                </section>
                            @endif
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
            setDateTimePickerRange('#active_from', '#active_to');
        })
    </script>
@endsection