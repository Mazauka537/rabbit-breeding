@extends('layouts.application')

@section('title', 'cages')

@section('main')
    <div class="main__inner">

        <div class="modal-window" id="modal-add-item-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="add-item-form">
                    <div class="close-button" id="btn-close-add-item-form"></div>
                    <form action="{{ route('addCage') }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Добавление новой клетки
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

        <div class="modal-window" id="modal-edit-item-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="edit-item-form">
                    <div class="close-button" id="btn-close-edit-item-form"></div>
                    <form action="{{ route('editCage', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Редактирование клетки <span id="cage-name-edit"></span>
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">Название*:</div>
                                    <div class="labeled">
                                        <input type="text" name="name" value="">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Описание:</div>
                                    <div class="labeled">
                                        <textarea name="desc"></textarea>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label"></div>
                                    <div class="labeled">
                                        <input type="submit" value="Сохранить">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal-window" id="modal-delete-item-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="delete-item-form">
                    <div class="close-button" id="btn-close-delete-item-form"></div>
                    <form action="{{ route('deleteCage', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Удаление клетки <span id="cage-name-delete"></span>
                        </div>

                        <div class="body pt-20">
                            Вы действительно хотите удалить клетку "<span id="cage-name-delete-2"></span>"?
                            <div class="delete-form-buttons">
                                <input type="submit" value="Да">
                                <input type="button" value="Отмена" id="canсel-delete-cage">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="add-button">
            <button id="btn-show-add-item-form"></button>
        </div>

        <div class="items">

            @foreach($cages as $cage)
                <div class="item__wrapper">
                    <div class="item" data-id="{{ $cage->id }}">
                        <div class="item-buttons">
                            <button class="ico-btn edit-btn"></button>
                            <button class="ico-btn delete-btn"></button>
                        </div>
                        <div class="item__head">
                            <div class="item__name">
                                {{ $cage->name }}
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
                                        {{ $cage->name }}
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Кролики:
                                    </div>
                                    <div class="labeled">
                                        @if(count($cage->rabbits) != 0)
                                            @foreach($cage->rabbits as $key => $rabbit)
                                                <a href="{{ route('rabbit', $rabbit->id) }}"
                                                   class="@if($rabbit->gender == 'f') {{ 'female' }} @elseif($rabbit->gender == 'm') {{ 'male' }} @endif">
                                                    {{ $rabbit->name }}
                                                </a>
                                                @if($key != count($cage->rabbits) - 1)
                                                    {{ ',' }}
                                                @endif
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
                                    <div class="labeled" id="desc">
                                        {{ $cage->desc ?? '(нет описания)' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

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

        <script src="{{ asset('application/js/modal-add-item.js') }}"></script>
        <script src="{{ asset('application/js/edit-item-cage.js') }}"></script>
        <script src="{{ asset('application/js/delete-item-cage.js') }}"></script>
    </div>
@endsection
