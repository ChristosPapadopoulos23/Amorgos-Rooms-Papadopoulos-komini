function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

const name = getQueryParam('name');
const id = getQueryParam('id');


var label = document.querySelector('.room_name');

fetch('./Room_Page.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Fetch request failed:', error);
        isFetching = false;
    });

