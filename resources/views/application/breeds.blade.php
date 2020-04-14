@extends('layouts.application')

@section('title', 'breeds')

@section('main')
    <div class="main__inner">

        <div class="modal-window" id="modal-add-item-form">
            <div class="form__wrapper" id="add-item-form">
                <div class="close-button" id="btn-close-add-item-form"></div>
                <form action="{{ route('addBreed') }}" class="form" method="post">
                    @csrf
                    <div class="head">
                        Добавление новой породы
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

            @foreach($breeds as $breed)
            <div class="item__wrapper">
                <a href="{{ route('breed', $breed->id) }}" class="item">
                    <div class="ratio ratio-4-3">
                        <div class="item__inner ratio__inner">
                            <div class="item-filter">
                                <div class="info">
                                    (Пусто)
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item__footer">
                        <div class="name">{{ $breed->name }}</div>
                        <div class="info">
                            <span class="show-desc-btn ico-info"></span>
                        </div>
                    </div>
                    <div class="item-desc">
                        {{ $breed->desc }}
                    </div>
                </a>
            </div>
            @endforeach

        </div>

        <script src="{{ asset('application/js/modal-add-item.js') }}"></script>
    </div>
@endsection
