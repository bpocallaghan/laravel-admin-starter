@extends('layouts.admin')

@section('content')
    {{-- most visited and referrers --}}
    <div class="row">
        <div class="col-md-6">
            @include('admin.partials.analytics.visited_pages')
        </div>

        <div class="col-md-6">
            @include('admin.partials.analytics.referrers')
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            @include('admin.partials.analytics.keywords')
        </div>
        <div class="col-sm-6">

        </div>
    </div>
@endsection