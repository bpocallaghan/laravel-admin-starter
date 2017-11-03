<header class="sticky-top fixed-top bg-primary">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar-collapse" aria-controls="main-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <h2 class="d-none">Navigation</h2>
            <div id="main-navbar-collapse" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    @if(isset($navigation))
                        @include ('website.partials.navigation.navigation', ['collection' => $navigation['root'], 'navigation' => $navigation])
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
