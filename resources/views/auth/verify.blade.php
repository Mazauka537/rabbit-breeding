@extends('layouts.app')

@section('title', 'Подтверждение e-mail')

@section('content')

    <div class="modal-window__inner scrollbar-macosx">
        <div class="form__wrapper" id="edit-item-form">
            <form action="{{ route('login') }}" class="form" method="post">
                @csrf
                <div class="head">
                    Подтверждение e-mail
                </div>

                <div class="body">
                    @if (session('resent'))
                        <div class="alert alert-success alert-full">
                            На указанный e-mail адрес было отправлено проверочное письмо.
                        </div>
                    @endif
                    <div class="pt-20 verify-text">
                        Прежде чем продолжить, пожалуйста, проверьте свою электронную почту на наличие проверочного письма.
                        Если письмо не было получено, <a class="underline" href="{{ /*route('verification.resend')*/'login'}}">нажмите здесь, чтобы отправить его повторно</a>.
                    </div>
                </div>
            </form>
        </div>
    </div>


{{-- {{ route('verification.resend') }} --}}

@endsection
