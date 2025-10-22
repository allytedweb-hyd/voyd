<?php
session_start();
include './includes/db.php';
include './utils/alerts.php';
include 'generate_admin_otp.php';

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit;
}

$email = trim($_SESSION['reset_email']);
$otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
date_default_timezone_set('Asia/Kolkata');
$expiresAt = date('Y-m-d H:i:s', strtotime('+30 minutes'));

error_log("Updating OTP for: $email");
error_log("OTP: $otp");
error_log("ExpiresAt: $expiresAt");

// Prepare statement
$stmt = $conn->prepare("UPDATE login_admin SET otp = ?, otp_expires = ? WHERE username = ?");
if (!$stmt) {
    error_log("Prepare failed: " . $conn->error);
    $_SESSION['otp_error'] = 'Internal server error.';
    header("Location: verify_otp.php");
    exit;
}

$stmt->bind_param("sss", $otp, $expiresAt, $email);

if (!$stmt->execute()) {
    error_log("Execute failed: " . $stmt->error);
    $_SESSION['otp_error'] = 'Failed to update OTP.';
    header("Location: verify_otp.php");
    exit;
}

if ($stmt->affected_rows === 0) {
    error_log("No rows updated. Possibly username mismatch.");
    $_SESSION['otp_error'] = 'User not found or no changes made.';
    header("Location: verify_otp.php");
    exit;
}

$stmt->close();

if (sendOtpEmail($email, $otp)) {
    $_SESSION['otp_success'] = 'A new OTP has been sent to your email.';
} else {
    $_SESSION['otp_error'] = 'OTP updated but failed to send email.';
}

header("Location: verify_otp.php");
exit;
?>
