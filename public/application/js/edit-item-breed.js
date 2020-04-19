let editButtons = document.getElementsByClassName('edit-btn');

for (let i = 0; i < editButtons.length; i++) {
    editButtons[i].addEventListener('click', showEditItemModal);
}

document.getElementById('modal-edit-item-form').addEventListener('click', hideEditItemModal);
document.getElementById('edit-item-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-edit-item-form').addEventListener('click', hideEditItemModal);

function showEditItemModal() {
    let item = this.closest('.item');
    let modal = document.getElementById('modal-edit-item-form');
    let form = modal.querySelector('form');

    modal.querySelector('#breed-name-edit').innerHTML = item.querySelector('.item__name').innerHTML.trim();
    form.elements.name.value = item.querySelector('.item__name').innerHTML.trim();
    form.elements.desc.value = item.querySelector('#desc').innerHTML.trim();

    let action = form.action.split('/');
    action[action.length - 1] = item.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideEditItemModal() {
    document.getElementById('modal-edit-item-form').classList.remove('show');
}
