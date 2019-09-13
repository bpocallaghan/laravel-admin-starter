@extends('layouts.website')

@section('content')
    <section class="content p-3">
        @include('website.partials.page_header')

        <div class="row">
            <div class="body col-sm-7 col-lg-8">
                @include('website.partials.breadcrumb')

                <div class="row">
                    <div class="col-md-12">
                        <div class="carousel slide" data-ride="carousel" id="testimonial-carousel">
                            <ol class="carousel-indicators">
                                @foreach($items as $item)
                                    <li data-target="#testimonial-carousel" data-slide-to="{{ $loop->index }}" class="{{ ($loop->first)? 'active':'' }}"></li>
                                @endforeach
                            </ol>

                            <div class="carousel-inner text-center">
                                @foreach($items as $item)
                                    <div class="carousel-item {{ ($loop->first)? 'active':'' }}">
                                        <blockquote>
                                            @if($item->image)
                                                <figure>
                                                    <img src="{{ uploaded_images_url($item->image) }}" class="img-fluid d-block rounded-circle" style="max-width:200px;margin:10px auto;">
                                                </figure>
                                            @endif
                                            <div class="row">
                                                <div class="col-sm-8 offset-sm-2">
                                                    {!! $item->description !!}
                                                    <small>
                                                        {!! $item->customer !!}
                                                        @if($item->link)
                                                            <a href="{{ $item->link }}">{{ $item->link }}</a>
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </blockquote>
                                    </div>
                                @endforeach
                            </div>

                            <a class="carousel-control-prev" href="#testimonial-carousel" role="button" data-slide="prev">
                                <span class="fa fa-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#testimonial-carousel" role="button" data-slide="next">
                                <span class="fa fa-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @include('website.partials.page_side')
        </div>
    </section>
@endsection