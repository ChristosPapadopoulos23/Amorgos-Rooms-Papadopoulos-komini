<?php
function validateFormData($formData) {
    // Validate form fields
    foreach ($formData as $key => $value) {
        if (empty($value)) {
            return ucfirst($key) . " is required!";
        }
    }

    // Check password match
    $password = $formData['password'];
    $cpassword = $formData['cpassword'];
    if ($password != $cpassword) {
        return "Passwords do not match!";
    }

    // All validation passed
    return null; // No errors
}

function is_input_empty(string $user_name, string $user_lastname, string $business_name, string $phone, string $email, string $username, string $password, string $cpassword) {
    return empty($user_name) || empty($user_lastname) || empty($business_name) || empty($phone) || empty($email) || empty($username) || empty($password) || empty($cpassword);
}

function is_email_invalid(string $email) {
    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function is_username_taken(string $username) {
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
