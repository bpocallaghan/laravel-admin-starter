@if($content->photos->count() > 0)
<div class="gallery">
    <div class="row">
        @foreach($content->photos as $item)
            <div class="col-6 col-sm-4 col-lg-3 mb-3">
                <figure>
                    <a href="{{ $item->url }}" rel="group" title="{{ $item->name }}" data-fancybox="gallery" class="cover" style="background-image:url('{{ $item->thumbUrl }}')">
                        <img src="{{ $item->thumbUrl }}">
                    </a>
                    <figcaption>{!! $item->name !!}</figcaption>
                </figure>
            </div>
        @endforeach
    </div>
</div>
@endif