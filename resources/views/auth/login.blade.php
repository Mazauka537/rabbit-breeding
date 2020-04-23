@extends('layouts.app')

@section('title', 'Login')

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
                                    Запомнить меня?
                                </label>
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
                        <div class="line">
                            <div class="label"></div>
                            <div class="labeled">
                                <input type="submit" value="Войти">
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
