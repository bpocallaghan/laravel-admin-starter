<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta name="author" content="{!! config('app.author') !!}">
        <meta name="keywords" content="{!! config('app.keywords') !!}">
        <meta name="description" content="{{ isset($description) ? $description : config('app.description') }}"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @include('partials.favicons')

        <title>{{ isset($title) ? $title : config('app.name') }}</title>

        <link rel="stylesheet" href="/css/website.css?v=1">

        @yield('styles')
    </head>

    <body id="top">
        <h1 class="hidden">{{ isset($title) ? $title : config('app.name') }}</h1>

        @include('website.partials.navigation')

        <div class="container">
            <div class="content">
                <div class="logo text-center" style="padding-top: 25px;">
                    <a href="/" title="{{ config('app.name') }}">
                        <img src="/images/logo.png"/>
                    </a>
                </div>

                @yield('content')
            </div>
        </div>

        @include('website.partials.footer')

        <script type="text/javascript" charset="utf-8" src="/js/website.js?v=3"></script>

        @yield('scripts')

        @if(config('app.env') != 'local')
            @include('partials.analytics')
        @endif
    </body>
</html>
