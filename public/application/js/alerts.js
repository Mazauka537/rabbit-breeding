let alertButtons = document.getElementsByClassName('alert-close-button');
for (let i = 0; i < alertButtons.length; i++) {
    alertButtons[i].addEventListener('click', closeAlert);
}
function closeAlert() {
    this.closest('.alert').remove();
}
