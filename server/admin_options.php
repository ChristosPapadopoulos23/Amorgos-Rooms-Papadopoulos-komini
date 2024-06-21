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
        $sql = "DELETE FROM userstable WHERE id=$uid";
    } else if ($action == 1) {
        $sql = "DELETE FROM userstable WHERE id=$uid";
    } else if ($action == 0) {
        $sql = "UPDATE userstable SET status_code = 'approved' WHERE id = $uid";
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
