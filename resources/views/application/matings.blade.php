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
                                                        value="{{ $rabbit->id }}" @if($rabbit->id == old('female')) {{ 'selected' }} @endif>{{ $rabbit->name }}</option>
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
                                    <div class="labeled errors">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
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

        <script src="{{ asset('application/js/modal-add-item.js') }}"></script>
    </div>
@endsection
