@extends('layouts.application')

@section('title', 'settings')

@section('main')
    <div class="main__inner">

        <div class="wrapper settings__wrapper">
            <div class="head">
                Настройки
            </div>
            <form action="{{ route('saveSettings', $user->id) }}" method="post"
                  enctype="multipart/form-data" class="form">
                @csrf
                <input type="hidden" name="theme" id="theme-name-inp" value="{{ $user->theme }}">
                <div class="center-form">
                    <div class="line">
                        <div class="label">Записей на странице:</div>
                        <div class="labeled">
                            <input type="number" name="pagination" min="1" max="200" value="{{ $user->pagination }}">
                        </div>
                    </div>
                    <div class="line">
                        <div class="label">Тема:</div>
                        <div class="labeled">
                            <div class="theme-input">
                                <div class="theme-item__wrapper">
                                    <div class="theme-item @if($user->theme == 'default' || empty($user->theme)) {{ 'selected-theme' }} @endif" data-name="default" style="background-color: #87F03C"></div>
                                </div>
                                @foreach($themes as $key => $value)
                                    <div class="theme-item__wrapper">
                                        <div class="theme-item @if($key == $user->theme) {{ 'selected-theme' }} @endif" data-name="{{ $key }}" style="background-color: {{ $value->color }}"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="line">
                        <div class="label"></div>
                        <div class="labeled">
                            <input type="submit" value="Сохранить">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="alerts animated bounceInUp">
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

    </div>
    <script src="{{ asset('application/js/themes.js') }}"></script>
@endsection
