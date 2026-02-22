<!doctype html>
<html lang="ru" class="text-(length:--font-size)">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Главная')</title>
    @vite('resources/css/style.css')
</head>
<body class="min-h-screen flex flex-col bg1 overflow-x-hidden scroll-smooth">

<header class="shrink-0 bg4">
    @include('inc.header')
</header>

<main class="shrink flex-1">
    @yield('main')
</main>

<footer class="shrink-0 mt-auto">
    @include('inc.footer')
</footer>

@stack('scripts')
</body>
</html>
