@extends('layouts.application')

@section('title', 'rabbits')

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
                                        <input type="text" name="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Пол*:</div>
                                    <div class="labeled">
                                        <select name="gender">
                                            <option value=""></option>
                                            <option value="m" @if(old('gender') == 'm') {{ "selected" }} @endif>М
                                            </option>
                                            <option value="f" @if(old('gender') == 'f') {{ "selected" }} @endif>Ж
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Фото:</div>
                                    <div class="labeled">
                                        <label class="input-label" for="photo-input-add">
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
                                                    value="{{ $cage->id }}" @if($cage->id == old('cage')) {{ 'selected' }} @endif>{{ $cage->name }}</option>
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
                                    <div class="label">Мама:</div>
                                    <div class="labeled">
                                        <select name="mother">
                                            <option value=""></option>
                                            @foreach($rabbits as $rabbit)
                                                @if($rabbit->gender == 'f')
                                                    <option
                                                        value="{{ $rabbit->id }}" @if($rabbit->id == old('mother')) {{ 'selected' }} @endif>{{ $rabbit->name }}</option>
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
                                            @foreach($rabbits as $rabbit)
                                                @if($rabbit->gender == 'm')
                                                    <option
                                                        value="{{ $rabbit->id }}" @if($rabbit->id == old('father')) {{ 'selected' }} @endif>{{ $rabbit->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
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

        <div class="add-button">
            <button id="btn-show-add-item-form"></button>
        </div>

        <div class="items">

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
                                        <div class="cage">{{ $rabbit->cage_name }}</div>
                                        <div class="birthday">{{ $rabbit->birthday }}</div>
                                        <div class="breed">{{ $rabbit->breed_name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">{{ $rabbit->name }}</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            {{ $rabbit->desc ?? "(нет описания)" }}
                        </div>
                    </a>
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
    </div>
@endsection
