<?php
session_start();
if (!isset($_SESSION['role'])) { 
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
    if ($action == 0) {
        $sql = "DELETE FROM userstable WHERE id=$uid";
    }

    // Execute the query
    if (isset($sql)) {
        if ($conn->query($sql) === TRUE) {
            echo "Record updated/deleted successfully";
            header("Location: ./sign-up.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "Invalid parameters.";
}

?>
