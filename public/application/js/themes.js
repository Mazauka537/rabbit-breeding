let themeItems = document.getElementsByClassName('theme-item');

for (let i = 0; i < themeItems.length; i++) {
    themeItems[i].addEventListener('click', selectTheme);
}

function selectTheme() {
    document.getElementById('theme-name-inp').value = this.dataset.name;

    let themeItems = document.getElementsByClassName('theme-item');
    for (let i = 0; i < themeItems.length; i++) {
        themeItems[i].classList.remove('selected-theme');
    }

    this.classList.add('selected-theme');
}
