@extends('layouts.admin')

@section('content')
    @include('admin.analytics.partials.analytics_header', ['activeUsers' => true])

    <div class="row">
        <div class="col-sm-12">
            @include('admin.analytics.partials.visitors_views')
        </div>
    </div>

    {{-- locations + devices_category --}}
    <div class="row">
        <div class="col-md-7">
            @include('admin.analytics.partials.locations')
        </div>
        <div class="col-md-5">
            @include('admin.analytics.partials.devices_category')
        </div>
    </div>
@endsection