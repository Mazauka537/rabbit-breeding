getTodayReminders();

function getTodayReminders() {
    $.ajax({
        url: 'http://' + window.location.host + '/application/reminder/get-today-count',
        method: 'post',
        data: {
            _token: document.querySelector('input[name="_token"]').value
        },
        success: function (data) {
            let icoLinkReminder = document.getElementById('ico-link-reminders');
            icoLinkReminder.innerHTML = '';
            if (data.match(/^[1-9][0-9]*$/)) {
                let div = document.createElement('div');
                div.classList.add('notify_counter');
                div.innerHTML = data;
                icoLinkReminder.append(div);
            }
            console.log(data);
        }
    });
}
