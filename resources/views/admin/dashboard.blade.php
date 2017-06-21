@extends('layouts.admin')

@section('content')

    <div class="well well-sm bg-gray-light">
        <p><strong>Note</strong>: uBlock Origin browser extension block the '<strong>/api/analtyics</strong>' ajax to get the google analytics</p>
    </div>

    @include('admin.partials.boxes.dashboard_header')

    <div class="row">
        <div class="col-sm-12">
            @include('admin.partials.boxes.visitors_views')
        </div>
    </div>

    {{-- devices + browsers --}}
    <div class="row">
        <div class="col-md-6">
            @include('admin.partials.boxes.devices_category')
        </div>

        <div class="col-md-6">
            @include('admin.partials.boxes.browsers')
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            @include('admin.partials.boxes.devices')
        </div>
        <div class="col-sm-6">
            @include('admin.partials.boxes.visited_pages')
        </div>
    </div>
@endsection