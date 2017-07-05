@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->title . ' entry': 'Create a new Subscription Plan' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="is_featured" name="is_featured" {{ ($errors && $errors->any()? (old('is_featured')? 'checked="checked"':'') :  (isset($item) && $item->is_featured? 'checked="checked"':'')) }}>
                                            <i></i> Is Featured
                                        </label>
                                        {!! form_error_message('is_featured', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group {{ form_error_class('title', $errors) }}">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Please insert the Title" value="{{ ($errors && $errors->any()? old('title') : (isset($item)? $item->title : '')) }}">
                                        {!! form_error_message('title', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group {{ form_error_class('cost', $errors) }}">
                                        <label for="cost">Plan Cost (99)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            <input type="text" class="form-control" id="cost" name="cost" placeholder="Please insert the Cost" value="{{ ($errors && $errors->any()? old('cost') : (isset($item)? $item->cost : '')) }}">
                                        </div>
                                        {!! form_error_message('cost', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ form_error_class('summary', $errors) }}">
                                <label for="summary">Summary</label>
                                <input type="text" class="form-control" id="summary" name="summary" placeholder="Please insert the Summary" value="{{ ($errors && $errors->any()? old('summary') : (isset($item)? $item->summary : '')) }}">
                                {!! form_error_message('summary', $errors) !!}
                            </div>

                            <div class="form-group {{ form_error_class('features', $errors) }}">
                            	<label for="features">Features</label>
                            	{!! form_select('features[]', $features, ($errors && $errors->any()? old('features') : (isset($item)? $item->features->pluck('id')->all() : '')), ['class' => 'select2 form-control', 'multiple']) !!}
                            	{!! form_error_message('features', $errors) !!}
                            </div>
                        </fieldset>

                        @include('admin.partials.form_footer')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection