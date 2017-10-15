@extends('layouts.website')

@section('content')
    <section class="content">
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
                                    <div class="item {{ ($loop->first)? 'active':'' }}">
                                        <blockquote>
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-2">
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

                            <a data-slide="prev" href="#testimonial-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                            <a data-slide="next" href="#testimonial-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            @include('website.partials.page_side')
        </div>
    </section>
@endsection