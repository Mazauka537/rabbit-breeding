@extends('layouts.app')

@section('title', 'Восстановление пароля')

@section('content')
    <div class="modal-window__inner scrollbar-macosx">
        <div class="form__wrapper" id="edit-item-form">
            <form action="{{ route('password.update') }}" class="form" method="post">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="head">
                    Восстановление пароля
                </div>

                <div class="body">
                    <div class="center-form pt-20">
                        <div class="line">
                            <div class="label">E-mail адрес:</div>
                            <div class="labeled">
                                <input type="email" name="email" value="{{ $email ?? old('email') }}" required>
                            </div>
                        </div>
                        <div class="line">
                            <div class="label">Новый пароль:</div>
                            <div class="labeled">
                                <input type="password" name="password" required>
                            </div>
                        </div>
                        <div class="line">
                            <div class="label">Повторите пароль:</div>
                            <div class="labeled">
                                <input type="password" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="line pt-20">
                            <div class="label"></div>
                            <div class="labeled">
                                <input type="submit" value="Подтвердить смену пароля">
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
