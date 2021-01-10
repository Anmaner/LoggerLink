<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LoggerLink</title>

    <script src="{{ mix('js/app.js', 'build') }}" defer></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body>
    @yield('body')
</body>
</html>
