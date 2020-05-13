let editCageGroupButtons = document.getElementsByClassName('edit-cage-group-btn');

for (let i = 0; i < editCageGroupButtons.length; i++) {
    editCageGroupButtons[i].addEventListener('click', showEditCageGroupModal);
}

document.getElementById('modal-edit-cage-group-form').addEventListener('click', hideEditCageGroupModal);
document.getElementById('edit-cage-group-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-edit-cage-group-form').addEventListener('click', hideEditCageGroupModal);

function showEditCageGroupModal(e) {
    e.stopPropagation();

    let item = this.closest('.item');
    let modal = document.getElementById('modal-edit-cage-group-form');
    let form = modal.querySelector('form');

    modal.querySelector('#cage-group-name-edit').innerHTML = item.querySelector('.item__name').innerHTML.trim();
    form.elements.name.value = item.querySelector('.item__name').innerHTML.trim();
    form.elements.desc.value = item.querySelector('#desc').innerHTML.trim();

    if (form.elements.desc.value === '(нет описания)')
        form.elements.desc.value = '';

    let action = form.action.split('/');
    action[action.length - 1] = item.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideEditCageGroupModal() {
    document.getElementById('modal-edit-cage-group-form').classList.remove('show');
}
