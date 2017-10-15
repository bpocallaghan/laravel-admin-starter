@foreach ($collection as $nav)
    <li class="{{ array_search_value($nav->id, $activeParents) ? 'active' : '' }} {{ isset($navigation[$nav->id])? 'dropdown':'' }}">
        <a href="{{ isset($navigation[$nav->id])? '#' : $nav->url }}" @if (isset($navigation[$nav->id])) class="dropdown-toggle" data-toggle="dropdown" role="button" role="button" aria-haspopup="true" aria-expanded="false" @endif>
            @if($nav->icon)
                <i class=" fa fa-fw fa-{{ $nav->icon }}"></i>
            @endif
            {!! $nav->name !!}
            @if (isset($navigation[$nav->id]))
                <span class="caret"></span>
            @endif
        </a>

        @if (isset($navigation[$nav->id]))
            <ul class="dropdown-menu">
                @include ('website.partials.navigation_list', ['collection' => $navigation[$nav->id]])
            </ul>
        @endif
    </li>
@endforeach
