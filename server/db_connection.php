<?php
$location = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "users";

$conn = new mysqli($location, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

