//инициализация скроллов
$('#container').scrollbar();
$('.modal-window__inner').scrollbar();

//показать/спрятать описание карточки
let showDescBtns = document.getElementsByClassName('show-desc-btn');
for (let i = 0; i < showDescBtns.length; i++) {
    showDescBtns[i].addEventListener('click', showItemDesc);
}

function showItemDesc(e) {
    e.preventDefault();
    this.closest('.item').querySelector('.item-desc').classList.toggle('item-desc-shown');
}

//выбор фото
$('#photo-input-add').change(function () {
    if ($(this).val() != '')
        $(this).prev().text($(this)[0].files[0].name);
    else
        $(this).prev().text('Выберите файл');
});

$('#photo-input-edit').change(function () {
    if ($(this).val() != '') {
        $(this).prev().text($(this)[0].files[0].name);
        this.parentElement.querySelector('input[type="submit"]').disabled = false;
    } else {
        $(this).prev().text('Выберите файл');
        this.parentElement.querySelector('input[type="submit"]').disabled = true;
    }
});

//user-list in header
document.getElementById('user-name').onclick = toggleUserList;

function toggleUserList(e) {
    e.preventDefault();
    e.stopPropagation();
    this.nextElementSibling.classList.toggle('none-height');
}

document.onclick = function () {
    document.getElementById('user-name').nextElementSibling.classList.add('none-height');

    hideAllItemButtons();
}

function hideAllItemButtons(b = null) {
    let itemButtons = document.getElementsByClassName('item-buttons');
    for (let i = 0; i < itemButtons.length; i++) {
        if (itemButtons[i] != b)
            itemButtons[i].classList.remove('show');
    }
}

//items toggle body
let itemHeads = document.getElementsByClassName('item__head');
for (let i = 0; i < itemHeads.length; i++) {
    itemHeads[i].onclick = toggleItemBody;
}

function toggleItemBody() {
    $(this).next().slideToggle();
}

//alerts
let alertButtons = document.getElementsByClassName('alert-close-button');
for (let i = 0; i < alertButtons.length; i++) {
    alertButtons[i].addEventListener('click', closeAlert);
}

function closeAlert() {
    this.closest('.alert').remove();
}

//item-buttons
let showItemButtonsBtns = document.getElementsByClassName('item-buttons-show-btn');
for (let i = 0; i < showItemButtonsBtns.length; i++) {
    showItemButtonsBtns[i].addEventListener('click', toggleItemButtons);
}

let allIcoBtnsInItemButton = document.querySelectorAll('.item-buttons .ico-btn');

for (let i = 0; i < allIcoBtnsInItemButton.length; i++) {
    allIcoBtnsInItemButton[i].addEventListener('click', hideItemButtons);
}

function hideItemButtons() {
    this.closest('.item').querySelector('.item-buttons').classList.remove('show');
}

function toggleItemButtons(e) {
    e.stopPropagation();
    let b = this.closest('.item__head').querySelector('.item-buttons');
    b.classList.toggle('show');
    hideAllItemButtons(b);
}

//screen height changing
window.addEventListener('resize',function () {
    let container = document.getElementById('container');
    let header = document.getElementById('header');
    container.style.maxHeight = document.body.offsetHeight - header.offsetHeight + 'px';
    console.log(container.style.maxHeight);
    console.log(container.offsetHeight, document.body.offsetHeight);

});
