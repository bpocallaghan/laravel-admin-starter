<div class="row">
    <div class="{{ $content->component->media_align == 'left' ? 'col-sm-4':'' }} {{ $content->component->media_align == 'right' ? 'col-sm-4 pull-right':'' }} {{ $content->component->media_align == 'top' ? 'col-sm-12 text-center':'' }}">
        <figure>
            <a href="{{ $content->component->imageUrl }}" data-fancybox="gallery">
                <img class="img-fluid" src="{{ $content->component->media_align == 'left'? $content->component->thumbUrl: $content->component->imageUrl }}" style="margin: auto;">
            </a>
            <figcaption>{!! $content->component->caption !!}</figcaption>
        </figure>
    </div>

    @if($content->component->content && strlen($content->component->content) > 15)
        <div class="col-sm-{{ $content->component->media_align == 'top' ? '12':'8' }}">
            {!! $content->component->content !!}
        </div>
    @endif
</div>
