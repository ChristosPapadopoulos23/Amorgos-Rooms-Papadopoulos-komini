<?php
session_start();
session_create_id(true);

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'logs.php';
// require_once 'reCAPTCHA.php';
require_once 'db_connection.php';
require_once 'user_data_validation.php';

// Function to sanitize user input
function sanitizeInput($input) {
    global $conn;
    if(isset($conn)) {
        return $conn->real_escape_string($input);
    } else {
        return htmlspecialchars(trim($input));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $name = sanitizeInput($_POST['name']);
    $lastname = sanitizeInput($_POST['lastname']);
    $business_name = sanitizeInput($_POST['business_name']);
    $phone = sanitizeInput($_POST['phone']);
    //$business_mobile = sanitizeInput($_POST['business_mobile']); // Corrected variable name
    $email = sanitizeInput($_POST['email']);
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);
    $cpassword = sanitizeInput($_POST['cpassword']);
    $timestamp = date("Y-m-d H:i:s");
    $business_location = "Some Location";
    $status = "unapproved";

    if($password != $cpassword) {
        header("Location: ../sign-up.php?error=passwords_mismatch");
        exit();
    }

    // Validate form data
    $error = validateFormData($_POST);
    if (!empty($error)) {
        header("Location: ../sign-up.php?error=$error");
        exit();
    }
    
    // Check if username or email already exists
    $checkQuery = "SELECT * FROM UsersTable WHERE username=?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../sign-up.php?error=username_exists");
        exit();
    } 

    // Hash the password
    $options = [
        'cost' => 12,
    ];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    // Insert user data into UsersTable
    $sqlUserSignup = "INSERT INTO UsersTable (first_name, last_name, username, password, created_at, status_code)
                        VALUES (?, ?, ?, ?, ?, ?)";
    $stmtUserSignup = $conn->prepare($sqlUserSignup);
    $stmtUserSignup->bind_param("ssssss", $name, $lastname, $username, $hashedPassword, $timestamp, $status); // Corrected number of parameters

    if ($stmtUserSignup->execute() === TRUE) {
        $user_id = $stmtUserSignup->insert_id;
        $stmtUserSignup->close();

        // Insert business data into BusinessTable
        $sqlBusinessSignup = "INSERT INTO BusinessTable (business_name, business_phone, business_mobile, business_email, location, created_at, owner_id)
                                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtBusinessSignup = $conn->prepare($sqlBusinessSignup);
        $stmtBusinessSignup->bind_param("ssssssi", $business_name, $phone, $business_mobile, $email, $business_location, $timestamp, $user_id); // Corrected number of parameters

        if ($stmtBusinessSignup->execute() === TRUE) {
            header("Location: ../sign-up.php?success=true");
            exit();
        } else {
            header("Location: ../sign-up.php?error=database_error");
            exit();
        }
    }
}
$conn->close();
?>
