$('#aside-inner').scrollbar();
$('#main').scrollbar();

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
