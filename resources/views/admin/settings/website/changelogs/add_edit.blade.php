@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->title . ' entry': 'Create a new Changelog' }}</span>
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
                                    <div class="form-group {{ form_error_class('version', $errors) }}">
                                        <label for="version">Version (v0.1)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">v</span>
                                            <input type="text" class="form-control" id="version" name="version" placeholder="Please insert the Version" value="{{ ($errors && $errors->any()? old('version') : (isset($item)? $item->version : '')) }}">
                                        </div>
                                        {!! form_error_message('version', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('date_at', $errors) }}">
                                        <label for="date_at">Date At</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="date_at" data-date-format="YYYY-MM-DD" name="date_at" placeholder="Please insert the Date At" value="{{ ($errors && $errors->any()? old('date_at') : (isset($item)? $item->date_at : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('date_at', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <section class="form-group {{ form_error_class('content', $errors) }}">
                                <label for="content-content">Content</label>
                                <textarea class="form-control summernote" id="content-content" name="content" rows="30" placeholder="Please insert the Content">{{ ($errors && $errors->any()? old('content') : (isset($item)? $item->content : '')) }}</textarea>
                                {!! form_error_message('content', $errors) !!}
                            </section>
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
        $(function ()
        {
            initSummerNote('.summernote');
            $('#date_at').datetimepicker();

            $('#form-edit').on('submit', function ()
            {
                $('#content-content').html($('.summernote').val());
                return true;
            });
        })
    </script>
@endsection