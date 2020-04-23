@extends('layouts.app')

@section('title', 'Reset Password')

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

    @if (session('status'))
        {{ session('status') }}
    @endif

@endsection
