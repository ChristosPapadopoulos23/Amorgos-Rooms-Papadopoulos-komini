<?php
session_start(); // Start the session

// Function to check and update API request count
function checkAndUpdateRequestCount() {
    // Initialize request count and last request time if they don't exist
    if (!isset($_SESSION['request_count'])) {
        $_SESSION['request_count'] = 0;
        $_SESSION['last_request_time'] = time();
    }

    // Increment request count if it's been more than a minute since the last request
    $time_since_last_request = time() - $_SESSION['last_request_time'];
    if ($time_since_last_request > 60) { // Limiting requests to 1 per minute
        $_SESSION['request_count'] = 0; // Reset request count
        $_SESSION['last_request_time'] = time(); // Update last request time
    }

    // Check if request count exceeds the limit
    $max_requests = 60; // Adjust this value as needed (e.g., 60 requests per minute)
    if ($_SESSION['request_count'] >= $max_requests) {
        // Handle rate limit exceeded
        http_response_code(429); // HTTP 429 Too Many Requests
        exit("Rate limit exceeded. Please try again later.");
    }

    // Increment request count
    $_SESSION['request_count']++;
}
        
// Check and update request count
checkAndUpdateRequestCount();



require_once 'logs.php';
require_once 'db_connection.php';

// Get page number and batch size from the AJAX request
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$batchSize = isset($_GET['batchSize']) ? intval($_GET['batchSize']) : 6;
$location = isset($_GET['location']) ? $_GET['location'] : 'all';
$roomName = isset($_GET['roomName']) ? $_GET['roomName'] : '';

// Calculate offset based on the page number and batch size
$offset = ($page - 1) * $batchSize;

// SQL query to fetch a batch of rows from the database
if ($location == 'all' && $roomName == '') {
    $sql = "SELECT * FROM BusinessTable LIMIT $batchSize OFFSET $offset";
} else if ($location == 'all' && $roomName != '') {
    $sql = "SELECT * FROM BusinessTable WHERE business_name LIKE '$roomName%'";
} else if ($location != 'all' && $roomName == '') {
    $sql = "SELECT * FROM BusinessTable WHERE location = '$location' LIMIT $batchSize OFFSET $offset";
} else {
    $sql = "SELECT * FROM BusinessTable WHERE location = '$location' AND business_name = '$roomName' LIMIT $batchSize OFFSET $offset";
}

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Customize data structure based on your table columns
        $data[] = array(
            'name' => $row['business_name'],
            'location' => $row['location'],
            'phone' => $row['business_phone'],
            'email' => $row['business_email'],
            'image' => 'images/island.jpg' // Example image URL
        );
    }
}

// Close the database connection
$conn->close();

// Output data as JSON (for AJAX response)
header('Content-Type: application/json');
echo json_encode($data);

