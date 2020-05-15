let checkReminderButtons = document.getElementsByClassName('check-btn');

for (let i = 0; i < checkReminderButtons.length; i++) {
    checkReminderButtons[i].addEventListener('click', checkReminder);
}

function checkReminder(e) {
    e.stopPropagation();
    let item = this.closest('.item');
    let state = item.querySelector('.checked-state');
    let inp = this;

    if (!this.classList.contains('check-btn-checked')) {
        $.ajax({
            url: 'http://' + window.location.host + '/application/reminder/' + item.dataset.id + '/check',
            method: 'post',
            data: {
                _token: document.querySelector('input[name="_token"]').value
            },
            beforeSend: function () {
                switchToLoad(inp, state);
            },
            success: function (data) {
                if (data == '+') {
                    switchToChecked(inp, state);
                    inp.querySelector('.ico-btn-text').innerHTML = 'Убрать пометку о выпонении';
                }
                else {
                    switchToUnchecked(inp, state);
                    inp.querySelector('.ico-btn-text').innerHTML = 'Пометить как выполненное';
                }
                getTodayReminders();
            },
            error: function (data) {
                switchToUnchecked(inp, state);
                inp.querySelector('.ico-btn-text').innerHTML = 'Пометить как выполненное';
            },
        });
    } else {
        $.ajax({
            url: 'http://' + window.location.host + '/application/reminder/' + item.dataset.id + '/uncheck',
            method: 'post',
            data: {
                _token: document.querySelector('input[name="_token"]').value
            },
            beforeSend: function () {
                switchToLoad(inp, state);
            },
            success: function (data) {
                if (data == '+') {
                    switchToUnchecked(inp, state);
                    inp.querySelector('.ico-btn-text').innerHTML = 'Пометить как выполненное';
                }
                else {
                    switchToChecked(inp, state);
                    inp.querySelector('.ico-btn-text').innerHTML = 'Убрать пометку о выпонении';
                }
                getTodayReminders();
            },
            error: function (data) {
                switchToChecked(inp, state);
                inp.querySelector('.ico-btn-text').innerHTML = 'Убрать пометку о выпонении';
            },
        });
    }
}

function switchToLoad(inp, state) {
    inp.classList.remove('check-btn-checked');
    inp.classList.add('check-btn-load');
    state.classList.remove('checked');
    state.classList.add('loading');
}

function switchToChecked(inp, state) {
    inp.classList.remove('check-btn-load');
    inp.classList.add('check-btn-checked');
    state.classList.remove('loading');
    state.classList.add('checked');
}

function switchToUnchecked(inp, state) {
    inp.classList.remove('check-btn-checked');
    inp.classList.remove('check-btn-load');
    state.classList.remove('loading');
    state.classList.remove('checked');
}
