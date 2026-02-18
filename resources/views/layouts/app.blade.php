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
<body class="min-h-screen flex flex-col">

<header class="shrink-0">
    <div class="container mx-auto">
        @include('inc.header')
    </div>
</header>

<main class="shrink">
    <div class="container mx-auto bg-">
        <h1>Первый</h1>
        <h2>Второй</h2>
        <h3>Третий</h3>
        <p>Абзац</p>
        <a href="">Ссылка</a>
        <label for="">Лэйбл</label>
        @yield('main')
    </div>
</main>

<footer class="shrink-0 mt-auto">
    <div class="container mx-auto">
        @include('inc.footer')
    </div>
</footer>

</body>
</html>
