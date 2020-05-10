let deleteCageButtons = document.getElementsByClassName('delete-cage-btn');

for (let i = 0; i < deleteCageButtons.length; i++) {
    deleteCageButtons[i].addEventListener('click', showDeleteCageModal);
}

document.getElementById('modal-delete-cage-form').addEventListener('click', hideDeleteCageModal);
document.getElementById('delete-cage-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-delete-cage-form').addEventListener('click', hideDeleteCageModal);
document.getElementById('canсel-delete-cage').addEventListener('click', hideDeleteCageModal);

function showDeleteCageModal(e) {
    e.stopPropagation();

    let item = this.closest('.item');
    let modal = document.getElementById('modal-delete-cage-form');
    let form = modal.querySelector('form');

    modal.querySelector('#cage-name-delete').innerHTML = item.querySelector('.item__name').innerHTML.trim();
    modal.querySelector('#cage-name-delete-2').innerHTML = item.querySelector('.item__name').innerHTML.trim();

    let action = form.action.split('/');
    action[action.length - 1] = item.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideDeleteCageModal() {
    document.getElementById('modal-delete-cage-form').classList.remove('show');
}
