<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <title>Laravel</title>
    </head>
    <body>
        <div id="app">
            <router-view />
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
