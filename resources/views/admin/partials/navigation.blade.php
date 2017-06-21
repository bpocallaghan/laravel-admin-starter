<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ profile_image() }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{!! user()->firstname !!}</p>
                <p>{!! user()->lastname !!}</p>
            </div>
        </div>

        <nav>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                {!! $navigation !!}
            </ul>
        </nav>
    </section>
</aside>