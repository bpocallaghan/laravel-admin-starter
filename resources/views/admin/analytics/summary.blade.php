@extends('layouts.admin')

@section('content')
    @include('admin.partials.analytics.analytics_header', ['pageLoad' => true])

    <div class="row">
        <div class="col-sm-12">
            @include('admin.partials.analytics.visitors_views')
        </div>
    </div>

    {{-- locations + devices_category --}}
    <div class="row">
        <div class="col-md-7">
            @include('admin.partials.analytics.locations')
        </div>
        <div class="col-md-5">
            @include('admin.partials.analytics.devices_category')
        </div>
    </div>
@endsection