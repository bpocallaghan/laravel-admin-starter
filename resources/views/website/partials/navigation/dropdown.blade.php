@foreach ($collection as $nav)
    <a href="{{ $nav->url }}" class="dropdown-item">
        @if($nav->icon)
            <i class=" fa fa-fw fa-{{ $nav->icon }}"></i>
        @endif
        {!! $nav->name !!}
    </a>

    @if (isset($navigation[$nav->id]))
        <div class="dropdown-menu" aria-labelledby="{{ $nav->id }}">
            @include ('website.partials.navigation.dropdown', ['collection' => $navigation[$nav->id]])
        </div>
    @endif
@endforeach
