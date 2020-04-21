let deleteReminderButtons = document.getElementsByClassName('delete-reminder-btn');

for (let i = 0; i < deleteReminderButtons.length; i++) {
    deleteReminderButtons[i].addEventListener('click', showDeleteReminderModal);
}

document.getElementById('modal-delete-reminder-form').addEventListener('click', hideDeleteReminderModal);
document.getElementById('delete-reminder-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-delete-reminder-form').addEventListener('click', hideDeleteReminderModal);
document.getElementById('canсel-delete-reminder').addEventListener('click', hideDeleteReminderModal);

function showDeleteReminderModal(e) {
    e.stopPropagation();
    let item = this.closest('.item');
    let modal = document.getElementById('modal-delete-reminder-form');
    let form = modal.querySelector('form');

    let action = form.action.split('/');
    action[action.length - 1] = item.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideDeleteReminderModal() {
    document.getElementById('modal-delete-reminder-form').classList.remove('show');
}
