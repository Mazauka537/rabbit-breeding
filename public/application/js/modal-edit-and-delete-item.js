document.getElementById('show-edit-fields-btn').addEventListener('click', showEditForm);

document.getElementById('show-delete-modal-btn').addEventListener('click', showDeleteModal);
document.getElementById('modal-delete-item-form').addEventListener('click', hideDeleteModal);
document.getElementById('delete-item-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('close-delete-modal-btn').addEventListener('click', hideDeleteModal);
document.getElementById('canсel-delete-modal-btn').addEventListener('click', hideDeleteModal);


function showEditForm() {
    document.getElementById('body-info').style.display = 'none';
    document.getElementById('body-form').style.display = 'block';
    document.getElementById('head-buttons').style.display = 'none';
}

function showDeleteModal() {
    document.getElementById('modal-delete-item-form').style.display = 'block';
}

function hideDeleteModal() {
    document.getElementById('modal-delete-item-form').style.display = 'none';
}
