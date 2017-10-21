<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta name="author" content="{!! config('app.author') !!}">
        <meta name="keywords" content="{!! config('app.keywords') !!}">
        <meta name="description" content="{{ $HTMLDescription }}"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @include ('partials.favicons')

        <title>{{ $HTMLTitle }}</title>

        @if(config('app.debug') != 'local')
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        @endif

        <link rel="stylesheet" href="/css/admin.css?v=1">
        @yield('styles')
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <h1 class="hidden">{{ isset($HTMLTitle) ? $HTMLTitle : config('app.name') }}</h1>

        <div class="wrapper">
            @include('admin.partials.header')

            @include('admin.partials.navigation')

            <div class="content-wrapper">
                <h2 class="hidden">Breadcrumb</h2>
                <section class="content-header">
                    {!! $pagecrumb !!}

                    {!! $breadcrumb !!}
                </section>

                <section class="content">
                    <h2 class="hidden">Page</h2>
                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <small>Copyright &copy; {{ date('Y') }}
                            <strong>{{ config('app.name') }}</strong>
                        </small>
                    </div>
                    <div class="col-sm-6 text-right">
                        <small>
                            Developed by
                            <a href="https://github.com/bpocallaghan" target="_blank">{!! config('app.author') !!}</a>
                        </small>
                    </div>
                </div>
            </footer>
        </div>

        @include('notify::notify')
        @include('admin.partials.modals')

        <script type="text/javascript" charset="utf-8" src="/js/admin.js?v=1"></script>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function () {
                initAdmin();
            });
        </script>

        @yield('scripts')

        @if(config('app.env') != 'local')
            @include('partials.analytics')
        @endif
    </body>
</html>
