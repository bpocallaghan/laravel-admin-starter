@extends('layouts.admin')

@section('content')
    @include('admin.partials.boxes.dashboard_header', ['pageLoad' => true])

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
    </div>
@endsection