<?php

header("Content-Type: application/json");

require 'mail_helper.php';

$data = json_decode(file_get_contents("php://input"), true);

try{

    sendLeadEmail($data);

    echo json_encode([
        "status" => "success",
        "message" => "✅ Thank you, {$name}!<br><br>Your enquiry has been submitted successfully.<br><br>Our sales team will contact you within 24 hours regarding <b>{$domain}</b>."
    ]);

}
catch(Exception $e){

    echo json_encode([

        "status"=>"error",

        "message"=>"Unable to submit enquiry."

    ]);

}