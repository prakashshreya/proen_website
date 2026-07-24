<?php

//====================================================
// PROEN Careers Mail Script
//====================================================

// Show errors during development
error_reporting(E_ALL);
ini_set('display_errors', 1);

//====================================================
// Load PHPMailer
//====================================================

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//====================================================
// Allow only POST Request
//====================================================

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Invalid Request.");
}

//====================================================
// Google reCAPTCHA Secret Key
//====================================================

$secretKey = "6Ldym1wtAAAAAKQZMtIS130fZAb7bkRshEq3Lbll";

//====================================================
// Verify Google reCAPTCHA
//====================================================

if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
    die("Please verify that you are not a robot.");
}

$captcha = $_POST['g-recaptcha-response'];

$verifyURL =
    "https://www.google.com/recaptcha/api/siteverify?secret="
    . $secretKey .
    "&response=" .
    $captcha;

$response = file_get_contents($verifyURL);
$responseKeys = json_decode($response, true);

if (!$responseKeys["success"]) {
    die("reCAPTCHA verification failed.");
}

//====================================================
// Collect Form Data
//====================================================

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$position = trim($_POST['position']);
$experience = trim($_POST['experience']);
$subject = trim($_POST['subject']);
$linkedin = trim($_POST['linkedin']);
$portfolio = trim($_POST['portfolio']);
$message = trim($_POST['message']);

//====================================================
// Basic Validation
//====================================================

if (
    empty($name) ||
    empty($email) ||
    empty($phone) ||
    empty($position) ||
    empty($experience) ||
    empty($subject)
) {
    die("Please fill all required fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid Email Address.");
}

//====================================================
// Resume Validation
//====================================================

if (!isset($_FILES['resume'])) {
    die("Resume not uploaded.");
}

$file = $_FILES['resume'];

if ($file['error'] != 0) {
    die("Resume upload failed.");
}

//====================================================
// Allowed Extensions
//====================================================

$allowedExtensions = array(
    "pdf",
    "doc",
    "docx"
);

$fileName = basename($file['name']);

$fileExtension = strtolower(
    pathinfo($fileName, PATHINFO_EXTENSION)
);

if (!in_array($fileExtension, $allowedExtensions)) {
    die("Only PDF, DOC and DOCX files are allowed.");
}

//====================================================
// Maximum File Size
// 5 MB
//====================================================

$maxFileSize = 5 * 1024 * 1024;

if ($file['size'] > $maxFileSize) {
    die("Resume size should not exceed 5 MB.");
}

//====================================================
// Upload Directory
//====================================================

$uploadDir = "uploads/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

//====================================================
// Generate Unique File Name
//====================================================

$newFileName =
    time() .
    "_" .
    preg_replace('/[^A-Za-z0-9]/', '_', $name) .
    "." .
    $fileExtension;

$uploadFile = $uploadDir . $newFileName;

//====================================================
// Move Uploaded File
//====================================================

if (!move_uploaded_file($file['tmp_name'], $uploadFile)) {
    die("Unable to upload resume.");
}

//====================================================
// Create PHPMailer Instance
//====================================================

$mail = new PHPMailer(true);

try {

    // SMTP configuration will be added in Part 2

        //====================================================
    // SMTP Configuration
    //====================================================

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'darshanardarshanar@gmail.com';
    $mail->Password   = 'xfqw ibuk frfq bant';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //====================================================
    // Sender & Receiver
    //====================================================

    $mail->setFrom('careers@proen.co.in', 'PROEN Careers');

    // HR Email
    $mail->addAddress('hr@proen.co.in', 'HR Team');

    // Reply directly to candidate
    $mail->addReplyTo($email, $name);

    //====================================================
    // Attach Resume
    //====================================================

    $mail->addAttachment(
        $uploadFile,
        $fileName
    );

    //====================================================
    // Email
    //====================================================

    $mail->isHTML(true);

    $mail->Subject = "New Career Application - " . $position;

    $mail->Body = '

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<style>

body{
    margin:0;
    padding:30px;
    background:#f4f7fb;
    font-family:Arial, Helvetica, sans-serif;
}

.main-wrapper{
    max-width:750px;
    margin:0 auto;
    background:#ffffff;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0px 5px 20px rgba(0,0,0,0.08);
}

.header{
    background:#17375E;
    color:#ffffff;
    text-align:center;
    padding:30px;
}

.header h1{
    margin:0;
    font-size:28px;
}

.header p{
    margin-top:10px;
    font-size:15px;
    color:#dbe8ff;
}

.content{
    padding:35px;
}

.section-title{
    font-size:20px;
    color:#17375E;
    margin-bottom:20px;
    font-weight:bold;
    border-left:5px solid #F69323;
    padding-left:12px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table tr:nth-child(even){
    background:#f9fbff;
}

table td{
    padding:15px;
    border-bottom:1px solid #ececec;
    vertical-align:top;
}

.label{
    width:220px;
    font-weight:bold;
    color:#17375E;
}

.value{
    color:#444444;
}

.message-box{
    background:#f8fafc;
    border-left:5px solid #1B5EB8;
    padding:20px;
    margin-top:20px;
    border-radius:5px;
    color:#555;
    line-height:28px;
}

.resume-box{
    margin-top:30px;
    padding:20px;
    background:#FFF8F0;
    border:1px solid #F69323;
    border-radius:8px;
}

.resume-box h3{
    margin-top:0;
    color:#F69323;
}

.footer{
    background:#17375E;
    color:#ffffff;
    text-align:center;
    padding:20px;
    font-size:14px;
}

.footer span{
    color:#F69323;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="main-wrapper">

<div class="header">

<h1>PROEN Consulting Services</h1>

<p>New Career Application Received</p>

</div>

<div class="content">

<div class="section-title">
Candidate Information
</div>

<table>

<tr>
<td class="label">Full Name</td>
<td class="value">'.$name.'</td>
</tr>

<tr>
<td class="label">Email Address</td>
<td class="value">'.$email.'</td>
</tr>

<tr>
<td class="label">Phone Number</td>
<td class="value">'.$phone.'</td>
</tr>

<tr>
<td class="label">Applied Position</td>
<td class="value">'.$position.'</td>
</tr>

<tr>
<td class="label">Experience</td>
<td class="value">'.$experience.'</td>
</tr>

<tr>
<td class="label">Subject</td>
<td class="value">'.$subject.'</td>
</tr>

<tr>
<td class="label">LinkedIn Profile</td>
<td class="value">'.$linkedin.'</td>
</tr>

<tr>
<td class="label">Portfolio / GitHub</td>
<td class="value">'.$portfolio.'</td>
</tr>

</table>

<div class="section-title" style="margin-top:35px;">
Cover Letter / Message
</div>

<div class="message-box">

'.nl2br($message).'

</div>

<div class="resume-box">

<h3>Resume Attached</h3>

<p>
The candidate''s resume has been attached to this email for your review.
</p>

</div>

</div>

<div class="footer">

This email was automatically generated from the
<span>PROEN Careers Portal</span>

</div>

</div>

</body>

</html>

';

    //====================================================
    // Plain Text Email
    //====================================================

    $mail->AltBody =
"New Career Application

Name : $name

Email : $email

Phone : $phone

Position : $position

Experience : $experience

Subject : $subject

LinkedIn : $linkedin

Portfolio : $portfolio

Message :

$message

Resume Attached.";

    //====================================================
    // Send Mail
    //====================================================

    $mail->send();

    //====================================================
    // Delete Uploaded Resume
    //====================================================

    if(file_exists($uploadFile)){
        unlink($uploadFile);
    }

    //====================================================
    // Success
    //====================================================

    echo "<script>
            alert('Application submitted successfully.');
            window.location='careers.php';
          </script>";

}

catch (Exception $e) {

    // Delete Uploaded File
    if(file_exists($uploadFile)){
        unlink($uploadFile);
    }

    echo "Mailer Error: " . $mail->ErrorInfo;

}

?>