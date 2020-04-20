let deleteVatinationButtons = document.getElementsByClassName('delete-vaccination-btn');

for (let i = 0; i < deleteVatinationButtons.length; i++) {
    deleteVatinationButtons[i].addEventListener('click', showDeleteVaccinationModal);
}

document.getElementById('modal-delete-vaccination-form').addEventListener('click', hideDeleteVaccinationModal);
document.getElementById('delete-vaccination-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-delete-vaccination-form').addEventListener('click', hideDeleteVaccinationModal);
document.getElementById('canсel-delete-vaccination').addEventListener('click', hideDeleteVaccinationModal);

function showDeleteVaccinationModal(e) {
    e.stopPropagation();
    let item = this.closest('.item');
    let modal = document.getElementById('modal-delete-vaccination-form');
    let form = modal.querySelector('form');

    modal.querySelector('#vaccination-name-delete').innerHTML = item.querySelector('.item__name').innerHTML.trim();
    modal.querySelector('#vaccination-name-delete-2').innerHTML = item.querySelector('.item__name').innerHTML.trim();

    let action = form.action.split('/');
    action[action.length - 1] = item.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideDeleteVaccinationModal() {
    document.getElementById('modal-delete-vaccination-form').classList.remove('show');
}
