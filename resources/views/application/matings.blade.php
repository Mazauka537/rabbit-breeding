@extends('layouts.application')

@section('title', 'Случки | ' . config('app.name'))

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
                                    <div class="label">Самка*:</div>
                                    <div class="labeled">
                                        <select name="female" required>
                                            <option value="">не известно</option>
                                            @foreach($rabbits as $rabbit)
                                                @if($rabbit->gender == 'f')
                                                    <option
                                                        value="{{ $rabbit->id }}" @if($rabbit->id == old('female')) {{ 'selected' }} @endif >{{ $rabbit->name }}  @if(!empty($rabbit->status_value)) {{ '('.$rabbit->status_value.')' }} @endif</option>
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
                                    <div class="label">Дата случки*:</div>
                                    <div class="labeled">
                                        <input type="date" name="date"
                                               value="{{ old('date') ?? date("Y-m-d", time()) }}" required>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Дата окрола:</div>
                                    <div class="labeled">
                                        <input type="date" name="date_birth" value="{{ old('date_birth') }}">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Рождено:</div>
                                    <div class="labeled">
                                        <input type="number" name="child_count" placeholder="Общее кол-во крольчат"
                                               value="{{ old('child_count') }}">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Выжило:</div>
                                    <div class="labeled">
                                        <input type="number" name="alive_count" placeholder="Кол-во выживших крольчат"
                                               value="{{ old('alive_count') }}">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Примечания</div>
                                    <div class="labeled">
                                        <textarea name="desc" maxlength="255"
                                                  placeholder="Дополнительная информация">{{ old('desc') }}</textarea>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label"></div>
                                    <div class="labeled">
                                        <input type="checkbox" name="notify" id="notify-inp" @if($user->auto_mating_reminders) {{ 'checked' }} @endif>
                                        <label for="notify-inp">
                                                Добавить <a href="{{ route('settings').'#default_reminders' }}" style="text-decoration: underline">стандартные напоминания</a>?
                                        </label>
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

        <div class="modal-window" id="modal-edit-mating-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="edit-mating-form">
                    <div class="close-button" id="btn-close-edit-mating-form"></div>
                    <form action="{{ route('editMating', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Редактирование случки <span id="mating-name-edit"></span>
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">Самка*:</div>
                                    <div class="labeled">
                                        <select name="female" required>
                                            <option value="">неизвестно</option>
                                            @foreach($rabbits as $rabbit)
                                                @if($rabbit->gender == 'f')
                                                    <option
                                                        value="{{ $rabbit->id }}">{{ $rabbit->name }} @if(!empty($rabbit->status_value)) {{ '('.$rabbit->status_value.')' }} @endif</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Самец:</div>
                                    <div class="labeled">
                                        <select name="male">
                                            <option value="">неизвестно</option>
                                            @foreach($rabbits as $rabbit)
                                                @if($rabbit->gender == 'm')
                                                    <option
                                                        value="{{ $rabbit->id }}">{{ $rabbit->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Дата случки*:</div>
                                    <div class="labeled">
                                        <input type="date" name="date" value="" required>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Дата окрола:</div>
                                    <div class="labeled">
                                        <input type="date" name="date_birth" value="">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Рождено:</div>
                                    <div class="labeled">
                                        <input type="number" name="child_count" placeholder="Общее кол-во крольчат"
                                               value="">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Выжило:</div>
                                    <div class="labeled">
                                        <input type="number" name="alive_count" placeholder="Кол-во выживших крольчат"
                                               value="">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Примечания:</div>
                                    <div class="labeled">
                                        <textarea name="desc" maxlength="255"
                                                  placeholder="Дополнительная информация"></textarea>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label"></div>
                                    <div class="labeled">
                                        <input type="submit" value="Сохранить">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal-window" id="modal-delete-mating-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="delete-mating-form">
                    <div class="close-button" id="btn-close-delete-mating-form"></div>
                    <form action="{{ route('deleteMating', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Удаление случки <span id="mating-name-delete"></span>
                        </div>

                        <div class="body pt-20">
                            Вы действительно хотите удалить случку <span id="mating-name-delete-2"></span>?
                            <div class="delete-form-buttons">
                                <input type="submit" value="Да">
                                <input type="button" value="Отмена" id="canсel-delete-mating">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="add-button">
            <button id="btn-show-add-item-form" title="добавить случку"></button>
        </div>

        <div class="items-top">
            <div class="filter">
                <div class="filter__inner">
                    <div class="filter-field">
                        <div class="filter-label">
                            Сортировать по:
                        </div>
                        <div class="filter-labeled">
                            <select name="sort_by" class="sort-inp">
                                <option value="date" @if($sortby == 'date') {{ 'selected' }} @endif>Дате случки</option>
                                <option value="date_birth" @if($sortby == 'date_birth') {{ 'selected' }} @endif>Дате
                                    окрола
                                </option>
                                <option value="female_name" @if($sortby == 'female_name') {{ 'selected' }} @endif>Имени
                                    самки
                                </option>
                                <option value="male_name" @if($sortby == 'male_name') {{ 'selected' }} @endif>Имени
                                    самца
                                </option>
                                <option value="child_count" @if($sortby == 'child_count') {{ 'selected' }} @endif>
                                    Количеству рожденных
                                </option>
                                <option value="alive_count" @if($sortby == 'alive_count') {{ 'selected' }} @endif>
                                    Количеству выживших
                                </option>
                                <option value="desc" @if($sortby == 'desc') {{ 'selected' }} @endif>Примечанию</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @component('application.components.pagination', ['pagination' => $pagination])@endcomponent
        </div>

        <div class="items">
            @if(!empty($matings->all()))
                @foreach($matings as $mating)
                    <div class="item__wrapper">
                        <div class="item" data-id="{{ $mating->id }}" data-female_id="{{ $mating->female_id ?? ''}}"
                             data-male_id="{{ $mating->male_id ?? ''}}">
                            <div class="item__head">
                                <div class="item__name">
                                <span class="female">
                                    {{ $mating->female_name ?? '(неизвестно)' }}
                                </span>
                                    +
                                    <span class="male">
                                    {{ $mating->male_name ?? '(неизвестно)' }}
                                </span>
                                </div>
                                <div class="item-buttons-show-btn">
                                    <button class="ico-btn show-buttons-btn"></button>
                                </div>
                                <div class="item-buttons">
                                    <button class="ico-btn edit-btn edit-mating-btn" title="редактировать">
                                        <span class="ico-btn-text">Редактировать</span>
                                    </button>
                                    <button class="ico-btn delete-btn delete-mating-btn" title="удалить">
                                        <span class="ico-btn-text">Удалить</span>
                                    </button>
                                    <span class="ico-btn caret-btn" title="показать подробности"></span>
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
                                                    {{ $mating->female_name }}
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
                                                    {{ $mating->male_name }}
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
                                        <div class="labeled" id="mating-item-date"
                                             data-date="{{ $mating->date ?? '' }}">
                                            @if(!empty($mating->date))
                                                {{ date("d.m.Y", strtotime($mating->date)) }}
                                            @else
                                                {{ '(неизвестно)' }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">
                                            Дата окрола:
                                        </div>
                                        <div class="labeled" id="mating-item-date_birth"
                                             data-date_birth="{{ $mating->date_birth ?? '' }}">
                                            @if(!empty($mating->date_birth))
                                                {{ date("d.m.Y", strtotime($mating->date_birth)) }}
                                            @else
                                                {{ '(неизвестно)' }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">
                                            Рождено:
                                        </div>
                                        <div class="labeled" id="mating-item-child_count">
                                            {{ $mating->child_count ?? '(неизвестно)' }}
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">
                                            Выжило:
                                        </div>
                                        <div class="labeled" id="mating-item-alive_count">
                                            {{ $mating->alive_count ?? '(неизвестно)' }}
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">
                                            Примечания:
                                        </div>
                                        <div class="labeled" id="mating-item-desc">
                                            {{ $mating->desc ?? '(нет)' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="none-items" title="Вы не добавили ни одной случки">
                    {{ '(Пусто)' }}
                </div>
            @endif
        </div>

        @component('application.components.alerts') @endcomponent

        <script src="{{ asset('application/js/modal-add-item.js') }}"></script>
        <script src="{{ asset('application/js/edit-item-mating.js') }}"></script>
        <script src="{{ asset('application/js/delete-item-mating.js') }}"></script>
    </div>
@endsection
