@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->title . ' entry': 'Create a new Testimonial' }}</span>
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
                                    <div class="form-group {{ form_error_class('customer', $errors) }}">
                                        <label for="customer">Customer</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" id="customer" name="customer" placeholder="Please insert the Customer" value="{{ ($errors && $errors->any()? old('customer') : (isset($item)? $item->customer : '')) }}">
                                        </div>
                                        {!! form_error_message('customer', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('link', $errors) }}">
                                        <label for="link">Website (optional)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-external-link"></i></span>
                                            <input type="text" class="form-control" id="link" name="link" placeholder="Please insert the Link" value="{{ ($errors && $errors->any()? old('link') : (isset($item)? $item->link : '')) }}">
                                        </div>
                                        {!! form_error_message('link', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <section class="form-group {{ form_error_class('description', $errors) }}">
                                <label for="description-content">Testimonial</label>
                                <textarea class="form-control summernote" id="description-content" name="description" rows="18" placeholder="Please insert the Testimonial">{{ ($errors && $errors->any()? old('description') : (isset($item)? $item->description : '')) }}</textarea>
                                {!! form_error_message('description', $errors) !!}
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

            $('#form-edit').on('submit', function ()
            {
                $('#description-content').html($('.summernote').val());
                return true;
            });
        })
    </script>
@endsection