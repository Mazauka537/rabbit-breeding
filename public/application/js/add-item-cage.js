document.getElementById('add-cage-btn').addEventListener('click', showAddCagesModal);
document.getElementById('modal-add-cage-form').addEventListener('click', hideAddCagesModal);
document.getElementById('add-cage-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-add-cage-form').addEventListener('click', hideAddCagesModal);

function showAddCagesModal() {
    let selector = '#modal-add-item-form';
    hideBlock(selector);
    selector = '#modal-add-cage-form';
    document.querySelector(selector).querySelector('form').elements.group.options[0].selected = true;;
    showBlock(selector);
}

function hideAddCagesModal() {
    let selector = '#modal-add-cage-form';
    hideBlock(selector);
}

function showBlock(selector) {
    document.querySelector(selector).classList.add('show');
}

function hideBlock(selector) {
    document.querySelector(selector).classList.remove('show');
}


