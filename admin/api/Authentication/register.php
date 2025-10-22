<?php
ini_set('display_errors', 1);
ini_set('display_startup_error', 1);
error_reporting(E_ALL);


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");
    header("HTTP/1.1 200 OK");
    die();
}

include "../../includes/db.php";

$activeTab = $_GET["registrationType"];
@$refer = $_GET["refferalCode"];





$json = file_get_contents('php://input');
$regData = json_decode($json);



// customer Details
@$firstName = $regData->firstName;
@$lastName = $regData->lastName;
@$mobileNo = $regData->mobileNo;
@$place = $regData->place;
@$email = $regData->email;
@$password = $regData->password;
@$cusHashedPassword = password_hash($password, PASSWORD_DEFAULT);
@$state = $regData->state;
@$city = $regData->city;
@$street = $regData->street;
@$refferedBy = $regData->refferedBy;
@$companyType = $regData->customerCompany;
@$panNo = $regData->customerPanNo;
@$gstNo = $regData->gstNo;
@$companyName = $regData->customerCompanyName;
@$address = $regData->address;
// vendor Details
@$vendorFirstName = $regData->VendorFirstName;
@$vendorLastName = $regData->vendorLastName;
@$vendorMobile = $regData->vendorMobileNo;
@$vendorMail = $regData->vendorEmail;
@$vendorCompany = $regData->vendorCompany;
@$vendorCompanyName = $regData->vendorCompanyName;
@$vendorGst = $regData->vendorGstNo;
@$vendorAadhar = $regData->vendorAadharNo;
@$vendorPan = $regData->vendorPanNo;
@$vendorClass = $regData->vendorClassification;
@$vendorLocality = $regData->vendorLocality;
@$vendorCity = $regData->vendorCity;
@$vendorState = $regData->vendorState;
@$vendorAddress = $regData->vendorAddress;






// $vendor_email_check = mysqli_query($conn, "SELECT * FROM vendor WHERE status=1 AND (vendor_email='" . $vendorMail . "' OR vendor_mobile='" . $vendorMobile . "'  OR vendor_pancard='" . $vendorPan . "' OR vendor_gst='" . $vendorGst . "')");
// $vendor_email_count = mysqli_num_rows($vendor_email_check);




if ($activeTab === "Customer") {
    $uniqueId = strtoupper('VOYD' . uniqid() . '1');
    if (!empty($regData->email_verified)) {
        $email = $regData->email;
    } else {
        $email = $email;
    }

    $refferedByConfirm = null;
    if ($refer === null || $refer === "null" || $refer === "") {
        $refferedByConfirm = $uniqueId;
    } else {
        $getRefferInfo = mysqli_query($conn, "SELECT * FROM customer WHERE refferal_code='" . $refer . "' && status=1");
        $fetchRefferInfo = mysqli_fetch_array($getRefferInfo);

        if (mysqli_num_rows($getRefferInfo) >= 1) {
            $refferedByConfirm = $fetchRefferInfo['refferal_code'];
        } else {
            $Cusresponse = ['status' => false, 'response' => 'Invalid refferal code'];
            echo json_encode($Cusresponse);
            exit();
        }
    }

    $reg_email_check = mysqli_query($conn, "SELECT * FROM customer WHERE status=1 AND customer_email='" . $email . "' ");
    $email_count = mysqli_num_rows($reg_email_check);


    if ($email_count >= 1) {
        $Cusresponse = ['status' => false, 'response' => 'A customer already exists with this email or mobile number.'];
    } else {

        if (!empty($regData->email_verified)) {
            $firstName = $regData->given_name;
            $lastName = $regData->family_name;
            $email = $regData->email;
            $googleId = $regData->sub;
            $profilePic = $regData->picture;

            $Cusregister = mysqli_query($conn, "INSERT INTO customer SET refferal_code='" . $uniqueId . "', first_name='" . $firstName . "', last_name='" . $lastName . "', customer_email='" . $email . "', place='" . $place . "', password='google password', refered_by='" . $refferedByConfirm . "', gst_num='" . $gstNo . "', company_name='" . $companyName . "', address='" . $address . "', status=1, login_type='google',google_id='" . $googleId . "',profile_img='$profilePic'");
        } else {
            $Cusregister = mysqli_query($conn, "INSERT INTO customer SET refferal_code='" . $uniqueId . "', first_name='" . $firstName . "', last_name='" . $lastName . "', customer_email='" . $email . "', customer_mobile='" . $mobileNo . "',place='" . $place . "',password='" . $cusHashedPassword . "',state='" . $state . "',city='" . $city . "',street='" . $street . "', refered_by='" . $refferedByConfirm . "', gst_num='" . $gstNo . "',company_type='" . $companyType . "',pan_no='" . $panNo . "', company_name='" . $companyName . "', address='" . $address . "',login_type='direct',status=1");
        }
        if ($Cusregister) {
            $Cusresponse = ['status' => true, 'response' => "Successfully Registered as Customer", 'refferalCode' => $refferedByConfirm];
        } else {
            $Cusresponse = ['status' => false, 'response' => 'Unable to Register as Customer'];
        }
    }
    echo json_encode($Cusresponse);
} else {
    $vendorConditions = [];
    if (!empty($vendorMail)) $vendorConditions[] = "vendor_email='" . mysqli_real_escape_string($conn, $vendorMail) . "'";
    if (!empty($vendorMobile)) $vendorConditions[] = "vendor_mobile='" . mysqli_real_escape_string($conn, $vendorMobile) . "'";
    if (!empty($vendorPan)) $vendorConditions[] = "vendor_pancard='" . mysqli_real_escape_string($conn, $vendorPan) . "'";
    if (!empty($vendorGst)) $vendorConditions[] = "vendor_gst='" . mysqli_real_escape_string($conn, $vendorGst) . "'";

    $vendor_email_count = 0;
    if (count($vendorConditions) > 0) {
        $vendorWhereClause = implode(" OR ", $vendorConditions);
        $vendorQuery = "SELECT * FROM vendor WHERE status=1 AND ($vendorWhereClause)";
        $vendorResult = mysqli_query($conn, $vendorQuery);
        $vendor_email_count = mysqli_num_rows($vendorResult);
    }




    if ($vendor_email_count > 0) {
        $venresponse = ['status' => false, 'response' => 'Vendor already exists'];
    } else {

        $venRegister = mysqli_query($conn, "INSERT INTO vendor SET vendor_firstname='" . $vendorFirstName . "', vendor_lastname='" . $vendorLastName . "', vendor_mobile='" . $vendorMobile . "', vendor_company='" . $vendorCompany . "' ,company_name='" . $vendorCompanyName . "',vendor_email='" . $vendorMail . "',vendor_aadhar='" . $vendorAadhar . "',vendor_pancard='" . $vendorPan . "',vendor_class='" . $vendorClass . "', vendor_locality='" . $vendorLocality . "', vendor_city='" . $vendorCity . "', vendor_state='" . $vendorState . "', vendor_gst='" . $vendorGst . "',vendor_address='" . $vendorAddress . "',status=1");



        if ($venRegister) {
            $venresponse = ['status' => true, 'response' => "Successfully Registered as Vendor"];
        } else {
            $venresponse = ['status' => false, 'response' => 'Unable to Register'];
        }
    }
    echo json_encode($venresponse);
}
