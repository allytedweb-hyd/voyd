

<!DOCTYPE html>
<html lang="en" class="semi-dark">




<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
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

	<title>VOYD-Admin</title>
</head>

<body>


<?php
include "./includes/db.php";
include "./utils/alerts.php";

if (isset($_POST['submit_btn'])) {
	if (!isset($_GET['id'])) {
        echo "<script>alert('ID parameter missing');</script>";
        exit;
    }

	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$conformpassword = mysqli_real_escape_string($conn, $_POST['conform-password']);
	$id = 1;
	// echo "<script>alert($id)</script>";


	$forgetQuery = "UPDATE login_admin SET password='" . $password . "',conform_password='" . $conformpassword . "' where id='" . $_GET['id'] . "' && status IN (1, 2)";
	// echo $forgetQuery;
	$query = mysqli_query($conn, $forgetQuery);
	if ($query) {
		// echo "<script>alert('successfully updated')</script>";

		echo "
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: 'Password updated successfully!',
    confirmButtonText: 'OK'
}).then((result) => {
    if (result.isConfirmed) {
        window.location.href = './login.php';
    }
});
</script>";
		
		
	} else {
		echo "<script>alert('failed to update')</script>";
	}
}
?>





	<!-- <div class="bg-reset">
		<div class="wrapper">
			<div class="authentication-reset-password d-flex align-items-center justify-content-center">
				<div class="container">
					<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
						<div class="col mx-auto">
							<div class="card">
								<div class="card-body">
									<div class="p-4">
										<div class="mb-4 text-center">
											<img src="assets/images/" width="60" alt="" />
										</div>
										<div class="text-start mb-4">
											<h5 class="">Generate New Password</h5>
											
										</div>
										<div class="form-body">
											<form class="row g-3" method="POST" enctype="multipart/form-data">
												<div class="mb-3 mt-4">
													<label class="form-label">New Password</label>
													<input type="text" class="form-control" placeholder="Enter new password" name="password" />
												</div>
												<div class="mb-4">
													<label class="form-label">Confirm Password</label>
													<input type="text" class="form-control" placeholder="Confirm password" name="conform-password" />
												</div>
												<div class="d-grid gap-2">
													<button type="submit" class="btn btn-primary" name="submit_btn">Change Password</button>
													<a href="./login.php" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
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
	</div> -->
	



	<div class="loginbackground">

    <div class="bg-overlay"></div>
    <div class="row">
        <div class="col-md-6"></div>

        <div class="col-md-6 d-flex align-items-center" style="height:100vh; justify-content: center;">
            <div class="formcardlogin">

                <div class="mb-1 text-center">
                    <img src="assets/images/voydGreen.png" width="170" alt="" />
                </div>

            <h1 class="formtitlelogin">Generate Password!</h1>
            <p class="formsubtitlelogin mb-1">Please fill in your new password </p>
            <form class="signinformlogin" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                <label for="password" class="loginformlabel mt-1">Enter Password</label>
                <input type="text" id="password" class="form-control logininputs" name="password" placeholder=" Password" >

                <div id="emailError" class="error-message"></div>
                <label for="conpassword" class="loginformlabel mt-1">Confirm Password</label>
                <input type="text" id="conpassword" class="form-control logininputs" name="conform-password" placeholder="Confirm Password" >

                <div id="emailError" class="error-message"></div>
                
              
               
                
                <button type="submit" name="submit_btn"  class="loginsubmitbutton mt-1">Submit</button>
            </form>
            <p class="loginredirecttext mt-2">Back to login page? <a href="./login.php" class="loginsignuplink">Click here!</a></p>
        </div>
        </div>

													


        </div>
    </div>




</body>




</html>


<script>
function validateForm() {
	const password = document.getElementById('password').value.trim();
	const conpassword = document.getElementById('conpassword').value.trim();

	if (!password || !conpassword) {
		Swal.fire('Missing Input', 'Please fill in both password fields.', 'warning');
		return false;
	}

	if (password.length < 6) {
		Swal.fire('Too Short', 'Password must be at least 6 characters long.', 'error');
		return false;
	}

	if (password !== conpassword) {
		Swal.fire('Mismatch', 'Passwords do not match.', 'error');
		return false;
	}

	return true; 
}
</script>