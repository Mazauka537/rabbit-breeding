class Pagination {

    constructor() {
        this.paginationBlock;
        this.currentPage;
        this.lastPage;
        this.middleSectionSize = 3;
    }

    getPage() {
        let regexp = /page=([^&]+)/i;

        if (!!regexp.exec(document.location.search))
            return regexp.exec(document.location.search)[1];
        else
            return 1;
    }

    makePagination(elemId) {
        this.paginationBlock = document.getElementById(elemId);

        if (this.paginationBlock == undefined) {
            return false;
        }

        this.currentPage = this.getPage();
        this.lastPage = this.paginationBlock.dataset.lastPage;

        this.paginationBlock.append(this.getPagination());
    }

    getPagination() {
        let leftPaginationSection = this.getLeftPaginationSection();
        let middlePaginationSection = this.getMiddlePaginationSection();
        let rightPaginationSection = this.getRightPaginationSection();

        let pagination = document.createElement('div');
        pagination.append(leftPaginationSection, middlePaginationSection, rightPaginationSection);
        pagination.classList.add('pagination');
        return pagination;
    }

    getLeftPaginationSection() {
        let firstButton = this.getPageButton('div', '<<', 1);
        let prevButton = this.getPageButton('div', '<', this.currentPage - 1);

        if (+this.currentPage <= 1) {
            firstButton.classList.add('disabled');
            prevButton.classList.add('disabled');
            firstButton.addEventListener('click', function (e) {
                e.preventDefault();
            });
            prevButton.addEventListener('click', function (e) {
                e.preventDefault();
            });
        }

        let leftSection = this.getSidePaginationButtons(firstButton, prevButton);
        leftSection.classList.add('left-pagination-buttons');
        return leftSection;
    }

    getMiddlePaginationSection() {
        let middleSection = document.createElement('ul');

        let min = this.currentPage - this.middleSectionSize;
        let max = +this.currentPage + this.middleSectionSize;

        if (min < 1) min = 1;
        if (max > this.lastPage) max = this.lastPage;

        for (let i = min; i <= max; i++) {
            let btn = this.getPageButton('li', i, i);

            let farNum = 0;

            if (i < this.currentPage)
                farNum = Math.abs(i - this.currentPage);

            if (i > this.currentPage)
                farNum = i - this.currentPage;

            if (i == this.currentPage)
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                });

            btn.classList.add('page-button-' + farNum);


            middleSection.append(btn);
        }
        middleSection.classList.add('middle-pagination-buttons');

        return middleSection;
    }

    getRightPaginationSection() {
        let lastButton = this.getPageButton('div', '>>', this.lastPage);
        let nextButton = this.getPageButton('div', '>', +this.currentPage + 1);

        if (+this.currentPage >= +this.lastPage) {
            lastButton.classList.add('disabled');
            nextButton.classList.add('disabled');
            lastButton.addEventListener('click', function (e) {
                e.preventDefault();
            });
            nextButton.addEventListener('click', function (e) {
                e.preventDefault();
            });
        }

        let rightSection = this.getSidePaginationButtons(nextButton, lastButton);
        rightSection.classList.add('right-pagination-buttons');
        return rightSection;
    }

    getSidePaginationButtons(...buttons) {
        let sideSection = document.createElement('div');
        sideSection.append(...buttons);
        sideSection.classList.add('side-pagination-buttons');

        return sideSection;
    }

    getPageButton(elemType, text, pageNum) {
        let pageBtn = document.createElement(elemType);
        pageBtn.classList.add('page-button');

        let link = document.createElement('a');
        link.innerHTML = text;

        let regex = /page=([0-9])*/;
        let href = document.location.href.toString();

        if (regex.exec(href))
            href = href.replace(/page=([0-9])*/, 'page=' + pageNum);
        else if (document.location.search == '')
            href += '?page=' + pageNum;
        else
            href += '&page=' + pageNum;

        link.href = href;

        pageBtn.append(link);

        return pageBtn;
    }

}

let paginationClass = new Pagination();

paginationClass.makePagination('pagination');



