@extends('layouts.app')

@section('title', 'Восстановление пароля')

@section('content')
    <div class="modal-window__inner scrollbar-macosx">
        <div class="form__wrapper" id="edit-item-form">
            <form action="{{ route('password.email') }}" class="form" method="post">
                @csrf
                <div class="head">
                    Восстановление пароля
                </div>

                <div class="body">
                    <div class="center-form pt-20">
                        <div class="line">
                            <div class="label">E-mail адрес:</div>
                            <div class="labeled">
                                <input type="email" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="line pt-20">
                            <div class="label"></div>
                            <div class="labeled">
                                <input type="submit" value="Отправить ссылку для сброса пароля">
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
        @if (session('status'))
            <div class="alert alert-success">
                <button class="alert-close-button"></button>
                На вашу почту было отправлено письмо для восстановления пароля.
            </div>
        @endif
    </div>

@endsection
