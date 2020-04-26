<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('application/fonts/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('application/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset($theme ?? '') }}">
    <title>@yield('title')</title>
</head>
<body>

<div class="app">

    <header class="header" id="header">
        <div class="container">
            <div class="header__inner">
                <div class="left">
                    <div class="logo">
                        <a href="#">
                            <img src="{{ asset('images/logo-long.png') }}" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="right">
                    <div class="user">
                        <a class="user-name" id="user-name">
                            {{ \Illuminate\Support\Facades\Auth::user()->name }}
                        </a>
                        <ul class="user-list none-height">
                            <li>
                                <a href="{{ route('settings') }}">настройки</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();"
                                >
                                    выход
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="content scrollbar-macosx" id="container">

        <div class="container">
            <div class="content__inner">

                <aside class="aside" id="aside">
                    <div class="aside__inner">
                        <nav class="nav">
                            <ul>
                                <li>
                                    <a href="{{ route('rabbits') }}">
                                        <span class="icon icon-rabbit"></span>
                                        <span>Кролики</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('breeds') }}">
                                        <span class="icon icon-pawprint"></span>
                                        <span>Породы</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('cages') }}">
                                        <span class="icon icon-bird-cage"></span>
                                        <span>Клетки</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('matings') }}">
                                        <span class="icon icon-heart"></span>
                                        <span>Случки</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('vaccinations') }}">
                                        <span class="icon icon-syringe"></span>
                                        <span>Вакцинации</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('reminders') }}">
                                        <span class="icon icon-bell"></span>
                                        <span>Напоминания</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('reports') }}">
                                        <span class="icon icon-statistics"></span>
                                        <span>Отчеты</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>


                <main class="main">
                    @yield('main')
                </main>

            </div>
        </div>

    </div>

</div>

<script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('application/js/main.js') }}"></script>
<script src="{{ asset('application/js/pagination.js') }}"></script>
</body>
</html>
