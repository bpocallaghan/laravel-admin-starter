<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{!! config('app.name') !!}</a>
        </div>

        <h2 class="hidden">Navigation</h2>
        <div id="main-navbar-collapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @if(isset($navigation))
                    @include ('website.partials.navigation_list', ['collection' => $navigation['root'], 'navigation' => $navigation])
                @endif
                @if(\Auth::check() && user()->hasRole('admin'))
                    <li><a href="/admin"><i class="fa fa-user-secret"></i></a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
