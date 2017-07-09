@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->question . ' entry': 'Create a new FAQ' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form id="form-edit" method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            <div class="row">
                                <div class="col col-md-8">
                                    <div class="form-group {{ form_error_class('question', $errors) }}">
                                        <label for="question">Question</label>
                                        <input type="text" class="form-control" id="question" name="question" placeholder="Please insert the Question" value="{{ ($errors && $errors->any()? old('question') : (isset($item)? $item->question : '')) }}">
                                        {!! form_error_message('question', $errors) !!}
                                    </div>
                                </div>
                                <div class="col col-md-4">
                                    <div class="form-group {{ form_error_class('category_id', $errors) }}">
                                        <label for="category">Category</label>
                                        {!! form_select('category_id', ([0 => 'Please select a Category'] + $categories), ($errors && $errors->any()? old('category_id') : (isset($item)? $item->category_id : '')), ['class' => 'select2 form-control']) !!}
                                        {!! form_error_message('category_id', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ form_error_class('answer', $errors) }}">
                                <label for="answer-content">Answer</label>
                                <textarea class="form-control summernote" id="answer-content" name="answer" rows="18" placeholder="Please insert the Answer">{{ ($errors && $errors->any()? old('answer') : (isset($item)? $item->answer : '')) }}</textarea>
                                {!! form_error_message('answer', $errors) !!}
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
        $(function ()
        {
            initSummerNote('.summernote');

            $('#form-edit').on('submit', function ()
            {
                $('#answer-content').html($('.summernote').val());
                return true;
            });
        })
    </script>
@endsection
