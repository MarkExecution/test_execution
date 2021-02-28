import {setElementVisibility} from './setElementVisibility.js';

export function parameterDisplay(quantity, page, sorting) {
    setElementVisibility('iconExit', true);
    setElementVisibility('messageOffice', true);
    setElementVisibility('iconAuthorization', false);
    const arrSorting = ['по имени пользователя по возрастанию', 'по имени пользователя по убыванию',
        'по e-mail по возрастанию', 'по e-mail по убыванию', 'по статусу: исправленные->без статуса ->выполненые'];
    document.getElementById('sortingTypeDemo').innerText = arrSorting[sorting % 5];
    if (page === 1) {
        if (!document.getElementById('paginationBack').classList.contains("d-none")) {
            document.getElementById('paginationBack').classList.add("d-none")
        }
    } else {
        if (document.getElementById('paginationBack').classList.contains("d-none")) {
            document.getElementById('paginationBack').classList.remove("d-none")
        }
    }
    document.getElementById('paginationCurrent').textContent = page + ' / ' + quantity;
    if (quantity === page) {
        if (!document.getElementById('paginationNext').classList.contains("d-none")) {
            document.getElementById('paginationNext').classList.add("d-none")
        }
    } else {
        if (document.getElementById('paginationNext').classList.contains("d-none")) {
            document.getElementById('paginationNext').classList.remove("d-none")
        }
    }
}