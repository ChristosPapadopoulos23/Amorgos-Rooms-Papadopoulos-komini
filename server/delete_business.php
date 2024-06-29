<?php

function deleteDirectory($dir) {
    // Check if the directory exists
    if (!file_exists($dir)) {
        return false;
    }

    // Check if the path is a directory
    if (!is_dir($dir)) {
        return false;
    }

    // Open the directory
    $items = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($items, RecursiveIteratorIterator::CHILD_FIRST);

    // Iterate over files and directories
    foreach ($files as $fileinfo) {
        $operation = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
        if (!$operation($fileinfo->getRealPath())) {
            echo "Failed to delete " . $fileinfo->getRealPath() . "<br>";
            return false;
        }
    }

    // Remove the now-empty directory
    return rmdir($dir);
}

session_start();


if (!isset($_SESSION['role']) || ($_SESSION['user_id'] !=$_GET['uid'] ) ) { 
    header("Location: ./sign-up.php");  // Feature is not implemented yet
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$uid = isset($_GET['uid']) ? (int)$_GET['uid'] : null;

require_once 'logs.php';
require_once 'db_connection.php';




if ($uid !== null) {
    // delete all the user's room images
    $sql1 = "SELECT id FROM BusinessTable WHERE id=$id";
    $result = $conn->query($sql1);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dir = "../uploads/" . $row['id'];
            if (!deleteDirectory($dir)) {
                echo "Failed to delete directory $dir";
            }
        }
    }
    // delete all the user's rooms
    $sql2 = "DELETE FROM BusinessTable WHERE id=$id";
    header("Location: ../control-panel.php");
    // Execute the query
    if (isset($sql2)) {
        if ($conn->query($sql2) === TRUE) {
            echo "Record updated/deleted successfully";
        } else {
            echo "Error: " . $conn->error;
        }
    }

} else {
    echo "Invalid parameters.";
}

?>
