'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Pagination = function () {
    function Pagination() {
        _classCallCheck(this, Pagination);

        this.paginationBlock;
        this.currentPage;
        this.lastPage;
        this.middleSectionSize = 3;
    }

    _createClass(Pagination, [{
        key: 'getPage',
        value: function getPage() {
            var regexp = /page=([^&]+)/i;

            if (!!regexp.exec(document.location.search)) return regexp.exec(document.location.search)[1];else return 1;
        }
    }, {
        key: 'makePagination',
        value: function makePagination(elemId) {
            this.paginationBlock = document.getElementById(elemId);

            if (this.paginationBlock == undefined) {
                return false;
            }

            this.currentPage = this.getPage();
            this.lastPage = this.paginationBlock.dataset.lastPage;

            console.log(this.currentPage, this.lastPage);

            this.paginationBlock.append(this.getPagination());
        }
    }, {
        key: 'getPagination',
        value: function getPagination() {
            var leftPaginationSection = this.getLeftPaginationSection();
            var middlePaginationSection = this.getMiddlePaginationSection();
            var rightPaginationSection = this.getRightPaginationSection();

            var pagination = document.createElement('div');
            pagination.append(leftPaginationSection, middlePaginationSection, rightPaginationSection);
            pagination.classList.add('pagination');
            return pagination;
        }
    }, {
        key: 'getLeftPaginationSection',
        value: function getLeftPaginationSection() {
            var firstButton = this.getPageButton('div', '<<', 1);
            var prevButton = this.getPageButton('div', '<', this.currentPage - 1);

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

            var leftSection = this.getSidePaginationButtons(firstButton, prevButton);
            leftSection.classList.add('left-pagination-buttons');
            return leftSection;
        }
    }, {
        key: 'getMiddlePaginationSection',
        value: function getMiddlePaginationSection() {
            var middleSection = document.createElement('ul');

            var min = this.currentPage - this.middleSectionSize;
            var max = +this.currentPage + this.middleSectionSize;

            if (min < 1) min = 1;
            if (max > this.lastPage) max = this.lastPage;

            for (var i = min; i <= max; i++) {
                var btn = this.getPageButton('li', i, i);

                var farNum = 0;

                if (i < this.currentPage) farNum = Math.abs(i - this.currentPage);

                if (i > this.currentPage) farNum = i - this.currentPage;

                if (i == this.currentPage) btn.addEventListener('click', function (e) {
                    e.preventDefault();
                });

                btn.classList.add('page-button-' + farNum);

                middleSection.append(btn);
            }
            middleSection.classList.add('middle-pagination-buttons');

            return middleSection;
        }
    }, {
        key: 'getRightPaginationSection',
        value: function getRightPaginationSection() {
            var lastButton = this.getPageButton('div', '>>', this.lastPage);
            var nextButton = this.getPageButton('div', '>', +this.currentPage + 1);

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

            var rightSection = this.getSidePaginationButtons(nextButton, lastButton);
            rightSection.classList.add('right-pagination-buttons');
            return rightSection;
        }
    }, {
        key: 'getSidePaginationButtons',
        value: function getSidePaginationButtons() {
            var sideSection = document.createElement('div');
            sideSection.append.apply(sideSection, arguments);
            sideSection.classList.add('side-pagination-buttons');

            return sideSection;
        }
    }, {
        key: 'getPageButton',
        value: function getPageButton(elemType, text, pageNum) {
            var pageBtn = document.createElement(elemType);
            pageBtn.classList.add('page-button');

            var link = document.createElement('a');
            link.innerHTML = text;

            var regex = /page=([0-9])*/;
            var href = document.location.href.toString();

            if (regex.exec(href)) href = href.replace(/page=([0-9])*/, 'page=' + pageNum);else if (document.location.search == '') href += '?page=' + pageNum;else href += '&page=' + pageNum;

            link.href = href;

            pageBtn.appendChild(link);

            return pageBtn;
        }
    }]);

    return Pagination;
}();

var paginationClass = new Pagination();

paginationClass.makePagination('pagination');
