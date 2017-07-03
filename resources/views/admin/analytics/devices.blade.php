@extends('layouts.admin')

@section('content')
    {{-- devices + browsers --}}
    <div class="row">
        <div class="col-md-6">
            @include('admin.partials.analytics.devices_category')
        </div>

        <div class="col-md-6">
            @include('admin.partials.analytics.browsers')
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            @include('admin.partials.analytics.devices')
        </div>
    </div>
@endsection