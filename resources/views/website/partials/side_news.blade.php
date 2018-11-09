@if(isset($news) && $news->count() >= 1)
    <aside class="card bg-light mt-3">
        <div class="card-body">
            <h2 class="side-heading">News &amp; Events</h2>

            <div id="news-carousel" class="carousel slide side-news" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    @foreach($news as $k => $item)
                        <div class="news carousel-item {{ $k == 0? 'active':'' }}">
                            <figure>
                                <a href="/news-and-events/{{ $item->slug }}">
                                    <img src="{{ $item->cover_photo->thumbUrl }}">
                                </a>
                            </figure>
                            <div class="media mt-2">
                                <div class="media-left mr-2">
                                    <div class="date bg-secondary">
                                        {!! $item->active_from->format('\<\s\t\r\o\n\g\>d\</\s\t\r\o\n\g\> M Y') !!}
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading text-primary">{!! $item->title !!}</h4>
                                    <div class="text limit">
                                        <p>{!! $item->summary !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#news-carousel" role="button" data-slide="prev">
                    <span class="fa fa-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#news-carousel" role="button" data-slide="next">
                    <span class="fa fa-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </aside>
@endif