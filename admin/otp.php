<!DOCTYPE html>
<html lang="en" class="semi-dark">


<!-- Mirrored from codervent.com/rukada/demo/vertical/ltr/auth-basic-reset-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Aug 2023 04:56:21 GMT -->
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
	<title>Mr.Interior</title>
</head>

<body>
	<!-- wrapper -->
<div class="bg-reset">
	<div class="wrapper">
		<div class="authentication-reset-password d-flex align-items-center justify-content-center">
		 <div class="container">
			<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
				<div class="col mx-auto">
                <div class="card mt-5">
                            <div class="otpcard">
                                <div class="col-md-12">

                                    <img src="assets/images/sanmarinelogo1.png" alt="logo" height="81" />

                                    <form class="">
                                        <div class="inputBox">
                                            <ng-otp-input (onInputChange)="onOtpChange($event)" [config]="{length:6}"
                                                class="otp"></ng-otp-input>

                                        </div>

                                        <div class="text-center inputBox mt-3">
                                            <button type="submit" class="btn btn-primary btn-raised mb-0
                                             " name="submit" (click)="submitform()">Submit</button>
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
	<!-- end wrapper -->
</body>


<!-- Mirrored from codervent.com/rukada/demo/vertical/ltr/auth-basic-reset-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Aug 2023 04:56:21 GMT -->
</html>