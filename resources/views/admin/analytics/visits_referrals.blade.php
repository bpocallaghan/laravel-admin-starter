@extends('layouts.admin')

@section('content')
    {{-- most visited and referrers --}}
    <div class="row">
        <div class="col-md-6">
            @include('admin.partials.boxes.visited_pages')
        </div>

        <div class="col-md-6">
            @include('admin.partials.boxes.referrers')
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            @include('admin.partials.boxes.keywords')
        </div>
        <div class="col-sm-6">

        </div>
    </div>
@endsection