function validateSignUp() {
    const password = document.getElementById('password').value;
    const cpassword = document.getElementById('cpassword').value;
    const passwordError = document.getElementById('password-error');
    const passwordInput = document.getElementById('password');
    const cpasswordInput = document.getElementById('cpassword');
    const number = document.getElementById('phone');
    numberValue = document.getElementById('phone').value.trim();

    if (!/^\d+$/.test(numberValue)) {
        number.style.border = "1px solid red";
        number.value = ""; 
        number.placeholder = "Only numbers are allowed";
        return false;
    }

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

function openSuccesSigUp() {
    document.getElementById('succes-sign-up').style.visibility = 'visible';
    document.getElementById('succes-sign-up').style.opacity = '100';
}

function openUserExists() {
    document.getElementById('user-exists').style.visibility = 'visible';
    document.getElementById('user-exists').style.opacity = '100';
}

function openWrongData() {
    document.getElementById('wrong-data').style.visibility = 'visible';
    document.getElementById('wrong-data').style.opacity = '100';
}

function openNotAccepted() {
    document.getElementById('Not-accepted').style.visibility = 'visible';
    document.getElementById('Not-accepted').style.opacity = '100';
}

function closePopup() {
    console.log('closePopup');
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.delete('success');
    urlParams.delete('error');
    const newUrl = window.location.pathname + '?' + urlParams.toString();
    window.history.replaceState({}, '', newUrl);
    document.getElementById('succes-sign-up').style.visibility = 'hidden';
    document.getElementById('succes-sign-up').style.opacity = '0';
    document.getElementById('user-exists').style.visibility = 'hidden';
    document.getElementById('user-exists').style.opacity = '0';
    document.getElementById('wrong-data').style.visibility = 'hidden';
    document.getElementById('wrong-data').style.opacity = '0';
    document.getElementById('password-mismatch').style.visibility = 'hidden';
    document.getElementById('password-mismatch').style.opacity = '0';
}

document.querySelectorAll('.close').forEach(closeAnchor => {
    closeAnchor.addEventListener('click', closePopup);
});

function getQueryParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

window.onload = function() {
    const success = getQueryParam('success');
    const error = getQueryParam('error');

    if (success === "true") {
        openSuccesSigUp();
    }
    if (error === "username_exists") {
        openUserExists();
    }
    if (error === "passwords_mismatch") {
        openPassMismatch();
    }
    if (error === "invalid_credentials") {
        openWrongData();
    }
    if (error === "user_not_accepted") {
        openNotAccepted();
    }
};
