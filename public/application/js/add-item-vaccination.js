document.getElementById('add-vaccination-btn').addEventListener('click', showAddVaccinationsModal);
document.getElementById('modal-add-vaccination-form').addEventListener('click', hideAddVaccinationsModal);
document.getElementById('add-vaccination-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-add-vaccination-form').addEventListener('click', hideAddVaccinationsModal);

function showAddVaccinationsModal() {
    let selector = '#modal-add-vaccination-form';
    showBlock(selector);
}

function hideAddVaccinationsModal() {
    let selector = '#modal-add-vaccination-form';
    hideBlock(selector);
}

function showBlock(selector) {
    document.querySelector(selector).classList.add('show');
}

function hideBlock(selector) {
    document.querySelector(selector).classList.remove('show');
}


