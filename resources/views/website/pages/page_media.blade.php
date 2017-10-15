<div class="row">
    <div class="{{ $content->component->media_align == 'left' ? 'col-sm-4':'' }} {{ $content->component->media_align == 'right' ? 'col-sm-4 pull-right':'' }} {{ $content->component->media_align == 'top' ? 'col-sm-12 text-center':'' }}">
        <a href="{{ $content->component->imageUrl }}" data-fancybox="gallery" data-caption="{{ $content->component->heading }}">
            <img class="img-responsive" src="{{ $content->component->thumbUrl }}" style="margin: auto;">
        </a>
    </div>

    <div class="col-sm-{{ $content->component->media_align == 'top' ? '12':'8' }}">
        {!! $content->component->content !!}
    </div>
</div>
