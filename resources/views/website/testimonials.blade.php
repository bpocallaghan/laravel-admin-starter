@extends('layouts.website')

@section('content')
    <div class="row">
        <div class="carousel slide" data-ride="carousel" id="testimonial-carousel">
            <!-- Bottom Carousel Indicators -->
            <ol class="carousel-indicators">
                @foreach($items as $item)
                    <li data-target="#testimonial-carousel" data-slide-to="{{ $loop->index }}" class="{{ ($loop->first)? 'active':'' }}"></li>
                @endforeach
            </ol>

            <!-- Carousel Slides / Quotes -->
            <div class="carousel-inner text-center">
                @foreach($items as $item)
                    <div class="item {{ ($loop->first)? 'active':'' }}">
                        <blockquote>
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <p>{!! $item->description !!}</p>
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

            <!-- Carousel Buttons Next/Prev -->
            <a data-slide="prev" href="#testimonial-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
            <a data-slide="next" href="#testimonial-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
@endsection