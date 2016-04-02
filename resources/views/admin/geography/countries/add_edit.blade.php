@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->title . ' entry': 'Add a new Country' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    {!! Form::open(['method' => isset($item)? 'put':'post', 'url' => $selectedNavigation->url . (isset($item)? $item->id : '')]) !!}

                    <input name="zoom_level" type="hidden" value="{{ isset($item)? $item->zoom_level : old('zoom_level') }}" readonly/>
                    <input name="latitude" type="hidden" value="{{ isset($item)? $item->latitude : old('latitude') }}" readonly/>
                    <input name="longitude" type="hidden" value="{{ isset($item)? $item->longitude : old('longitude') }}" readonly/>

                    <fieldset>
                        <div class="row">
                            <section class="col col-6">
                                <section class="form-group {{ form_error_class('title', $errors) }}">
                                    <label for="id-title">Title</label>
                                    <input type="text" class="form-control input-generate-slug" id="id-title" name="title" placeholder="Please insert the Title" value="{{ ($errors && $errors->any()? old('title') : (isset($item)? $item->title : '')) }}">
                                    {!! form_error_message('title', $errors) !!}
                                </section>
                            </section>

                            <section class="col col-6">
                                <section class="form-group {{ form_error_class('abbreviation', $errors) }}">
                                    <label for="id-abbreviation">Abbreviation</label>
                                    <input type="text" class="form-control" id="id-abbreviation" name="abbreviation" placeholder="Please insert the Abbreviation" value="{{ ($errors && $errors->any()? old('abbreviation') : (isset($item)? $item->abbreviation : '')) }}">
                                    {!! form_error_message('abbreviation', $errors) !!}
                                </section>
                            </section>
                        </div>
                    </fieldset>

                    @include('admin.partials.form_footer')

                    {!! Form::close() !!}
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
                    <div id="map_canvas" class="google_maps" style="height: 400px;">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('google_map_key') }}&sensor=truep&libraries=places"></script>
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            var latitude = {{ isset($item) && strlen($item->latitude) > 2? $item->latitude : -22 }};
            var longitude = {{ isset($item) && strlen($item->longitude) > 2? $item->longitude : 17 }};
            var zoom_level = {{ isset($item) && strlen($item->zoom_level) >= 1? $item->zoom_level : 6 }};

            initGoogleMapEditClean('map_canvas', latitude, longitude, zoom_level);
        })
    </script>
@endsection