//edit photo
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

//delete photo
document.getElementById('btn-show-delete-photo').addEventListener('click', showDeletePhotoModal);
document.getElementById('delete-photo-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('close-delete-photo-btn').addEventListener('click', hideDeletePhotoModal);
document.getElementById('delete-photo-modal').addEventListener('click', hideDeletePhotoModal);
document.getElementById('canсel-delete-photo').addEventListener('click', hideDeletePhotoModal);

function showDeletePhotoModal() {
    document.getElementById('delete-photo-modal').classList.add('show');
}

function hideDeletePhotoModal() {
    document.getElementById('delete-photo-modal').classList.remove('show');
}
