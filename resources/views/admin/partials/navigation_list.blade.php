@foreach ($collection as $nav)
    <li class="{{ array_search_value($nav->id, $selectedNavigationParents) ? 'active menu-open' : '' }} {{ isset($navigation[$nav->id])? 'treeview':'' }}">
        <a href="{{ isset($navigation[$nav->id])? '#' : $nav->url }}">
            <i class="fa fa-fw fa-{{ $nav->icon }}"></i>
            <span>{!! $nav->title !!}</span>

            @if (isset($navigation[$nav->id]))
                <i class="fa fa-angle-left pull-right"></i>
            @endif
        </a>

        @if (isset($navigation[$nav->id]))
            <ul class="treeview-menu">
                @include ('admin.partials.navigation_list', ['collection' => $navigation[$nav->id]])
            </ul>
        @endif
    </li>
@endforeach
