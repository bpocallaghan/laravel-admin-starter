@extends('layouts.website')

@section('content')
    <section class="content p-3">
        @include('website.partials.page_header'/*, ['pageTitle' => $article->title]*/)

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                @include('website.partials.breadcrumb')

                <h2>{!! $article->title !!}</h2>
                <p>{{ $article->posted_at }}</p>
                @if($article->cover_photo)
                    <figure>
                        <a href="{{ $article->cover_photo->url }}" title="{{ $article->cover_photo->name }}" data-fancybox="gallery" data-caption="{{ $article->cover_photo->name }}">
                            <img src="{{ $article->cover_photo->url }}" class="display-block">
                        </a>
                        <figcaption>{{ $article->cover_photo->name }}</figcaption>
                    </figure>
                @endif

                <div>
                    {!! $article->content !!}
                </div>

                <div class="gallery">
                    <div class="row">
                        @foreach($article->photos as $item)
                            <div class="col-sm-6 col-md-4">
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