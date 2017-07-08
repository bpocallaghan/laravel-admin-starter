@extends('layouts.website')

@section('content')
    <div class="row">
        @foreach($items as $item)
            <div class="col-md-12">
                <div class="changelog-box">
                    <h3>{{ $item->version }} - {{ $item->date_at->format('D, d M Y') }}</h3>
                    <hr/>
                    {!! $item->content !!}
                </div>
            </div>
        @endforeach
    </div>
@endsection