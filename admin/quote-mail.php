<?php

session_start();

// include 'includes/db.php';
// include './utils/alerts.php';

// require_once 'vendor/autoload.php';




// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;



// use Dompdf\Dompdf;
// $html = $_POST['invoice'];
// $dompdf = new Dompdf();
// $dompdf->loadHtml($html);

// $pdfs = $dompdf->render();
// $pdf = $dompdf->output();



// $mail = new PHPMailer(true);

// $recipientEmail = $_POST['mail'];

// try {
//     $mail->isSMTP();                                            
//     $mail->Host = 'smtp.hostinger.com';                     
//     $mail->SMTPAuth = true;                                  
//     $mail->Username = 'mrinterior@mmworkspace.com';                    
//     $mail->Password = 'Interior@321$#';                                
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
//     $mail->Port = 465;                                    


//     $mail->setFrom('mrinterior@mmworkspace.com', 'VOYD Interiors');

//     $mail->addAddress('sekharrebel216@gmail.com');
//     $mail->addAddress($recipientEmail);
//     $mail->addAddress('rufusprakashkalla1@gmail.com');


//     $mail->isHTML(true);                                 
//     $mail->Subject = 'Your Quotation';
//     $mail->Body = '<p>Please check the quotation pdf.</p><br/>';
//     $mail->addStringAttachment($pdf, 'invoices.pdf');
//     $mail->AltBody = 'VOYD VERIFICATION';

//     $send = $mail->send();

//     if ($send) {
//         echo 'mail sent successfully';
//     }
// } catch (Exception $e) {
//     echo 'failed', $e, 'failed';
// }













use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;

require 'vendor/autoload.php';
include './includes/db.php';

$toEmail = $_POST['mail'] ?? '';
$queId = $_GET['queId'] ?? $_POST['queId'] ?? '';
$cusId = $_GET['cusId'] ?? $_POST['cusId'] ?? '';

if (empty($toEmail) || empty($queId) || empty($cusId)) {
  http_response_code(400);
  echo 'Required data missing.';
  exit;
}

if (!filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo 'Invalid email address.';
  exit;
}

// Fetch main quote and customer data
$stmt = $conn->prepare("SELECT * FROM questionnaire tbl1 JOIN quotation tbl2 ON tbl1.que_id = tbl2.que_id WHERE tbl1.customer_id = ? AND tbl1.status = 1 AND tbl1.que_id = ?");
$stmt->bind_param("ss", $cusId, $queId);
$stmt->execute();
$result = $stmt->get_result();
$fet = $result->fetch_assoc();
$stmt->close();

if (!$fet) {
  http_response_code(404);
  echo 'Quotation not found.';
  exit;
}

// Fetch excess items
$excessItems = [];
$stmt2 = $conn->prepare("SELECT * FROM quotation_addon WHERE que_id = ? AND customer_id = ? AND status = 1");
$stmt2->bind_param("ss", $queId, $cusId);
$stmt2->execute();
$res2 = $stmt2->get_result();
while ($row = $res2->fetch_assoc()) {
  $excessItems[] = $row;
}
$stmt2->close();


$managerId = $fet['manager_id'] ?? '';


$managerEmail = '';
if (!empty($managerId)) {
    $managerStmt = $conn->prepare("SELECT * FROM login_admin WHERE id = ?");
    $managerStmt->bind_param("s", $managerId);
    $managerStmt->execute();
    $managerResult = $managerStmt->get_result();
    $manager = $managerResult->fetch_assoc();
    $managerStmt->close();

    $managerEmail = $manager['username'] ?? '';
}

$sessionAdminId = $_SESSION['admin_id'];
$sessionUserEmail = '';


$sessionStmt = $conn->prepare("SELECT username FROM login_admin WHERE id = ?");
$sessionStmt->bind_param("s", $sessionAdminId);
$sessionStmt->execute();
$sessionRes = $sessionStmt->get_result();
$sessionUser = $sessionRes->fetch_assoc();
$sessionStmt->close();





// Fetch main quote items (assuming $quoteData is fetched similarly)
// For example, if you have a function or query to get $quoteData, do it here.
// For demo, let's assume $quoteData is empty or fetched elsewhere.
$quoteData = []; // Replace with actual fetching logic

// Prepare logo base64
$logoPath = __DIR__ . '/assets/images/voydGreen.png';
$logoBase64 = base64_encode(file_get_contents($logoPath));
$imagePath = __DIR__ . '/assets/images/teamImgBg.png';
$imageBase64 = base64_encode(file_get_contents($imagePath));

// Build items rows HTML
$grandTotal = 0;
$i = 1;
$itemsHtml = '';

// Main quote items
if (!empty($quoteData)) {
  foreach ($quoteData as $areaName => $areaData) {
    foreach ($areaData['tabs'] as $tabIndex => $tab) {
      if (empty($tab))
        continue;
      foreach ($tab as $item) {
        $price = isset($item['minimum_price']) ? (float) $item['minimum_price'] : 0;
        $total = $price;
        $grandTotal += $total;
        $itemsHtml .= '<tr>
                    <td style="border:1px solid #ddd; text-align:center;">' . $i++ . '</td>
                    <td style="border:1px solid #ddd;">' . htmlspecialchars($item['element_name_display'] . '/' . $item['model']) . '</td>
                    <td style="border:1px solid #ddd; text-align:center;">1</td>
                    <td style="border:1px solid #ddd; text-align:right;"><span style="font-family: \'DejaVu Sans\';">₹</span> ' . number_format($price, 2) . '</td>
                    <td style="border:1px solid #ddd; text-align:right;"><span style="font-family: \'DejaVu Sans\';">₹</span> ' . number_format($total, 2) . '</td>
                </tr>';
      }
    }
  }
}

// Excess items
foreach ($excessItems as $excess) {
  $amount = $excess['quantity'] * $excess['item_cost'];
  $grandTotal += $amount;
  $itemsHtml .= '<tr>
        <td style="border:1px solid #ddd; text-align:center;">' . $i++ . '</td>
        <td style="border:1px solid #ddd;">' . htmlspecialchars($excess['item_name']) . ' (Excess Item)</td>
        <td style="border:1px solid #ddd; text-align:center;">' . $excess['quantity'] . '</td>
        <td style="border:1px solid #ddd; text-align:right;"><span style="font-family: \'DejaVu Sans\';">₹</span> ' . number_format($excess['item_cost'], 2) . '</td>
        <td style="border:1px solid #ddd; text-align:right;"><span style="font-family: \'DejaVu Sans\';">₹</span> ' . number_format($amount, 2) . '</td>
    </tr>';
}

$gst = $grandTotal * 0.18;
$finalTotal = $grandTotal + $gst;

// Build full HTML for Dompdf
$dompdfHtml = '
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Project Estimation Bill</title>
<style>
  @page {
    margin: 0px;
  }


</style>
</head>
<body style="font-family: Arial, sans-serif; color: #4c5258; background-color: #e9ecef; margin:0; padding:5px;">
  <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom: 20px;">
    <tr>
      <td style="width: 50%; vertical-align: middle; padding-left: 10px;">
        <img src="data:image/png;base64,' . $logoBase64 . '" alt="VOYD Logo" style="width: 220px; display: block;" />
      </td>
      <td style="width: 50%; vertical-align: middle; padding-right: 10px; text-align: right;">
        <h3 style="margin: 0; font-weight: 500; font-size: 24px;">Project Estimation Bill</h3>
        <p style="margin: 5px 0 0 0; color: #696969; font-size: 16px;">Effortlessly handle your estimation here.</p>
      </td>
    </tr>
  </table>

  <table width="100%" cellpadding="10" cellspacing="0" style=" border-collapse: separate; border-spacing: 20px 0; margin-bottom: 20px; font-size: 14px;">
    <tr>
      <td style="width: 40%; padding: 10px 12px;
    border-radius: 12px; border: 5px solid #e7f3ff;
    background: #f6f8fc; vertical-align: top;">
        <h4 style="margin-top: 0;">Estimated By:</h4>
        <strong>VOYD Interior Execution Partner</strong><br />
        Plot No 28/A, Survey No 40, Khajaguda, Serilingampalle (M), Telangana 500032<br />
        Email: info@voyd.com<br />
        Phone: +91 9876543212
      </td>
      
      <td style="width: 40%; padding: 10px 12px;
    border-radius: 12px; border: 5px solid #e7f3ff;
    background: #f6f8fc; vertical-align: top;">
        <h4 style="margin-top: 0;">Estimation to:</h4>
       <span><img src="data:image/png;base64,' . $imageBase64 . '" alt="Profile image" style="width: 20px; border-radius:50%; display: block;" /></span> <strong>' . htmlspecialchars($fet['first_name'] . ' ' . $fet['last_name']) . '</strong><br />
        ' . htmlspecialchars($fet['street'] . ', ' . $fet['locality'] . ', ' . $fet['city'] . ', ' . $fet['state']) . '<br />
        Email: ' . htmlspecialchars($fet['email']) . '<br />
        Phone: +91 ' . htmlspecialchars($fet['mobile']) . '
      </td>
         <td style="width: 20%; padding: 10px 12px;
    border-radius: 12px; border: 1px solid black;
    background: #f6f8fc; vertical-align: top;">
        <h4 style="margin: 0;">Estimation Amount</h4>
        <h2 style="margin: 5px 0;"><span style="font-family: \'DejaVu Sans\';">₹</span> ' . number_format($fet['budget'], 2) . '</h2>
        <p style="margin: 0;">INR</p>
        <p style="margin: 0;">Date: ' . date("M d, Y", strtotime($fet['created_At'])) . '</p>
      </td>
    </tr>
  </table>

 

  <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse; background: #fff; border-top-left-radius: 20px; border-top-right-radius: 20px;">
    <thead>
      <tr style="background-color: #3c6d59; color: white; border-radius:20px;">
        <th style="border: 1px solid #ddd; border-top-left-radius: 20px;">S.No</th>
        <th style="border: 1px solid #ddd;">Excess Items</th>
        <th style="border: 1px solid #ddd;">Quantity</th>
        <th style="border: 1px solid #ddd;">Cost</th>
        <th style="border: 1px solid #ddd; border-top-right-radius: 20px;">Amount</th>
      </tr>
    </thead>
    <tbody>
      ' . $itemsHtml . '
    </tbody>
  </table>

  <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse; background: #fff; margin-top: 10px;">
    <tr>
      <td style="border: 1px solid #ddd; text-align: right; font-weight: bold;" colspan="4">Total</td>
      <td style="border: 1px solid #ddd; text-align: right;"><span style="font-family: \'DejaVu Sans\';">₹</span> ' . number_format($grandTotal, 2) . '</td>
    </tr>
    <tr>
      <td style="border: 1px solid #ddd; text-align: right; font-weight: bold;" colspan="4">GST (18%)</td>
      <td style="border: 1px solid #ddd; text-align: right;"><span style="font-family: \'DejaVu Sans\';">₹</span> ' . number_format($gst, 2) . '</td>
    </tr>
    <tr>
      <td style="border: 1px solid #ddd; text-align: right; font-weight: bold;" colspan="4">Grand Total</td>
      <td style="border: 1px solid #ddd; text-align: right;"><span style="font-family: \'DejaVu Sans\';">₹</span> ' . number_format($finalTotal, 2) . '</td>
    </tr>
  </table>

  <table width="100%" cellpadding="10" cellspacing="0" style="background: #fff; border-collapse: collapse; margin-top: 20px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
    <tr>
      <td style="border: 1px solid #ddd;">
        <h4>Terms & Conditions:</h4>
        <p>Fees and payment terms will be established in the contract or agreement prior to the commencement of the project.</p>
      </td>
    </tr>
  <tr>
  <td style="border: 1px solid #ddd; padding: 10px; ">
    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
      <tr>
    
        <td style="width: 70%; vertical-align: top; border-bottom-left-radius: 20px;">
          <h4>Contact:</h4>
          <p>VOYD Interior Designing Solutions</p>
          <p>www.voyd.com</p>
          <p>Email: info@voyd.com | Phone: +91 98765 43210</p>
        </td>

        
        <td style="width: 30%; text-align: right; vertical-align: middle; margin-top:20px; border-bottom-right-radius: 20px;">
          <img src="data:image/png;base64,' . $logoBase64 . '" alt="VOYD Logo" style="width: 200px; display: block;" />
        </td>
      </tr>
    </table>
  </td>
</tr>

  </table>

</body>
</html>
';

// Generate PDF
$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('defaultFont', 'DejaVu Sans');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($dompdfHtml);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$pdf = $dompdf->output();

// Send email with PDF attachment
$mail = new PHPMailer(true);
try {
  $mail->isSMTP();
  $mail->Host = 'smtp.hostinger.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'mrinterior@mmworkspace.com';
  $mail->Password = 'Interior@321$#';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port = 465;

  $mail->setFrom('mrinterior@mmworkspace.com', 'VOYD Interiors');
  $mail->addAddress($toEmail);
  $mail->addAddress($managerEmail);
  $mail->addAddress($sessionUser);
  $mail->addAddress('rufusprakashkalla1@gmail.com');
  $mail->addAddress('sekharrebel216@gmail.com');

  $mail->isHTML(true);
  $mail->Subject = 'Your Project Estimation Invoice';
  $mail->Body = '<p>Dear ' . htmlspecialchars($fet['first_name']) . ',</p><p>Please find your quotation attached as a PDF.</p><p>Regards,<br>VOYD Interiors</p>';
  $mail->AltBody = 'Quotation PDF attached.';

  $mail->addStringAttachment($pdf, 'quotation.pdf');
  $mail->send();
  echo 'Email sent successfully!';
} catch (Exception $e) {
  http_response_code(500);
  echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>