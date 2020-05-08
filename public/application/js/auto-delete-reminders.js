let autoDelRemInp = document.getElementById('auto_delete_reminders_inp');
let disabableLines = document.getElementsByClassName('auto-delete-reminder');

if (autoDelRemInp.checked) {
    for (let i = 0; i < disabableLines.length; i++) {
        disabableLines[i].classList.remove('disabled');
        disabableLines[i].querySelector('input').disabled = false;
    }
} else {
    for (let i = 0; i < disabableLines.length; i++) {
        disabableLines[i].classList.add('disabled');
        disabableLines[i].querySelector('input').disabled = true;
    }
}

autoDelRemInp.addEventListener('change', toggleDeleteRemindersLines);

function toggleDeleteRemindersLines() {
    if (this.checked) {
        for (let i = 0; i < disabableLines.length; i++) {
            disabableLines[i].classList.remove('disabled');
            disabableLines[i].querySelector('input').disabled = false;
        }
    } else {
        for (let i = 0; i < disabableLines.length; i++) {
            disabableLines[i].classList.add('disabled');
            disabableLines[i].querySelector('input').disabled = true;
        }
    }
}
