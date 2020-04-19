let deleteButtons = document.getElementsByClassName('delete-btn');

for (let i = 0; i < deleteButtons.length; i++) {
    deleteButtons[i].addEventListener('click', showDeleteItemModal);
}

document.getElementById('modal-delete-item-form').addEventListener('click', hideDeleteItemModal);
document.getElementById('delete-item-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-delete-item-form').addEventListener('click', hideDeleteItemModal);
document.getElementById('canсel-delete-breed').addEventListener('click', hideDeleteItemModal);

function showDeleteItemModal() {
    let item = this.closest('.item');
    let modal = document.getElementById('modal-delete-item-form');
    let form = modal.querySelector('form');

    modal.querySelector('#breed-name-delete').innerHTML = item.querySelector('.item__name').innerHTML.trim();
    modal.querySelector('#breed-name-delete-2').innerHTML = item.querySelector('.item__name').innerHTML.trim();

    let action = form.action.split('/');
    action[action.length - 1] = item.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideDeleteItemModal() {
    document.getElementById('modal-delete-item-form').classList.remove('show');
}
