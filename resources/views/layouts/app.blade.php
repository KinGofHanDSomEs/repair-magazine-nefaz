<!doctype html>
<html lang="ru" class="text-(length:--font-size) scroll-smooth" theme>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/icons/nefaz.png') }}" type="image/x-icon">

    <title>@yield('title', 'Главная')</title>

    @vite('resources/css/style.css')

    @vite('resources/js/theme.js')
</head>

<body class="bg1 min-h-screen flex flex-col overflow-x-hidden scroll-smooth">

<header class="bg3 c1 shrink-0 sticky top-0 z-9999">
    @include('inc.header')
</header>

<main class="shrink flex flex-1 flex-col justify-center items-center">
    @yield('main')
</main>

<footer class="c1 shrink-0 mt-auto text-xs">
    @include('inc.footer')
</footer>

@stack('scripts')
</body>
</html>
