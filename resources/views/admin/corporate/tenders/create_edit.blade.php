@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->title . ' entry': 'Create a new Tender' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            <div class="row">
                                <div class="col col-md-12">
                                    <div class="form-group {{ form_error_class('name', $errors) }}">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Please insert the Name" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->name : '')) }}">
                                        {!! form_error_message('name', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="form-group {{ form_error_class('active_from', $errors) }}">
                                        <label for="active_from">Active From</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="active_from" data-date-format="YYYY-MM-DD HH:mm:ss" name="active_from" placeholder="Please insert the Active From" value="{{ ($errors && $errors->any()? old('active_from') : (isset($item)? $item->active_from : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('active_from', $errors) !!}
                                    </div>
                                </div>

                                <div class="col col-md-6">
                                    <div class="form-group {{ form_error_class('active_to', $errors) }}">
                                        <label for="active_to">Active To</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="active_to" data-date-format="YYYY-MM-DD HH:mm:ss" name="active_to" placeholder="Please insert the Active To" value="{{ ($errors && $errors->any()? old('active_to') : (isset($item)? $item->active_to : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('active_to', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ form_error_class('content', $errors) }}">
                                <label for="tender-content">Content</label>
                                <textarea class="form-control summernote" id="tender-content" name="content" rows="18">{{ ($errors && $errors->any()? old('content') : (isset($item)? $item->content : '')) }}</textarea>
                                {!! form_error_message('content', $errors) !!}
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ form_error_class('file', $errors) }}">
                                        <label>Upload your Tender Document (Max 5MB)</label>
                                        <div class="input-group input-group-sm">
                                            <input id="file-label" type="text" class="form-control" readonly placeholder="Browse for a document">
                                            <span class="input-group-btn">
                                    		  <button type="button" class="btn btn-default" onclick="document.getElementById('file').click();">Browse</button>
                                    		</span>
                                            <input id="file" style="display: none" accept=".pdf" type="file" name="file" onchange="document.getElementById('file-label').value = this.value">
                                        </div>
                                        {!! form_error_message('file', $errors) !!}
                                    </div>

                                    @if(isset($item) && $item->document)
                                        <div>
                                            <a target="_blank" href="{{ $item->document_url }}">{!! $item->document->name !!}</a>
                                        </div>
                                    @endif
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

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function () {
            setDateTimePickerRange('#active_from', '#active_to');

            initSummerNote('.summernote');
            $('#form-edit').on('submit', function () {
                $('#tender-content').html($('.summernote').val());
                return true;
            });
        })
    </script>
@endsection