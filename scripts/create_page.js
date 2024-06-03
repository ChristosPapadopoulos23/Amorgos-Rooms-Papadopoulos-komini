
const Fieldname = document.getElementById('name');
const Fieldcomments = document.getElementById('comments');
const Fieldcommentslabel = document.getElementById('desc');
const Fieldemail = document.getElementById('email');
const Fieldphone = document.getElementById('phone');
const Fieldmobile = document.getElementById('mobile');
var commentLabel = Fieldcommentslabel.textContent;

Fieldphone.addEventListener('input', function(event) {
    if (!/^\d+$/.test(event.target.value) || event.target.value.length!=10) {
        Fieldphone.style.border = "1px solid red";
        return false;
    }
    else{
        event.target.style.borderColor = '';
        event.target.style.borderStyle = '';
        event.target.style.borderWidth = '';
    }
});

Fieldmobile.addEventListener('input', function(event) {
    if (!/^\d+$/.test(event.target.value)|| event.target.value.length!=10) {
        Fieldmobile.style.border = "1px solid red";
        return false;
    }
    else{
        event.target.style.borderColor = '';
        event.target.style.borderStyle = '';
        event.target.style.borderWidth = '';
    }
});

Fieldcomments.addEventListener('input', function(event) {
    if(Fieldcomments.value.length>0)
        Fieldcommentslabel.textContent = commentLabel + " | " + Fieldcomments.value.length;
    else
        Fieldcommentslabel.textContent = commentLabel;
    
    if ( event.target.value.length<100 && event.target.value.length>0) {
        Fieldcomments.style.border = "1px solid red";
        return false;
    }
    else{
        event.target.style.borderColor = '';
        event.target.style.borderStyle = '';
        event.target.style.borderWidth = '';
    }
});


function validateForm() {
    var temp=0;
    if (!/^\d+$/.test(Fieldphone.value) || Fieldphone.value.length!=10) {
        Fieldphone.style.border = "1px solid red";
        Fieldphone.value = ""; 
        Fieldphone.placeholder = "Only numbers are allowed";
        temp=1;
    }
    if (!/^\d+$/.test(Fieldmobile.value)|| Fieldmobile.value.length!=10) {
        Fieldmobile.style.border = "1px solid red";
        Fieldmobile.value = ""; 
        Fieldmobile.placeholder = "Only numbers are allowed";
        temp=1;
    }
    if(Fieldcomments.value.length<100 && Fieldcomments.value.length>0){
        Fieldcomments.style.border = "1px solid red";
        Fieldcomments.value = ""; 
        Fieldcomments.placeholder = "Εάν επιθυμείτε να χρησιμοποιήσετε περιγραφή, τότε πρέπει να είναι τουλάχιστον 100 χαρακτήρες.";
        temp=1;
    }
    if(temp==1){
        return false;
    }



}


