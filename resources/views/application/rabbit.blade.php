@extends('layouts.application')

@section('title', 'rabbit')

@section('main')
    <main class="main scrollbar-macosx" id="main">

        <div class="rabbit-container">
            <div class="left">
                <div class="photo__wrapper wrapper">
                    <div class="photo">
                        <img src="{{ asset('application/images/пожилой крол.jpg') }}" alt="Имя кроля">
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
                                <div class="name">Имя кроля</div>
                                <div class="status">Отдыхает</div>
                            </div>
                            <div class="buttons">
                                <button>Изменить</button>
                                <button>Удалить</button>
                            </div>
                        </div>

                        <div class="body">
                            <div class="line gender clearfix">
                                <div class="label">Пол:</div>
                                <div class="labeled">Мужской Мужской Мужской Мужской Мужской МужсМужскойкой Мужской Мужской </div>
                            </div>
                            <div class="line gender clearfix">
                                <div class="label">Пол:</div>
                                <div class="labeled">Мужской</div>
                            </div>
                            <div class="line gender clearfix">
                                <div class="label">Пол:</div>
                                <div class="labeled">Мужской</div>
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

    </main>
@endsection
