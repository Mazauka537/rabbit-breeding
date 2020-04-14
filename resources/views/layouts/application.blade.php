<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('application/fonts/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('application/css/main.css') }}">
    <title>@yield('title')</title>
</head>
<body>

<div class="app">

    <header class="header" id="header">

    </header>

    <div class="content">

        <aside class="aside" id="aside">
            <div class="aside__header">

            </div>
            <div class="aside__inner scrollbar-macosx" id="aside-inner">
                <nav class="nav">
                    <ul>
                        <li>
                            <a href="#">
                                <span class="icon icon-rabbit"></span>
                                <span>Кролики</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon icon-pawprint"></span>
                                <span>Породы</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon icon-bird-cage"></span>
                                <span>Клетки</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon icon-heart"></span>
                                <span>Случки</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon icon-syringe"></span>
                                <span>Вакцинации</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon icon-statistics"></span>
                                <span>Отчеты</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon icon-bell"></span>
                                <span>Уведомления</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <main class="main scrollbar-macosx" id="main">
            @yield('main')
        </main>

    </div>

</div>

<script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('application/js/main.js') }}"></script>
</body>
</html>
