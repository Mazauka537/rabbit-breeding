//окно добавления новой записи
document.getElementById('btn-show-add-item-form').addEventListener('click', showAddItemsModal);
document.getElementById('modal-add-item-form').addEventListener('click', hideAddItemsModal);
document.getElementById('add-item-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-add-item-form').addEventListener('click', hideAddItemsModal);

function showAddItemsModal() {
    let selector = '#modal-add-item-form';
    showBlock(selector);
}

function hideAddItemsModal() {
    let selector = '#modal-add-item-form';
    hideBlock(selector);
}

function showBlock(selector) {
    document.querySelector(selector).style.display = 'block';
}

function hideBlock(selector) {
    document.querySelector(selector).style.display = 'none';
}
