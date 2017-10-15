@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->title . ' entry': 'Create a new PhotoAlbum' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ form_error_class('name', $errors) }}">
                                        <label for="name">Photo Album</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name of the Photo Album" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->name : '')) }}">
                                        {!! form_error_message('name', $errors) !!}
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