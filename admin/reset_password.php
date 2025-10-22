<?php
session_start();

$otp_success_msg = '';
if (isset($_SESSION['otp_success_msg'])) {
    $otp_success_msg = $_SESSION['otp_success_msg'];
    unset($_SESSION['otp_success_msg']);
}


date_default_timezone_set('Asia/Kolkata');

include './includes/db.php';
include './utils/alerts.php';

// Redirect if not verified
if (!isset($_SESSION['otp_verified']) || !isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit;
}

$email = $_SESSION['reset_email'];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password'])) {
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters.";
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $error = "Password must contain at least one uppercase letter.";
    } elseif (!preg_match('/[\W_]/', $password)) { // Special characters
        $error = "Password must contain at least one special character.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
       
        // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $hashedPassword = $password;

        $stmt = $conn->prepare("UPDATE login_admin SET password = ?, otp = NULL, otp_expires = NULL WHERE username = ?");
        $stmt->bind_param("ss", $hashedPassword, $email);

        if ($stmt->execute()) {
            // Clear session
            unset($_SESSION['otp_verified']);
            unset($_SESSION['reset_email']);

          
            // header("Location: login.php?reset=success");
             $success = "success";
            
        } else {
            $error = "Something went wrong. Please try again.";
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



<h2>Reset Password</h2>

<p style="margin-bottom:40px;">Enter new password</p>


  

      

                 <form class="signinformlogin" method="POST" novalidate>
                   
                        <label for="password" class="loginformlabel">New Password</label>
                        <input type="password" name="password" class="form-control logininputs" required
                               minlength="8"
                               pattern="^(?=.*[A-Z])(?=.*[\W_]).{8,}$"
                               title="Must be at least 8 characters, with one uppercase letter and one special character.">

                                  <div id="emailError" class="error-messagelogin"></div>
                       
                
                        <label for="confirm_password" class="loginformlabel">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control logininputs" required>
                
                    <button type="submit" name="reset_password" class="loginsubmitbutton">Reset Password</button>
                </form>



   

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


           
<!-- <script>
document.addEventListener("DOMContentLoaded", function () {
    Swal.fire({
        icon: 'error',
        width:'450',
        borderRadius:'12',
        title: 'Login Failed',
        text: <?php echo json_encode($loginError); ?>,
        confirmButtonText: 'Try Again',
        customClass: {
            popup: 'swal-login-error-only',
            confirmButton: 'my-swal-confirm-btn'
        }
    });
});
</script> -->

<?php if ($error): ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    Swal.fire({
        icon: 'error',
        width:'450',
        borderRadius:'12',
        title: 'Error',
        text: <?php echo json_encode($error); ?>,
        confirmButtonText: 'Try Again',
        customClass: {
            popup: 'swal-login-error-only',
            confirmButton: 'my-swal-confirm-btn'
        }
    });
});
</script>
<?php endif; ?>



<script>
document.addEventListener("DOMContentLoaded", function () {
  <?php if (!empty($otp_success_msg)): ?>
    Swal.fire({
      icon: 'success',
      title: 'OTP verified ',
      text: <?= json_encode($otp_success_msg) ?>,
      confirmButtonText: 'OK'
    });
  <?php endif; ?>
});
</script>

<?php if ($success === "success"): ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
  Swal.fire({
    icon: 'success',
    title: 'Success',
    text: 'Your password has been reset successfully!',
    confirmButtonText: 'OK'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = 'login.php';
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



  
 





<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
