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
    $.ajax({
        url: '..\Room_Page.php',
        dataType: 'json',
        success: function(data) {

            console.log(data); 
            var name = data.name;
            var phone = data.phone;
            var email = data.email;
            var location = data.location;
            var description = data.description;
            
        },
        error: function(xhr, status, error) {

            console.error(error);
        }
    });
});
/*
document.querySelector('.room_name').textContent = response.name;
document.getElementById('phone').textContent = response.phone;
document.getElementById('email').textContent = response.email;
document.getElementById('location').textContent = response.location;
document.getElementById('description').textContent = response.description;
console.log(response.name);*/