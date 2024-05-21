<?php
require_once 'logs.php';
require_once 'db_connection.php';


$name = $conn->real_escape_string($_POST['name']);
$lastname = $conn->real_escape_string($_POST['lastname']);
$business_name = $conn->real_escape_string($_POST['business_name']);
$phone = $conn->real_escape_string($_POST['phone']);
$email = $conn->real_escape_string($_POST['email']);
$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);
$cpassword = $conn->real_escape_string($_POST['cpassword']);
$timestamp = date("Y-m-d H:i:s");
$business_location = "Some Location";



$checkQuery = "SELECT * FROM UsersTable WHERE username='$username' LIMIT 1";
$checkResult = $conn->query($checkQuery);

// Insert user data into UsersTable
$sqlUserSignup = "INSERT INTO UsersTable (first_name, last_name, username, password, created_at) 
                    VALUES (?, ?, ?, ?, ?)";

$stmtUserSignup = $conn->prepare($sqlUserSignup);

$stmtUserSignup->bind_param("sssss", $name, $lastname, $username, $hashedPassword, $timestamp);

$user_id = mysqli_insert_id($conn);

$stmtUserSignup->close();

$sqlBusinessSignup = "INSERT INTO BusinessTable (business_name, business_phone, business_email, location, owner_id, created_at)
                        VALUES (?, ?, ?, ?, ?, ?)";
                        
$stmtBusinessSignup = $conn->prepare($sqlBusinessSignup);

$stmtBusinessSignup->bind_param("ssssis", $business_name, $phone, $email, $business_location, $user_id, $timestamp);

$stmtBusinessSignup->close();

$checkResult->close();