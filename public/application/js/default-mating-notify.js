//add form//
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

//edit form//

let editBtns = document.getElementsByClassName('edit-btn');
for (let i = 0; i < editBtns.length; i++) {
    editBtns[i].addEventListener('click', showEditMatingNotifyForm);
}
document.getElementById('modal-edit-mating-notify-form').addEventListener('click', hideEditMatingNotifyForm);
document.getElementById('edit-mating-notify-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-edit-mating-notify-form').addEventListener('click', hideEditMatingNotifyForm);

function showEditMatingNotifyForm(e) {
    e.stopPropagation();
    let line = this.closest('.line');
    let modal = document.getElementById('modal-edit-mating-notify-form');
    let form = modal.querySelector('form');

    console.log(this, line, modal, form);

    form.elements.days.value = line.querySelector('.after-days').innerHTML.trim();
    form.elements.text.value = line.querySelector('.notify-text').innerHTML.trim();

    let action = form.action.split('/');
    action[action.length - 1] = line.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideEditMatingNotifyForm() {
    let selector = '#modal-edit-mating-notify-form';
    hideBlock(selector);
}

//delete//

let deleteBtns = document.getElementsByClassName('delete-btn');
for (let i = 0; i < deleteBtns.length; i++) {
    deleteBtns[i].addEventListener('click', showDeleteMatingNotifyForm);
}

document.getElementById('modal-delete-mating-notify-form').addEventListener('click', hideDeleteMatingNotifyForm);
document.getElementById('delete-mating-notify-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-delete-mating-notify-form').addEventListener('click', hideDeleteMatingNotifyForm);
document.getElementById('canсel-delete-mating-notify').addEventListener('click', hideDeleteMatingNotifyForm);

function showDeleteMatingNotifyForm(e) {
    e.stopPropagation();
    let line = this.closest('.line');
    let modal = document.getElementById('modal-delete-mating-notify-form');
    let form = modal.querySelector('form');

    let action = form.action.split('/');
    action[action.length - 1] = line.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideDeleteMatingNotifyForm() {
    let selector = '#modal-delete-mating-notify-form';
    hideBlock(selector);
}

//other//

function showBlock(selector) {
    document.querySelector(selector).classList.add('show');
}

function hideBlock(selector) {
    document.querySelector(selector).classList.remove('show');
}
