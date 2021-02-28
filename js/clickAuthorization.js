import {requestAndShowPage} from './requestAndShowPage.js';

export async function clickAuthorization() {
    const login = document.getElementById('recipient-login').value;
    const passw = document.getElementById('recipient-password').value;
    $('#ModalAuthorization').modal('hide');
    let promise = new Promise((resolve) => {
        setTimeout(() => resolve("готово!"), 1000)
    });
    await promise;
    await requestAndShowPage('login', {'login': login, 'passw': passw});
}