@extends('layouts.application')

@section('title', 'reminders')

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
            <button id="btn-show-add-item-form"></button>
        </div>

        <div class="items">

            @foreach($reminders as $reminder)
                <div class="item__wrapper">
                    <div class="item" data-id="{{ $reminder->id }}" data-rabbit_id="{{ $reminder->rabbit_id }}">
                        <div class="item__head item__head-hovered">
                            <div class="item__name">
                                {{ $reminder->text }}
                            </div>
                            <div class="item-buttons">
                                <button class="ico-btn edit-btn edit-reminder-btn"></button>
                                <button class="ico-btn delete-btn delete-reminder-btn"></button>
                                <span class="ico-btn caret-btn"></span>
                            </div>
                        </div>
                        <div class="item__body">
                            <div class="left-form">

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="alerts">
            @if(count($errors->all()) != 0)
                <div class="alert alert-error">
                    <button class="alert-close-button"></button>
                    <div class="alert__inner">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        <script src="{{ asset('application/js/modal-add-item.js') }}"></script>
        <script src="{{ asset('application/js/edit-item-reminder.js') }}"></script>
        <script src="{{ asset('application/js/delete-item-reminder.js') }}"></script>
    </div>
@endsection
