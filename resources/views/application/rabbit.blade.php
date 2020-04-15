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
                                <button>Изменить</button>
                                <button>Удалить</button>
                            </div>
                        </div>

                        <div class="body">
                            <div class="line gender clearfix">
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
                                <div class="labeled">{{ $rabbit->birthday }}</div>
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

    </div>
@endsection
