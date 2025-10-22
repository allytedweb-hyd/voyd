<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



session_start();


include "./includes/db.php";
include './utils/alerts.php';



if (isset($_POST['submit_form'])) {
    $user = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $login_check = mysqli_query($conn, "SELECT * from login_admin where username ='" . $user . "' and password='" . $password . "' and status=2");
    $count = mysqli_num_rows($login_check);
    $fetch_user = mysqli_fetch_array($login_check);
    if ($count == 1) {

        
        $_SESSION['admin_id'] = $fetch_user['id'];
        $_SESSION['role'] = $fetch_user['role_id'];
        $_SESSION['Adminname'] = $fetch_user['admin_name'];
        showToast('Success', 'logged Successfully', 'success');
        echo "<script>window.location.href = 'index.php'</script>";
    } else {
       
        // $_SESSION['login_error'] = "Invalid email or password";
        // header("Location: login.php");
        // exit();
 
    $loginError = "Invalid email or password";


    

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




<!-- <div class="bg-login">
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card mb-0">
                            <div class="card-body p-0">
                                <div class="p-4">
                                    <div class="mb-3 text-center">
                                        <img src="assets/images/voydGreen.png" width="150" alt="" />
                                    </div>
                                    <div class="text-center ">
                                      
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" method="POST" enctype="multipart/form-data">
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="inputEmailAddress"
                                                    name="user_name">
                                                    <p id="emailError" class="error-text "></p>
                                            </div>
                                            <div class="col-12 mt-1">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0"
                                                        id="inputChoosePassword" name="password"> <a href="javascript:;"
                                                        class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                            <p id="passwordError" class="error-text " style="width: 100%;"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-0">
                                             
                                            </div>
                                            <div class="col-md-6 text-end mt-0"><a class="form-check-label ftext" style="color: #1d2026;"
                                                    href="./forgot_password.php">Forgot Password ?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                 
                                                        <button type="button" id="add-color"
                                        class="btn btn-primary px-4 submit">Submit</button>
                                    <button name="submit_form" type="submit" id="submit-color"
                                        class="btn btn-primary px-4 submit d-none">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                  
                                </div>


                       




                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
        </div>
    </div>
</div>
</div>  -->





<!-- <div class="loginbackground">

    <div class="bg-overlay"></div>
    <div class="row">
        <div class="col-md-6"></div>

        <div class="col-md-6 d-flex align-items-center" style="height:100vh; justify-content: center;">
            <div class="formcardlogin">

                <div class="mb-4 text-center">
                    <img src="assets/images/voydGreen.png" width="170" alt="" />
                </div>

            <h1 class="formtitlelogin">Welcome Back!</h1>
            <p class="formsubtitlelogin">Please fill in your Email and Password to Sign In.</p>
            <form class="signinformlogin" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <label for="email" class="loginformlabel">Email Address</label>
                <input type="email" id="email" class="form-control logininputs" name="user_name" placeholder="Your Email Address" >

                <div id="emailError" class="error-message"></div>
                
                <label for="password" class="loginformlabel">Password</label>
              
                
                <div class="password-wrapper">
    <input type="password" id="password" class="form-control logininputs" name="password" placeholder="********" >
    <i class='bx bx-hide toggle-password' onclick="togglePassword()"></i>
</div>
<div id="passwordError" class="error-message"></div>
               
                
                <button type="submit" name="submit_form" class="loginsubmitbutton">Sign In</button>
            </form>
            <p class="loginredirecttext">Forgot Password? <a href="./forgot_password.php" class="loginsignuplink">Click here!</a></p>
        </div>
        </div>


        <?php if (isset($_SESSION['login_error'])): ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Swal.fire({
            icon: 'error',
            width:'400',
            title: 'Login Failed',
            text: '<?php echo $_SESSION['login_error']; ?>',
            confirmButtonText: 'Try Again',
            customClass: {
                popup: 'swal-login-error'
            }
        });
    });
</script>
<?php unset($_SESSION['login_error']); endif; ?>



        </div>
    </div> -->

    
<div class="loginbackground ">

<div class="container " >

<div class="row ">


<div class="col-md-5 d-flex align-items-center justify-content-center">

<div class="logincontainercard " >

<div class="logincard">



<h2>Sign in</h2>

<p style="margin-bottom:40px;">Enter your email and password to access your account</p>


<form class="signinformlogin" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <label for="email" class="loginformlabel">Email</label>
                <input type="email" id="email" class="form-control logininputs" name="user_name" placeholder="Enter your email" >

                <div id="emailError" class="error-messagelogin"></div>
                
                <label for="password" class="loginformlabel mt-2">Password</label>
              
                
                <div class="password-wrapper">
    <input type="password" id="password" class="form-control logininputs" name="password" placeholder="Enter your password" >
    <i class='bx bx-hide toggle-password' onclick="togglePassword()"></i>
</div>
<div id="passwordError" class="error-messagelogin"></div>
               
<p class="loginredirecttext">Forgot Password? <a href="./forgot_password.php" class="loginsignuplink">Change now</a></p>
                
                <button type="submit" name="submit_form" class="loginsubmitbutton">Sign In</button>
            </form>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


            <?php if (isset($loginError)): ?>
<script>
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



<script>
function togglePassword() {
    const passwordInput = document.getElementById("password");
    const icon = document.querySelector(".toggle-password");
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("bx-hide");
        icon.classList.add("bx-show");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("bx-show");
        icon.classList.add("bx-hide");
    }
}
</script>



<script>
function validateForm() {
    let isValid = true;

    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");

    emailError.textContent = "";
    passwordError.textContent = "";

  
    if (email.value.trim() === "") {
        emailError.textContent = "Enter valid email id";
        isValid = false;
    }

  
    if (password.value.trim() === "") {
        passwordError.textContent = "Enter valid password";
        isValid = false;
    }

    return isValid;
}
</script>