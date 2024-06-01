<?php
session_start();
session_create_id(true);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'logs.php';
require_once 'db_connection.php';
require_once 'user_data_validation.php';

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

    $b_name = sanitizeInput($_POST['name']);
    $comments = sanitizeInput($_POST['comments']);
    $email = sanitizeInput($_POST['email']);
    $phone = sanitizeInput($_POST['phone']);
    $mobile = sanitizeInput($_POST['mobile']);
    $area = "tst";

    // $url = sanitizeInput($_POST['url']);

    $files = $_FILES['pic'];
    $fileName = $_FILES['pic']['name'];
    $fileTmpName = $_FILES['pic']['tmp_name'];
    $fileSize = $_FILES['pic']['size'];
    $fileError = $_FILES['pic']['error'];
    $fileType = $_FILES['pic']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    $MAX_FILE_SIZE = 20000000; // 20MB

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < $MAX_FILE_SIZE) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $directory = '../uploads/' . $_SESSION['username'] . '/' . $b_name;
                if (!file_exists($directory)) {
                    if (!mkdir($directory, 0777, true)) {
                        die('Failed to create folders...');
                    }
                }
                $fileDestination = $directory . '/' . $fileNameNew;
                if (!move_uploaded_file($fileTmpName, $fileDestination)) {
                    die('Failed to move uploaded file...');
                }
    
            } else {
                header("Location: ../create-page.php?error=file_too_big");
                exit();
            }
        } else {
            header("Location: ../create-page.php?error=upload_error");
            exit();
        }
    } else {
        header("Location: ../create-page.php?error=wrong_file_type");
        exit();
    }
    
    $created_at = date("Y-m-d H:i:s");
    $owner_id = $_SESSION['user_id'];

    $query = "INSERT INTO BusinessTable (business_name, business_phone, business_email, location, created_at, owner_id, business_mobile, discription) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("ssssssss", $b_name, $phone, $email, $area, $created_at, $owner_id, $mobile, $comments);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: ../create-page.php?success=created");
        exit();
    } else {
        header("Location: ../create-page.php?error=database_error");
        exit();
    }

    $stmt->close();
    $conn->close();
    
} else {
    header("Location: ../create-page.php?error=invalid_request");
    exit();
}
