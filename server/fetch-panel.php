<?php
session_start();

require_once 'db_connection.php';

// Uncomment the following line if you want to use the session variable
// $user_id = $_SESSION['user_id'];

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($user_id > 0) {
    $sql = "SELECT * FROM BusinessTable WHERE owner_id = $user_id";
    $result = $conn->query($sql);

    $data = array();

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
                    'name' => $row['business_name'],
                    'location' => $row['location'],
                    'phone' => $row['business_phone'],
                    'email' => $row['business_email'],
                    'image' => 'images/island.jpg' // Example image URL
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
