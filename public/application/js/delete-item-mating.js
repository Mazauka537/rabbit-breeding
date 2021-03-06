let deleteMatingButtons = document.getElementsByClassName('delete-mating-btn');

for (let i = 0; i < deleteMatingButtons.length; i++) {
    deleteMatingButtons[i].addEventListener('click', showDeleteItemModal);
}

document.getElementById('modal-delete-mating-form').addEventListener('click', hideDeleteItemModal);
document.getElementById('delete-mating-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-delete-mating-form').addEventListener('click', hideDeleteItemModal);
document.getElementById('canсel-delete-mating').addEventListener('click', hideDeleteItemModal);

function showDeleteItemModal(e) {
    e.stopPropagation();

    let item = this.closest('.item');
    let modal = document.getElementById('modal-delete-mating-form');
    let form = modal.querySelector('form');

    modal.querySelector('#mating-name-delete').innerHTML = item.querySelector('.item__name').innerHTML.trim();
    modal.querySelector('#mating-name-delete-2').innerHTML = item.querySelector('.item__name').innerHTML.trim();

    let action = form.action.split('/');
    action[action.length - 1] = item.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideDeleteItemModal() {
    document.getElementById('modal-delete-mating-form').classList.remove('show');
}
