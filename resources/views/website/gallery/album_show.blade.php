@extends('layouts.website')

@section('content')
    <section class="content p-3">
        @include('website.partials.page_header')

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                @include('website.partials.breadcrumb')

                <div class="row">
                    <div class="col-md-12">
                        <h2>{!! $album->name !!}</h2>
                    </div>
                </div>
                <div class="gallery">
                    <div class="row">
                        @foreach($album->photos as $item)
                            <div class="col-6 col-sm-4 col-lg-3">
                                <figure>
                                    <a href="{{ $item->url }}" rel="group" title="{{ $item->name }}" data-fancybox="gallery" data-caption="{{ $item->name }}">
                                        <img src="{{ $item->thumbUrl }}" alt="{{ $item->name }}">
                                    </a>
                                    <figcaption>{!! $item->name !!}</figcaption>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @include('website.partials.page_side')
        </div>
    </section>
@endsection
