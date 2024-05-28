<?php
session_start(); // Start the session

// Function to check and update request count
function checkAndUpdateRequestCount() {
    if (!isset($_SESSION['request_count'])) {
        $_SESSION['request_count'] = 0;
        $_SESSION['last_request_time'] = time();
    }

    $time_since_last_request = time() - $_SESSION['last_request_time'];
    if ($time_since_last_request > 60) { // Limiting requests to 60 per minute
        $_SESSION['request_count'] = 0; // Reset request count
        $_SESSION['last_request_time'] = time(); // Update last request time
    }

    $max_requests = 200; // Adjust this value as needed (e.g., 60 requests per minute)
    if ($_SESSION['request_count'] >= $max_requests) {
        http_response_code(429); // HTTP 429 Too Many Requests
        exit("Rate limit exceeded. Please try again later.");
    }

    $_SESSION['request_count']++;
}

// Check and update request count
checkAndUpdateRequestCount();

// Include necessary files
require_once 'logs.php';
require_once 'db_connection.php';

// Set default values for parameters
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$batchSize = isset($_GET['batchSize']) ? intval($_GET['batchSize']) : 6;
$location = isset($_GET['location']) ? $_GET['location'] : 'all'; // Set default location to 'all'
$roomName = isset($_GET['roomName']) ? $_GET['roomName'] : '';
$user_state = isset($_GET['state']) ? $_GET['state'] : '';


$offset = ($page - 1) * $batchSize;

// Build SQL query based on location and roomName
$sql = "SELECT * FROM BusinessTable WHERE 1=1"; // Initial query
$countSql = "SELECT COUNT(*) as total FROM BusinessTable WHERE 1=1"; // Initial count query

if ($user_state == 'unapproved') {
    $sql .= " AND location = 'Some Location'";
    $countSql .= " AND location = 'Some Location'";
} else if ($user_state == 'approved') {
    if ($location != 'all') {
        $sql .= " AND location = '$location'";
        $countSql .= " AND location = '$location'";
    }
} else if ($user_state == 'rejected') {
    $sql .= " AND location = 'rejected'";
    $countSql .= " AND location = 'rejected'";
}

if ($roomName != '') {
    $sql .= " AND business_name LIKE '$roomName%'";
    $countSql .= " AND business_name LIKE '$roomName%'";
}

$sql .= " LIMIT $batchSize OFFSET $offset";


// Execute queries
$result = $conn->query($sql);
$countResult = $conn->query($countSql);
$totalRows = $countResult->fetch_assoc()['total'];

$data = array();
$hasMore = ($offset + $batchSize) < $totalRows;

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

$conn->close();

$response = array(
    'rooms' => $data,
    'hasMore' => $hasMore
);

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);

