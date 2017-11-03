{{--@if($content->component->cover_photo)
    <figure>
        <a href="{{ $content->component->cover_photo->url }}" title="Image Caption" data-caption="Image Caption" data-fancybox="image">
            <img src="{{ $content->component->cover_photo->url }}" class="img-responsive" style="max-height: 300px; width: auto; margin: auto;">
        </a>
        <figcaption>{{ $content->component->cover_photo->name }}</figcaption>
    </figure>
@endif--}}

@include('website.pages.page_content')

<div class="gallery">
    <div class="row">
        @foreach($content->component->photos as $item)
            <div class="col-6 col-sm-4 col-lg-3">
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
