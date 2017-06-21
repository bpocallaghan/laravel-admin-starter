<header id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
        @if(isset($banners) && count($banners) > 0)
            @foreach($banners as $k => $banner)
                <div class="item {{ $k == 0? 'active':'' }}">
                    <img src="/uploads/images/{{ $banner->image }}"/>
                    <div class="carousel-caption">
                        <h2>{!! $banner->title !!}</h2>
                        @if($banner->subtitle)
                            <p>{!! $banner->subtitle !!}</p>
                        @endif
                        @if($banner->action_link)
                            <a class="btn btn-default" target="_blank" href="{{ $banner->action_link }}">{{ $banner->action_title ?: 'Click Me' }}</a>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="item active">
                <div class="fill" style="background-image:url('http://placehold.it/1900x500');"></div>
                <div class="carousel-caption">
                    <h2>Title Caption 1</h2>
                </div>
            </div>

            <div class="item">
                <div class="fill" style="background-image:url('http://placehold.it/1900x500');"></div>
                <div class="carousel-caption">
                    <h2>Title Caption 2</h2>
                </div>
            </div>
        @endif
    </div>

    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>
</header>