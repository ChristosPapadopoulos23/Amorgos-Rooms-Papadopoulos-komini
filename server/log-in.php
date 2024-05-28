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
        echo json_encode(['success' => false, 'error' => 'Please fill in all fields']);
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

            // Set success and redirect based on location
            if ($row_business && $row_business['location'] != "Some Location") {
                header("Location: ../create-page.php");
                exit();
            } else {
                header("Location: ../index.html");
                exit();
            }

        } else {
            echo json_encode(['success' => false, 'error' => 'User not found']);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
        exit();
    }
    $conn->close();
}
?>
