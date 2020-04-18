@extends('layouts.application')

@section('title', 'rabbit')

@section('main')
    <div class="main__inner">

        <div class="modal-window delete-modal" id="modal-delete-item-form">
            <div class="form__wrapper" id="delete-item-form">
                <div class="close-button" id="close-delete-modal-btn"></div>
                <form action="{{ route('deleteRabbit', $rabbit->id) }}" class="form" method="post">
                    @csrf
                    <div class="head">
                        Удаление кролика
                    </div>

                    <div class="body">
                        Вы действительно хотите удалить данного кролика? При нажатии на кнопку "Да" кролик и все данные
                        связанные с ним будут навсегда удалены из системы.
                        <div class="buttons">
                            <input type="submit" value="Да">
                            <input type="button" value="Отмена" id="canсel-delete-modal-btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal-window delete-modal" id="delete-photo-modal">
            <div class="form__wrapper" id="delete-photo-form">
                <div class="close-button" id="close-delete-photo-btn"></div>
                <form action="{{ route('deletePhoto', $rabbit->id) }}" class="form" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="head">
                        Удаление фотографии
                    </div>

                    <div class="body delete-photo-body">
                        Удалить фотографию данного кролика ({{ $rabbit->name }})?
                        <div class="buttons">
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
                                                {{ $rabbit->birthday ?? '(нет)' }}
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
                                    <div class="item">
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
                                            <div class="item__arrow">

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
                                                    <div class="labeled">
                                                        {{ $mating->date ?? '(неизвестно)' }}
                                                    </div>
                                                </div>
                                                <div class="line">
                                                    <div class="label">
                                                        Дата окрола:
                                                    </div>
                                                    <div class="labeled">
                                                        {{ $mating->date_birth ?? '(неизвестно)' }}
                                                    </div>
                                                </div>
                                                <div class="line">
                                                    <div class="label">
                                                        Всего крольчат:
                                                    </div>
                                                    <div class="labeled">
                                                        {{ $mating->child_count ?? '(неизвестно)' }}
                                                    </div>
                                                </div>
                                                <div class="line">
                                                    <div class="label">
                                                        Выживших крольчат:
                                                    </div>
                                                    <div class="labeled">
                                                        {{ $mating->alive_count ?? '(неизвестно)' }}
                                                    </div>
                                                </div>
                                                <div class="line">
                                                    <div class="label">
                                                        Дополнительная информация:
                                                    </div>
                                                    <div class="labeled">
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

            </div>
        </div>

        <script src="{{ asset('application/js/modal-edit-and-delete-item.js') }}"></script>
        <script src="{{ asset('application/js/edit-rabbit-photo.js') }}"></script>
    </div>
@endsection
