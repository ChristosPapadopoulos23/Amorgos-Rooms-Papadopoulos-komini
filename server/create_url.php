<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

session_regenerate_id(true);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'logs.php';
require_once 'db_connection.php';
require_once 'user_data_validation.php';

// Function to sanitize user input
function sanitizeInput($input, $conn = null) {
    if ($conn) {
        return $conn->real_escape_string($input);
    } else {
        return htmlspecialchars(trim($input));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $b_name = sanitizeInput($_POST['name_l'], $conn);
    $email = sanitizeInput($_POST['email_l'], $conn);
    $phone = sanitizeInput($_POST['phone_l'], $conn);
    $mobile = sanitizeInput($_POST['mobile_l'], $conn);
    $area = sanitizeInput($_POST['area_l'], $conn);
    $url = sanitizeInput($_POST['link'], $conn);
    $url_confirm = sanitizeInput($_POST['link_confirmation'], $conn);
    $comments = "0";

    // Basic validation
    if (strlen($b_name) < 1 || strlen($phone) != 10 || strlen($mobile) != 10 || strlen($url) < 1 || $url_confirm != "yes") {
        header("Location: ../create-page.php?error=invalid_input");
        exit();
    }
    
    $created_at = date("Y-m-d H:i:s");
    $owner_id = $_SESSION['user_id'];

    $query = "INSERT INTO BusinessTable (business_name, business_phone, business_mobile, business_email, location, url, created_at, owner_id, description)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("sssssssis", $b_name, $phone, $mobile, $email, $area, $url, $created_at, $owner_id, $comments);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $b_id = $conn->insert_id;

        $files = $_FILES['pic'];
        $fileName = $files['name'];
        $fileTmpName = $files['tmp_name'];
        $fileSize = $files['size'];
        $fileError = $files['error'];
        $fileType = $files['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');
        $MAX_FILE_SIZE = 20000000; // 20MB

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < $MAX_FILE_SIZE) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $directory = '../uploads/' . $b_id;
                    if (!file_exists($directory)) {
                        if (!mkdir($directory, 0777, true)) {
                            die('Failed to create folders...');
                        }
                    }
                    $fileDestination = $directory . '/' . $fileNameNew;
                    if (!move_uploaded_file($fileTmpName, $fileDestination)) {
                        die('Failed to move uploaded file...');
                    }
                    header("Location: ../control-panel.php?success=created");
                } else {
                    header("Location: ../create-page.php?error=file_too_big");
                    exit();
                }
            } else {
                header("Location: ../create-page.php?error=upload_error");
                exit();
            }
        } else {
            header("Location: ../create-page.php?error=invalid_file_type");
            exit();
        }
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

