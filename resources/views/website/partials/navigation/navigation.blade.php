@foreach ($collection as $nav)
    <li class="{{ array_search_value($nav->id, $activeParents) ? 'active' : '' }} {{ isset($navigation[$nav->id])? 'dropdown':'' }} @if ( $nav->parent_id != 0) dropdown-item @else nav-item @endif ">
        <a href="{{ isset($navigation[$nav->id])? '#' : $nav->url }}" @if (isset($navigation[$nav->id])) class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="{{ $nav->id }}" @else class="nav-link" @endif>
            @if($nav->icon)
                <i class=" fa fa-fw fa-{{ $nav->icon }}"></i>
            @endif
            {!! $nav->name !!}
        </a>

        @if (isset($navigation[$nav->id]))
            <div class="dropdown-menu" aria-labelledby="{{ $nav->id }}">
                @include('website.partials.navigation.dropdown', ['collection' => $navigation[$nav->id]])
            </div>
        @endif
    </li>
@endforeach
