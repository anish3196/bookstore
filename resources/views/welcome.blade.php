<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin</title>

        <!-- Fonts -->
        <link href="{{ url('css/all.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
    </head>
    <body class="antialiased">
        <div id="app">
            @if(Auth::check())
                <mainapp :user="true"></mainapp>
            @else
                <mainapp :user="false"></mainapp>
            @endif


            @if(Auth::check())
            <script>
                window.User = {!! auth()->user()  !!}
            </script>
            @else
            <script>
                window.User = false
            </script>
            @endif

        </div>
    </body>
    <script src="{{ url('js/app.js') }}"></script>
</html>
