@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->name . ' entry': 'Create a new Newsletter Subscribers' }}</span>
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
                                    <div class="form-group {{ form_error_class('fullname', $errors) }}">
                                        <label for="fullname">Fullname</label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Please insert the Fullname" value="{{ ($errors && $errors->any()? old('fullname') : (isset($item)? $item->fullname : '')) }}">
                                        {!! form_error_message('fullname', $errors) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('email', $errors) }}">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Please insert the Email" value="{{ ($errors && $errors->any()? old('email') : (isset($item)? $item->email : '')) }}">
                                        {!! form_error_message('email', $errors) !!}
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