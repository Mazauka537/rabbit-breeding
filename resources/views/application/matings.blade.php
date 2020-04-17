@extends('layouts.application')

@section('title', 'matings')

@section('main')
    <div class="main__inner">

        <div class="modal-window" id="modal-add-item-form">
            <div class="form__wrapper" id="add-item-form">
                <div class="close-button" id="btn-close-add-item-form"></div>
                <form action="{{ route('addMating') }}" class="form" method="post">
                    @csrf
                    <div class="head">
                        Добавление новой случки
                    </div>

                    <div class="body">
                        <div class="line clearfix">
                            <div class="label">Самка:</div>
                            <div class="labeled">
                                <select name="female">
                                    <option value="">не известно</option>
                                    @foreach($rabbits as $rabbit)
                                        @if($rabbit->gender == 'f')
                                            <option value="{{ $rabbit->id }}" @if($rabbit->id == old('female')) {{ 'selected' }} @endif>{{ $rabbit->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="line clearfix">
                            <div class="label">Самец:</div>
                            <div class="labeled">
                                <select name="male">
                                    <option value="">не известно</option>
                                    @foreach($rabbits as $rabbit)
                                        @if($rabbit->gender == 'm')
                                            <option value="{{ $rabbit->id }}" @if($rabbit->id == old('male')) {{ 'selected' }} @endif>{{ $rabbit->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="line clearfix">
                            <div class="label">Дата случки:</div>
                            <div class="labeled">
                                <input type="date" name="date" value="{{ old('date') }}">
                            </div>
                        </div>
                        <div class="line clearfix">
                            <div class="label">Дата окрола:</div>
                            <div class="labeled">
                                <input type="date" name="date_birth" value="{{ old('date_birth') }}">
                            </div>
                        </div>
                        <div class="line clearfix">
                            <div class="label">Общее кол-во крольчат:</div>
                            <div class="labeled">
                                <input type="number" name="child_count" value="{{ old('child_count') }}">
                            </div>
                        </div>
                        <div class="line clearfix">
                            <div class="label">Кол-во выживших крольчат:</div>
                            <div class="labeled">
                                <input type="number" name="alive_count" value="{{ old('alive_count') }}">
                            </div>
                        </div>
                        <div class="line clearfix">
                            <div class="label">Дополнительная информация</div>
                            <div class="labeled">
                                <textarea name="desc">{{ old('desc') }}</textarea>
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

            @foreach($matings as $mating)
                <div class="item__wrapper">
                    <a href="{{ route('mating', $mating->id) }}" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner item__inner-mating ratio__inner">
                                <div class="item-filter">
                                    <div class="info mating-info">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">
                                <span class="female">
                                    {{ $mating->female_name ?? '(неизвестно)' }}
                                </span>
                                +
                                <span class="male">
                                    {{ $mating->male_name ?? '(неизвестно)' }}
                                </span>
                            </div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            {{ $mating->desc ?? "(нет дополнительной информации)" }}
                        </div>
                    </a>
                </div>
            @endforeach

        </div>

        <script src="{{ asset('application/js/modal-add-item.js') }}"></script>
    </div>
@endsection
