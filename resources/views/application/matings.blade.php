@extends('layouts.application')

@section('title', 'matings')

@section('main')
    <div class="main__inner">

        <div class="modal-window" id="modal-add-item-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="add-item-form">
                    <div class="close-button" id="btn-close-add-item-form"></div>
                    <form action="{{ route('addMating') }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Добавление новой случки
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">Самка:</div>
                                    <div class="labeled">
                                        <select name="female">
                                            <option value="">не известно</option>
                                            @foreach($rabbits as $rabbit)
                                                @if($rabbit->gender == 'f')
                                                    <option
                                                        value="{{ $rabbit->id }}" @if($rabbit->id == old('female')) {{ 'selected' }} @endif >{{ $rabbit->name }}  @if(!empty($rabbit->status_value)) {{ '('.$rabbit->status_value.')' }} @endif</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Самец:</div>
                                    <div class="labeled">
                                        <select name="male">
                                            <option value="">не известно</option>
                                            @foreach($rabbits as $rabbit)
                                                @if($rabbit->gender == 'm')
                                                    <option
                                                        value="{{ $rabbit->id }}" @if($rabbit->id == old('male')) {{ 'selected' }} @endif>{{ $rabbit->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Дата случки:</div>
                                    <div class="labeled">
                                        <input type="date" name="date" value="{{ old('date') }}">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Дата окрола:</div>
                                    <div class="labeled">
                                        <input type="date" name="date_birth" value="{{ old('date_birth') }}">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Общее кол-во крольчат:</div>
                                    <div class="labeled">
                                        <input type="number" name="child_count" value="{{ old('child_count') }}">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Кол-во выживших крольчат:</div>
                                    <div class="labeled">
                                        <input type="number" name="alive_count" value="{{ old('alive_count') }}">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Дополнительная информация</div>
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

        <div class="modal-window" id="modal-edit-mating-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="edit-mating-form">
                    <div class="close-button" id="btn-close-edit-mating-form"></div>
                    <form action="{{ route('editMating', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Редактирование случки <span id="mating-name-edit"></span>
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">Самка:</div>
                                    <div class="labeled">
                                        <select name="female">
                                            <option value="">неизвестно</option>
                                            @foreach($rabbits as $rabbit)
                                                @if($rabbit->gender == 'f')
                                                    <option
                                                        value="{{ $rabbit->id }}">{{ $rabbit->name }} @if(!empty($rabbit->status_value)) {{ '('.$rabbit->status_value.')' }} @endif</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Самец:</div>
                                    <div class="labeled">
                                        <select name="male">
                                            <option value="">неизвестно</option>
                                            @foreach($rabbits as $rabbit)
                                                @if($rabbit->gender == 'm')
                                                    <option
                                                        value="{{ $rabbit->id }}">{{ $rabbit->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Дата случки:</div>
                                    <div class="labeled">
                                        <input type="date" name="date" value="">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Дата окрола:</div>
                                    <div class="labeled">
                                        <input type="date" name="date_birth" value="">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Общее кол-во крольчат:</div>
                                    <div class="labeled">
                                        <input type="number" name="child_count" value="">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Кол-во выживших крольчат:</div>
                                    <div class="labeled">
                                        <input type="number" name="alive_count" value="">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Дополнительная информация:</div>
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

        <div class="modal-window" id="modal-delete-mating-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="delete-mating-form">
                    <div class="close-button" id="btn-close-delete-mating-form"></div>
                    <form action="{{ route('deleteMating', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Удаление случки <span id="mating-name-delete"></span>
                        </div>

                        <div class="body pt-20">
                            Вы действительно хотите удалить случку <span id="mating-name-delete-2"></span>?
                            <div class="delete-form-buttons">
                                <input type="submit" value="Да">
                                <input type="button" value="Отмена" id="canсel-delete-mating">
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

            @foreach($matings as $mating)
                <div class="item__wrapper">
                    <div class="item" data-id="{{ $mating->id }}" data-female_id="{{ $mating->female->id ?? ''}}"
                         data-male_id="{{ $mating->male->id ?? ''}}">
                        <div class="item__head">
                            <div class="item__name">
                                <span class="female">
                                    {{ $mating->female->name ?? '(неизвестно)' }}
                                </span>
                                +
                                <span class="male">
                                    {{ $mating->male->name ?? '(неизвестно)' }}
                                </span>
                            </div>
                            <div class="item-buttons">
                                <button class="ico-btn edit-btn edit-mating-btn"></button>
                                <button class="ico-btn delete-btn delete-mating-btn"></button>
                                <span class="ico-btn caret-btn"></span>
                            </div>
                        </div>
                        <div class="item__body">
                            <div class="left-form">
                                <div class="line">
                                    <div class="label">
                                        Самка:
                                    </div>
                                    <div class="labeled">
                                        @if(!empty($mating->female_id))
                                            <a class="female" href="{{ route('rabbit', $mating->female_id) }}">
                                                {{ $mating->female->name }}
                                            </a>
                                        @else
                                            <span class="female">
                                            (неизвестно)
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Самец:
                                    </div>
                                    <div class="labeled">
                                        @if(!empty($mating->male_id))
                                            <a class="male" href="{{ route('rabbit', $mating->male_id) }}">
                                                {{ $mating->male->name }}
                                            </a>
                                        @else
                                            <span class="male">
                                            (неизвестно)
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Дата случки:
                                    </div>
                                    <div class="labeled" id="mating-item-date" data-date="{{ $mating->date ?? '' }}">
                                        @if(!empty($mating->date))
                                            {{ date("d.m.Y", strtotime($mating->date)) }}
                                        @else
                                            {{ '(неизвестно)' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Дата окрола:
                                    </div>
                                    <div class="labeled" id="mating-item-date_birth"
                                         data-date_birth="{{ $mating->date_birth ?? '' }}">
                                        @if(!empty($mating->date_birth))
                                            {{ date("d.m.Y", strtotime($mating->date_birth)) }}
                                        @else
                                            {{ '(неизвестно)' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Всего крольчат:
                                    </div>
                                    <div class="labeled" id="mating-item-child_count">
                                        {{ $mating->child_count ?? '(неизвестно)' }}
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Выживших крольчат:
                                    </div>
                                    <div class="labeled" id="mating-item-alive_count">
                                        {{ $mating->alive_count ?? '(неизвестно)' }}
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Дополнительная информация:
                                    </div>
                                    <div class="labeled" id="mating-item-desc">
                                        {{ $mating->desc ?? '(нет)' }}
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
        <script src="{{ asset('application/js/edit-item-mating.js') }}"></script>
        <script src="{{ asset('application/js/delete-item-mating.js') }}"></script>
    </div>
@endsection
