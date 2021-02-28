import {typeSort} from './index.js';
import {requestAndShowPage} from './requestAndShowPage.js';

export function clickAdd() {
    let t = {
        'action': 'add', 'user': document.getElementById('recipient-name').value,
        'mail': document.getElementById('recipient-mail').value,
        'task': document.getElementById('message-text').value,
        'sort': typeSort.sort
    };
    $('#ModalSupplemental').modal('hide');
    requestAndShowPage('add', t);
    document.getElementById('messageSuccessSupplemental').classList.remove('d-none');
    setTimeout(() => document.getElementById('messageSuccessSupplemental').classList.add('d-none'), 2000)
}