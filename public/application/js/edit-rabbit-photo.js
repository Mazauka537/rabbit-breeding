document.getElementById('btn-show-edit-photo').addEventListener('click', showEditPhotoModal);
document.getElementById('edit-photo-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('close-edit-photo-btn').addEventListener('click', hideEditPhotoModal);
document.getElementById('edit-photo-modal').addEventListener('click', hideEditPhotoModal);

function showEditPhotoModal() {
    document.getElementById('edit-photo-modal').classList.add('show');
}

function hideEditPhotoModal() {
    document.getElementById('edit-photo-modal').classList.remove('show');
}
