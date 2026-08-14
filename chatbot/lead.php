<?php

header("Content-Type: application/json; charset=UTF-8");

require_once "mail_helper.php";

try {

    // Read JSON input
    $rawInput = file_get_contents("php://input");

    if (empty($rawInput)) {
        throw new Exception("No data received.");
    }

    // Decode JSON
    $data = json_decode($rawInput, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid JSON data.");
    }

    // Validate required fields
    $requiredFields = [
        'name',
        'email',
        'phone',
        'organization',
        'designation',
        'domain',
        'location',
        'description'
    ];

    foreach ($requiredFields as $field) {

        if (!isset($data[$field]) || trim($data[$field]) === '') {

            throw new Exception(ucfirst($field) . " is required.");

        }

    }

    // Validate email
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email address.");
    }

    // Sanitize values
    $name = trim($data['name']);
    $domain = trim($data['domain']);

    // Send email
    sendLeadEmail($data);

    echo json_encode([
        "status" => "success",
        "message" => "✅ Thank you, <b>{$name}</b>!<br><br>Your enquiry has been submitted successfully.<br><br>Our sales team will contact you within 24 hours regarding <b>{$domain}</b>."
    ]);

} catch (Exception $e) {

    // During development, uncomment the next line to see the exact error.
    // $message = $e->getMessage();

    $message = "Unable to submit your enquiry. Please try again later.";

    echo json_encode([
        "status" => "error",
        "message" => $message
        // "debug" => $e->getMessage()
    ]);

}