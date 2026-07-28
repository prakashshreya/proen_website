<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// PHPMailer Files

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'chatbot/mail_helper.php';



/*
|--------------------------------------------------------------------------
| Check Request Method
|--------------------------------------------------------------------------
*/


if($_SERVER["REQUEST_METHOD"] !== "POST"){


    echo "
    <script>
        alert('Invalid request');
        window.location.href='index.html';
    </script>";

    exit;

}



/*
|--------------------------------------------------------------------------
| Sanitize Form Inputs
|--------------------------------------------------------------------------
*/


$name = htmlspecialchars(trim($_POST['name'] ?? ''));

$email = htmlspecialchars(trim($_POST['email'] ?? ''));

$phone = htmlspecialchars(trim($_POST['phone'] ?? ''));

$organization = htmlspecialchars(trim($_POST['organization'] ?? ''));

$designation = htmlspecialchars(trim($_POST['designation'] ?? ''));

$domain = htmlspecialchars(trim($_POST['domain'] ?? ''));

$location = htmlspecialchars(trim($_POST['location'] ?? ''));

$description = htmlspecialchars(trim($_POST['description'] ?? ''));



/*
|--------------------------------------------------------------------------
| Required Field Validation
|--------------------------------------------------------------------------
*/

$lead = [

    "name"=>$name,
    "email"=>$email,
    "phone"=>$phone,
    "organization"=>$organization,
    "designation"=>$designation,
    "domain"=>$domain,
    "location"=>$location,
    "description"=>$description

];


if(
empty($name) ||
empty($email) ||
empty($phone) ||
empty($organization) ||
empty($domain)

){


echo "

<script>

alert('Please fill all required fields.');

window.history.back();

</script>";

exit;


}



/*
|--------------------------------------------------------------------------
| Email Validation
|--------------------------------------------------------------------------
*/


if(!filter_var($email,FILTER_VALIDATE_EMAIL)){


echo "

<script>

alert('Please enter a valid email address.');

window.history.back();

</script>";

exit;


}


/*
|--------------------------------------------------------------------------
| Create PHPMailer Object
|--------------------------------------------------------------------------
*/


try {

    sendLeadEmail($lead);

    echo "

    <script>

    alert('Thank you! Your enquiry has been submitted successfully.');

    window.location.href='index.html';

    </script>

    ";





}

catch(Exception $e){

    error_log(

        date('Y-m-d H:i:s')
        ." - "
        .$e->getMessage()
        .PHP_EOL,

        3,

        "email_error.log"

    );

    echo "

    <script>

    alert('Unable to send enquiry.');

    window.history.back();

    </script>

    ";

}


?>