function validateSignUp() {
    const password = document.getElementById('password').value;
    const cpassword = document.getElementById('cpassword').value;
    const username = document.getElementById('username').value;
    const passwordInput = document.getElementById('password');
    const cpasswordInput = document.getElementById('cpassword');
    const usernameInput = document.getElementById('username');
    const passwordError = document.getElementById('password-error');

    // Check if passwords match
    if (password !== cpassword) {
        passwordError.textContent = "Passwords do not match!";
        passwordInput.classList.add('error');
        cpasswordInput.classList.add('error');
        return false; // Prevent form submission
    } else {
        passwordError.textContent = "";
        passwordInput.classList.remove('error');
        cpasswordInput.classList.remove('error');
    }

    // If passwords match, proceed with form submission
    const formData = new FormData(document.getElementById('signup-form'));
    const xhr = new XMLHttpRequest();
    xhr.open('POST', './server/sign-up.php', true);
    xhr.onload = function () {
        const response = JSON.parse(this.responseText);
        if (response.success) {
            window.location.href = response.redirect;
        } else {
            document.getElementById('signup-message').textContent = response.error;
            if (response.error === 'User not found' || response.error === 'Invalid credentials') {
                usernameInput.classList.add('error');
                passwordInput.classList.add('error');
                usernameInput.addEventListener('input', function () {
                    usernameInput.classList.remove('error');
                    passwordInput.classList.remove('error');
                });
                passwordInput.addEventListener('input', function () {
                    usernameInput.classList.remove('error');
                    passwordInput.classList.remove('error');
                });
            }
        }
    };
    xhr.send(formData);
    return false; // Prevent form submission
}



function validateLogIn() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const loginError = document.getElementById('login-error');
    const loginForm = document.getElementById('login-form');

    if (username === '' || password === '') {
        loginError.textContent = "Please enter both username and password.";
        return false; // Prevent form submission
    }

    const formData = new FormData(loginForm);

    fetch('./server/log-in.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success === flase) {

                const usernameInput = document.getElementById('username');
                const passwordInput = document.getElementById('password');
                usernameInput.classList.add('error');
                passwordInput.classList.add('error');

            }
        })
        .catch(error => {
            console.error('Login request failed:', error);
            loginError.textContent = 'An error occurred while logging in.';
        });

    return false; // Prevent form submission
}


function openPopup() {
    document.getElementById('popup1').style.visibility = 'visible';
    document.getElementById('popup1').style.opacity = '100';
}
