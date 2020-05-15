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
                    <div class="burger-btn" id="burger-btn-1">
                        <span class="burg-top"></span>
                        <span class="burg-middle"></span>
                        <span class="burg-bottom"></span>
                    </div>
                </div>
                <div class="middle">
                    <div class="logo">
                        <a href="{{ route('rabbits') }}">
                            <img src="{{ asset('images/logo-long.png') }}" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="right">
                    <div class="user">
                        <a class="user-name txt-clip" id="user-name">
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
                                    <a href="{{ route('rabbits') }}" @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'rabbits'){{ 'class=active' }}@endif>
                                        <span class="icon icon-rabbit" title="Кролики"></span>
                                        <span class="link-text">Кролики</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('breeds') }}" @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'breeds'){{ 'class=active' }}@endif>
                                        <span class="icon icon-pawprint" title="Породы"></span>
                                        <span class="link-text">Породы</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('cages') }}" @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'cages'){{ 'class=active' }}@endif>
                                        <span class="icon icon-bird-cage" title="Клетки"></span>
                                        <span class="link-text">Клетки</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('matings') }}" @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'matings'){{ 'class=active' }}@endif>
                                        <span class="icon icon-heart" title="Случки"></span>
                                        <span class="link-text">Случки</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('vaccinations') }}" @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'vaccinations'){{ 'class=active' }}@endif>
                                        <span class="icon icon-syringe" title="Вакцинации"></span>
                                        <span class="link-text">Вакцинации</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('reminders') }}" @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'reminders'){{ 'class=active' }}@endif>
                                        <span class="icon icon-bell" id="ico-link-reminders" title="Напоминания"></span>
                                        <span class="link-text">Напоминания</span>
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
<script src="{{ asset('application/js/sorting.js') }}"></script>
<script src="{{ asset('application/js/get-today-reminders.js') }}"></script>
</body>
</html>
