@extends('layouts.admin')

@section('content')
    {{-- demographics --}}
    <div class="row">
        <div class="col-md-6">
            @include('admin.partials.boxes.gender')
        </div>

        <div class="col-md-6">
            @include('admin.partials.boxes.age')
        </div>
    </div>
@endsection