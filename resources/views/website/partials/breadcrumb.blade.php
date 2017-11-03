@if(isset($breadcrumbItems))
    @if($page->id != 1)
        <ol class="breadcrumb bg-light">
            @foreach($breadcrumbItems as $item)
                <li class="breadcrumb-item">
                    @if(!$loop->last)
                        <a class="text-secondary" href="{{ $item->url }}">{{ $item->name }}</a>
                    @else
                        <span class="text-muted">{!! $item->name !!}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    @endif
@endif
