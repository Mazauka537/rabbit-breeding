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

        <div class="rabbit-container">

            <div class="left">
                <div class="photo__wrapper wrapper">
                    <div class="photo">
                        <img src="@if($rabbit->photo != null)
                            {{ asset('storage/' . $rabbit->photo) }}
                            @else
                            {{ asset('application/images/rabbit.svg') }}
                            @endif" alt="Фото кролика">
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
                                <div class="line clearfix">
                                    <div class="label">Пол:</div>
                                    <div class="labeled">
                                        @if($rabbit->gender == 'f')
                                            {{ 'Женский' }}
                                        @else
                                            {{ 'Мужской' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="line clearfix">
                                    <div class="label">Дата рождения:</div>
                                    <div class="labeled">{{ $rabbit->birthday ?? '(нет)' }}</div>
                                </div>
                                <div class="line clearfix">
                                    <div class="label">Порода:</div>
                                    <div class="labeled">
                                        @if($rabbit->breed_id)
                                            <a href="{{ route('breed', $rabbit->breed_id) }}">{{ $rabbit->breed_name }}</a>
                                        @else
                                            {{ '(нет)' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="line clearfix">
                                    <div class="label">Клетка:</div>
                                    <div class="labeled">
                                        @if($rabbit->cage_id)
                                            <a href="{{ route('cage', $rabbit->cage_id) }}">{{ $rabbit->cage_name }}</a>
                                        @else
                                            {{ '(нет)' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="line clearfix">
                                    <div class="label">Мама:</div>
                                    <div class="labeled">
                                        @if($rabbit->mother_id)
                                            <a href="{{ route('rabbit', $rabbit->mother_id) }}">{{ $rabbit->mother_name }}</a>
                                        @else
                                            {{ '(нет)' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="line clearfix">
                                    <div class="label">Папа:</div>
                                    <div class="labeled">
                                        @if($rabbit->father_id)
                                            <a href="{{ route('rabbit', $rabbit->father_id) }}">{{ $rabbit->father_name }}</a>
                                        @else
                                            {{ '(нет)' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="line clearfix">
                                    <div class="label">Описание:</div>
                                    <div class="labeled">
                                        {{ $rabbit->desc ?? '(нет)' }}
                                    </div>
                                </div>
                            </div>

                            <div class="body-form" id="body-form">
                                <form action="{{ route('editRabbit', $rabbit->id) }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="line clearfix">
                                        <div class="label">Имя:</div>
                                        <div class="labeled">
                                            <input type="text" name="name" value="{{ $rabbit->name }}">
                                        </div>
                                    </div>
                                    <div class="line clearfix">
                                        <div class="label">Пол:</div>
                                        <div class="labeled">
                                            <select name="gender">
                                                <option value=""></option>
                                                <option value="f" @if($rabbit->gender == 'f') {{ 'selected' }} @endif>
                                                    Ж
                                                </option>
                                                <option value="m" @if($rabbit->gender == 'm') {{ 'selected' }} @endif>
                                                    М
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="line clearfix">
                                        <div class="label">Дата рождения:</div>
                                        <div class="labeled">
                                            <input type="date" name="birthday" value="{{ $rabbit->birthday ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="line clearfix">
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
                                    <div class="line clearfix">
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
                                    <div class="line clearfix">
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
                                    <div class="line clearfix">
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
                                    <div class="line clearfix">
                                        <div class="label">Описание:</div>
                                        <div class="labeled">
                                            <textarea name="desc">{{ $rabbit->desc ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="line clearfix">
                                        <div class="label"></div>
                                        <div class="labeled">
                                            <input type="submit" value="Сохранить">
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
                            <div class="line">

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <script src="{{ asset('application/js/modal-edit-and-delete-item.js') }}"></script>
    </div>
@endsection
