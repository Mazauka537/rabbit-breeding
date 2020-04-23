@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="modal-window__inner scrollbar-macosx">
        <div class="form__wrapper" id="edit-item-form">
            <form action="{{ route('register') }}" class="form" method="post">
                @csrf
                <div class="head">
                    Регистрация
                </div>

                <div class="body">
                    <div class="center-form pt-20">
                        <div class="line">
                            <div class="label">Имя:</div>
                            <div class="labeled">
                                <input type="text" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="line">
                            <div class="label">E-mail адрес:</div>
                            <div class="labeled">
                                <input type="email" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="line">
                            <div class="label">Пароль:</div>
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
                                <input type="submit" value="Зарегистрироваться">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
