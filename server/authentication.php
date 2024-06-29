<?php
// Include the file containing the database connection
require_once 'db_connection.php';

// Function to authenticate a user based on the provided username and password
function authenticateUser($username, $password) {
    global $conn;

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    $sql = "SELECT * FROM UsersTable WHERE username='$username'";
    $result = $conn->query($sql);   
    

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (isset($row['PASSWORD'])) {
            if (password_verify($password, $row['PASSWORD'])) {
                return true;
            } else {
                return false; // Incorrect password
            }
        } else {
            return false; // Password column not found
        }
    } else {
        return false; // User not found
    }
}


