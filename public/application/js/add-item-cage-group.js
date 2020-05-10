document.getElementById('add-cage-group-btn').addEventListener('click', showAddCageGroupsModal);
document.getElementById('modal-add-cage-group-form').addEventListener('click', hideAddCageGroupsModal);
document.getElementById('add-cage-group-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-add-cage-group-form').addEventListener('click', hideAddCageGroupsModal);

function showAddCageGroupsModal() {
    let selector = '#modal-add-item-form';
    hideBlock(selector);
    selector = '#modal-add-cage-group-form';
    showBlock(selector);
}

function hideAddCageGroupsModal() {
    let selector = '#modal-add-cage-group-form';
    hideBlock(selector);
}

function showBlock(selector) {
    document.querySelector(selector).classList.add('show');
}

function hideBlock(selector) {
    document.querySelector(selector).classList.remove('show');
}


