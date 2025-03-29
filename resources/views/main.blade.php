<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            @yield('title', 'Juegos')
        </title> 

        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">    
    
    </head>
    <body>
        

        @yield('content')

        <div class=footer>© Lucas 2025</div>

    </body>
</html>
