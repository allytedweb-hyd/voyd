<!-- <?php
include "./includes/db.php";
?>


<!DOCTYPE html>
<html lang="en" class="semi-dark">




<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="assets/images/voydGeen1.png" type="image/png" />

	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>

	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<title>VOYD-Admin</title>
</head>

<body class="">

	






	<div class="loginbackground">

    <div class="bg-overlay"></div>
    <div class="row">
        <div class="col-md-6"></div>

        <div class="col-md-6 d-flex align-items-center" style="height:100vh; justify-content: center;">
            <div class="formcardlogin">

                <div class="mb-1 text-center">
                    <img src="assets/images/voydGreen.png" width="170" alt="" />
                </div>

            <h1 class="formtitlelogin">Forgot Password!</h1>
            <p class="formsubtitlelogin mb-1">Please fill in your registered Email </p>
            <form class="signinformlogin" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                <label for="email" class="loginformlabel mt-1">Email Address</label>
                <input type="email" id="email" class="form-control logininputs" style="box-shadow: rgba(17, 17, 26, 0.05) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 0px 8px;" name="user_name" placeholder="Your Email Address" >

                <div id="emailError" class="error-message"></div>
                
              
               
                
                <button type="submit" name="send" onclick="send()" class="loginsubmitbutton mt-1">Submit</button>
            </form>
            <p class="loginredirecttext mt-2">Back to login page? <a href="./login.php" class="loginsignuplink text-black">Click here!</a></p>
        </div>
        </div>


       



        </div>
    </div>




</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    function validateForm() {
        var email = document.getElementById("email").value.trim();

        if (email === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Email',
				width:400,
                text: 'Please enter your email address.',
                confirmButtonText: 'OK'
            });
            return false; 
        }

        
        $.ajax({
            type: 'POST',
            url: 'forgot-mail.php',
            data: { mail: email },
            success: function(response) {
                console.log(response);
                Swal.fire({
                    icon: 'success',
                    title: 'Email Sent',
                    text: 'You’ll receive reset mail shortly.',
                    confirmButtonText: 'OK'

});
            },
            error: function(err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: 'Could not contact the server. Try again later.',
                });
            }
        });

        return false; 
    }
</script> -->


<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



session_start();



date_default_timezone_set('Asia/Kolkata'); 

include "./includes/db.php";
include './utils/alerts.php';
include 'generate_admin_otp.php';


$fp_error = '';
$fp_success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_fp'])) {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $fp_error = "Please enter your email address.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fp_error = "Invalid email format.";
    } else {
        // Check if email exists
        $stmt = $conn->prepare("SELECT id FROM login_admin WHERE username = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $fp_error = "This email is not registered.";
        } else {
            $otp = rand(100000, 999999);
            $expiresAt = date('Y-m-d H:i:s', strtotime('+30 minutes'));
            // $expiresAt = date('Y-m-d H:i:s', strtotime('+180 seconds'));

            // Save OTP and expiry to DB
            $stmtUpdate = $conn->prepare("UPDATE login_admin SET otp = ?, otp_expires = ? WHERE username = ?");
            $stmtUpdate->bind_param("sss", $otp, $expiresAt, $email);

            if ($stmtUpdate->execute()) {
                $_SESSION['reset_email'] = $email;
                $_SESSION['reset_otp'] = $otp;
                $_SESSION['otp_created'] = time();

                if (sendOtpEmail($email, $otp)) {
                        $_SESSION['otp_success'] = 'OTP has been sent to your email.';
                    header("Location: verify_otp.php");
                    exit;
                } else {
                    $fp_error = "Failed to send email. Please try again.";
                }
            } else {
                $fp_error = "Failed to save OTP in the database.";
            }
        }
    }
}


?>
<link rel="icon" href="assets/images/voydGeen1.png" type="image/png" />




<!--plugins-->
<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
<!-- loader-->
<link href="assets/css/pace.min.css" rel="stylesheet" />
<script src="assets/js/pace.min.js"></script>
<!-- Bootstrap CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
<link href="assets/css/app.css" rel="stylesheet">
<link href="assets/css/icons.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<div class="loginbackground ">

<div class="container " >

<div class="row ">


<div class="col-md-5 d-flex align-items-center justify-content-center">

<div class="logincontainercard " >

<div class="logincard">



<h2>Forgot Password</h2>

<p style="margin-bottom:40px;">Please enter your registered email address</p>


  

      <form class="signinformlogin" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                <label for="email" class="loginformlabel">Email</label>
                <input type="email" id="email" class="form-control logininputs" name="email" placeholder="Enter your email" >

                <div id="emailError" class="error-messagelogin"></div>
                
            
               
<p class="loginredirecttext">Back to login? <a href="./login.php" class="loginsignuplink">Click here</a></p>
                
                <button type="submit" name="submit_fp" class="loginsubmitbutton">Submit</button>
            </form>



   

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


            <?php if (isset($otp_success)): ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    Swal.fire({
        icon: 'success',
        width:'450',
        borderRadius:'12',
        title: 'Success',
        text: <?php echo json_encode($otp_success); ?>,
        confirmButtonText: 'Ok',
        customClass: {
            popup: 'swal-login-error-only',
            confirmButton: 'my-swal-confirm-btn'
        }
    });
});
</script>
<?php endif; ?>

</div>

</div>


</div>
<div class="col-md-7">

<div class="lightsdiv">
    <img src="assets/images/lights.png" alt="">
</div>

<div class="logodiv">
    <img src="assets/images/voydGreen.png" alt="">
</div>

<div class="row d-flex justify-content-center cardsqualitytrust">
 
    <div class="subtitlecards">
        <div class="subcard d-flex">
            <div class="iconcard">
                <img src="assets/images/Vector.png" alt="">
            </div>
            <div class="contentcard">
                <div class="titlee">
                Quality
                </div>
                <div class="subtitlee">
                We pay attention to every single details.
                </div>
            </div>
        </div>
    </div>
    <div class="subtitlecards">
    <div class="subcard d-flex">
    <div class="iconcard">
                <img src="assets/images/check (4).png" alt="">
            </div>
            <div class="contentcard">
                <div class="titlee">
                Trusted
                </div>
                <div class="subtitlee">
                Over 400 clients all over the world love us
                </div>
            </div>
        </div>
        </div>
    </div>
        
    
</div>


</div>


</div>
</div>



  <script>
    function validateForm() {
      const emailInput = document.getElementById('email');
      const emailError = document.getElementById('emailError');
      const email = emailInput.value.trim();

      emailError.textContent = '';

      if (!email) {
        emailError.textContent = "Email is required.";
        return false;
      }

      const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
      if (!emailPattern.test(email)) {
        emailError.textContent = "Invalid email address.";
        return false;
      }

      return true;
    }

    <?php if (!empty($fp_error)): ?>
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: <?= json_encode($fp_error) ?>,
        confirmButtonText: 'OK'
      });
    <?php endif; ?>

    <?php if (!empty($fp_success)): ?>
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: <?= json_encode($fp_success) ?>,
        confirmButtonText: 'OK'
      });
    <?php endif; ?>
  </script>

 





<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
