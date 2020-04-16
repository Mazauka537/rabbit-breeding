@extends('layouts.application')

@section('title', 'rabbit')

@section('main')
    <div class="main__inner">

        <div class="rabbit-container">

            <div class="left">
                <div class="photo__wrapper wrapper">
                    <div class="photo">
                        <img src="{{ asset('storage/' . $rabbit->photo) }}" alt="Фото кролика">
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
                            <div class="buttons">
                                <button id="show-edit-fields-btn">Изменить</button>
                                <button id="show-delete-modal-btn">Удалить</button>
                            </div>
                        </div>

                        <div class="body">
                            <div class="line clearfix">
                                <div class="label">Пол:</div>
                                <div class="labeled">
                                    @if($rabbit->gender == 'f')
                                        {{ 'Женский' }}
                                    @else
                                        {{ 'Мужской' }}
                                    @endif
                                </div>
                                <div class="labeled-edit">
                                    <select name="gender">
                                        <option value=""></option>
                                        <option value="f" @if($rabbit->gender == 'f') {{ 'selected' }} @endif>Ж</option>
                                        <option value="m" @if($rabbit->gender == 'm') {{ 'selected' }} @endif>М</option>
                                    </select>
                                </div>
                            </div>
                            <div class="line clearfix">
                                <div class="label">Дата рождения:</div>
                                <div class="labeled">{{ $rabbit->birthday ?? '(нет)' }}</div>
                                <div class="labeled-edit">
                                    <input type="date" name="birthday" value="{{ $rabbit->birthday ?? '' }}">
                                </div>
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
                                <div class="labeled-edit">
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
                                    @if($rabbit->cage_id)
                                        <a href="{{ route('cage', $rabbit->cage_id) }}">{{ $rabbit->cage_name }}</a>
                                    @else
                                        {{ '(нет)' }}
                                    @endif
                                </div>
                                <div class="labeled-edit">
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
                                    @if($rabbit->mother_id)
                                        <a href="{{ route('rabbit', $rabbit->mother_id) }}">{{ $rabbit->mother_name }}</a>
                                    @else
                                        {{ '(нет)' }}
                                    @endif
                                </div>
                                <div class="labeled-edit">
                                    <select name="mother">
                                        <option value=""></option>
                                        @foreach($rabbits as $mother)
                                            @if($mother->gender == 'f')
                                                <option value="{{ $mother->id }}" @if($mother->id == $rabbit->mother_id) {{ 'selected' }} @endif>{{ $mother->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
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
                                <div class="labeled-edit">
                                    <select name="father">
                                        <option value=""></option>
                                        @foreach($rabbits as $father)
                                            @if($father->gender == 'm')
                                                <option value="{{ $father->id }}" @if($father->id == $rabbit->father_id) {{ 'selected' }} @endif>{{ $father->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="line clearfix">
                                <div class="label">Описание:</div>
                                <div class="labeled">
                                    {{ $rabbit->desc ?? '(нет)' }}
                                </div>
                                <div class="labeled-edit">
                                    <textarea name="desc">{{ $rabbit->desc ?? '' }}</textarea>
                                </div>
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
