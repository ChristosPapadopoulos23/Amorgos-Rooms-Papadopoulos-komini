<?php
session_start();

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../index.html");
    die();
}

// Include necessary files
require_once 'config.php';
require_once 'db_connection.php';
require_once 'authentication.php';

// Function to sanitize user input
function sanitizeInput($input) {
    global $conn;
    return isset($conn) ? $conn->real_escape_string($input) : htmlspecialchars(trim($input));
}

// Sanitize input data
$username = sanitizeInput($_POST['username']);
$password = sanitizeInput($_POST['password']);

// Validate input (e.g., check if fields are not empty)
if (empty($username) || empty($password)) {
    $_SESSION["error_login"] = "Please fill in all fields.";
    header("Location: ../sign-up.html");
    die();
}

// Authenticate user
if (authenticateUser($username, $password)) {
    // Get user details from UsersTable
    $sql = "SELECT * FROM UsersTable WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // If user exists
    if ($user) {
        // Set session variables
        $_SESSION['username'] = $user['username'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['created_at'] = $user['created_at'];

        // Check if the user has a specific location
        $id = $_SESSION['id'];
        $sql_business = "SELECT * FROM BusinessTable WHERE owner_id = ?";
        $stmt_business = $conn->prepare($sql_business);
        $stmt_business->bind_param("i", $id);
        $stmt_business->execute();
        $result_business = $stmt_business->get_result();
        $row_business = $result_business->fetch_assoc();
        $stmt_business->close();

        // Redirect based on location
        if ($row_business && $row_business['location'] != "Some Location") {
            header("Location: ../create-page.php");
        } else {
            $_SESSION["error_login"] = "You are not approved. Try again leiter.";
            header("Location: ../index.html");
        }
        exit();
    } else {
        $_SESSION["error_login"] = "User not found.";
        header("Location: ../login.html");
        die();
    }
} else {
    $_SESSION["error_login"] = "Invalid credentials.";
    header("Location: ../sign-up.html");
    die();
}

$conn->close();
?>
