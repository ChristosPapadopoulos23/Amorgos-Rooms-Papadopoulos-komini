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
    if (isset($conn)) {
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
    $area = sanitizeInput($_POST['area']);

    if (strlen($comments) < 1) {
        $comments = 0;
    }

    if (strlen($b_name) < 1 || strlen($phone) != 10 || strlen($mobile) != 10) {
        exit("Invalid input data");
    }

    $created_at = date("Y-m-d H:i:s");
    $owner_id = $_SESSION['user_id'];

    $query = "INSERT INTO BusinessTable (business_name, business_phone, business_mobile, business_email, location, created_at, owner_id, description)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssssssis", $b_name, $phone, $mobile, $email, $area, $created_at, $owner_id, $comments);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $b_id = $conn->insert_id;
        $directory = '../uploads/' . $b_id;
        if (!file_exists($directory)) {
            if (!mkdir($directory, 0777, true)) {
                $stmt->close();
                die('Failed to create folders...');
            }
        }

        if (isset($_FILES['pic']) && !empty($_FILES['pic']['name'][0])) {
            $files = $_FILES['pic'];
            $fileNames = $files['name'];
            $fileTmpNames = $files['tmp_name'];
            $fileSizes = $files['size'];
            $fileErrors = $files['error'];
            $fileTypes = $files['type'];

            $allowed = array('jpg', 'jpeg', 'png');
            $MAX_FILE_SIZE = 20000000; // 20MB

            for ($i = 0; $i < count($fileNames); $i++) {
                $fileName = $fileNames[$i];
                $fileTmpName = $fileTmpNames[$i];
                $fileSize = $fileSizes[$i];
                $fileError = $fileErrors[$i];
                $fileType = $fileTypes[$i];

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                if (in_array($fileActualExt, $allowed)) {
                    if ($fileError === 0) {
                        if ($fileSize < $MAX_FILE_SIZE) {
                            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                            $fileDestination = $directory . '/' . $fileNameNew;
                            if (!move_uploaded_file($fileTmpName, $fileDestination)) {
                                $stmt->close();
                                die('Failed to move uploaded file: ' . $fileName);
                            }
                        } else {
                            header("Location: ../create-page.php?error=file_too_big&file=$fileName");
                            $stmt->close();
                            exit();
                        }
                    } else {
                        header("Location: ../create-page.php?error=upload_error&file=$fileName");
                        $stmt->close();
                        exit();
                    }
                } else {
                    header("Location: ../create-page.php?error=invalid_file_type&file=$fileName");
                    $stmt->close();
                    exit();
                }
            }
        }

        header("Location: ../control-panel.php?error=created");
        $stmt->close();
        exit();
    } else {
        header("Location: ../create-page.php?error=database_error");
        $stmt->close();
        exit();
    }

} else {
    header("Location: ../create-page.php?error=invalid_request");
    $stmt->close();
    exit();
}

// Ensure connection is always closed
if (isset($conn) && $conn->ping()) {
    $conn->close();
}
