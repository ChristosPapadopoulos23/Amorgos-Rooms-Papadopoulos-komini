function validateSignUp() {
    const password = document.getElementById('password').value;
    const cpassword = document.getElementById('cpassword').value;
    const passwordError = document.getElementById('password-error');
    const passwordInput = document.getElementById('password');
    const cpasswordInput = document.getElementById('cpassword');

    if (password !== cpassword) {
        
        passwordError.textContent = "";
        passwordInput.style.border = "1px solid red";
        passwordInput.fontSize = ".5rem";
        passwordInput.value = "";
        passwordInput.placeholder = "Passwords do not match!";
        cpasswordInput.style.border = "1px solid red";
        cpasswordInput.value = "";
        cpasswordInput.placeholder = "Passwords don't match!";
        return false; // Prevent form submission
    } else {
        passwordError.textContent = ""; // Clear error message if passwords match
        return true; // Allow form submission
    }
}

function validateLogIn() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const loginError = document.getElementById('login-error');
    const loginForm = document.getElementById('login-form');

    if (username === '' || password === '') {
        loginError.textContent = "Please enter both username and password.";
        return false; // Prevent form submission
    } else {
        loginError.textContent = ""; // Clear error message
        return true; // Allow form submission
    }

}

function openPopup1() {
    document.getElementById('popup1').style.visibility = 'visible';
    document.getElementById('popup1').style.opacity = '100';
}

function openPopup2() {
    document.getElementById('popup2').style.visibility = 'visible';
    document.getElementById('popup2').style.opacity = '100';
}
const closeAnchor = document.querySelector('.close');
closeAnchor.addEventListener('click', closePopup);

function closePopup() {
    document.getElementById('popup1').style.visibility = 'hidden';
    document.getElementById('popup1').style.opacity = '0';
    document.getElementById('popup2').style.visibility = 'hidden';
    document.getElementById('popup2').style.opacity = '0';
}


function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}
const success = getQueryParam('success');
const error = getQueryParam('error');

window.onload = function() {
    if (success === "true") {
        document.getElementById('loginMessage').innerHTML = 'Sign up successful!';
        openPopup1();
    } else if (success === "false") {
        document.getElementById('loginMessage').innerHTML = 'Sign up failed. Please try again.';
        openPopup2();
    }
    console.log(success);
};
    
