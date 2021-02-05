<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wiko-POS</title>

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.jpg') }}" />
    @yield('stylePerPage')

</head>

<body>
    @yield('body')
</body>
<!-- Scripts -->

@yield('jsPerPage')

</html>
