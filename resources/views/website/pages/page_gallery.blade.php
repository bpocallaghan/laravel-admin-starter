@if($content->component->cover_photo)
    <figure>
        <a href="{{ $content->component->cover_photo->url }}" data-caption="{{ $content->component->cover_photo->name }}" data-fancybox="image">
            <img src="{{ $content->component->cover_photo->url }}" class="img-responsive" style="max-height: 300px; width: auto; margin: auto;">
        </a>
        <figcaption>{{ $content->component->cover_photo->name }}</figcaption>
    </figure>
@endif

{!! $content->component->content !!}

<div class="gallery">
    <div class="row">
        @foreach($content->component->photos as $item)
            <div class="col-xs-6 col-sm-4 col-lg-3">
                <figure>
                    <a href="{{ $item->url }}" rel="group" data-caption="{{ $item->name }}" data-fancybox="gallery" class="cover">
                        <img src="{{ $item->thumbUrl }}">
                    </a>
                    <figcaption>{!! $item->name !!}</figcaption>
                </figure>
            </div>
        @endforeach
    </div>
</div>
