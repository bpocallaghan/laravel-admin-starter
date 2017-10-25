@include('website.pages.page_content')

<div class="gallery">
    <div class="row">
        @foreach($content->component->documents as $item)
            <div class="col-xs-6 col-sm-4 col-lg-3">
                <a href="{{ $item->url }}" rel="group" title="{{ $item->name }}" target="_blank">
                    {{ $item->name }}
                </a>
            </div>
        @endforeach
    </div>
</div>
