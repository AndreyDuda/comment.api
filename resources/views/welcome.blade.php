<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}'}</script>

        <title>Comments</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div id="app">
            <navbar></navbar>
            <div class="container">
                <comments></comments>
            </div>
        </div>

        <script src="{{ mix('js/bootstrap.js', 'build') }}"></script>
        <script src="{{ mix('js/app.js', 'build') }}"></script>
    </body>
</html>
