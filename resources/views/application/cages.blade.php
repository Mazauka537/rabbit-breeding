@extends('layouts.application')

@section('title', 'Клетки - ' . config('app.name'))

@section('main')
    <div class="main__inner">

        <div class="modal-window" id="modal-add-item-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="add-item-form">
                    <div class="close-button" id="btn-close-add-item-form"></div>
                    <div class="form">
                        <div class="head">
                            Что вы хотите добавить?
                        </div>

                        <div class="body text-center pb-10">
                            <div class="center-form">
                                <div class="line">
                                    <input type="button" value="Клетку" id="add-cage-btn">
                                </div>
                                <div class="line">
                                    <input type="button" value="Группу клеток" id="add-cage-group-btn">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-window" id="modal-add-cage-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="add-cage-form">
                    <div class="close-button" id="btn-close-add-cage-form"></div>
                    <form action="{{ route('addCage') }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Добавление новой клетки
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">Название*:</div>
                                    <div class="labeled">
                                        <input type="text" name="name" placeholder="Название или номер клетки"
                                               value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Описание:</div>
                                    <div class="labeled">
                                        <textarea name="desc" maxlength="255"
                                                  placeholder="Дополнительная информация о данной клетке">{{ old('desc') }}</textarea>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Добавить в группу:</div>
                                    <div class="labeled">
                                        <select name="group">
                                            <option value="">(нет)</option>
                                            @foreach($cageGroupsAll as $cageGroup)
                                                <option value="{{ $cageGroup->id }}">{{ $cageGroup->name }}</option>
                                            @endforeach
                                        </select>
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

        <div class="modal-window" id="modal-add-cage-group-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="add-cage-group-form">
                    <div class="close-button" id="btn-close-add-cage-group-form"></div>
                    <form action="{{ route('addCageGroup') }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Добавление новой группы клеток
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">Название*:</div>
                                    <div class="labeled">
                                        <input type="text" name="name" placeholder="Название или группы"
                                               value="{{ old('name') }}" required>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Описание:</div>
                                    <div class="labeled">
                                        <textarea name="desc" maxlength="255"
                                                  placeholder="Дополнительная информация о данной группе клеток">{{ old('desc') }}</textarea>
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

        <div class="modal-window" id="modal-edit-cage-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="edit-cage-form">
                    <div class="close-button" id="btn-close-edit-cage-form"></div>
                    <form action="{{ route('editCage', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Редактирование клетки "<span id="cage-name-edit"></span>"
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">Название*:</div>
                                    <div class="labeled">
                                        <input type="text" name="name" placeholder="Название или номер клетки" value=""
                                               required>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Описание:</div>
                                    <div class="labeled">
                                        <textarea name="desc" maxlength="255"
                                                  placeholder="Дополнительная информация о данной клетке"></textarea>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Добавить в группу:</div>
                                    <div class="labeled">
                                        <select name="group">
                                            <option value="">(нет)</option>
                                            @foreach($cageGroupsAll as $cageGroup)
                                                <option value="{{ $cageGroup->id }}">{{ $cageGroup->name }}</option>
                                            @endforeach
                                        </select>
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

        <div class="modal-window" id="modal-edit-cage-group-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="edit-cage-group-form">
                    <div class="close-button" id="btn-close-edit-cage-group-form"></div>
                    <form action="{{ route('editCageGroup', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Редактирование группы клеток "<span id="cage-group-name-edit"></span>"
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">Название*:</div>
                                    <div class="labeled">
                                        <input type="text" name="name" placeholder="Название группы" value=""
                                               required>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Описание:</div>
                                    <div class="labeled">
                                        <textarea name="desc" maxlength="255"
                                                  placeholder="Дополнительная информация о данной группе клеток"></textarea>
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

        <div class="modal-window" id="modal-delete-cage-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="delete-cage-form">
                    <div class="close-button" id="btn-close-delete-cage-form"></div>
                    <form action="{{ route('deleteCage', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Удаление клетки "<span id="cage-name-delete"></span>"
                        </div>

                        <div class="body pt-20">
                            Вы действительно хотите удалить клетку "<span id="cage-name-delete-2"></span>"?
                            <div class="delete-form-buttons">
                                <input type="submit" value="Да">
                                <input type="button" value="Отмена" id="canсel-delete-cage">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal-window" id="modal-delete-cage-group-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="delete-cage-group-form">
                    <div class="close-button" id="btn-close-delete-cage-group-form"></div>
                    <form action="{{ route('deleteCageGroup', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Удаление группы клеток "<span id="cage-group-name-delete"></span>"
                        </div>

                        <div class="body pt-20">
                            Вы действительно хотите удалить группу клеток "<span id="cage-group-name-delete-2"></span>"?<br>
                            Все клетки, находящиеся в данной группе, также будут удалены.
                            <div class="delete-form-buttons">
                                <input type="submit" value="Да">
                                <input type="button" value="Отмена" id="canсel-delete-cage-group">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="add-button">
            <button id="btn-show-add-item-form"></button>
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
                                <option value="created_at" @if($sortby == 'created_at') {{ 'selected' }} @endif>Дате
                                    добавления
                                </option>
                                <option value="name" @if($sortby == 'name') {{ 'selected' }} @endif>Названию</option>
                                <option value="desc" @if($sortby == 'desc') {{ 'selected' }} @endif>Описанию</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pagination__wrapper" id="pagination" data-last-page="{{ $pageCount ?? 1 }}">

            </div>
        </div>

        <div class="items">
            @if(!empty($cages->all()) || !empty($cageGroups->all()))
                @foreach($cageGroups as $cageGroup)
                    <div class="item__wrapper">
                        <div class="item" data-id="{{ $cageGroup->id }}">
                            <div class="item__head">
                                <div class="item__name item-icon ico-cage-group">
                                    {{ $cageGroup->name }}
                                </div>
                                <div class="item-buttons">
                                    <button class="ico-btn small-plus-btn" title="Добавить навую клетку в группу"></button>
                                    <button class="ico-btn edit-btn edit-cage-group-btn"></button>
                                    <button class="ico-btn delete-btn delete-cage-group-btn"></button>
                                    <span class="ico-btn caret-btn"></span>
                                </div>
                            </div>
                            <div class="item__body">
                                <div class="left-form">
                                    <div class="line">
                                        <div class="label">
                                            Название:
                                        </div>
                                        <div class="labeled">
                                            {{ $cageGroup->name }}
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">
                                            Описание:
                                        </div>
                                        <div class="labeled" id="desc">
                                            {{ $cageGroup->desc ?? '(нет описания)' }}
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">
                                            Кролики:
                                        </div>
                                        <div class="labeled">
                                            @if(count($cageGroup->rabbits) != 0)
                                                @foreach($cageGroup->rabbits as $key => $rabbit)
                                                    <a href="{{ route('rabbit', $rabbit->id) }}"
                                                       class="@if($rabbit->gender == 'f') {{ 'female' }} @elseif($rabbit->gender == 'm') {{ 'male' }} @endif">
                                                        {{ $rabbit->name }}
                                                    </a>
                                                    @if($key != count($cageGroup->rabbits) - 1)
                                                        {{ ',' }}
                                                    @endif
                                                @endforeach
                                            @else
                                                {{ '(нет кроликов)' }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">Клетки:</div>
                                        <div class="labeled"></div>
                                    </div>
                                </div>
                                <div class="items">
                                    @if(count($cageGroup->cages) != 0)
                                        @foreach($cageGroup->cages as $cgCage)
                                            <div class="item__wrapper inner-item__wrapper">
                                                <div class="item" data-id="{{ $cgCage->id }}" data-group-id="{{ $cageGroup->id }}">
                                                    <div class="item__head">
                                                        <div class="item__name">
                                                            {{ $cgCage->name }}
                                                        </div>
                                                        <div class="item-buttons">
                                                            <button class="ico-btn edit-btn edit-cage-btn"></button>
                                                            <button class="ico-btn delete-btn delete-cage-btn"></button>
                                                            <span class="ico-btn caret-btn"></span>
                                                        </div>
                                                    </div>
                                                    <div class="item__body">
                                                        <div class="left-form">
                                                            <div class="line">
                                                                <div class="label">
                                                                    Название:
                                                                </div>
                                                                <div class="labeled">
                                                                    {{ $cgCage->name }}
                                                                </div>
                                                            </div>
                                                            <div class="line">
                                                                <div class="label">
                                                                    Кролики:
                                                                </div>
                                                                <div class="labeled">
                                                                    @if(count($cgCage->rabbits) != 0)
                                                                        @foreach($cgCage->rabbits as $key => $rabbit)
                                                                            <a href="{{ route('rabbit', $rabbit->id) }}"
                                                                               class="@if($rabbit->gender == 'f') {{ 'female' }} @elseif($rabbit->gender == 'm') {{ 'male' }} @endif">
                                                                                {{ $rabbit->name }}
                                                                            </a>
                                                                            @if($key != count($cgCage->rabbits) - 1)
                                                                                {{ ',' }}
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        {{ '(нет кроликов)' }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="line">
                                                                <div class="label">
                                                                    Описание:
                                                                </div>
                                                                <div class="labeled" id="desc">
                                                                    {{ $cgCage->desc ?? '(нет описания)' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="none-items">
                                            {{ '(Нет клеток)' }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($cages as $cage)
                    <div class="item__wrapper">
                        <div class="item" data-id="{{ $cage->id }}">
                            <div class="item__head">
                                <div class="item__name item-icon ico-cage">
                                    {{ $cage->name }}
                                </div>
                                <div class="item-buttons">
                                    <button class="ico-btn edit-btn edit-cage-btn"></button>
                                    <button class="ico-btn delete-btn delete-cage-btn"></button>
                                    <span class="ico-btn caret-btn"></span>
                                </div>
                            </div>
                            <div class="item__body">
                                <div class="left-form">
                                    <div class="line">
                                        <div class="label">
                                            Название:
                                        </div>
                                        <div class="labeled">
                                            {{ $cage->name }}
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">
                                            Кролики:
                                        </div>
                                        <div class="labeled">
                                            @if(count($cage->rabbits) != 0)
                                                @foreach($cage->rabbits as $key => $rabbit)
                                                    <a href="{{ route('rabbit', $rabbit->id) }}"
                                                       class="@if($rabbit->gender == 'f') {{ 'female' }} @elseif($rabbit->gender == 'm') {{ 'male' }} @endif">
                                                        {{ $rabbit->name }}
                                                    </a>
                                                    @if($key != count($cage->rabbits) - 1)
                                                        {{ ',' }}
                                                    @endif
                                                @endforeach
                                            @else
                                                {{ '(нет кроликов)' }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">
                                            Описание:
                                        </div>
                                        <div class="labeled" id="desc">
                                            {{ $cage->desc ?? '(нет описания)' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="none-items">
                    {{ '(Пусто)' }}
                </div>
            @endif
        </div>

        @component('application.components.alerts') @endcomponent

        <script src="{{ asset('application/js/modal-add-item.js') }}"></script>
        <script src="{{ asset('application/js/add-item-cage.js') }}"></script>
        <script src="{{ asset('application/js/add-item-cage-group.js') }}"></script>
        <script src="{{ asset('application/js/add-item-cage-in-group.js') }}"></script>

        <script src="{{ asset('application/js/edit-item-cage.js') }}"></script>
        <script src="{{ asset('application/js/edit-item-cage-group.js') }}"></script>

        <script src="{{ asset('application/js/delete-item-cage.js') }}"></script>
        <script src="{{ asset('application/js/delete-item-cage-group.js') }}"></script>
    </div>
@endsection
