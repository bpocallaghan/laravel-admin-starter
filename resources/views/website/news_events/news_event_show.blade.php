@extends('layouts.website')

@section('content')
    <section class="content p-3">
        @include('website.partials.page_header'/*, ['pageTitle' => $news->title]*/)

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                @include('website.partials.breadcrumb')

                <h2>{!! $news->title !!}</h2>
                <p><i class="fa fa-calendar mr-2"></i>{{ $news->posted_at }}</p>
                @if($news->cover_photo)
                    <figure>
                        <a href="{{ $news->cover_photo->url }}" title="{{ $news->cover_photo->name }}" data-fancybox="gallery" data-caption="{{ $news->cover_photo->name }}">
                            <img src="{{ $news->cover_photo->url }}" class="display-block">
                        </a>
                        <figcaption>{{ $news->cover_photo->name }}</figcaption>
                    </figure>
                @endif

                <div class="mt-3">
                    {!! $news->content !!}
                </div>

                @if($news->photos && $news->photos->count() > 1)
                    <div class="gallery bg-light mt-3 mb-3 p-3">
                        <div class="row">
                            @foreach($news->photos as $item)
                                <div class="col-6 col-sm-4 col-lg-3">
                                    <figure>
                                        <a href="{{ $item->url }}" rel="group" title="{{ $item->name }}" data-fancybox="gallery" class="cover" style="background-image:url('{{ $item->thumbUrl }}')">
                                            <img src="{{ $item->thumbUrl }}">
                                        </a>
                                        <figcaption>{!! $item->name !!}</figcaption>
                                    </figure>
                                    {{--<div class="swipe-item news">
                                        <figure>
                                            <a>
                                                <img src="{{ $item->thumbUrl }}" class="display-block">
                                            </a>
                                        </figure>
                                    </div>--}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            @include('website.partials.page_side')
        </div>
    </section>
@endsection