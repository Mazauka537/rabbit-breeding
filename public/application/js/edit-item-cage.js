let editCageButtons = document.getElementsByClassName('edit-cage-btn');

for (let i = 0; i < editCageButtons.length; i++) {
    editCageButtons[i].addEventListener('click', showEditCageModal);
}

document.getElementById('modal-edit-cage-form').addEventListener('click', hideEditCageModal);
document.getElementById('edit-cage-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-edit-cage-form').addEventListener('click', hideEditCageModal);

function showEditCageModal(e) {
    e.stopPropagation();

    let item = this.closest('.item');
    let modal = document.getElementById('modal-edit-cage-form');
    let form = modal.querySelector('form');

    modal.querySelector('#cage-name-edit').innerHTML = item.querySelector('.item__name').innerHTML.trim();
    form.elements.name.value = item.querySelector('.item__name').innerHTML.trim();
    form.elements.desc.value = item.querySelector('#desc').innerHTML.trim();

    if (item.dataset.groupId)
        for (let i = 0; i < form.elements.group.options.length; i++) {
            if (form.elements.group.options[i].value == item.dataset.groupId) {
                form.elements.group.options[i].selected = true;
                break;
            }
        }
    else
        form.elements.group.options[0].selected = true;

    let action = form.action.split('/');
    action[action.length - 1] = item.dataset.id;
    form.action = action.join('/');

    modal.classList.add('show');
}

function hideEditCageModal() {
    document.getElementById('modal-edit-cage-form').classList.remove('show');
}
