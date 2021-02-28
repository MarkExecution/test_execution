import {typeSort} from './index.js';
import {parameterDisplay} from './parameterDisplay.js';
import {clickSorting} from './clickSorting.js';
import {clickAdd} from './clickAdd.js';
import {clickPagination} from './clickPagination.js';
import {clickStatus} from './clickStatus.js';
import {clickAuthorization} from './clickAuthorization.js';
import {clickExit} from './clickExit.js';
import {changeReplace} from './changeReplace.js';

export function showPage(tasks) {
    if ('token' in tasks) {
        localStorage.setItem('token', tasks.token);
    }
    while (document.getElementById('mainTable').firstChild) {
        document.getElementById('mainTable').removeChild(document.getElementById('mainTable').firstChild);
    }
    typeSort.sort = tasks.sort;
    parameterDisplay(tasks.quantity, tasks.page, typeSort.sort);
    if (tasks.list !== undefined) {
        tasks.list.forEach(item => {
            document.getElementById('mainTable').insertAdjacentHTML('beforeend',
                `<tr data-key="${item.id}" class="${item.status}" >
                    <td>${item.user}</td>
                    <td>${item.mail}</td>
                    <td>${(localStorage.getItem('token') === null) ?
                    item.task :
                    '<textarea class="form-control" rows="5">' + item.task + '</textarea>'}
                    </td>
                    </tr>`);
            if (localStorage.getItem('token') !== null) {
                const elem = document.getElementById('mainTable').lastElementChild;
                elem.children[0].addEventListener("click", clickStatus);
                elem.children[1].addEventListener("click", clickStatus);
                elem.children[2].addEventListener("change", changeReplace);
            }
        })
    }

    document.querySelector('#supplemental').addEventListener("submit", clickAdd);
    document.querySelectorAll('#ModalSorting button').forEach(item => item.addEventListener("click", clickSorting));
    document.querySelector('#authorization').addEventListener("submit", clickAuthorization);
    document.getElementById('paginationBack').addEventListener("click", clickPagination);
    document.getElementById('paginationNext').addEventListener("click", clickPagination);
    document.getElementById('iconExit').addEventListener("click", clickExit);
}