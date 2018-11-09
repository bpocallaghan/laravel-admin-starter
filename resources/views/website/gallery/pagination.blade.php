<div class="row">
    @foreach($paginator as $item)
        <div class="col-sm-4">
            <div class="gallery">
                <figure>
                    @if($item->cover_photo)
                        <a href="/gallery/{{ $item->slug }}" title="{{ $item->cover_photo->name }}">
                            <img src="{{ $item->cover_photo->thumbUrl }}">
                        </a>
                    @endif
                </figure>
                <h2>{!! $item->name !!}</h2>
                <p>
                    <a href="/gallery/{{ $item->slug }}" class="btn btn-primary btn-block">
                        View gallery
                    </a>
                </p>
            </div>
        </div>
    @endforeach
</div>

@include('website.partials.paginator_footer')
