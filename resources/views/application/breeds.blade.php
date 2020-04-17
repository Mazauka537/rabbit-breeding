@extends('layouts.application')

@section('title', 'breeds')

@section('main')
    <div class="main__inner">

        <div class="modal-window" id="modal-add-item-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="add-item-form">
                    <div class="close-button" id="btn-close-add-item-form"></div>
                    <form action="{{ route('addBreed') }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Добавление новой породы
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">Название*:</div>
                                    <div class="labeled">
                                        <input type="text" name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Описание:</div>
                                    <div class="labeled">
                                        <textarea name="desc">{{ old('desc') }}</textarea>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label"></div>
                                    <div class="labeled errors">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label"></div>
                                    <div class="labeled">
                                        <input type="submit" value="Добавить">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="add-button">
            <button id="btn-show-add-item-form"></button>
        </div>

        <div class="items clearfix">

            @foreach($breeds as $breed)
                <div class="item__wrapper">
                    <div class="item">
                        <div class="item__head">
                            <div class="item__name">
                                {{ $breed->name }}
                            </div>
                            <div class="item__arrow">

                            </div>
                        </div>
                        <div class="item__body">
                            <div class="left-form">
                                <div class="line">
                                    <div class="label">
                                        Название:
                                    </div>
                                    <div class="labeled">
                                        {{ $breed->name }}
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Кролики:
                                    </div>
                                    <div class="labeled">
                                        @if(!empty($breed->rabbits))
                                            @foreach($breed->rabbits as $key => $rabbit)
                                                <a href="{{ route('rabbit', $rabbit->id) }}">
                                                <span
                                                    class="@if($rabbit->gender == 'f') {{ 'female' }} @elseif($rabbit->gender == 'm') {{ 'male' }} @endif">
                                                    {{ $rabbit->name }}
                                                </span>
                                                    @if($key != count($breed->rabbits) - 1)
                                                        {{ ',' }}
                                                    @endif
                                                </a>
                                            @endforeach
                                        @else
                                            {{ '(нет кроликов)' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Описание:
                                    </div>
                                    <div class="labeled">
                                        {{ $breed->desc ?? '(нет описания)' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <script src="{{ asset('application/js/modal-add-item.js') }}"></script>
    </div>
@endsection
