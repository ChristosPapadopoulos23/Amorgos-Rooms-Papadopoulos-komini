<?php
function validateFormData($formData) {
    foreach ($formData as $key => $value) {
        if (empty($value)) {
            return ucfirst($key) . " is required!";
        }
    }

    $password = $formData['password'];
    $cpassword = $formData['cpassword'];
    if ($password != $cpassword) {
        return "Passwords do not match!";
    }

    return null; // No errors
}

function is_input_empty($name, $lastname, $business_name, $phone, $email, $username, $password, $cpassword) {
    return empty($name) || empty($lastname) || empty($business_name) || empty($phone) || empty($email) || empty($username) || empty($password) || empty($cpassword);
}

function is_email_invalid($email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_username_taken($username) {
    global $conn;
    $query = "SELECT * FROM UsersTable WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    $result = $stmt->num_rows > 0;
    $stmt->close();
    return $result;
}
?>
