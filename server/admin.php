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
        exit(json_encode(array("error" => "Rate limit exceeded. Please try again later.")));
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
$userName = isset($_GET['userName']) ? $_GET['userName'] : '';
$user_state = isset($_GET['state']) ? $_GET['state'] : '';
$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

$offset = ($page - 1) * $batchSize;

// Build SQL query based on userName and state
$sql = "SELECT * FROM UsersTable WHERE 1=1"; // Initial query
$countSql = "SELECT COUNT(*) as total FROM UsersTable WHERE 1=1"; // Initial count query

if ($user_state == 'unapproved') {
    $sql .= " AND status_code = 'unapproved'";
    $countSql .= " AND status_code = 'unapproved'";
} else if ($user_state == 'approved') {
    $sql .= " AND status_code = 'approved'";
    $countSql .= " AND status_code = 'approved'";
} else if ($user_state == 'rejected') {
    $sql .= " AND status_code = 'rejected'";
    $countSql .= " AND status_code = 'rejected'";
}

if ($userName != '') {
    $sql .= " AND business_name LIKE '$userName%'";
    $countSql .= " AND business_name LIKE '$userName%'";
}


if ($order != 'DESC') {
    $sql .= " ORDER BY created_at ASC";
} else {
    $sql .= " ORDER BY created_at DESC";
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
            'name' => $row['first_name'] . ' ' . $row['last_name'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'business_name' => $row['business_name'], 
            'created_at' => $row['created_at'], 
            'id' => $row['id']
        );
    }
}

$conn->close();

$response = array(
    'users' => $data,
    'hasMore' => $hasMore
);

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
