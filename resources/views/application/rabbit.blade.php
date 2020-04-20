@extends('layouts.application')

@section('title', 'rabbit')

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
                            <label class="input-label" for="photo-input-edit">
                                Выберите файл
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
                    <div class="some-info">
                        some info
                    </div>
                </div>
            </div>

            <div class="right">

                <div class="info__wrapper wrapper">
                    <div class="info">

                        <div class="head">
                            <div>
                                <div class="name">{{ $rabbit->name }}</div>
                                <div class="status">{{ $rabbit->status }}</div>
                            </div>
                            <div class="buttons" id="head-buttons">
                                <button id="show-edit-fields-btn">Редактировать</button>
                                <button id="show-delete-modal-btn">Удалить</button>
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
                                        <div class="label">Мама:</div>
                                        <div class="labeled">
                                            <div class="labeled__inner">
                                                @if($rabbit->mother_id)
                                                    <a href="{{ route('rabbit', $rabbit->mother->id) }}">{{ $rabbit->mother->name }}</a>
                                                @else
                                                    {{ '(нет)' }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">Папа:</div>
                                        <div class="labeled">
                                            <div class="labeled__inner">
                                                @if($rabbit->father_id)
                                                    <a href="{{ route('rabbit', $rabbit->father->id) }}">{{ $rabbit->father->name }}</a>
                                                @else
                                                    {{ '(нет)' }}
                                                @endif
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
                                            <div class="label">Имя:</div>
                                            <div class="labeled">
                                                <input type="text" name="name" value="{{ $rabbit->name }}">
                                            </div>
                                        </div>
                                        <div class="line">
                                            <div class="label">Пол:</div>
                                            <div class="labeled">
                                                <select name="gender">
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
                                            <div class="label">Мама:</div>
                                            <div class="labeled">
                                                <select name="mother">
                                                    <option value=""></option>
                                                    @foreach($rabbits as $mother)
                                                        @if($mother->gender == 'f')
                                                            <option
                                                                value="{{ $mother->id }}" @if($mother->id == $rabbit->mother_id) {{ 'selected' }} @endif>{{ $mother->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line">
                                            <div class="label">Папа:</div>
                                            <div class="labeled">
                                                <select name="father">
                                                    <option value=""></option>
                                                    @foreach($rabbits as $father)
                                                        @if($father->gender == 'm')
                                                            <option
                                                                value="{{ $father->id }}" @if($father->id == $rabbit->father_id) {{ 'selected' }} @endif>{{ $father->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="line">
                                            <div class="label">Описание:</div>
                                            <div class="labeled">
                                                <textarea name="desc">{{ $rabbit->desc ?? '' }}</textarea>
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
                                    <div class="item" data-id="{{ $mating->id }}" data-female_id="{{ $mating->female->id ?? ''}}"
                                         data-male_id="{{ $mating->male->id ?? ''}}">
                                        <div class="item-buttons">
                                            <button class="ico-btn edit-btn edit-mating-btn"></button>
                                            <button class="ico-btn delete-btn delete-mating-btn"></button>
                                        </div>
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
                                                    <div class="labeled" id="mating-item-date_birth" data-date_birth="{{ $mating->date_birth ?? '' }}">
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

                    </div>
                </div>

                <div class="vaccinations__wrapper wrapper">
                    <div class="vaccinations">

                        <div class="head">
                            Вакцинации
                        </div>

                        <div class="body">
                            @foreach($vaccinations as $vaccination)
                                <div class="item__wrapper">
                                    <div class="item" data-id="{{ $vaccination->id }}" data-rabbit_id="{{ $vaccination->rabbit_id }}">
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

        <script src="{{ asset('application/js/edit-item-rabbit.js') }}"></script>
        <script src="{{ asset('application/js/delete-item-rabbit.js') }}"></script>
        <script src="{{ asset('application/js/edit-rabbit-photo.js') }}"></script>
        <script src="{{ asset('application/js/edit-item-mating.js') }}"></script>
        <script src="{{ asset('application/js/delete-item-mating.js') }}"></script>
        <script src="{{ asset('application/js/edit-item-vaccination.js') }}"></script>
        <script src="{{ asset('application/js/delete-item-vaccination.js') }}"></script>
    </div>
@endsection
