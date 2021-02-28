export async function requestTask(options) {
    const url = window.location.href.slice(0, window.location.href.indexOf('?')) + '/index.php';
    let response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(options)
    });
    if (response.ok) {
        return await response.json();
    }
    alert("Ошибка HTTP: " + response.status);
}