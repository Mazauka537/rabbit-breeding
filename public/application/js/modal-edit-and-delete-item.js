let labeled = document.getElementsByClassName('labeled');
let labeledEdit = document.getElementsByClassName('labeled-edit');

document.getElementById('show-edit-fields-btn').addEventListener('click', showLabeledEdit);

function showLabeledEdit() {
    for (let i = 0; i < labeled.length; i++) {
        labeled[i].style.display = 'none';
    }
    for (let i = 0; i < labeledEdit.length; i++) {
        labeledEdit[i].style.display = 'block';
    }
}

function hideLabeledEdit() {
    for (let i = 0; i < labeledEdit.length; i++) {
        labeledEdit[i].style.display = 'none';
    }
    for (let i = 0; i < labeled.length; i++) {
        labeled[i].style.display = 'block';
    }
}
