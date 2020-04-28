let sortInps = document.getElementsByClassName('sort-inp');

for (let i = 0; i < sortInps.length; i++) {
    sortInps[i].addEventListener('change', changeSorting);
}

function changeSorting() {
    let sortBy = this.value;

    let regex = /sortby=\w*/;
    let href = document.location.href.toString();

    if (regex.exec(href))
        href = href.replace(/sortby=\w*/, 'sortby=' + sortBy);
    else if (document.location.search == '')
        href += '?sortby=' + sortBy;
    else
        href += '&sortby=' + sortBy;

    window.location.replace(href);
}
