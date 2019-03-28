<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <title>Тестовое задание@yield('title_postfix')</title>
</head>

<body>
    <div id="content">
        @yield('content')
    </div>

    <hr>
    <h4>Навигация</h4>
    <ul id="links">
        <li><a href="/find-numbers">Функционал 1: поиск чисел</a></li>
        <li><a href="/exchange-converter?amount=100&currency=USD">Функционал 2: конвертер из валюты в RUR</a></li>
    </ul>
</body>

</html>
