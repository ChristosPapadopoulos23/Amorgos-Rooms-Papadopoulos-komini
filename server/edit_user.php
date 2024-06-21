<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connection.php';
require_once 'user_data_validation.php';

function sanitizeInput($input) {
    global $conn;
    if(isset($conn)) {
        return $conn->real_escape_string($input);
    } else {
        return htmlspecialchars(trim($input));
    }
}
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
if (!isset($_SESSION['role']) || (($_SESSION['role'] != 'admin') && ($_SESSION['id'] != $id))) { 
    header("Location: ./sign-up.php");  // Feature is not implemented yet
    exit(0);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitizeInput($_POST['name']);
    $lastname = sanitizeInput($_POST['lastname']);
    $phone = sanitizeInput($_POST['phone']);
    $email = sanitizeInput($_POST['email']);

    $sql = "UPDATE UsersTable
    SET first_name = '$name',
        last_name = '$lastname',
        phone = '$phone',
        email = '$email'
    WHERE id = '$id'";
    if (isset($sql)) {
        if ($conn->query($sql) === TRUE) {
            echo "Record edit success";
            header("Location: ../control-panel.php?error=success_edit");
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    header("Location: ../sign-up.php");
    exit();
}
?>
