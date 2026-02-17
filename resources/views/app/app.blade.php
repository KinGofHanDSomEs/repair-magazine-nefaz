<!doctype html>
<html lang="ru" theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Главная')</title>
</head>
<body>

<header>
    <div class="container">
        @include('inc.header')
    </div>
</header>

<main>
    <div class="container">
        @yield('main')
    </div>
</main>

<footer>
    <div class="container">
        @include('inc.footer')
    </div></footer>

</body>
</html>
