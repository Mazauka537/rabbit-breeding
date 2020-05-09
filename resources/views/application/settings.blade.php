@extends('layouts.application')

@section('title', 'Настройки - ' . config('app.name'))

@section('main')
    <div class="main__inner">

        <div class="modal-window" id="modal-add-mating-notify-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="add-mating-notify-form">
                    <div class="close-button" id="btn-close-add-mating-notify-form"></div>
                    <form action="{{ route('addDefaultMatingNotify') }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Добавление напоминания по умолчанию
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">Дни*:</div>
                                    <div class="labeled">
                                        <input type="number" name="days" value="{{ old('days') }}"
                                               placeholder="Через сколько дней напомнить?" required maxlength="255">
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Текст*:</div>
                                    <div class="labeled">
                                        <textarea name="text" placeholder="Текст напоминания"
                                                  required>{{ old('text') }}</textarea>
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

        <div class="modal-window" id="modal-edit-mating-notify-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="edit-mating-notify-form">
                    <div class="close-button" id="btn-close-edit-mating-notify-form"></div>
                    <form action="{{ route('editDefaultMatingNotify', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Редактирование напоминания по умолчанию
                        </div>

                        <div class="body">
                            <div class="center-form">
                                <div class="line">
                                    <div class="label">Дни*:</div>
                                    <div class="labeled">
                                        <input type="number" name="days" value=""
                                               placeholder="Через сколько дней напомнить?" required>
                                    </div>
                                </div>
                                <div class="line">
                                    <div class="label">Текст*:</div>
                                    <div class="labeled">
                                        <textarea name="text" placeholder="Текст напоминания" required
                                                  maxlength="255"></textarea>
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

        <div class="modal-window" id="modal-delete-mating-notify-form">
            <div class="modal-window__inner scrollbar-macosx">
                <div class="form__wrapper" id="delete-mating-notify-form">
                    <div class="close-button" id="btn-close-delete-mating-notify-form"></div>
                    <form action="{{ route('deleteDefaultMatingNotify', 0) }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Удаление напоминания
                        </div>

                        <div class="body pt-20">
                            Вы действительно хотите удалить данное напоминание?
                            <div class="delete-form-buttons">
                                <input type="submit" value="Да">
                                <input type="button" value="Отмена" id="canсel-delete-mating-notify">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="wrapper settings__wrapper">
            <div class="head">
                Общие настройки
            </div>
            <form action="{{ route('saveSettings', $user->id) }}" method="post"
                  enctype="multipart/form-data" class="form">
                @csrf
                <input type="hidden" name="theme" id="theme-name-inp" value="{{ $user->theme ?? 'default' }}">
                <div class="center-form">
                    <div class="line">
                        <div class="label">Ваше имя:</div>
                        <div class="labeled">
                            <input type="text" name="name" value="{{ $user->name }}" required>
                        </div>
                    </div>
                    <div class="line">
                        <div class="label">Записей на странице:</div>
                        <div class="labeled">
                            <input type="number" name="pagination" min="1" max="200" value="{{ $user->pagination }}"
                                   required>
                        </div>
                    </div>
                    <div class="line checkbox-line">
                        <div class="label">
                        </div>
                        <div class="labeled">
                            <input id="auto_mating_reminders_inp" type="checkbox"
                                   name="auto_mating_reminders" @if($user->auto_mating_reminders) {{ 'checked' }} @endif>
                            <label for="auto_mating_reminders_inp">Автоматически помечать поле для добавления
                                стандартных напоминаний</label>
                        </div>
                    </div>
                    <div class="line checkbox-line">
                        <div class="label">
                        </div>
                        <div class="labeled">
                            <input id="auto_delete_reminders_inp" name="auto_delete_reminders"
                                   type="checkbox" @if($user->days_for_delete_reminders != 0) {{ 'checked' }} @endif>
                            <label for="auto_delete_reminders_inp">Автоматически удалять старые напоминания</label>
                        </div>
                    </div>
                    <div class="line checkbox-line auto-delete-reminder disabled">
                        <div class="label">
                        </div>
                        <div class="labeled">
                            <input id="delete_only_checked_reminders_inp" name="delete_only_checked_reminders"
                                   type="checkbox" @if($user->delete_only_checked_reminders) {{ 'checked' }} @endif>
                            <label for="delete_only_checked_reminders_inp">Удалять только выполненные
                                напоминания</label>
                        </div>
                    </div>
                    <div class="line auto-delete-reminder disabled">
                        <div class="label">
                            Удалять через (дней):
                        </div>
                        <div class="labeled">
                            <input type="number" min="1" max="30000" required name="days_for_delete_reminders"
                                   placeholder="кол-во дней"
                                   value="@if($user->days_for_delete_reminders != 0){{ $user->days_for_delete_reminders }}@endif">
                            <span class="explain"></span>
                            <span class="explain-box">
                                Число дней через которое напоминания будут автоматически удаляться.<br>К примеру, если напоминание назначено на 15 августа, а значение данного поля равно 6, то напоминание будет удалено 21 августа.
                            </span>
                        </div>
                    </div>
                    <div class="line">
                        <div class="label">Тема:</div>
                        <div class="labeled">
                            <div class="theme-input">
                                <div class="theme-item__wrapper">
                                    <div
                                        class="theme-item @if($user->theme == 'default' || empty($user->theme)) {{ 'selected-theme' }} @endif"
                                        data-name="default" style="background-color: #87F03C"></div>
                                </div>
                                @foreach($themes as $key => $value)
                                    <div class="theme-item__wrapper">
                                        <div class="theme-item @if($key == $user->theme) {{ 'selected-theme' }} @endif"
                                             data-name="{{ $key }}" style="background-color: {{ $value->color }}"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="line">
                        <div class="label"></div>
                        <div class="labeled">
                            <input type="submit" value="Сохранить">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="wrapper settings__wrapper" id="default_reminders">
            <div class="head">
                Стандартные напоминания
                <span class="explain">
                    <span class="explain-box">
                        Напоминания, добавляемые автоматически при добавлении случки.
                    </span>
                </span>
            </div>
            <div class="form">
                <div class="center-form">
                    @if(count($defaultNotifies) != 0)
                        @foreach($defaultNotifies as $dnotify)
                            <div class="line" data-id="{{ $dnotify->id }}">
                                <div class="label">
                                    Через
                                    <span class="after-days">
                                        {{ $dnotify->days }}
                                    </span>
                                    дней:
                                </div>
                                <div class="labeled">
                                    <div class="input-label txt-clip">
                                        <span class="notify-text">
                                            {{ $dnotify->text }}
                                        </span>
                                        <div class="item-buttons">
                                            <button class="ico-btn edit-btn edit-notify-btn"></button>
                                            <button class="ico-btn delete-btn delete-notify-btn"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="line">
                            <div class="label"></div>
                            <div class="labeled">
                                <div class="input-label text-center" style="padding-right: 9px">
                                    (Пусто)
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="line">
                        <div class="label"></div>
                        <div class="labeled">
                            <input type="button" value="+" id="add-mating-notify-btn">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @component('application.components.alerts') @endcomponent

    </div>
    <script src="{{ asset('application/js/themes.js') }}"></script>
    <script src="{{ asset('application/js/default-mating-notify.js') }}"></script>
    <script src="{{ asset('application/js/auto-delete-reminders.js') }}"></script>
@endsection
