document.getElementById('add-mating-notify-btn').addEventListener('click', showAddMatingNotifyForm);
document.getElementById('modal-add-mating-notify-form').addEventListener('click', hideAddMatingNotifyForm);
document.getElementById('add-mating-notify-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-add-mating-notify-form').addEventListener('click', hideAddMatingNotifyForm);

function showAddMatingNotifyForm() {
    let selector = '#modal-add-mating-notify-form';
    showBlock(selector);
}

function hideAddMatingNotifyForm() {
    let selector = '#modal-add-mating-notify-form';
    hideBlock(selector);
}

function showBlock(selector) {
    document.querySelector(selector).classList.add('show');
}

function hideBlock(selector) {
    document.querySelector(selector).classList.remove('show');
}
