import {typeSort} from './index.js';
import {requestAndShowPage} from './requestAndShowPage.js';

export function clickStatus(e) {
    const elem = e.target.parentElement;
    let status = elem.className;
    status = (status === 'mainStatus') ? 'perfectionStatus' : 'mainStatus';
    requestAndShowPage('status', {
        'page': +document.getElementById('paginationCurrent').textContent.split('/')[0],
        'number': elem.dataset.key,
        'status': status,
        'sort': typeSort.sort,
        'token': localStorage.getItem('token')
    });
}