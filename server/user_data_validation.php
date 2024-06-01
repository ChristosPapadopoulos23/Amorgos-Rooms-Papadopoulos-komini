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
