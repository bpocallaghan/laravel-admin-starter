<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="{!! env('APP_AUTHOR') !!}">
        <meta name="keywords" content="{!! env('APP_KEYWORDS') !!}">
        <meta name="description" content="{{ $HTMLDescription }}"/>

        <title>{{ $HTMLTitle }}</title>

        <link rel="shortcut icon" type="image/ico" href="/favicon.ico">

        {{-- google font --}}
        @if(env('APP_DEBUG') != 'local')
            <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel='stylesheet' type='text/css'>
        @endif

        {{-- stylesheet --}}
        <link rel="stylesheet" href="/css/admin/all.css">
    </head>

    <body class="hold-transition skin-blue sidebar-mini">

        <div class="wrapper">

            @include('admin.partials.header')

            @include('admin.partials.navigation')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    {!! $pagecrumb !!}

                    {!! $breadcrumb !!}
                </section>

                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
                <div class="" style="text-align: right">
                    &copy; {{ date('Y') }} {!! env('APP_TITLE') !!}
                </div>
            </footer>
        </div>

        @include('notify::notify')
        @include('admin.partials.modals')

        <!-- scripts -->
        <script type="text/javascript" charset="utf-8" src="/js/admin/all.js"></script>

        <script type="text/javascript">
            $(document).ready(function ()
            {
                initAdmin();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    }
                });
            });
        </script>

        @yield('scripts')
    </body>
</html>
