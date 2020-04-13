//инициализация скроллов
$('#aside-inner').scrollbar();
$('#main').scrollbar();

//показать/спрятать описание карточки кролика
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

//модальное окно добавления нового кролика
document.getElementById('btn-show-add-rabbit-form').addEventListener('click', showAddRabbitsModal);
document.getElementById('modal-add-rabbit-form').addEventListener('click', hideAddRabbitsModal);
document.getElementById('add-rabbit-form').onclick = function (e) {
    e.stopPropagation();
}
document.getElementById('btn-close-add-rabbit-form').addEventListener('click', hideAddRabbitsModal);

function showAddRabbitsModal() {
    let selector = '#modal-add-rabbit-form';
    showBlock(selector);
}

function hideAddRabbitsModal() {
    let selector = '#modal-add-rabbit-form';
    hideBlock(selector);
}

function showBlock(selector) {
    document.querySelector(selector).style.display = 'block';
}

function hideBlock(selector) {
    document.querySelector(selector).style.display = 'none';
}
