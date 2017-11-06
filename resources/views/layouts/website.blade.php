<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="{{ config('app.author') }}">
        <meta name="keywords" content="{{ config('app.keywords') }}">
        <meta name="description" content="{{ isset($description) ? $description : config('app.description') }}"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta property="og:type" name="og:type" content="website"/>
        <meta property="og:site_name" content="{{ config('app.name') }}"/>
        <meta property="og:url" name="og:url" content="{{ request()->url() }}"/>
        <meta property="og:caption" name="og:caption" content="{{ config('app.url') }}"/>
        <meta property="fb:app_id" name="fb:app_id" content="{{ config('app.facebook_id') }}"/>
        <meta property="og:title" name="og:title" content="{{ isset($title) ? $title : config('app.title') }}">
        <meta property="og:description" name="og:description" content="{{ isset($description) ? $description : config('app.description') }}">
        <meta property="og:image" name="og:image" content="{{ config('app.url') }}{{ isset($image) ? $image : '/images/logo.png' }}">

        @include ('partials.favicons')

        <title>{{ isset($title) ? $title : config('app.name') }}</title>

        @if(config('app.env') != 'local')
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        @endif

        <link rel="stylesheet" href="/css/website.css?v=2">

        @yield('styles')
    </head>

    <body id="top" class="d-flex flex-column align-items-end">
        <h1 class="d-none">{{ isset($title) ? $title : config('app.name') }}</h1>

        @if(config('app.env') != 'local')
            @include('partials.facebook')
        @endif

        @include('website.partials.header')

        @include('website.partials.navigation')

        @if(isset($showPageBanner) && $showPageBanner == true || !isset($showPageBanner))
            @include('website.partials.banner')
        @endif

        <div class="container mb-5">
            @yield('content')
        </div>

        @include('website.partials.footer')

        @include('website.partials.popups')

        {{-- back to top --}}
        <a href="#top" class="back-to-top jumper btn btn-secondary">
            <i class="fa fa-angle-up"></i>
        </a>

        <script type="text/javascript" charset="utf-8" src="/js/website.js?v=2"></script>

        @yield('scripts')

        @if(config('app.env') != 'local')
            @include('partials.analytics')
        @endif
    </body>
</html>
