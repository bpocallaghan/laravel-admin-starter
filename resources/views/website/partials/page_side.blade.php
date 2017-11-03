<div class="side d-none d-sm-block col-sm-5 col-lg-4">
    {{--<div class="well">
        <div class="side-heading">{!! $activePageTiers->name !!}</div>
        <ul>
            @foreach($activePageTiers->items as $item)
                <li><a href="{{ $item->url }}" class="{{ $item->id == $page->id? 'active':'' }}">{!! $item->name !!}</a></li>
            @endforeach
        </ul>
    </div>--}}
    <div class="card bg-light">
        <div class="card-body">
            <h2 class="side-heading">Popular Links</h2>
            <ul>
                @foreach($popularPages as $item)
                    <li><a href="{{ $item->url }}">{!! $item->name !!}</a></li>
                @endforeach
            </ul>
        </div>
    </div>

    @include('website.partials.side_news')
</div>