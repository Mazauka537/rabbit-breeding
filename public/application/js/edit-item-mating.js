let editMatingButtons = document.getElementsByClassName('edit-mating-btn');

for (let i = 0; i < editMatingButtons.length; i++) {
    editMatingButtons[i].addEventListener('click', showEditItemModal);
}

document.getElementById('modal-edit-mating-form').addEventListener('click', hideEditItemModal);
document.getElementById('edit-mating-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-edit-mating-form').addEventListener('click', hideEditItemModal);

function showEditItemModal(e) {
    e.stopPropagation();
    let item = this.closest('.item');
    let modal = document.getElementById('modal-edit-mating-form');
    let form = modal.querySelector('form');

    modal.querySelector('#mating-name-edit').innerHTML = item.querySelector('.item__name').innerHTML.trim();

    for (let i = 0; i < form.elements.female.options.length; i++) {
        if (form.elements.female.options[i].value == item.dataset.female_id) {
            form.elements.female.options[i].selected = true;
            break;
        }
    }
    for (let i = 0; i < form.elements.male.options.length; i++) {
        if (form.elements.male.options[i].value == item.dataset.male_id) {
            form.elements.male.options[i].selected = true;
            break;
        }
    }
    form.elements.date.value = item.querySelector('#mating-item-date').dataset.date.trim();
    form.elements.date_birth.value = item.querySelector('#mating-item-date_birth').dataset.date_birth.trim();
    form.elements.child_count.value = item.querySelector('#mating-item-child_count').innerHTML.trim();
    form.elements.alive_count.value = item.querySelector('#mating-item-alive_count').innerHTML.trim();
    form.elements.desc.value = item.querySelector('#mating-item-desc').innerHTML.trim();

    if (form.elements.desc.value === '(нет)')
        form.elements.desc.value = '';

    let action = form.action.split('/');
    action[action.length - 1] = item.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideEditItemModal() {
    document.getElementById('modal-edit-mating-form').classList.remove('show');
}
