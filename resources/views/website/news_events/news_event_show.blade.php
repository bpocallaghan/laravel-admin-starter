@extends('layouts.website')

@section('content')
    <section class="content bg-default padding padding-top padding-bottom">
        @include('website.partials.page_header'/*, ['pageTitle' => $news->title]*/)

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                @include('website.partials.breadcrumb')

                <h2>{!! $news->title !!}</h2>
                <p>{{ $news->posted_at }}</p>
                @if($news->cover_photo)
                    <figure>
                        <a href="{{ $news->cover_photo->url }}" title="{{ $news->cover_photo->name }}" data-fancybox="gallery" data-caption="{{ $news->cover_photo->name }}">
                            <img src="{{ $news->cover_photo->url }}" class="display-block">
                        </a>
                        <figcaption>{{ $news->cover_photo->name }}</figcaption>
                    </figure>
                @endif

                <div>
                    {!! $news->content !!}
                </div>

                <div class="gallery">
                    <div class="row">
                        @foreach($news->photos as $item)
                            <div class="col-xs-6 col-md-4">
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