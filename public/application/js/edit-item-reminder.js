let editReminderButtons = document.getElementsByClassName('edit-reminder-btn');

for (let i = 0; i < editReminderButtons.length; i++) {
    editReminderButtons[i].addEventListener('click', showEditReminderModal);
}

document.getElementById('modal-edit-reminder-form').addEventListener('click', hideEditReminderModal);
document.getElementById('edit-reminder-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-edit-reminder-form').addEventListener('click', hideEditReminderModal);

function showEditReminderModal(e) {
    e.stopPropagation();
    let item = this.closest('.item');
    let modal = document.getElementById('modal-edit-reminder-form');
    let form = modal.querySelector('form');

    for (let i = 0; i < form.elements.rabbit.options.length; i++) {
        if (form.elements.rabbit.options[i].value == item.dataset.rabbit_id) {
            form.elements.rabbit.options[i].selected = true;
            break;
        }
    }

    form.elements.text.value = item.querySelector('.item__name').innerHTML.trim();
    form.elements.date.value = item.querySelector('#reminder-item-date').dataset.date.trim();

    let action = form.action.split('/');
    action[action.length - 1] = item.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideEditReminderModal() {
    document.getElementById('modal-edit-reminder-form').classList.remove('show');
}
