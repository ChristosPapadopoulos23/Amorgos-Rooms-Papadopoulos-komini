<?php
session_start(); // Start the session

// Function to check and update API request count
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

require_once 'logs.php';
require_once 'db_connection.php';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$batchSize = isset($_GET['batchSize']) ? intval($_GET['batchSize']) : 6;
$location = isset($_GET['location']) ? $_GET['location'] : 'all';
$roomName = isset($_GET['roomName']) ? $_GET['roomName'] : '';

$offset = ($page - 1) * $batchSize;

if ($location == 'all' && $roomName == '') {
    $sql = "SELECT * FROM BusinessTable LIMIT $batchSize OFFSET $offset";
    $countSql = "SELECT COUNT(*) as total FROM BusinessTable";
} else if ($location == 'all' && $roomName != '') {
    $sql = "SELECT * FROM BusinessTable WHERE business_name LIKE '$roomName%'";
    $countSql = "SELECT COUNT(*) as total FROM BusinessTable WHERE business_name LIKE '$roomName%'";
} else if ($location != 'all' && $roomName == '') {
    $sql = "SELECT * FROM BusinessTable WHERE location = '$location' LIMIT $batchSize OFFSET $offset";
    $countSql = "SELECT COUNT(*) as total FROM BusinessTable WHERE location = '$location'";
} else {
    $sql = "SELECT * FROM BusinessTable WHERE location = '$location' AND business_name = '$roomName' LIMIT $batchSize OFFSET $offset";
    $countSql = "SELECT COUNT(*) as total FROM BusinessTable WHERE location = '$location' AND business_name = '$roomName'";
}

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
            'id' => $row['id'],
            'image' => 'images/island.jpg' // Example image URL
        );
    }
}

$conn->close();

$response = array(
    'rooms' => $data,
    'hasMore' => $hasMore
);

header('Content-Type: application/json');
echo json_encode($response);
