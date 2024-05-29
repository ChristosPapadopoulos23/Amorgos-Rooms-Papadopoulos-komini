<?php
session_start();
session_create_id(true);

// Include necessary files  
require_once 'db_connection.php';
require_once 'authentication.php';

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
    // Sanitize input data
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    // Validate input (e.g., check if fields are not empty)
    if (empty($username) || empty($password)) {
        header("Location: ../sign-up.html?error=empty_fields");
        exit();
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
            if ($row_business && $row_business['location'] != "Some Location" && $row_business['location'] != "rejected") {
                header("Location: ../create_page.html");
                exit();
            } else {
                header("Location: ../sign-up.html?error=user_not_accepted"); //custom page incoming
                exit();
            }
        } else {
            header("Location: ../sign-up.html?error=user_not_found");
            exit();
        }
    } else {
        header("Location: ../sign-up.html?error=invalid_credentials");
        exit();
    }
    $conn->close();
}
?>
