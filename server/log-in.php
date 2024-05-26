<?php
session_start();
session_create_id();

// Include necessary files  
require_once 'db_connection.php';
require_once 'authentication.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = $_POST['username'];
	$password = $_POST['password'];

    if (authenticateUser($username, $password)) {
        $_SESSION['username'] = $username;
        $sql = "SELECT * FROM UsersTable WHERE username='$username'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['created_at'] = $row['created_at'];

        $id = $_SESSION['id'];
        $sql_business = "SELECT * FROM businessTable WHERE owner_id = $id";
        $result_bus = $conn->query($sql_business);
        $row_bus = $result_bus->fetch_assoc();
        if($row_bus['location'] != "Some Location"){
            header("Location: ../create_page.html");    ;
            exit();
        }
        header("Location: ../index.html");//custom page incumming
        exit();
    } else {
        header("Location: ../sign-up.html");
        exit();
    }
    $conn->close();
}
