@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-eye"></i></span>
                        <span>PostOffices - {{ $item->name }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <section class="form-group">
                                        <label>Post Office</label>
                                        <input type="text" class="form-control" value="{{ $item->name }}" readonly>
                                    </section>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <section class="form-group">
                                        <label>Contact Person</label>
                                        <input type="text" class="form-control" value="{{ $item->contact_person }}" readonly>
                                    </section>
                                </div>

                                <div class="col-md-6">
                                    <section class="form-group">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $item->email }}" readonly>
                                            <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        </div>
                                    </section>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $item->telephone }}" readonly>
                                            <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fax</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $item->fax }}" readonly>
                                            <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cellphone</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $item->cellphone }}" readonly>
                                            <span class="input-group-addon"><i class="fa fa-link"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <section class="form-group">
                                <label>Address</label>
                                <div class="well well-light well-form-description">
                                    {!! $item->address !!}
                                </div>
                            </section>
                        </fieldset>

                        @include('admin.partials.form_footer', ['submit' => false])
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
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_key') }}"></script>
    <script type="text/javascript" charset="utf-8">
        $(function () {
            var latitude = {{ isset($item) && strlen($item->latitude) > 2? $item->latitude : -30 }};
            var longitude = {{ isset($item) && strlen($item->longitude) > 2? $item->longitude : 24 }};
            var zoom_level = {{ isset($item) && strlen($item->zoom_level) >= 1? $item->zoom_level : 6 }};

            var map = initGoogleMapView('map_canvas', latitude, longitude, zoom_level);
            addGoogleMapMarker(map, latitude, longitude, false);
        })
    </script>
@endsection