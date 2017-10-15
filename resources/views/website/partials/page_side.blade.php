<div class="side hidden-xs col-sm-5 col-lg-4">
    {{--<div class="well">
        <div class="side-heading">{!! $activePageTiers->name !!}</div>
        <ul>
            @foreach($activePageTiers->items as $item)
                <li><a href="{{ $item->url }}" class="{{ $item->id == $page->id? 'active':'' }}">{!! $item->name !!}</a></li>
            @endforeach
        </ul>
    </div>--}}
    <div class="well">
        <div class="side-heading">Popular Links</div>
        <ul>
            @foreach($popularPages as $item)
                <li><a href="{{ $item->url }}">{!! $item->name !!}</a></li>
            @endforeach
        </ul>
    </div>

    @include('website.partials.side_news')
</div>