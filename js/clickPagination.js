import {typeSort} from './index.js';
import {requestAndShowPage} from './requestAndShowPage.js';

export function clickPagination(e) {
    let page = +document.getElementById('paginationCurrent').textContent.split('/')[0];
    page = (e.target.id === 'paginationBack') ? --page : ++page;
    requestAndShowPage('get', {'page': page, 'sort': typeSort.sort});
}