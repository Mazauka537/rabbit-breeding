document.getElementById('show-delete-modal-btn').addEventListener('click', showDeleteModal);
document.getElementById('modal-delete-item-form').addEventListener('click', hideDeleteModal);
document.getElementById('delete-item-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('close-delete-modal-btn').addEventListener('click', hideDeleteModal);
document.getElementById('canсel-delete-modal-btn').addEventListener('click', hideDeleteModal);

function showDeleteModal() {
    document.getElementById('modal-delete-item-form').style.display = 'block';
}

function hideDeleteModal() {
    document.getElementById('modal-delete-item-form').style.display = 'none';
}
