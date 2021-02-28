export function setElementVisibility(id, sign) {
    let lk = localStorage.getItem('token') !== null;
    let presence = document.getElementById(id).classList.contains("d-none");
    if (((lk === sign) && presence) || ((lk !== sign) && !presence)) document.getElementById(id).classList.toggle("d-none");
}