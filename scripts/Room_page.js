function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

const name = getQueryParam('name');
const id = getQueryParam('id');



document.addEventListener('DOMContentLoaded', function() {
    var label = document.querySelector('.room_name');
    if (label)    
        label.innerHTML = name;
});