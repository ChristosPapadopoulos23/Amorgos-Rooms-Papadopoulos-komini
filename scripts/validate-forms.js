const loginform = document.getElementById('form');


console.log(loginform);

form.addEventListener('submit', e => {
    e.preventDefault();
    console.log('submit');
    
    if (form.id === 'signup-form') {
        validateSignUpInputs();
    } else {
        
        validateLoginInputs();
    }
});    
 

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success')
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

const validateSingUp = () => {
    const name = document.getElementById('name');
    const lastname = document.getElementById('lastname');
    const business_name = document.getElementById('business_name');
    const phone = document.getElementById('phone');
    const email = document.getElementById('email');
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const cpassword = document.getElementById('cpassword');


    const nameValue = name.value.trim();
    const lastnameValue = lastname.value.trim();
    const business_nameValue = business_name.value.trim();
    const phoneValue = phone.value.trim();
    const emailValue = email.value.trim();
    const usernameValue = username.value.trim();
    const passwordValue = password.value.trim();
    const cpasswordValue = cpassword.value.trim();

    if (nameValue === '') {
        setError(name, 'Name is required');
        document.getElementById('name').style.borderColor = 'red';
    } else {
        setSuccess(name);
    }

    if (lastnameValue === '') {
        setError(lastname, 'Lastname is required');
        document.getElementById('lastname').style.borderColor = 'red';
    } else {
        setSuccess(lastname);
    }

    if (business_nameValue === '') {
        setError(business_name, 'Business name is required');
        document.getElementById('business_name').style.borderColor = 'red';
    } else {
        setSuccess(business_name);
    }

    if (phoneValue === '') {
        setError(phone, 'Phone is required');
        document.getElementById('phone').style.borderColor = 'red';
    } else {
        setSuccess(phone);
    }

    if (emailValue === '') {
        setError(email, 'Email is required');
        document.getElementById('email').style.borderColor = 'red';
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Email is not valid');
        document.getElementById('email').style.borderColor = 'red';
    } else {
        setSuccess(email);
    }

    if (usernameValue === '') {
        setError(username, 'Username is required');
        document.getElementById('username').style.borderColor = 'red';
    } else {
        setSuccess(username);
    }

    if (passwordValue === '') {
        setError(password, 'Password is required');
        document.getElementById('password').style.borderColor = 'red';
    } else if (passwordValue.length < 8) {
        setError(password, 'Password must be at least 8 character.')
        document.getElementById('password').style.borderColor = 'red';
    } else {
        setSuccess(password);
    }

    if (cpasswordValue === '') {
        setError(cpassword, 'Confirm password is required');
        document.getElementById('cpassword').style.borderColor = 'red';
    } else if (cpasswordValue !== passwordValue) {
        setError(cpassword, 'Password does not match');
        document.getElementById('cpassword').style.borderColor = 'red';
    } else {
        setSuccess(cpassword);
    }

}

const validateLogIn = () => {

    const username = document.getElementById('username');
    const password = document.getElementById('password');

    const usernameValue = username.value.trim();
    const passwordValue = password.value.trim();

    if (usernameValue === '') {
        setError(username, 'Username is required');
        document.getElementById('username').style.borderColor = 'red';
    } else {
        setSuccess(username);
    }

    if (passwordValue === '') {
        setError(password, 'Password is required');
        document.getElementById('password').style.borderColor = 'red';
    } else if (passwordValue.length < 8) {
        setError(password, 'Password must be at least 8 character.')
        document.getElementById('password').style.borderColor = 'red';
    } else {
        setSuccess(password);
    }

};
