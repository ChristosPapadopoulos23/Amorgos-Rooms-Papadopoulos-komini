<?php
session_start();

require_once 'db_connection.php';

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

$data = array(); // Initialize the $data array here to avoid undefined variable error

if ($user_id > 0) {
    $sql = "SELECT * FROM BusinessTable WHERE owner_id = $user_id";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imageDir = "../uploads/" . $_SESSION['username'] . "/" . $row['business_name'];
                $imageDir2 = "uploads/" . $_SESSION['username'] . "/" . $row['business_name'];
                // Initialize $image as null
                
                $image = null;

                // Get the list of files in the directory
                if (is_dir($imageDir)) {
                    $files = scandir($imageDir);

                    // Iterate through the files to find the first image file
                    foreach ($files as $file) {
                        if (is_file($imageDir . '/' . $file) && getimagesize($imageDir . '/' . $file)) {
                            // Found the first image file, construct the path and break the loop
                            $image = $imageDir2 . '/' . $file;
                            break;
                        }
                    }
                }

                // If no image is found, you can set a default image or handle it accordingly
                if ($image === null) {
                    $image = 'media/church.jpg'; // Adjust this path to your default image
                }

                $data[] = array(
                    'name' => $row['business_name'],
                    'location' => $row['location'],
                    'phone' => $row['business_phone'],
                    'email' => $row['business_email'],
                    'image' => $image
                );
            }
        }
    } else {
        // Debugging: Log the error
        error_log("SQL error: " . $conn->error);
    }

    $result->close();
} else {
    // Debugging: Log invalid user ID
    error_log("Invalid user ID: " . $user_id);
}

$conn->close();

$response = array(
    'rooms' => $data
);

header('Content-Type: application/json');
echo json_encode($response);
?>
