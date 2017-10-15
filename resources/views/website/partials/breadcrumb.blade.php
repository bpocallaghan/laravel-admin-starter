@if(isset($breadcrumbItems))
    @if($page->id != 1)
        <ol class="breadcrumb">
            @foreach($breadcrumbItems as $item)
                <li>
                    @if(!$loop->last)
                        <a href="{{ $item->url }}">{{ $item->name }}</a>
                    @else
                        <span class="text-muted">{!! $item->name !!}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    @endif
@endif
