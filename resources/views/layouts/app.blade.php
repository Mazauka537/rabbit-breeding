<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('application/fonts/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('application/css/main.css') }}">
    <title>@yield('title')</title>

</head>
<body>
<div class="app">

    <header class="header" id="header">
        <div class="container">
            <div class="header__inner">
                <div class="left">
                    <div class="logo">
                        <a href="{{ route('rabbits') }}">
                            <img src="{{ asset('images/logo-long.png') }}" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="right">
                    <div class="user">
                        @guest
                            <ul class="auth-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ 'Вход' }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ 'Регистрация' }}</a>
                                    </li>
                                @endif
                            </ul>
                        @else
                            <a class="user-name" id="user-name">
                                {{ \Illuminate\Support\Facades\Auth::user()->name }}
                            </a>
                            <ul class="user-list none-height">
                                <li>
                                    <a href="#">настройки</a>
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
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="content scrollbar-macosx" id="container">
        <div class="container">
            <div class="content__inner">
                <main class="main">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

</div>

<script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('application/js/scrolls.js') }}"></script>
<script src="{{ asset('application/js/alerts.js') }}"></script>

</body>
</html>
