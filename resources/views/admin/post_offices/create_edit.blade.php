@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->title . ' entry': 'Create a new PostOffice' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <input name="zoom_level" type="hidden" value="{{ isset($item)? $item->zoom_level : old('zoom_level') }}" readonly/>
                        <input name="latitude" type="hidden" value="{{ isset($item)? $item->latitude : old('latitude') }}" readonly/>
                        <input name="longitude" type="hidden" value="{{ isset($item)? $item->longitude : old('longitude') }}" readonly/>

                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ form_error_class('name', $errors) }}">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Please insert the Name of the Post Office" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->name : '')) }}">
                                        {!! form_error_message('name', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('contact_person', $errors) }}">
                                        <label for="contact_person">Contact Person</label>
                                        <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Please insert the Contact Person" value="{{ ($errors && $errors->any()? old('contact_person') : (isset($item)? $item->contact_person : '')) }}">
                                        {!! form_error_message('contact_person', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('email', $errors) }}">
                                        <label for="email">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Please insert the Email" value="{{ ($errors && $errors->any()? old('email') : (isset($item)? $item->email : '')) }}">
                                        </div>
                                        {!! form_error_message('email', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ form_error_class('cellphone', $errors) }}">
                                        <label for="cellphone">Cellphone</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                            <input type="text" class="form-control" id="cellphone" name="cellphone" placeholder="Please insert the Cellphone" value="{{ ($errors && $errors->any()? old('cellphone') : (isset($item)? $item->cellphone : '')) }}">
                                        </div>
                                        {!! form_error_message('cellphone', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ form_error_class('telephone', $errors) }}">
                                        <label for="telephone">Telephone</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
                                            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Please insert the Telephone" value="{{ ($errors && $errors->any()? old('telephone') : (isset($item)? $item->telephone : '')) }}">
                                        </div>
                                        {!! form_error_message('telephone', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ form_error_class('fax', $errors) }}">
                                        <label for="fax">Fax</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fax"></i></span>
                                            <input type="text" class="form-control" id="fax" name="fax" placeholder="Please insert the Fax" value="{{ ($errors && $errors->any()? old('fax') : (isset($item)? $item->fax : '')) }}">
                                        </div>
                                        {!! form_error_message('fax', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('suburb_id', $errors) }}">
                                        <label for="suburb">Suburb</label>
                                        {!! form_select('suburb_id', ([0 => 'Please select a suburb'] + $suburbs), ($errors && $errors->any()? old('suburb_id') : (isset($item)? $item->suburb_id : '')), ['class' => 'select2 form-control']) !!}
                                        {!! form_error_message('suburb_id', $errors) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('city_id', $errors) }}">
                                        <label for="city">City</label>
                                        {!! form_select('city_id', ([0 => 'Please select a City'] + $cities), ($errors && $errors->any()? old('city_id') : (isset($item)? $item->city_id : '')), ['class' => 'select2 form-control']) !!}
                                        {!! form_error_message('city_id', $errors) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ form_error_class('address', $errors) }}">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Please insert the Address" value="{{ ($errors && $errors->any()? old('address') : (isset($item)? $item->address : '')) }}">
                                        {!! form_error_message('address', $errors) !!}
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

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-map-marker"></i></span>
                        <span>Google Map</span>
                    </h3>
                </div>

                <div class="box-body no-padding">
                    <input id="pac-input" class="controls" type="text" placeholder="Enter Address">
                    <div id="map_canvas" class="google_maps" style="height: 450px;">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_key') }}&libraries=places"></script>
    <script type="text/javascript" charset="utf-8">
        $(function () {
            var latitude = {{ isset($item) && strlen($item->latitude) > 2? $item->latitude : -30 }};
            var longitude = {{ isset($item) && strlen($item->longitude) > 2? $item->longitude : 24 }};
            var zoom_level = {{ isset($item) && strlen($item->zoom_level) >= 1? $item->zoom_level : 6 }};

            initGoogleMapEditMarker('map_canvas', latitude, longitude, zoom_level);
        })
    </script>
@endsection