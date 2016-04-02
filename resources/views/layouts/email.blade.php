<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">

        <style type='text/css'>
            body, html { color: #565656; font-family: Arial; font-size: 14px; padding: 0px; margin: 0px; }
            p { margin:0; padding:5px 0 }
            a {color:#2c699d }
            h2 { font-size:20px; }
            .dear { font-size:18px; }
            .dear strong { color:#2c699d}
        </style>
    </head>
    <body>
        @yield('content')

        <p>&nbsp;</p>
        <p>Have a great day ahead!</p>
        <p><strong>{{ env('APP_TITLE') }}</strong></p>
        <p> <a href="{{ env('APP_URL') }}">{{ env('APP_URL') }}</a></p>

        <p>&nbsp;</p>
        <img src="{{ env('APP_URL') }}images/logo.png" style="margin-top:10px" />
    </body>
</html>
