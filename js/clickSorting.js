import {requestAndShowPage} from './requestAndShowPage.js';

export function clickSorting(e) {
    $('#ModalSorting').modal('hide');
    requestAndShowPage('sort', {'sort': e.target.id.substring(7)});
}