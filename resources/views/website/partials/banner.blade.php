<div class="banner-container">
    <h2 class="hidden">Banner</h2>
    <div id="banner-carousel" class="carousel slide banners" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            @foreach($banners as $k => $banner)
                <div class="item {{ $k == 0? 'active':'' }}">
                    <img src="{{ uploaded_images_url($banner->image) }}"/>
                    <div class="carousel-caption">
                        @if(!$banner->hide_name)
                            <h2>{!! $banner->name !!}</h2>
                        @endif
                        @if($banner->summary)
                            <p>{!! $banner->summary !!}</p>
                        @endif
                        @if($banner->action_url)
                            <a class="btn btn-default" target="_blank" href="{{ $banner->action_url }}">{{ $banner->action_name ?: 'read more' }}</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <a class="left carousel-control" href="#banner-carousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#banner-carousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </div>
</div>

