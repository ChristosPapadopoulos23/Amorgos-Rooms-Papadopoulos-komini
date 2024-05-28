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

function openPopup() {
    document.getElementById('popup1').style.visibility = 'visible';
    document.getElementById('popup1').style.opacity = '100';
}



document.getElementById('singup-form').addEventListener('submit', function(event) {
    event.preventDefault(); 

    const formData = new FormData(this);

    fetch('./server/sing-up.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            document.getElementById('loginMessage').innerHTML = 'Login successful!';
            openPopup();
        } else {
            document.getElementById('loginMessage').innerHTML = 'Login failed. Please try again.';
            
        }
    })
    .catch(error => {
        console.error('Fetch request failed:', error);
        document.getElementById('loginMessage').innerHTML = 'An unexpected error occurred. Please try again later.';
    });
});