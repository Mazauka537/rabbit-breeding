document.getElementById('show-edit-fields-btn').addEventListener('click', showEditForm);

function showEditForm() {
    document.getElementById('body-info').style.display = 'none';
    document.getElementById('body-form').style.display = 'block';
    document.getElementById('head-buttons').style.display = 'none';
}

// function hideEditForm() {
//     document.getElementById('body-edit').style.display = 'none';
//     document.getElementById('body-info').style.display = 'block';
//     document.getElementById('head-buttons').style.display = 'block';
//
// }
