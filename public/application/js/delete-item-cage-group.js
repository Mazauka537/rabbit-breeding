let deleteCageGroupButtons = document.getElementsByClassName('delete-cage-group-btn');

for (let i = 0; i < deleteCageGroupButtons.length; i++) {
    deleteCageGroupButtons[i].addEventListener('click', showDeleteCageGroupModal);
}

document.getElementById('modal-delete-cage-group-form').addEventListener('click', hideDeleteCageGroupModal);
document.getElementById('delete-cage-group-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-delete-cage-group-form').addEventListener('click', hideDeleteCageGroupModal);
document.getElementById('canсel-delete-cage-group').addEventListener('click', hideDeleteCageGroupModal);

function showDeleteCageGroupModal(e) {
    e.stopPropagation();

    let item = this.closest('.item');
    let modal = document.getElementById('modal-delete-cage-group-form');
    let form = modal.querySelector('form');

    modal.querySelector('#cage-group-name-delete').innerHTML = item.querySelector('.item__name').innerHTML.trim();
    modal.querySelector('#cage-group-name-delete-2').innerHTML = item.querySelector('.item__name').innerHTML.trim();

    let action = form.action.split('/');
    action[action.length - 1] = item.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideDeleteCageGroupModal() {
    document.getElementById('modal-delete-cage-group-form').classList.remove('show');
}
