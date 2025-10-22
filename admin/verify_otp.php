

<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



session_start();

$otp_success = '';
if (isset($_SESSION['otp_success'])) {
    $otp_success = $_SESSION['otp_success'];
    unset($_SESSION['otp_success']);
}


date_default_timezone_set('Asia/Kolkata');

include './includes/db.php';
include './utils/alerts.php';

// Redirect if no OTP session exists
if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit;
}

$email = $_SESSION['reset_email'];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify_otp'])) {
    $entered_otp = trim($_POST['otp']);

    if (empty($entered_otp)) {
        $error = "Please enter the OTP.";
    } elseif (!is_numeric($entered_otp)) {
        $error = "OTP must be numeric.";
    } else {
        
        $stmt = $conn->prepare("SELECT otp, otp_expires FROM login_admin WHERE username = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            $error = "No record found for the email.";
        } else {
            $db_otp = $row['otp'];
            $otp_expires = $row['otp_expires'];

            if ($db_otp != $entered_otp) {
                $error = "Invalid OTP.";
            } elseif (strtotime($otp_expires) < time()) {
                // $error = "OTP has expired.";
                $_SESSION['otp_expired'] = true;
header("Location: verify_otp.php");
exit;

            } else {
                
                $_SESSION['otp_verified'] = true;
                 $_SESSION['otp_success_msg'] = 'Reset your password.';
                header("Location: reset_password.php");
                exit;
            }
        }
    }
}



?>
<link rel="icon" href="assets/images/voydGeen1.png" type="image/png" />

<style>
    .otp-input-wrapper {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.otp-input {
    width: 45px;
    height: 55px;
    font-size: 22px;
    text-align: center;
    border: 2px solid #ccc;
    border-radius: 8px;
    transition: border-color 0.2s ease-in-out, box-shadow 0.2s;
    background-color: #f9f9f9;
    outline: none;
}

.otp-input:focus {
    border-color: #3c8dbc;
    box-shadow: 0 0 5px rgba(60, 141, 188, 0.4);
    background-color: #fff;
}

</style>



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



<h2>OTP</h2>

<p style="margin-bottom:40px;">Enter otp received to your mail</p>


  

      <form class="signinformlogin" method="POST" enctype="multipart/form-data">
              

                     
                <label for="otp" class="loginformlabel">OTP</label>
          

                <div class="d-flex justify-content-between otp-input-wrapper mb-3">
  <?php for ($i = 1; $i <= 6; $i++): ?>
    <input type="number" class="otp-input form-control text-center" maxlength="1" id="otp<?= $i ?>" oninput="moveNext(this, <?= $i ?>)" onkeydown="handleBackspace(event, <?= $i ?>)" autocomplete="off" inputmode="numeric" >
  <?php endfor; ?>
</div>
<input type="hidden" name="otp" id="otp_hidden">

            
            <button type="submit" name="verify_otp" class="loginsubmitbutton">Verify</button>
                
            
               
<p class="loginredirecttext mt-2">Back to login? <a href="./login.php" class="loginsignuplink">Click here</a></p>
                
          
            </form>

  <?php if (!empty($error)): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: <?= json_encode($error) ?>,
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>

   <?php if (!empty($_SESSION['otp_expired'])): ?>
  <script>
    Swal.fire({
      icon: 'warning',
      title: 'OTP Expired',
      text: 'Your OTP has expired. Would you like to resend it?',
      showCancelButton: true,
      confirmButtonText: 'Resend OTP',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
       
        window.location.href = 'resend_otp.php';
      } else if (result.isDismissed) {
       
        window.location.href = 'login.php';
      }
    });
  </script>
  <?php unset($_SESSION['otp_expired']); ?>
<?php endif; ?>



 
<script>
document.addEventListener("DOMContentLoaded", function () {
  <?php if (!empty($otp_success)): ?>
    Swal.fire({
      icon: 'success',
      title: 'OTP Sent',
      text: <?= json_encode($otp_success) ?>,
      confirmButtonText: 'OK'
    });
  <?php endif; ?>
});
</script>


   

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


           


<script>
  function moveNext(input, index) {
    const value = input.value;
    if (value.length === 1 && index < 6) {
      document.getElementById('otp' + (index + 1)).focus();
    }

    assembleOTP();
  }

  function handleBackspace(event, index) {
    if (event.key === 'Backspace' && event.target.value === '' && index > 1) {
      document.getElementById('otp' + (index - 1)).focus();
    }
  }

  function assembleOTP() {
    let otp = '';
    for (let i = 1; i <= 6; i++) {
      otp += document.getElementById('otp' + i).value;
    }
    document.getElementById('otp_hidden').value = otp;
  }
</script>



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



 





<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
