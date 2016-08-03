<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="{{ config('app.author') }}">
        <meta name="keywords" content="{{ config('app.keywords') }}">
        <meta name="description" content="{{ isset($HTMLDescription) ? $HTMLDescription : config('app.description') }}"/>

        <meta property="og:type" name="og:type" content="website"/>
        <meta property="og:site_name" content="{{ config('app.title') }}"/>
        <meta property="og:url" name="og:url" content="{{ Request::url() }}"/>
        <meta property="og:caption" name="og:caption" content="{{ config('app.url') }}"/>
        <meta property="fb:app_id" name="fb:app_id" content="{{ config('app.facebook_id') }}"/>
        <meta property="og:title" name="og:title" content="{{ isset($HTMLTitle) ? $HTMLTitle : config('app.title') }}">
        <meta property="og:description" name="og:description" content="{{ isset($HTMLDescription) ? $HTMLDescription : config('app.description') }}">
        <meta property="og:image" name="og:image" content="{{ config('app.url') }}{{ isset($HTMLImage) ? $HTMLImage : 'images/logo.png' }}">

        <title>{{ isset($HTMLTitle) ? $HTMLTitle : config('app.title') }}</title>

        <link rel="shortcut icon" type="image/ico" href="/favicon.ico">

        {{-- google font --}}
        @if(config('app.env') != 'local')
        @endif

        {{-- stylesheet --}}
        <link rel="stylesheet" href="/css/all.css">
    </head>

    <body>
        {{-- facebook root --}}
        @if(config('app.env') != 'local')
            @include('partials.facebook')
        @endif

        @include('website.partials.header')

        @include('website.partials.slider')

        @include('website.partials.breadcrumb')

        @yield('content')

        @include('website.partials.footer')

        @include('website.partials.popup')

        {{-- scripts --}}
        <script type="text/javascript" charset="utf-8" src="/js/all.js"></script>

        <script type="text/javascript">
            $(document).ready(function ()
            {
                $.ajaxSetup({headers: {'X-CSRF-Token': '{{ csrf_token() }}'}});
            });
        </script>

        {{-- page specific scripts --}}
        @yield('scripts')

        @if(config('app.env') != 'local')
            @include('partials.google_analytics')
        @endif
    </body>
</html>
