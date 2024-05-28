<?php
session_start();
session_create_id();

require_once 'logs.php';
// require_once 'reCAPTCHA.php';
require_once 'db_connection.php';
require_once 'user_data_validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape and validate form data
    $name = $conn->real_escape_string($_POST['name']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $business_name = $conn->real_escape_string($_POST['business_name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $cpassword = $conn->real_escape_string($_POST['cpassword']);
    $timestamp = date("Y-m-d H:i:s");
    $business_location = "Some Location";
    // $salt = rad2deg(random_bytes(0));

    if($password!=$cpassword){
        header("Location: ../sign-up.html?error=passwords_mismatch");
        exit();
    }

    $options = [
        'cost' => 12,
    ];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);


    // Validate form data
    $error = validateFormData($formData);
    if ($error) {
        echo $error;
        exit();
    }
    
    // Check if username or email already exists
    $checkQuery = "SELECT * FROM UsersTable WHERE username='$username' LIMIT 1";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "Username or email already exists!";
        header("Location: ../sign-up.php");
        exit();
    } 

    // Insert user data into UsersTable
    $sqlUserSignup = "INSERT INTO UsersTable (first_name, last_name, username, password, created_at)
                        VALUES (?, ?, ?, ?, ?)";

    $stmtUserSignup = $conn->prepare($sqlUserSignup);

    $stmtUserSignup->bind_param("sssss", $name, $lastname, $username, $hashedPassword, $timestamp);

    if ($stmtUserSignup->execute() === TRUE) {
        echo "User signed up successfully!<br>";
    } else {
        echo "Error: " . $stmtUserSignup->error;
    }

    $user_id = mysqli_insert_id($conn);

    $stmtUserSignup->close();

    // Insert business data into BusinessTable
    $sqlBusinessSignup = "INSERT INTO BusinessTable (business_name, business_phone, business_email, location, owner_id, created_at)
                            VALUES (?, ?, ?, ?, ?, ?)";

    $stmtBusinessSignup = $conn->prepare($sqlBusinessSignup);

    $stmtBusinessSignup->bind_param("ssssis", $business_name, $phone, $email, $business_location, $user_id, $timestamp);

    if ($stmtBusinessSignup->execute() === TRUE) {
        header("Location: ../pop-up.html");
        exit();
    } else {
        echo "Error: " . $stmtBusinessSignup->error;
    }
    $stmtBusinessSignup->close();

    $checkResult->close();
}

// Close database connection
$conn->close();
