@if(!$content->media)
    @if($content->content && strlen($content->content) > 15)
        {!! $content->content !!}
    @endif
@else
    <div class="row {{ $content->media_align == 'right' ? 'd-block':'' }}">
        <div class="{{ $content->media_align == 'left' ? 'col-sm-4':'' }} {{ $content->media_align == 'right' ? 'col-sm-4 float-right':'' }} {{ $content->media_align == 'top' ? 'col-sm-12 text-center':'' }}">
            <figure>
                <a href="{{ $content->imageUrl }}" data-fancybox="gallery">
                    <img class="img-fluid mb-3" src="{{ $content->media_align != 'top'? $content->thumbUrl: $content->imageUrl }}" style="margin: auto;">
                </a>
                <figcaption>{!! $content->caption !!}</figcaption>
            </figure>
        </div>

        @if($content->content && strlen($content->content) > 15)
            <div class="col-sm-{{ $content->media_align == 'top' ? '12':'8' }}">
                {!! $content->content !!}
            </div>
        @endif
    </div>
@endif
