document.getElementById('inp-rabbit-gender').addEventListener('change', genderChange);

function genderChange() {
    let form = this.closest('form');
    if (this.value == 'f')
        form.querySelector('.select-status').disabled = false;
    else
        form.querySelector('.select-status').disabled = true;
}
