@extends('layouts.application')

@section('title', 'Напоминания - ' . config('app.name'))

@section('main')
    <div class="main__inner">

        <div class="modal-window" id="modal-add-item-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="add-item-form">
                    <div class="close-button" id="btn-close-add-item-form"></div>
                    <form action="{{ route('addReminder') }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Добавление нового напоминания
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">
                                        Дата*:
                                    </div>
                                    <div class="labeled">
                                        <input type="date" name="date" value="{{ old('date') }}" required>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Текст*:
                                    </div>
                                    <div class="labeled">
                                        <textarea name="text"
                                                  placeholder="Опишите ваши планы на выбранную дату"
                                                  maxlength="255" required>{{ old('text') }}</textarea>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Кролик:
                                    </div>
                                    <div class="labeled">
                                        <select name="rabbit">
                                            <option value="">(нет)</option>
                                            @foreach($rabbits as $r)
                                                <option
                                                    value="{{ $r->id }}" @if(old('rabbit') == $r->id) {{ 'selected' }} @endif>{{ $r->name }}</option>
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

        <div class="modal-window" id="modal-edit-reminder-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="edit-reminder-form">
                    <div class="close-button" id="btn-close-edit-reminder-form"></div>
                    <form action="{{ route('editReminder', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Редактирование напоминания
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">
                                        Дата*:
                                    </div>
                                    <div class="labeled">
                                        <input type="date" name="date" required>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Текст*:
                                    </div>
                                    <div class="labeled">
                                        <textarea name="text"
                                                  placeholder="Опишите ваши планы на выбранную дату"
                                                  maxlength="255" required></textarea>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">
                                        Кролик:
                                    </div>
                                    <div class="labeled">
                                        <select name="rabbit">
                                            <option value="">(нет)</option>
                                            @foreach($rabbits as $r)
                                                <option
                                                    value="{{ $r->id }}">{{ $r->name }}</option>
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

        <div class="modal-window" id="modal-delete-reminder-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="delete-reminder-form">
                    <div class="close-button" id="btn-close-delete-reminder-form"></div>
                    <form action="{{ route('deleteReminder', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Удаление напоминания
                        </div>

                        <div class="body pt-20">
                            Вы действительно хотите удалить данное напоминание?
                            <div class="delete-form-buttons">
                                <input type="submit" value="Да">
                                <input type="button" value="Отмена" id="canсel-delete-reminder">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="add-button">
            <button id="btn-show-add-item-form" title="добавить напоминание"></button>
        </div>

        <div class="items overflow-v">
            @if(!empty($reminders->all()))
                @foreach($reminders as $key => $reminder)
                    <div class="item__wrapper">
                        @if($key != 0 && $reminder->date != $reminders[$key - 1]->date || $key == 0)
                            <div class="item__date @if(strtotime($reminder->date) < strtotime(date('Y-m-d')))
                                {{ 'past' }}
                                @elseif($reminder->date == date('Y-m-d'))
                                {{ 'today' }}
                                @endif">
                                @if($reminder->date == date('Y-m-d'))
                                    {{ 'сегодня' }}
                                @else
                                    {{ date("d.m.Y", strtotime($reminder->date)) }}
                                @endif
                            </div>
                        @endif
                        <div class="item" data-id="{{ $reminder->id }}" data-rabbit_id="{{ $reminder->rabbit_id }}">
                            <div class="item__head">
                                <div class="item__name">
                                    {{ $reminder->text }}
                                </div>
                                <div class="item-buttons">
                                    <button
                                        class="ico-btn check-btn @if($reminder->checked) {{ 'check-btn-checked' }} @endif"
                                        title="пометить как выполненное"></button>
                                    <button class="ico-btn edit-btn edit-reminder-btn" title="редактировать"></button>
                                    <button class="ico-btn delete-btn delete-reminder-btn" title="удалить"></button>
                                    <span class="ico-btn caret-btn" title="показать подробности"></span>
                                </div>
                            </div>
                            <div class="item__body">
                                <div class="left-form">
                                    <div class="line">
                                        <div class="label">
                                            Дата:
                                        </div>
                                        <div class="labeled" id="reminder-item-date" data-date="{{ $reminder->date }}">
                                            {{ date("d.m.Y", strtotime($reminder->date)) }}
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">
                                            Текст:
                                        </div>
                                        <div class="labeled">
                                            {{ $reminder->text }}
                                        </div>
                                    </div>
                                    <div class="line">
                                        <div class="label">
                                            Кролик:
                                        </div>
                                        <div class="labeled">
                                            @if(!empty($reminder->rabbit))
                                                <a href="{{ route('rabbit', $reminder->rabbit->id) }}"
                                                   class="@if($reminder->rabbit->gender == 'f') {{ 'female' }} @else {{ 'male' }} @endif">
                                                    {{ $reminder->rabbit->name }}
                                                </a>
                                            @else
                                                {{ '(нет)' }}
                                            @endif
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
        <script src="{{ asset('application/js/edit-item-reminder.js') }}"></script>
        <script src="{{ asset('application/js/delete-item-reminder.js') }}"></script>
        <script src="{{ asset('application/js/check-reminder.js') }}"></script>
    </div>
@endsection
