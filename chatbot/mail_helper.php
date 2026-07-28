<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__.'/../PHPMailer/src/Exception.php';
require_once __DIR__.'/../PHPMailer/src/PHPMailer.php';
require_once __DIR__.'/../PHPMailer/src/SMTP.php';

function sendLeadEmail($lead)
{
    $name = $lead['name'];
    $email = $lead['email'];
    $phone = $lead['phone'];
    $organization = $lead['organization'];
    $designation = $lead['designation'];
    $domain = $lead['domain'];
    $location = $lead['location'];
    $description = $lead['description'];

    $mail = new PHPMailer(true);

    // Copy your existing SMTP configuration here
    // Copy your existing email body here

    /*
    |--------------------------------------------------------------------------
    | SMTP Configuration
    |--------------------------------------------------------------------------
    */


    $mail->isSMTP();


    // PROEN SMTP Server
    $mail->Host = "smtp.gmail.com";


    // Enable SMTP Authentication
    $mail->SMTPAuth = true;



    // Your PROEN Email ID
    $mail->Username = "darshanardarshanar@gmail.com";


    // Your Email Password / App Password
    $mail->Password = "xfqw ibuk frfq bant";



    // Encryption
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;


    // SMTP Port
    $mail->Port = 587;



    /*
    |--------------------------------------------------------------------------
    | Sender Information
    |--------------------------------------------------------------------------
    */


    $mail->setFrom(

        "darshanardarshanar@gmail.com",

        "PROEN Website Enquiry"

    );



    /*
    |--------------------------------------------------------------------------
    | Receiver Information
    |--------------------------------------------------------------------------
    */


    $mail->addAddress(

        "darshanardarshanar@gmail.com",

        "PROEN Consulting Services"

    );



    /*
    |--------------------------------------------------------------------------
    | Reply To Customer
    |--------------------------------------------------------------------------
    */


    $mail->addReplyTo(

        $email,

        $name

    );



    /*
    |--------------------------------------------------------------------------
    | Email Content Type
    |--------------------------------------------------------------------------
    */


    $mail->isHTML(true);



    /*
    |--------------------------------------------------------------------------
    | Email Subject
    |--------------------------------------------------------------------------
    */


    $mail->Subject = 
    "New Business Enquiry - " . $domain;



    /*
    |--------------------------------------------------------------------------
    | PROEN Branded Email Body
    |--------------------------------------------------------------------------
    */


    $mail->Body = "

    <!DOCTYPE html>

    <html>

    <head>

    <meta charset='UTF-8'>

    </head>


    <body style='margin:0;
    padding:0;
    background:#F8FAFC;
    font-family:Arial,Helvetica,sans-serif;'>


    <table width='100%' cellpadding='0' cellspacing='0'>

    <tr>

    <td align='center'>


    <table width='650'
    cellpadding='0'
    cellspacing='0'
    style='
    background:#ffffff;
    margin:40px auto;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 20px 50px rgba(0,0,0,.12);
    '>



    <!-- Header -->

    <tr>

    <td style='
    background:#17375E;
    padding:35px;
    text-align:center;
    '>


    <h1 style='
    margin:0;
    color:#ffffff;
    font-size:28px;
    '>

    PROEN Consulting

    </h1>


    <p style='
    color:#ffffff;
    font-size:15px;
    margin-top:10px;
    '>

    New Website Enquiry Received

    </p>


    </td>

    </tr>





    <!-- Content -->

    <tr>

    <td style='padding:40px;'>


    <h2 style='
    color:#17375E;
    font-size:22px;
    margin-top:0;
    '>

    Customer Details

    </h2>



    <table width='100%'
    cellpadding='12'
    cellspacing='0'
    style='
    border-collapse:collapse;
    font-size:15px;
    color:#333;
    '>



    <tr>

    <td style='border-bottom:1px solid #eeeeee;'>
    <strong>Name</strong>
    </td>

    <td style='border-bottom:1px solid #eeeeee;'>

    $name

    </td>

    </tr>




    <tr>

    <td style='border-bottom:1px solid #eeeeee;'>

    <strong>Email</strong>

    </td>


    <td style='border-bottom:1px solid #eeeeee;'>

    $email

    </td>

    </tr>




    <tr>

    <td style='border-bottom:1px solid #eeeeee;'>

    <strong>Phone</strong>

    </td>


    <td style='border-bottom:1px solid #eeeeee;'>

    $phone

    </td>

    </tr>




    <tr>

    <td style='border-bottom:1px solid #eeeeee;'>

    <strong>Organization</strong>

    </td>


    <td style='border-bottom:1px solid #eeeeee;'>

    $organization

    </td>

    </tr>




    <tr>

    <td style='border-bottom:1px solid #eeeeee;'>

    <strong>Designation</strong>

    </td>


    <td style='border-bottom:1px solid #eeeeee;'>

    $designation

    </td>

    </tr>




    <tr>

    <td style='border-bottom:1px solid #eeeeee;'>

    <strong>Service Domain</strong>

    </td>


    <td style='border-bottom:1px solid #eeeeee;'>

    $domain

    </td>

    </tr>




    <tr>

    <td style='border-bottom:1px solid #eeeeee;'>

    <strong>Location</strong>

    </td>


    <td style='border-bottom:1px solid #eeeeee;'>

    $location

    </td>

    </tr>




    <tr>

    <td valign='top'>

    <strong>Requirements</strong>

    </td>


    <td>

    $description

    </td>


    </tr>



    </table>



    </td>

    </tr>





    <!-- Footer -->

    <tr>

    <td style='
    background:#F69323;
    padding:20px;
    text-align:center;
    color:#ffffff;
    font-size:14px;
    '>


    PROEN Consulting Services<br>

    Enterprise Contract Lifecycle Management Solutions


    </td>

    </tr>




    </table>


    </td>

    </tr>


    </table>


    </body>


    </html>


    ";




    /*
    |--------------------------------------------------------------------------
    | Plain Text Version
    |--------------------------------------------------------------------------
    */


    $mail->AltBody = "

    New PROEN Website Enquiry


    Name:
    $name


    Email:
    $email


    Phone:
    $phone


    Organization:
    $organization


    Designation:
    $designation


    Domain:
    $domain


    Location:
    $location


    Requirement:
    $description

    ";





    /*
    |--------------------------------------------------------------------------
    | Send Email
    |--------------------------------------------------------------------------
    */


    $mail->send();

    return true;
}