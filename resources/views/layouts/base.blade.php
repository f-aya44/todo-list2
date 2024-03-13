<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Todo</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @viteReactRefresh
    @yield('resource')
</head>
<body>
    {{-- @yield('header') --}}
    <div>
    @yield('content')
    </div>
</body>
</html>