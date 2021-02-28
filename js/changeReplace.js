import {typeSort} from './index.js';
import {requestAndShowPage} from './requestAndShowPage.js';

export function changeReplace(e) {
    let task = e.target.value;
    const elem = e.target.parentElement.parentElement;
    const number = elem.dataset.key;
    const page = +document.getElementById('paginationCurrent').textContent.split('/')[0];
    let t = {
        'page': page,
        'number': number,
        'status': 'changeStatus',
        'task': task,
        'sort': typeSort.sort,
        'token': localStorage.getItem('token')
    };
    requestAndShowPage('status', t);
}
