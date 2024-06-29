<?php
session_start();
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin')) { 
    header("Location: ./sign-up.php");  // Feature is not implemented yet
    exit();
}
require_once 'logs.php';
require_once 'db_connection.php';

$action = isset($_GET['action']) ? (int)$_GET['action'] : null;
$uid = isset($_GET['id']) ? (int)$_GET['id'] : null;

echo "$uid";
echo " $action";

if ($uid !== null && $action !== null) {
    if ($action == 2) {
        $sql = "DELETE FROM UsersTable WHERE id=$uid";
    } else if ($action == 1) {
        $sql = "DELETE FROM UsersTable WHERE id=$uid";
    } else if ($action == 0) {
        $sql = "UPDATE UsersTable SET status_code = 'approved' WHERE id = $uid";
    } else if ($action == 3) {
        // works like a switch if is a user it makes it admin and vice versa
        // make a query to get the role of the user
        $sql = "SELECT role FROM UsersTable WHERE id = $uid";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if ($row['role'] == 'admin') {
            $sql = "UPDATE UsersTable SET role = 'user' WHERE id = $uid";
        } else {
            $sql = "UPDATE UsersTable SET role = 'admin' WHERE id = $uid";
        }
    } else if ($action == 4) {
        $sql = "UPDATE UsersTable SET role = user WHERE id = $uid";
    } else {
        echo "Invalid action.";
    }
    header("Location: ../admin_panel.php"); 

    // Execute the query
    if (isset($sql)) {
        if ($conn->query($sql) === TRUE) {
            echo "Record updated/deleted successfully";
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "Invalid parameters.";
}

?>
