@extends('layouts.application')

@section('title', 'cages')

@section('main')
    <div class="main__inner">

        <div class="modal-window" id="modal-add-item-form">
            <div class="form__wrapper" id="add-item-form">
                <div class="close-button" id="btn-close-add-item-form"></div>
                <form action="{{ route('addCage') }}" class="form" method="post">
                    @csrf
                    <div class="head">
                        Добавление новой клетки
                    </div>

                    <div class="body">
                        <div class="line clearfix">
                            <div class="label">Название*:</div>
                            <div class="labeled">
                                <input type="text" name="name">
                            </div>
                        </div>
                        <div class="line clearfix">
                            <div class="label">Описание:</div>
                            <div class="labeled">
                                <textarea name="desc"></textarea>
                            </div>
                        </div>
                        <div class="line clearfix">
                            <div class="label"></div>
                            <div class="labeled errors">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="line clearfix">
                            <div class="label"></div>
                            <div class="labeled">
                                <input type="submit" value="Добавить">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="add-button">
            <button id="btn-show-add-item-form"></button>
        </div>

        <div class="items clearfix">

            @foreach($cages as $cage)
            <div class="item__wrapper">
                <a href="{{ route('cage', $cage->id) }}" class="item">
                    <div class="ratio ratio-4-3">
                        <div class="item__inner ratio__inner">
                            <div class="item-filter">
                                <div class="info cage-info">
                                    @if ($cage->rabbits == null)
                                        (пусто)
                                    @else
                                        @foreach($cage->rabbits as $key => $rabbit)
                                            @if($rabbit->gender == 'f')
                                                <span class="female">{{ $rabbit->name }}</span>
                                            @else
                                                <span class="male">{{ $rabbit->name }}</span>
                                            @endif
                                            @if($key != count($cage->rabbits) - 1)
                                                ,
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item__footer">
                        <div class="name">{{ $cage->name }}</div>
                        <div class="info">
                            <span class="show-desc-btn ico-info"></span>
                        </div>
                    </div>
                    <div class="item-desc">
                        {{ $cage->desc ?? "(нет описания)" }}
                    </div>
                </a>
            </div>
            @endforeach

        </div>

        <script src="{{ asset('application/js/modal-add-item.js') }}"></script>
    </div>
@endsection
