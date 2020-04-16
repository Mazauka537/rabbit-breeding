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
$('.input-file').change(function() {
    if ($(this).val() != '') $(this).prev().text($(this)[0].files[0].name);
    else $(this).prev().text('Выберите файл');
});
