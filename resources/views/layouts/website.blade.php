<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="{{ config('app.author') }}">
        <meta name="keywords" content="{{ config('app.keywords') }}">
        <meta name="description" content="{{ isset($HTMLDescription) ? $HTMLDescription : config('app.description') }}"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta property="og:type" name="og:type" content="website"/>
        <meta property="og:site_name" content="{{ config('app.name') }}"/>
        <meta property="og:url" name="og:url" content="{{ Request::url() }}"/>
        <meta property="og:caption" name="og:caption" content="{{ config('app.url') }}"/>
        <meta property="fb:app_id" name="fb:app_id" content="{{ config('app.facebook_id') }}"/>
        <meta property="og:title" name="og:title" content="{{ isset($HTMLTitle) ? $HTMLTitle : config('app.title') }}">
        <meta property="og:description" name="og:description" content="{{ isset($HTMLDescription) ? $HTMLDescription : config('app.description') }}">
        <meta property="og:image" name="og:image" content="{{ config('app.url') }}{{ isset($HTMLImage) ? $HTMLImage : 'images/logo.png' }}">

        @include ('partials.favicons')

        <title>{{ isset($HTMLTitle) ? $HTMLTitle : config('app.name') }}</title>

        <link rel="stylesheet" href="/css/website.css?v=2">
        @yield('styles')
    </head>

    <body>
        @if(config('app.env') == 'llocall')
            @include('partials.facebook')
        @endif

        @include('website.partials.header')

        @if(isset($showPageBanner) && $showPageBanner == true || !isset($showPageBanner))
            @include('website.partials.slider')
        @endif

        <div class="container">
            @include('website.partials.breadcrumb')

            @yield('content')
        </div>

        @include('website.partials.footer')

        @include('website.partials.popup')

        <script type="text/javascript" charset="utf-8" src="/js/website.js?v=2"></script>
        <script type="text/javascript">
            $(document).ready(function ()
            {
                initWebsite();
            });
        </script>

        @yield('scripts')

        @if(config('app.env') != 'local')
            @include('partials.analytics')
        @endif
    </body>
</html>
