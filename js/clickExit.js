import {requestAndShowPage} from './requestAndShowPage.js';

export function clickExit() {
    const token = localStorage.getItem('token');
    localStorage.removeItem('token');
    requestAndShowPage('out', {'token': token});
}