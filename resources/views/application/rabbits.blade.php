@extends('layouts.application')

@section('title', 'rabbits')

@section('main')
        <div class="main__inner">

            <div class="modal-window" id="modal-add-item-form">
                <div class="form__wrapper" id="add-item-form">
                    <div class="close-button" id="btn-close-add-item-form"></div>
                    <form action="{{ route('addRabbit') }}" class="form" method="post">
                        @csrf
                        <div class="head">
                            Добавление нового кролика
                        </div>

                        <div class="body">
                            <div class="line clearfix">
                                <div class="label">Имя*:</div>
                                <div class="labeled">
                                    <input type="text" name="name">
                                </div>
                            </div>
                            <div class="line clearfix">
                                <div class="label">Пол*:</div>
                                <div class="labeled">
                                    <select name="gender">
                                        <option value=""></option>
                                        <option value="m">М</option>
                                        <option value="f">Ж</option>
                                    </select>
                                </div>
                            </div>
                            <div class="line clearfix">
                                <div class="label">Порода:</div>
                                <div class="labeled">
                                    <select name="breed">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="line clearfix">
                                <div class="label">Клетка:</div>
                                <div class="labeled">
                                    <select name="cage">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="line clearfix">
                                <div class="label">Дата рождения:</div>
                                <div class="labeled">
                                    <input type="date" name="date">
                                </div>
                            </div>
                            <div class="line clearfix">
                                <div class="label">Мама:</div>
                                <div class="labeled">
                                    <select name="mother">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="line clearfix">
                                <div class="label">Папа:</div>
                                <div class="labeled">
                                    <select name="father">
                                        <option value=""></option>
                                    </select>
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

                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>
                <div class="item__wrapper">
                    <a href="#" class="item">
                        <div class="ratio ratio-4-3">
                            <div class="item__inner ratio__inner">
                                <div class="item-filter">
                                    <div class="info">
                                        <div class="cage">121</div>
                                        <div class="birthday">02.03.2004</div>
                                        <div class="breed">белый</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item__footer">
                            <div class="name">Жора</div>
                            <div class="info">
                                <span class="show-desc-btn ico-info"></span>
                            </div>
                        </div>
                        <div class="item-desc">
                            дополнительное описание кролика
                        </div>
                    </a>
                </div>

            </div>

            <script src="{{ asset('application/js/modal-add-item.js') }}"></script>
        </div>
@endsection
