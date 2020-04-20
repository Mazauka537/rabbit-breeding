@extends('layouts.application')

@section('title', 'vaccinations')

@section('main')
    <div class="main__inner">

        <div class="modal-window" id="modal-add-item-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="add-item-form">
                    <div class="close-button" id="btn-close-add-item-form"></div>
                    <form action="{{ route('addVaccination') }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Добавление новой вакцинации
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">
                                        Название*:
                                    </div>
                                    <div class="labeled">
                                        <input type="text" name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Кролик*:
                                    </div>
                                    <div class="labeled">
                                        <select name="rabbit">
                                            <option value=""></option>
                                            @foreach($rabbits as $rabbit)
                                                <option
                                                    value="{{ $rabbit->id }}" @if(old('rabbit') == $rabbit->id) {{ 'selected' }} @endif>
                                                    {{ $rabbit->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Дата:
                                    </div>
                                    <div class="labeled">
                                        <input type="date" name="date" value="{{ old('date') }}">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Примечания:
                                    </div>
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

        <div class="modal-window" id="modal-edit-vaccination-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="edit-vaccination-form">
                    <div class="close-button" id="btn-close-edit-vaccination-form"></div>
                    <form action="{{ route('editVaccination', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Редактирование вакцинации "<span id="vaccination-name-edit"></span>"
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">
                                        Название*:
                                    </div>
                                    <div class="labeled">
                                        <input type="text" name="name" value="">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Кролик*:
                                    </div>
                                    <div class="labeled">
                                        <select name="rabbit">
                                            <option value=""></option>
                                            @foreach($rabbits as $rabbit)
                                                <option value="{{ $rabbit->id }}">
                                                    {{ $rabbit->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Дата:
                                    </div>
                                    <div class="labeled">
                                        <input type="date" name="date" value="">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Примечания:
                                    </div>
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

        <div class="modal-window" id="modal-delete-vaccination-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="delete-vaccination-form">
                    <div class="close-button" id="btn-close-delete-vaccination-form"></div>
                    <form action="{{ route('deleteVaccination', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Удаление вакцинации "<span id="vaccination-name-delete"></span>"
                        </div>

                        <div class="body pt-20">
                            Вы действительно хотите удалить вакцинацию "<span id="vaccination-name-delete-2"></span>"?
                            <div class="delete-form-buttons">
                                <input type="submit" value="Да">
                                <input type="button" value="Отмена" id="canсel-delete-vaccination">
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

            @foreach($vaccinations as $vaccination)
                <div class="item__wrapper">
                    <div class="item" data-id="{{ $vaccination->id }}" data-rabbit_id="{{ $vaccination->rabbit_id }}">
                        <div class="item__head item__head-hovered">
                            <div class="item__name">
                                {{ $vaccination->name }}
                            </div>
                            <div class="item__name-2">
                                {{ $vaccination->rabbit->name }}
                            </div>
                            <div class="item-buttons">
                                <button class="ico-btn edit-btn edit-vaccination-btn"></button>
                                <button class="ico-btn delete-btn delete-vaccination-btn"></button>
                                <span class="ico-btn caret-btn"></span>
                            </div>
                        </div>
                        <div class="item__body">
                            <div class="left-form">
                                <div class="line">
                                    <div class="label">
                                        Название:
                                    </div>
                                    <div class="labeled">
                                        {{ $vaccination->name }}
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Кролик:
                                    </div>
                                    <div class="labeled" id="vaccination-item-rabbit"
                                         data-rabbit_id="{{ $vaccination->rabbit->id }}">
                                        <a href="{{ route('rabbit', $vaccination->rabbit->id) }}"
                                           class="@if($vaccination->rabbit->gender == "f") {{ 'female' }} @else {{ 'male' }} @endif">
                                            {{ $vaccination->rabbit->name }}
                                        </a>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Дата:
                                    </div>
                                    <div class="labeled" id="vaccination-item-date"
                                         data-date="{{ $vaccination->date ?? '' }}">
                                        @if(!empty($vaccination->date))
                                            {{ date("d.m.Y", strtotime($vaccination->date)) }}
                                        @else
                                            {{ '(неизвестно)' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Примечания:
                                    </div>
                                    <div class="labeled" id="vaccination-item-desc">
                                        {{ $vaccination->desc ?? '(нет)' }}
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
        <script src="{{ asset('application/js/edit-item-vaccination.js') }}"></script>
        <script src="{{ asset('application/js/delete-item-vaccination.js') }}"></script>
    </div>
@endsection
