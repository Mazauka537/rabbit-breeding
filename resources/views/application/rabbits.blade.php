@extends('layouts.application')

@section('title', 'Кролики - ' . config('app.name'))

@section('main')
    <div class="main__inner rabbits-page">

        <div class="modal-window" id="modal-add-item-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="add-item-form">
                    <div class="close-button" id="btn-close-add-item-form"></div>
                    <form action="{{ route('addRabbit') }}" class="form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="head">
                            Добавление нового кролика
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">Имя*:</div>
                                    <div class="labeled">
                                        <input type="text" name="name" placeholder="Имя кролика"
                                               value="{{ old('name') }}" required maxlength="64">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Пол*:</div>
                                    <div class="labeled">
                                        <select name="gender" id="inp-rabbit-gender" required>
                                            <option value=""></option>
                                            <option value="m" @if(old('gender') == 'm') {{ "selected" }} @endif>Самец
                                            </option>
                                            <option value="f" @if(old('gender') == 'f') {{ "selected" }} @endif>Самка
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Статус:
                                    </div>
                                    <div class="labeled">
                                        <select name="status"
                                                class="select-status" @if(old('gender') != 'f') {{ 'disabled' }} @endif>
                                            <option value="young">Молодняк</option>
                                            <option value="ready" selected>Готова к спариванию</option>
                                            <option value="pregnant">Беременная</option>
                                            <option value="lactation">Лактация</option>
                                            <option value="rest">Отдых</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Фото:</div>
                                    <div class="labeled">
                                        <label class="input-label txt-clip text-center" for="photo-input-add">
                                            Выберите файл
                                        </label>
                                        <input type="file" name="photo" id="photo-input-add" style="display: none"
                                               class="input-file">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Порода:</div>
                                    <div class="labeled">
                                        <select name="breed">
                                            <option value=""></option>
                                            @foreach($breeds as $breed)
                                                <option
                                                    value="{{ $breed->id }}" @if($breed->id == old('breed')) {{ 'selected' }} @endif>{{ $breed->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Клетка:</div>
                                    <div class="labeled">
                                        <select name="cage">
                                            <option value=""></option>
                                            @foreach($cages as $cage)
                                                <option
                                                    value="{{ $cage->id }}" @if($cage->id == old('cage')) {{ 'selected' }} @endif>
                                                    @if(!empty($cage->cageGroup))
                                                        {{ $cage->cageGroup->name . ' → ' . $cage->name }}
                                                    @else
                                                        {{ $cage->name }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Дата рождения:</div>
                                    <div class="labeled">
                                        <input type="date" name="birthday" value="{{ old('birthday') }}">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Описание:</div>
                                    <div class="labeled">
                                        <textarea name="desc" maxlength="1024"
                                                  placeholder="Дополнительная информация о кролике">{{ old('desc') }}</textarea>
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
            <button id="btn-show-add-item-form" title="добавить кролика"></button>
        </div>

        <div class="items-top">
            <div class="filter">
                <div class="filter__inner">
                    <div class="filter-field">
                        <div class="filter-label">
                            Сортировать по:
                        </div>
                        <div class="filter-labeled">
                            <select name="sort_by" class="sort-inp">
                                <option value="created_at" @if($sortby == 'created_at') {{ 'selected' }} @endif>Дате
                                    добавления
                                </option>
                                <option value="breed_name" @if($sortby == 'breed_name') {{ 'selected' }} @endif>Породе
                                </option>
                                <option value="cage_name" @if($sortby == 'cage_name') {{ 'selected' }} @endif>Клеткам
                                </option>
                                <option value="name" @if($sortby == 'name') {{ 'selected' }} @endif>Имени</option>
                                <option value="gender" @if($sortby == 'gender') {{ 'selected' }} @endif>Полу</option>
                                <option value="birthday" @if($sortby == 'birthday') {{ 'selected' }} @endif>Дате
                                    рождения
                                </option>
                                <option value="status" @if($sortby == 'status') {{ 'selected' }} @endif>Статусу</option>
                                <option value="desc" @if($sortby == 'desc') {{ 'selected' }} @endif>Описанию</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @component('application.components.pagination', ['pagination' => $pagination])@endcomponent
        </div>

        <div class="items">
            @if(!empty($rabbits->all()))
                @foreach($rabbits as $rabbit)
                    <div class="item__wrapper">
                        <a href="{{ route('rabbit', $rabbit->id) }}" class="item">
                            <div class="ratio ratio-4-3">
                                <div class="item__inner ratio__inner"
                                @if($rabbit->photo != null)
                                    {{ 'style=background-image:url(' . asset('storage/' . $rabbit->photo) . ');background-size:cover' }}
                                    @endif
                                >
                                    <div class="item-filter">
                                        <div class="info">
                                            @if(!empty($rabbit->status_value))
                                                <div
                                                    class="status txt-clip icon-power" title="статус кролика">{{ $rabbit->status_value }}</div>
                                            @endif
                                            @if(!empty($rabbit->birthday))
                                                <div
                                                    class="birthday txt-clip icon-calendar" title="дата рождения кролика">{{ date("d.m.Y", strtotime($rabbit->birthday)) }}</div>
                                            @endif
                                            @if(!empty($rabbit->breed_name))
                                                <div
                                                    class="breed txt-clip icon-pawprint" title="порода кролика">{{ $rabbit->breed_name }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="item-desc">
                                        {{ $rabbit->desc ?? "(нет описания)" }}
                                    </div>
                                    <div
                                        class="h-gender @if($rabbit->gender == 'f') {{ 'female' }} @else {{ 'male' }} @endif" title="пол кролика">
                                        ♥
                                    </div>
                                </div>
                            </div>
                            <div class="item__footer">
                                <div class="name txt-clip" title="имя кролика">
                                    {{ $rabbit->name }}
                                </div>
                                <span class="show-desc-btn ico-info" title="показать описание кролика"></span>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="none-items" title="Вы не добавили ни одного кролика">
                    {{ '(Пусто)' }}
                </div>
            @endif
        </div>

        @component('application.components.alerts') @endcomponent

        <script src="{{ asset('application/js/modal-add-item.js') }}"></script>
        <script src="{{ asset('application/js/enable-input.js') }}"></script>
    </div>
@endsection
