<?php
$location = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "users";

try {
    $conn = new mysqli($location, $dbUsername, $dbPassword, $dbName);
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

// $conn = new mysqli($location, $dbUsername, $dbPassword, $dbName);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

