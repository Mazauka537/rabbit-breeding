@extends('layouts.application')

@section('title', 'Кролик '. $rabbit->name .' - ' . config('app.name'))

@section('main')
    <div class="main__inner">

        <div class="modal-window" id="modal-delete-item-form">
            <div class="form__wrapper" id="delete-item-form">
                <div class="close-button" id="close-delete-modal-btn"></div>
                <form action="{{ route('deleteRabbit', $rabbit->id) }}" class="form" method="post">
                    @csrf
                    <div class="head">
                        Удаление кролика
                    </div>

                    <div class="body pt-20">
                        Вы действительно хотите удалить данного кролика? При нажатии на кнопку "Да" кролик и все данные
                        связанные с ним будут навсегда удалены из системы.
                        <div class="delete-form-buttons">
                            <input type="submit" value="Да">
                            <input type="button" value="Отмена" id="canсel-delete-modal-btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal-window" id="delete-photo-modal">
            <div class="form__wrapper" id="delete-photo-form">
                <div class="close-button" id="close-delete-photo-btn"></div>
                <form action="{{ route('deletePhoto', $rabbit->id) }}" class="form" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="head">
                        Удаление фотографии
                    </div>

                    <div class="body pt-20">
                        Удалить фотографию данного кролика ({{ $rabbit->name }})?
                        <div class="delete-form-buttons">
                            <input type="submit" value="Да">
                            <input type="button" value="Отмена" id="canсel-delete-photo">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal-window" id="edit-photo-modal">
            <div class="form__wrapper" id="edit-photo-form">
                <div class="close-button" id="close-edit-photo-btn"></div>
                <form action="{{ route('editPhoto', $rabbit->id) }}" class="form" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="head">
                        Изменение фотографии
                    </div>

                    <div class="body edit-photo-body">
                        <div class="text-center">
                            <label class="input-label txt-clip" for="photo-input-edit">
                                Выбрать файл
                            </label>
                            <input type="file" name="photo" id="photo-input-edit" style="display: none"
                                   class="input-file">
                            <input type="submit" value="Сохранить" disabled>
                        </div>
                    </div>
                </form>
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
                                            @foreach($rabbits as $r)
                                                @if($r->gender == 'f')
                                                    <option
                                                        value="{{ $r->id }}">{{ $r->name }}</option>
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
                                            @foreach($rabbits as $r)
                                                @if($r->gender == 'm')
                                                    <option
                                                        value="{{ $r->id }}">{{ $r->name }}</option>
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
                                    <div class="label">Рождено:</div>
                                    <div class="labeled">
                                        <input type="number" name="child_count" placeholder="Общее кол-во крольчат"
                                               value="">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Выжило:</div>
                                    <div class="labeled">
                                        <input type="number" name="alive_count" placeholder="Кол-во выживших крольчат"
                                               value="">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Примечания:</div>
                                    <div class="labeled">
                                        <textarea name="desc" maxlength="255"
                                                  placeholder="Дополнительная информация"></textarea>
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

        <div class="modal-window" id="modal-add-vaccination-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="add-vaccination-form">
                    <div class="close-button" id="btn-close-add-vaccination-form"></div>
                    <form action="{{ route('addVaccination') }}" class="form" method="post">
                        @csrf
                        <input type="hidden" name="rabbit" value="{{ $rabbit->id }}">
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
                                        <input type="text" name="name" value="{{ old('name') }}" required>
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
                                        <textarea name="desc" maxlength="255">{{ old('desc') }}</textarea>
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
                                        <input type="text" name="name" value="" required>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Кролик*:
                                    </div>
                                    <div class="labeled">
                                        <select name="rabbit" required>
                                            <option value=""></option>
                                            @foreach($rabbits as $r)
                                                <option value="{{ $r->id }}">
                                                    {{ $r->name }}
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
                                        <textarea name="desc" maxlength="255"></textarea>
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

        <div class="rabbit-container">

            <div class="left">
                <div class="photo__wrapper wrapper">
                    <div class="photo">
                        <img src="@if($rabbit->photo != null)
                        {{ asset('storage/' . $rabbit->photo) }}
                        @else
                        {{ asset('application/images/rabbit.svg') }}
                        @endif" alt="Фото кролика">
                        <div class="side-panel">
                            <div id="btn-show-edit-photo">Изменить фотографию</div>
                            <div id="btn-show-delete-photo">Удалить фотографию</div>
                        </div>
                    </div>
                </div>
                <div class="some-info__wrapper wrapper">
                    <div class="head small-head">
                        Доп. информация
                    </div>
                    <div class="some-info small-form">
                        <div class="line">
                            <div class="label">
                                Возраст:
                            </div>
                            <div class="labeled">
                                @if(!empty($rabbit->birthday))
                                    <ul class="rabbit-age">
                                        <li>{{ $rabbit->days . ' дней' }}</li>
                                        <li>{{ $rabbit->months . ' месяцев' }}</li>
                                        <li>{{ $rabbit->years . ' лет' }}</li>
                                    </ul>
                                @else
                                    {{ '(неизвестно)' }}
                                @endif
                            </div>
                        </div>
                        <div class="line">
                            <div class="label">
                                Случек:
                            </div>
                            <div class="labeled">
                                {{ count($matings) }}
                            </div>
                        </div>
                        <div class="line">
                            <div class="label">
                                Детей:
                            </div>
                            <div class="labeled">
                                {{ $rabbit->child_count }}
                            </div>
                        </div>
                        <div class="line">
                            <div class="label">
                                Выживших:
                            </div>
                            <div class="labeled">
                                {{ $rabbit->alive_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right">

                <div class="info__wrapper wrapper">
                    <div class="info">

                        <div class="head">
                            <div>
                                <div class="name">{{ $rabbit->name }}</div>
                                <div class="status">{{ $rabbit->status_value ?? '' }}</div>
                            </div>
                            <div class="buttons" id="head-buttons">
                                <button id="show-edit-fields-btn" type="button">Редактировать</button>
                                <button id="show-delete-modal-btn" type="button">Удалить</button>
                            </div>
                        </div>

                        <div class="body">
                            <div class="body-info" id="body-info">
                                <div class="left-form">
                                    <div class="line">
                                        <div class="label">Пол:</div>
                                        <div class="labeled">
                                            <div class="labeled__inner">
                                                @if($rabbit->gender == 'f')
                                                    <span class="female">{{ 'Женский' }}</span>
                                                @else
                                                    <span class="male">{{ 'Мужской' }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">Дата рождения:</div>
                                        <div class="labeled">
                                            <div class="labeled__inner">
                                                @if(!empty($rabbit->birthday))
                                                    {{ date("d.m.Y", strtotime($rabbit->birthday)) }}
                                                @else
                                                    {{ '(нет)' }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">Порода:</div>
                                        <div class="labeled">
                                            <div class="labeled__inner">
                                                {{ $rabbit->breed->name ?? '(нет)' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">Клетка:</div>
                                        <div class="labeled">
                                            <div class="labeled__inner">
                                                {{ $rabbit->cage->name ?? '(нет)' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">Описание:</div>
                                        <div class="labeled">
                                            <div class="labeled__inner">
                                                {{ $rabbit->desc ?? '(нет)' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="body-form" id="body-form">
                                <form action="{{ route('editRabbit', $rabbit->id) }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="center-form">
                                        <div class="line">
                                            <div class="label">Имя*:</div>
                                            <div class="labeled">
                                                <input type="text" name="name" placeholder="Имя кролика"
                                                       value="{{ $rabbit->name }}" required>
                                            </div>
                                        </div>
                                        <div class="line">
                                            <div class="label">Пол*:</div>
                                            <div class="labeled">
                                                <select name="gender" id="inp-rabbit-gender" required>
                                                    <option value=""></option>
                                                    <option
                                                        value="f" @if($rabbit->gender == 'f') {{ 'selected' }} @endif>
                                                        Ж
                                                    </option>
                                                    <option
                                                        value="m" @if($rabbit->gender == 'm') {{ 'selected' }} @endif>
                                                        М
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
                                                        class="select-status" @if($rabbit->gender != 'f') {{ 'disabled' }} @endif>
                                                    <option
                                                        value="young" @if($rabbit->status == 'young') {{ 'selected' }} @endif>
                                                        Молодняк
                                                    </option>
                                                    <option
                                                        value="ready" @if($rabbit->status == 'ready') {{ 'selected' }} @endif>
                                                        Готова к спариванию
                                                    </option>
                                                    <option
                                                        value="pregnant" @if($rabbit->status == 'pregnant') {{ 'selected' }} @endif>
                                                        Беременная
                                                    </option>
                                                    <option
                                                        value="lactation" @if($rabbit->status == 'lactation') {{ 'selected' }} @endif>
                                                        Лактация
                                                    </option>
                                                    <option
                                                        value="rest" @if($rabbit->status == 'rest') {{ 'selected' }} @endif>
                                                        Отдых
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line">
                                            <div class="label">Дата рождения:</div>
                                            <div class="labeled">
                                                <input type="date" name="birthday"
                                                       value="{{ $rabbit->birthday ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="line">
                                            <div class="label">Порода:</div>
                                            <div class="labeled">
                                                <select name="breed">
                                                    <option value=""></option>
                                                    @foreach($breeds as $breed)
                                                        <option
                                                            value="{{ $breed->id }}" @if($breed->id == $rabbit->breed_id) {{ 'selected' }} @endif>{{ $breed->name }}</option>
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
                                                            value="{{ $cage->id }}" @if($cage->id == $rabbit->cage_id) {{ 'selected' }} @endif>{{ $cage->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line">
                                            <div class="label">Описание:</div>
                                            <div class="labeled">
                                                <textarea name="desc" maxlength="255"
                                                          placeholder="Дополнительная информация о кролике">{{ $rabbit->desc ?? '' }}</textarea>
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
                        </div>

                    </div>
                </div>

                <div class="matings__wrapper wrapper">
                    <div class="matings">

                        <div class="head">
                            Случки
                        </div>

                        <div class="body">
                            @foreach($matings as $mating)
                                <div class="item__wrapper">
                                    <div class="item" data-id="{{ $mating->id }}"
                                         data-female_id="{{ $mating->female_id ?? ''}}"
                                         data-male_id="{{ $mating->male_id ?? ''}}">
                                        <div class="item-buttons">
                                            <button class="ico-btn edit-btn edit-mating-btn"></button>
                                            <button class="ico-btn delete-btn delete-mating-btn"></button>
                                        </div>
                                        <div class="item__head">
                                            <div class="item__name">
                                <span class="female">
                                    {{ $mating->female_name ?? '(неизвестно)' }}
                                </span>
                                                +
                                                <span class="male">
                                    {{ $mating->male_name ?? '(неизвестно)' }}
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
                                                            <a class="female"
                                                               href="{{ route('rabbit', $mating->female_id) }}">
                                                                {{ $mating->female_name }}
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
                                                            <a class="male"
                                                               href="{{ route('rabbit', $mating->male_id) }}">
                                                                {{ $mating->male_name }}
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
                                                    <div class="labeled" id="mating-item-date"
                                                         data-date="{{ $mating->date ?? '' }}">
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
                                                        Рождено:
                                                    </div>
                                                    <div class="labeled" id="mating-item-child_count">
                                                        {{ $mating->child_count ?? '(неизвестно)' }}
                                                    </div>
                                                </div>
                                                <div class="line">
                                                    <div class="label">
                                                        Выжило:
                                                    </div>
                                                    <div class="labeled" id="mating-item-alive_count">
                                                        {{ $mating->alive_count ?? '(неизвестно)' }}
                                                    </div>
                                                </div>
                                                <div class="line">
                                                    <div class="label">
                                                        Примечания:
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

                    </div>
                </div>

                <div class="vaccinations__wrapper wrapper">
                    <div class="vaccinations">

                        <div class="head">
                            Вакцинации
                            <span class="ico-btn plus-btn" id="add-vaccination-btn"></span>
                        </div>

                        <div class="body">
                            @foreach($vaccinations as $vaccination)
                                <div class="item__wrapper">
                                    <div class="item" data-id="{{ $vaccination->id }}"
                                         data-rabbit_id="{{ $vaccination->rabbit_id }}">
                                        <div class="item__head">
                                            <div class="item__name">
                                                {{ $vaccination->name }}
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
                    </div>
                </div>

            </div>
        </div>

        @component('application.components.alerts') @endcomponent

        <script src="{{ asset('application/js/edit-item-rabbit.js') }}"></script>
        <script src="{{ asset('application/js/delete-item-rabbit.js') }}"></script>
        <script src="{{ asset('application/js/edit-rabbit-photo.js') }}"></script>
        <script src="{{ asset('application/js/edit-item-mating.js') }}"></script>
        <script src="{{ asset('application/js/delete-item-mating.js') }}"></script>
        <script src="{{ asset('application/js/edit-item-vaccination.js') }}"></script>
        <script src="{{ asset('application/js/delete-item-vaccination.js') }}"></script>
        <script src="{{ asset('application/js/add-item-vaccination.js') }}"></script>
        <script src="{{ asset('application/js/enable-input.js') }}"></script>

    </div>
@endsection
