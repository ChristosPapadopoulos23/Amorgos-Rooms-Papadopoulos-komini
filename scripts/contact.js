
function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

const value = getQueryParam('value');

const Fieldname = document.getElementById('name');
const Fieldsname = document.getElementById('sname');
const Fieldadults = document.getElementById('adults');
const Fieldkids = document.getElementById('kids');
const Fieldarrival = document.getElementById('arrival');
const Fieldreturn = document.getElementById('return');
const Fieldroom_number = document.getElementById('room_number');
const Fieldphone = document.getElementById('phone');


Fieldname.addEventListener('input', function(event) {
    console.log('User is typing: ', event.target.value);
    if(event.target.value.length<2 && event.target.value.length>0){
        event.target.style.borderColor = 'red';
        event.target.style.borderStyle = 'solid';
        event.target.style.borderWidth = '1px';
    }
    else{
        event.target.style.borderColor = '';
        event.target.style.borderStyle = '';
        event.target.style.borderWidth = '';
    }
});


Fieldsname.addEventListener('input', function(event) {
    console.log('User is typing: ', event.target.value);
    if(event.target.value.length<2 && event.target.value.length>0){
        event.target.style.borderColor = 'red';
        event.target.style.borderStyle = 'solid';
        event.target.style.borderWidth = '1px';
    }
    else{
        event.target.style.borderColor = '';
        event.target.style.borderStyle = '';
        event.target.style.borderWidth = '';
    }
});


document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0]; 
    Fieldarrival.value=today
    Fieldarrival.min = today; 
    Fieldreturn.min = Fieldarrival.value;
    
});

Fieldarrival.addEventListener('input', function(event) {
    console.log('User is typing: ', event.target.value);
    if(Fieldarrival.value>Fieldreturn.value){
        Fieldreturn.value = "";
    }
});

Fieldreturn.addEventListener('click', function(event) {
    console.log('User is typing: ', event.target.value);
    Fieldreturn.min = Fieldarrival.value;
});

Fieldphone.addEventListener('input', function(event) {
    console.log('User is typing: ', event.target.value);
    if((event.target.value.length<10 || event.target.value.length>15) && event.target.value.length>0){
        event.target.style.borderColor = 'red';
        event.target.style.borderStyle = 'solid';
        event.target.style.borderWidth = '1px';
    }
    else{
        event.target.style.borderColor = '';
        event.target.style.borderStyle = '';
        event.target.style.borderWidth = '';
    }
});