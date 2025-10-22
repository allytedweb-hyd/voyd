<?php
include './includes/db.php';
include './utils/alerts.php';

require_once './vendor/autoload.php';

// include './vendor/phpmailer/src/PHPMailer.php';
// include './vendor/phpmailer/src/SMTP.php';
// include './vendor/phpmailer/src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$email = $_POST['mail'];
$query = mysqli_query($conn, "SELECT * from login_admin where username = '" . $email . "' && status IN (1, 2)");
$fetch = mysqli_fetch_array($query);
$id = $fetch['id'];

$mail = new PHPMailer(true);

// $mail->SMTPDebug = 2;
// $mail->Debugoutput = function($str, $level) {
//     echo "Debug level $level; message: $str<br>";
// };

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
    // $mail->addAddress('bolemneelimasai@gmail.com');               //Name is optional
    $mail->addAddress('sekharrebel216@gmail.com');               //Name is optional
    $mail->addAddress('sripriyaallyted@gmail.com');               //Name is optional
    $mail->addAddress($email);               //Name is optional

    //Name is optional
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Urgent Action Needed';
    $mail->Body = '<p>Please click the link below to set New Password.</p><br/>
    <a href="https://mmworkspace.com/mr.Interior/admin/reset-password.php?id=' . $id . '"><h6>CLICK HERE</h6></a>
    ';
    $mail->AltBody = 'VOYD VERIFICATION';

    $send = $mail->send();
    echo $send;

    if ($send == 1) {
        $result = true;
    }
    echo "result is " . $result;

    if ($send == true) {
        showToast('Success', 'Mail Sent Successfully', 'success');
        // echo "<script>alert('success',$id)</script>";
    }
} catch (Exception $e) {
    echo "<script>alert('Failed')</script>";
}
