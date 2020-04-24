@extends('layouts.app')

@section('title', 'Авторизация на сайте')

@section('content')
    <div class="modal-window__inner scrollbar-macosx">
        <div class="form__wrapper" id="edit-item-form">
            <form action="{{ route('login') }}" class="form" method="post">
                @csrf
                <div class="head">
                    Авторизация
                </div>

                <div class="body">
                    <div class="center-form pt-20">
                        <div class="line">
                            <div class="label">E-mail адрес:</div>
                            <div class="labeled">
                                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>
                        <div class="line">
                            <div class="label">Пароль:</div>
                            <div class="labeled">
                                <input type="password" name="password" required>
                            </div>
                        </div>
                        <div class="line">
                            <div class="label"></div>
                            <div class="labeled">
                                <input id="remember-check" type="checkbox"
                                       name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember-check">
                                    Запомнить меня
                                </label>
                            </div>
                        </div>
                        <div class="line pt-20">
                            <div class="label"></div>
                            <div class="labeled">
                                <input type="submit" value="Войти">
                            </div>
                        </div>
                        <div class="line form-link">
                            <div class="label"></div>
                            <div class="labeled">
                                @if (Route::has('password.request'))
                                    <a class="" href="{{ route('password.request') }}">
                                        {{ __('Забыли пароль?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="alerts">
        @if(count($errors->all()) != 0)
            <div class="alert alert-error">
                <button class="alert-close-button"></button>
                <div class="alert__inner">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endsection
