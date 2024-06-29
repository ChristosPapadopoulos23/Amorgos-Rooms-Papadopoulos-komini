<?php
session_start(); // Start the session

// Function to check and update request count in session this is for rate limiting
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
$user_state = isset($_GET['state']) ? $_GET['state'] : 'unapproved';
$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

// Calculate offset based on page number and batch size
$offset = ($page - 1) * $batchSize;

// Build SQL query based on userName and state
$sql = "SELECT * FROM UsersTable WHERE 1=1"; // Initial query
$countSql = "SELECT COUNT(*) as total FROM UsersTable WHERE 1=1"; // Initial count query

// Add conditions based on parameters
if ($user_state == 'unapproved') {
    $sql .= " AND status_code = 'unapproved'";
    $countSql .= " AND status_code = 'unapproved'";
} else if ($user_state == 'approved') {
    $sql .= " AND status_code = 'approved'";
    $countSql .= " AND status_code = 'approved'";
}

// Add search condition based on userName
if ($userName != '') {
    $sql .= " AND last_name LIKE '$userName%' OR first_name LIKE '$userName%'";
    $countSql .= " AND last_name LIKE '$userName%' OR first_name LIKE '$userName%'";
}

// Add order by clause
if ($order != 'DESC') {
    $sql .= " ORDER BY created_at ASC";
} else {
    $sql .= " ORDER BY created_at DESC";
}

// Add limit and offset
$sql .= " LIMIT $batchSize OFFSET $offset";

// Execute queries
$result = $conn->query($sql);
$countResult = $conn->query($countSql);
$totalRows = $countResult->fetch_assoc()['total'];

$data = array();
$hasMore = ($offset + $batchSize) < $totalRows;

// Fetch data from result
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            'name' => $row['first_name'] . ' ' . $row['last_name'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'created_at' => $row['created_at'], 
            'id' => $row['id'],
            'role' => $row['role']
        );
    }
}

$conn->close();

// Prepare response
$response = array(
    'users' => $data,
    'hasMore' => $hasMore
);

// Send JSON response to the client
header('Content-Type: application/json');
echo json_encode($response);
