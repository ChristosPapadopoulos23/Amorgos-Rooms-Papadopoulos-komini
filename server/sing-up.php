<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.html");
    die();
}

require_once 'config.php';
require_once 'user_data_validation.php';

function sanitizeInput($input) {
    global $conn;
    return isset($conn) ? $conn->real_escape_string($input) : htmlspecialchars(trim($input));
}

function create_user($name, $lastname, $username, $hashedPassword, $timestamp) {
    global $conn;
    $sqlUserSignup = "INSERT INTO UsersTable (first_name, last_name, username, password, created_at)
                      VALUES (?, ?, ?, ?, ?)";
    $stmtUserSignup = $conn->prepare($sqlUserSignup);
    $stmtUserSignup->bind_param("sssss", $name, $lastname, $username, $hashedPassword, $timestamp);

    if ($stmtUserSignup->execute() === TRUE) {
        $user_id = $stmtUserSignup->insert_id;
        $stmtUserSignup->close();
        return $user_id;
    } else {
        error_log("Database error: " . $stmtUserSignup->error);
        return false;
    }
}

function create_business($business_name, $phone, $email, $business_location, $user_id, $timestamp) {
    global $conn;
    $sqlBusinessSignup = "INSERT INTO BusinessTable (business_name, business_phone, business_email, location, owner_id, created_at)
                          VALUES (?, ?, ?, ?, ?, ?)";
    $stmtBusinessSignup = $conn->prepare($sqlBusinessSignup);
    $stmtBusinessSignup->bind_param("ssssis", $business_name, $phone, $email, $business_location, $user_id, $timestamp);

    if ($stmtBusinessSignup->execute() === TRUE) {
        return true;
    } else {
        error_log("Database error: " . $stmtBusinessSignup->error);
        return false;
    }
}

// Sanitize and validate form data
$name = sanitizeInput($_POST['name']);
$lastname = sanitizeInput($_POST['lastname']);
$business_name = sanitizeInput($_POST['business_name']);
$phone = sanitizeInput($_POST['phone']);
$email = sanitizeInput($_POST['email']);
$username = sanitizeInput($_POST['username']);
$password = sanitizeInput($_POST['password']);
$cpassword = sanitizeInput($_POST['cpassword']);
$timestamp = date("Y-m-d H:i:s");
$business_location = "Some Location";

try {
    $errors = [];

    if (is_input_empty($name, $lastname, $business_name, $phone, $email, $username, $password, $cpassword)) {
        $errors["empty_fields"] = "All fields are required!";
    }
    if (is_email_invalid($email)) {
        $errors["invalid_email"] = "Invalid email address!";
    }
    if (is_username_taken($username)) {
        $errors["username_taken"] = "Username already exists!";
    }
    if ($password != $cpassword) {
        $errors["password_mismatch"] = "Passwords do not match!";
    }

    if ($errors) {
        $_SESSION["errors_signup"] = $errors;

        $signupData = [
            'name' => $name,
            'lastname' => $lastname,
            'business_name' => $business_name,
            'phone' => $phone,
            'email' => $email,
            'username' => $username
        ];

        $_SESSION["signup_data"] = $signupData;

        header("Location: ../sign-up.html");
        die();
    }

    $options = ['cost' => 12];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    $user_id = create_user($name, $lastname, $username, $hashedPassword, $timestamp);

    if ($user_id) {
        $status = create_business($business_name, $phone, $email, $business_location, $user_id, $timestamp);
        if ($status) {
            $_SESSION["success"] = "Account created successfully!";
        } else {
            $_SESSION["error"] = "Failed to create account!";
        }
    } else {
        $_SESSION["error"] = "Failed to create account!";
    }

    header("Location: ../index.html?signup=success");
    $conn->close();

} catch (Exception $e) {
    die('Query failed: ' . $e->getMessage());
}

?>
