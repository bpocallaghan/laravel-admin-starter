@if(isset($news) && $news->count() >= 1)
    <aside class="well">
        <h2 class="side-heading">News &amp; Events</h2>

        <div id="news-carousel" class="carousel slide side-news" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                @foreach($news as $k => $item)
                    <div class="news item {{ $k == 0? 'active':'' }}">
                        <figure>
                            <a href="/news-and-events/{{ $item->slug }}">
                                <img src="{{ $item->cover_photo->thumbUrl }}">
                            </a>
                        </figure>
                        <div class="media">
                            <div class="media-left">
                                <div class="date">
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
            <a class="left carousel-control" href="#news-carousel" data-slide="prev">
                <span class="icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#news-carousel" data-slide="next">
                <span class="icon-next"></span>
            </a>
        </div>
    </aside>
@endif