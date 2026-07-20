<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $senderName  = trim($_POST['username']);
    $senderEmail = trim($_POST['email']);
    $message     = trim($_POST['message']);

    // Validate
    if (empty($senderName) || empty($senderEmail) || empty($message)) {
        header("Location: contact.html?message=Failed");
        exit();
    }

    $mail = new PHPMailer(true);

    try {

        // ==========================
        // SMTP Configuration
        // ==========================

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // CHANGE THIS
        $mail->Username   = 'darshanardarshanar@gmail.com';

        // CHANGE THIS (App Password, NOT Gmail password)
        $mail->Password   = 'xfqw ibuk frfq bant';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // ==========================
        // Email Settings
        // ==========================

        $mail->setFrom('darshanardarshanar@gmail.com', 'PROEN Website');

        $mail->addAddress('darshanardarshanar@gmail.com', 'Darshan A R');

        // Reply goes to visitor
        $mail->addReplyTo($senderEmail, $senderName);

        // ==========================
        // Email Content
        // ==========================

        $mail->isHTML(true);

        $mail->Subject = 'New Contact Form Enquiry';

        $mail->Body = '

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">

</head>

<body style="margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f9;padding:40px 0;">

<tr>
<td align="center">

<table width="650" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 5px 20px rgba(0,0,0,.08);">

<!-- Header -->

<tr>
<td style="background:#17375E;padding:30px;text-align:center;">

<h1 style="margin:0;color:#ffffff;font-size:28px;">
PROEN Consulting Services
</h1>

<p style="margin-top:8px;color:#d9e8ff;font-size:15px;">
New Contact Form Submission
</p>

</td>
</tr>

<!-- Greeting -->

<tr>
<td style="padding:35px;">

<h2 style="margin-top:0;color:#17375E;">
Hello Darshan,
</h2>

<p style="font-size:16px;color:#555;line-height:28px;">
You have received a new enquiry from your website.
Below are the customer details.
</p>

</td>
</tr>

<!-- Customer Details -->

<tr>
<td style="padding:0 35px 35px;">

<table width="100%" cellpadding="12" cellspacing="0" style="border-collapse:collapse;">

<tr style="background:#F8FAFC;">
<td width="180"><strong>Name</strong></td>
<td>'.$senderName.'</td>
</tr>

<tr>
<td><strong>Email</strong></td>
<td>'.$senderEmail.'</td>
</tr>

<tr style="background:#F8FAFC;">
<td><strong>Submitted On</strong></td>
<td>'.date("d M Y h:i A").'</td>
</tr>

<tr>
<td valign="top"><strong>Message</strong></td>
<td>'.nl2br($message).'</td>
</tr>

</table>

</td>
</tr>

<!-- CTA -->

<tr>

<td align="center" style="padding-bottom:35px;">

<a href="mailto:'.$senderEmail.'" style="
background:#F69323;
color:#ffffff;
text-decoration:none;
padding:14px 35px;
border-radius:5px;
display:inline-block;
font-weight:bold;
font-size:16px;
">
Reply to Customer
</a>

</td>

</tr>

<!-- Footer -->

<tr>

<td style="
background:#17375E;
padding:25px;
text-align:center;
color:#ffffff;
font-size:14px;
">

<b>PROEN Consulting Services</b><br><br>

Empowering Digital Transformation Through Innovation

<br><br>

© '.date("Y").' PROEN Consulting Services.
All Rights Reserved.

</td>

</tr>

</table>

</td>

</tr>

</table>

</body>

</html>

';

        $mail->AltBody =
            "New Contact Form Submission\n\n" .
            "Name: $senderName\n" .
            "Email: $senderEmail\n\n" .
            "Message:\n$message";

        // Send Email
        $mail->send();

        header("Location: contact.html?message=Successfull");
        exit();

    } catch (Exception $e) {

        // Uncomment this line while testing
        // echo $mail->ErrorInfo;

        header("Location: contact.html?message=Failed");
        exit();
    }

} else {

    header("Location: contact.html?message=Failed");
    exit();
}

?>