
const Fieldname_l = document.getElementById('name_l');
const Fieldemail_l = document.getElementById('email_l');
const Fieldphone_l = document.getElementById('phone_l');
const Fieldmobile_l = document.getElementById('mobile_l');
const Fieldarea_l = document.getElementById('area_l');
const Fieldlink = document.getElementById('link');
const FieldlinkConfirm = document.getElementById('link_confirmation');
const FieldUrl = document.getElementById('url');
const Fieldlbl = document.getElementById('url_lbl');
const FieldCreate = document.getElementById('create');


flag=0;
Fieldlbl.addEventListener('click',function(event){
    console.log('User is typing: ', event.target.value);
    if(flag==0){
        FieldUrl.style.transform = 'translateY(-720px)';
        flag=1;
    }
    else{
        FieldUrl.style.transform = 'translateY(-70px)'; 
        flag=0;
    }

});

FieldCreate.addEventListener('click',function(event){
    console.log('User is typing: ', event.target.value);
    if(flag==1){
        FieldUrl.style.transform = 'translateY(-70px)'; 
        flag=0;
    }

});

Fieldphone_l.addEventListener('input', function(event) {
    if (!/^\d+$/.test(event.target.value) || event.target.value.length!=10) {
        Fieldphone_l.style.border = "1px solid red";
        return false;
    }
    else{
        event.target.style.borderColor = '';
        event.target.style.borderStyle = '';
        event.target.style.borderWidth = '';
    }
});

Fieldmobile_l.addEventListener('input', function(event) {
    if (!/^\d+$/.test(event.target.value)|| event.target.value.length!=10) {
        Fieldmobile_l.style.border = "1px solid red";
        return false;
    }
    else{
        event.target.style.borderColor = '';
        event.target.style.borderStyle = '';
        event.target.style.borderWidth = '';
    }
});


function validateLogin() {
    var temp=0;
    if (!/^\d+$/.test(Fieldphone_l.value) || Fieldphone_l.value.length!=10) {
        Fieldphone_l.style.border = "1px solid red";
        Fieldphone_l.value = ""; 
        Fieldphone_l.placeholder = "Only numbers are allowed";
        temp=1;
    }
    if (!/^\d+$/.test(Fieldmobile_l.value)|| Fieldmobile_l.value.length!=10) {
        Fieldmobile_l.style.border = "1px solid red";
        Fieldmobile_l.value = ""; 
        Fieldmobile_l.placeholder = "Only numbers are allowed";
        temp=1;
    }
    if(Fieldlink<=0){
        Fieldlink.style.border = "1px solid red";
        Fieldlink.value = ""; 
        Fieldlink.placeholder = "Παρκαλώ δώστε έναν σύνδεσμο";
        temp=1;
    }
    if(FieldlinkConfirm.value!="yes"){
        FieldlinkConfirm.style.border = "1px solid red";
        temp=1;
    }
    
    if(Fieldarea_l.value=='0'){
        Fieldarea_l.style.border = "1px solid red";
        temp=1;
    }
    if(temp==1){
        return false;
    }



}


