@extends('layouts.website')

@section('content')
    <section class="content">
        @include('website.partials.page_header')

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                @include('website.partials.breadcrumb')

                <div class="row">
                    <div class="col-md-12">
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
                </div>
            </div>

            @include('website.partials.page_side')
        </div>
    </section>
@endsection