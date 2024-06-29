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
if (!isset($_SESSION['role']) || ($_SESSION['user_id'] != $_GET['id']) ) { 
    header("Location: ./sign-up.php");
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
        $sql = "DELETE FROM UsersTable WHERE id=$uid";
        // delete all the user's room images
        $sql1 = "SELECT id FROM BusinessTable WHERE owner_id=$uid";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dir = "../uploads/" . $row['id'];
                if (!deleteDirectory($dir)) {
                    echo "Failed to delete directory $dir";
                }
            }
        }
    }

    // Execute the query
    if (isset($sql)) {
        if ($conn->query($sql) === TRUE) { 
            // kick the user out
            session_unset();
            session_destroy();
            header("Location: ../sign-up.php");
            exit();

        } else {
            echo "Error: " . $conn->error;
        }
    }

} else {
    echo "Invalid parameters.";
}

?>
