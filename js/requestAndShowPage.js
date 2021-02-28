import {showPage}  from './showPage.js';
import {requestTask}  from './requestTask.js';

export async function requestAndShowPage(action, options) {
    options.action = action;
    const tasks = await requestTask(options);
    if (tasks.error !== '') {
        $("#ModalAuthorization").modal('show');
    } else {
        showPage(tasks);
    }
}