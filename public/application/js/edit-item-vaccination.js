let editVatinationButtons = document.getElementsByClassName('edit-vaccination-btn');

for (let i = 0; i < editVatinationButtons.length; i++) {
    editVatinationButtons[i].addEventListener('click', showEditVaccinationModal);
}

document.getElementById('modal-edit-vaccination-form').addEventListener('click', hideEditVaccinationModal);
document.getElementById('edit-vaccination-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-edit-vaccination-form').addEventListener('click', hideEditVaccinationModal);

function showEditVaccinationModal(e) {
    e.stopPropagation();
    let item = this.closest('.item');
    let modal = document.getElementById('modal-edit-vaccination-form');
    let form = modal.querySelector('form');

    modal.querySelector('#vaccination-name-edit').innerHTML = item.querySelector('.item__name').innerHTML.trim();

    for (let i = 0; i < form.elements.rabbit.options.length; i++) {
        if (form.elements.rabbit.options[i].value == item.dataset.rabbit_id) {
            form.elements.rabbit.options[i].selected = true;
            break;
        }
    }

    form.elements.name.value = item.querySelector('.item__name').innerHTML.trim();
    form.elements.date.value = item.querySelector('#vaccination-item-date').dataset.date.trim();
    form.elements.desc.value = item.querySelector('#vaccination-item-desc').innerHTML.trim();

    let action = form.action.split('/');
    action[action.length - 1] = item.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideEditVaccinationModal() {
    document.getElementById('modal-edit-vaccination-form').classList.remove('show');
}
