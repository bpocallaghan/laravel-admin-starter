@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->title . ' entry': 'Create a new Tag' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    {!! Form::open(['method' => isset($item)? 'put':'post', 'url' => $selectedNavigation->url . (isset($item)? $item->id : '')]) !!}

                    <fieldset>
                        <section class="form-group {{ form_error_class('title', $errors) }}">
                            <label for="id-title">Title</label>
                            <input type="text" class="form-control input-generate-slug" id="id-title" name="title" placeholder="Please insert the Title" value="{{ ($errors && $errors->any()? old('title') : (isset($item)? $item->title : '')) }}">
                            {!! form_error_message('title', $errors) !!}
                        </section>
                    </fieldset>

                    @include('admin.partials.form_footer')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection