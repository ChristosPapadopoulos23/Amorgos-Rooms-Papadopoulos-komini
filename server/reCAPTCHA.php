<?php

if (!isset($_POST['recaptcha_response'])) {
    // Handle case where reCAPTCHA response is missing
    echo "reCAPTCHA response is missing.";
}

// Verify reCAPTCHA
$secretKey = '6LeEMsYpAAAAAPw6yKTsCLWlaXVGxNP6d70awRaI'; // Replace with your reCAPTCHA secret key
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = [
    'secret' => $secretKey,
    'response' => $recaptchaResponse
];

$options = [
    'http' => [
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$result = json_decode($response);

if (!$result->success) {
    // reCAPTCHA verification failed
    echo "reCAPTCHA verification failed.";
}

