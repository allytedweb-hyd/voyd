<?php

include "../../includes/db.php";
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin,authorization");


ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);



require_once "../../vendor/autoload.php";

include '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
include '../../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$json = file_get_contents('php://input');
$data = json_decode($json);

$userMail = $data->mailId;
$userId = $data->customerId;

$query = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id='" . $userId . "' && status=1");
$fetch = mysqli_fetch_array($query);



$mail = new PHPMailer(true);

try {
  $mail->isSMTP();                                            //Send using SMTP
  $mail->Host = 'smtp.hostinger.com';                     //Set the SMTP server to send through
  $mail->SMTPAuth = true;                                   //Enable SMTP authentication
  $mail->Username = 'mrinterior@mmworkspace.com';                     //SMTP username
  $mail->Password = 'Interior@321$#';                               //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
  $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //Recipients
  $mail->setFrom('mrinterior@mmworkspace.com', 'VOYD Interiors');
  $mail->addAddress($userMail);               //Name is optional   
  $mail->addAddress("sekharrebel216@gmail.com");
  $mail->addAddress("sripriyaallyted@gmail.com");

  $mail->isHTML(true);                                  //Set email format to HTML
  $mail->Subject = 'Reset Your Password';
  $mail->Body = '<!DOCTYPE html>
    <html>
      <head>
        <title></title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <style>
          /* email styles */
          body {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333333;
            background-color: #F2F2F2;
          }
          .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #FFFFFF;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
          }
          h1, h2, p {
            margin: 0 0 20px 0;
          }
          h1 {
            font-size: 24px;
          }
          h2 {
            font-size: 20px;
          }
          p {
            font-size: 16px;
          }
          .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0084FF;
            color: #FFFFFF;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
          }
          .btn:hover {
            background-color: #0073E6;
          }
          .reset-password-btn{
            height:auto !important;
            width: auto !important;
            padding: 5px 15px ;
            background-color: blue;
            border:none !important;
            cursor: pointer;
          }
          /* OTP styles */
          .otp {
            display: inline-block;
            padding: 10px 20px;
            background-color: #FFFFFF;
            border: 2px solid #0084FF;
            border-radius: 5px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            letter-spacing: 10px;
            color: #333333;
          }
        </style>
      </head>
      <body>
        <div class="container">
        <div class="row">
        <div class="description-container">
        <p>Hii ' . $fetch['first_name'] . " " . $fetch['last_name'] . ',</br> 
        Forgot Password...? Here is the Link to reset your Password, Click the Button below to reset Password.
        </p>
        <div>
        <a href="http://localhost:5173/resetPassword" target = "_blank">
<button class="reset-password-btn">Reset Password</button>
</a>
<p>If you not, Please Ignore this Mail </br> Good Luck...!, Team Mr.Interior</p>
</div>
        </div>
        </div>
        </div>
      </body>
    </html>
    ';
  $mail->AltBody = 'Reset Password';

  $send = $mail->send();

  if ($send) {
    $stat = ['success' => 'Mail sent successfully', 'status' => true];
  } else {
    $stat = ['success' => 'Failed to send, Please try again', 'status' => false];
  }
} catch (Exception $e) {
  $stat = ["status" => false, "error" => $e, "message" => "Failed"];
}

echo json_encode($stat);
