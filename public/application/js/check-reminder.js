let checkReminderButtons = document.getElementsByClassName('check-btn');

for (let i = 0; i < checkReminderButtons.length; i++) {
    checkReminderButtons[i].addEventListener('click', checkReminder);
}

function checkReminder(e) {
    e.stopPropagation();
    let item = this.closest('.item');
    let inp = this;

    if (!this.classList.contains('check-btn-checked')) {
        $.ajax({
            url: 'http://' + window.location.host + '/application/reminder/' + item.dataset.id + '/check',
            method: 'post',
            data: {
                _token: document.querySelector('input[name="_token"]').value
            },
            beforeSend: function () {
                switchToLoad(inp);
            },
            success: function (data) {
                if (data == '+')
                    switchToChecked(inp);
                else
                    switchToUnchecked(inp);
                getTodayReminders();
            },
            error: function (data) {
                switchToUnchecked(inp);
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
                switchToLoad(inp);
            },
            success: function (data) {
                if (data == '+')
                    switchToUnchecked(inp);
                else
                    switchToChecked(inp);
                getTodayReminders();
            },
            error: function (data) {
                switchToChecked(inp);
            },
        });
    }
}

function switchToLoad(inp) {
    inp.classList.remove('check-btn-checked');
    inp.classList.add('check-btn-load');
}

function switchToChecked(inp) {
    inp.classList.remove('check-btn-load');
    inp.classList.add('check-btn-checked');
}

function switchToUnchecked(inp) {
    inp.classList.remove('check-btn-checked');
    inp.classList.remove('check-btn-load');
}
