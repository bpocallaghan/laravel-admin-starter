<div class="row pb-3">
    @foreach($paginator as $item)
        <div class="col-md-6">
            <div class="news">
                <figure>
                    <a href="/blog/{{ $item->slug }}">
                        <img src="{{ $item->cover_photo->thumbUrl }}">
                    </a>
                </figure>
                <div class="media mt-2">
                    <div class="media-left">
                        <div class="date bg-secondary mr-2">
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
        </div>
    @endforeach
</div>

@include('website.partials.paginator_footer')
