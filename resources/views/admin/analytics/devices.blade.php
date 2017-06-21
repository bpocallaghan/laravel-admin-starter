@extends('layouts.admin')

@section('content')
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
    </div>
@endsection