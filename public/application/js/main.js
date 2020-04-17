//инициализация скроллов
$('#aside-inner').scrollbar();
$('#main').scrollbar();

//показать/спрятать описание карточки
let showDescBtns = document.getElementsByClassName('show-desc-btn');
for (let i = 0; i < showDescBtns.length; i++) {
    showDescBtns[i].addEventListener('click', showItemDesc);
}

let itemDescs = document.getElementsByClassName('item-desc');
for (let i = 0; i < itemDescs.length; i++) {
    itemDescs[i].addEventListener('click', hideItemDesc);
}

function showItemDesc(e) {
    e.preventDefault();
    this.parentElement.parentElement.nextElementSibling.classList.add('item-desc-shown');
}
function hideItemDesc(e) {
    e.preventDefault();
    this.classList.remove('item-desc-shown');
}

//выбор фото
$('#photo-input-add').change(function() {
    if ($(this).val() != '')
        $(this).prev().text($(this)[0].files[0].name);
    else
        $(this).prev().text('Выберите файл');
});

$('#photo-input-edit').change(function() {
    if ($(this).val() != '') {
        $(this).prev().text($(this)[0].files[0].name);
        this.parentElement.querySelector('input[type="submit"]').disabled = false;
    }
    else {
        $(this).prev().text('Выберите файл');
        this.parentElement.querySelector('input[type="submit"]').disabled = true;
    }
});

//user-list
document.getElementById('user-name').onclick = toggleUserList;

function toggleUserList(e) {
    e.preventDefault();
    e.stopPropagation();
    this.nextElementSibling.classList.toggle('none-height');
}

document.onclick = function () {
    document.getElementById('user-name').nextElementSibling.classList.add('none-height');
}
