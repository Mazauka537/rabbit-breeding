let addCageInGroupBtns = document.getElementsByClassName('small-plus-btn');

for (let i = 0; i < addCageInGroupBtns.length; i++) {
    addCageInGroupBtns[i].addEventListener('click', showAddCageInGroupForm);
}

function showAddCageInGroupForm(e) {
    e.stopPropagation();

    let item = this.closest('.item');
    let modal = document.getElementById('modal-add-cage-form');
    let form = modal.querySelector('form');

    for (let i = 0; i < form.elements.group.options.length; i++) {
        if (form.elements.group.options[i].value == item.dataset.id) {
            form.elements.group.options[i].selected = true;
            break;
        }
    }

    modal.classList.add('show');
}


