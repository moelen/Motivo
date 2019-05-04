<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        @stack('css')
    </head>
    <body>

        @include('layouts.partials.menu')

        <div class="container">
            @yield('content')
        </div>

        <script src="{{ mix('/js/app.js') }}"></script>

        @stack('js')

    </body>
</html>
