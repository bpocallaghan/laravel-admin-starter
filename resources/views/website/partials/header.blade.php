<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{!! config('app.name') !!}</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if(isset($navigation))
                    {!! $navigation !!}
                @else
                    <li>
                        <a href="/">Home</a>
                    </li>
                @endif
                <li>
                    <a href="/admin">
                        @if(Auth::check())
                            {!! user()->fullname !!}
                        @else
                            <i class="fa fa-user-secret"></i>
                            Admin
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
