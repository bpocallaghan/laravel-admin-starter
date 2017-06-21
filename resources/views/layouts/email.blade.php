<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">

        <style type='text/css'>
            body, html {
                color: #565656;
                font-family: Arial;
                font-size: 14px;
                padding: 0px;
                margin: 0px;
            }

            p {
                margin: 0;
                padding: 5px 0
            }

            a {
                color: #2c699d
            }

            h2 {
                font-size: 20px;
            }

            .dear {
                font-size: 18px;
            }

            .dear strong {
                color: #2c699d
            }
        </style>
    </head>
    <body>
        @yield('content')

        <p>&nbsp;</p>
        {{--<p>Have a great day ahead!</p>--}}
        <p><strong>{{ config('app.name') }}</strong></p>
        <p><a href="{{ config('app.url') }}">{{ config('app.url') }}</a></p>

        <p>
            <a href="{{ config('app.url') }}">
                <img src="{{ config('app.url') }}/images/logo.png" style="margin-top:10px"/>
            </a>
        </p>
    </body>
</html>
