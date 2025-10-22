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

include '../Authentication/authToken.php';
include "../../includes/db.php";


$headers = apache_request_headers();

if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'unauthorized']);
    exit();
}

@$token = str_replace('Bearer ', '', $headers['Authorization']);
if (empty($token)) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Unauthorized Access']);
    exit();
}

$response = verifyAuthToken($token);
if (!$response['status']) {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Unauthorized Access']);
    exit();
}



$json = file_get_contents('php://input');
$regData = json_decode($json);

@$quotetype = $regData->quoteType;

// echo json_encode($regData);
// exit();

// customer Details
@$customerId = $response['loginid'];
@$firstName = $regData->cusFirstName;
@$type = $regData->quoteType;
@$projectStatus = $regData->projectStatus;
@$lastName = $regData->cusLastName;
@$mobileNo = $regData->cusMobile;
@$email = $regData->cusEmail;
@$state = $regData->cusState;
@$city = $regData->cusCity;
@$locality = $regData->cusLocation;
@$street = $regData->cusStreet;
@$nearBy = $regData->nearBy;
@$mapLink = $regData->cusMapLink;
@$property = $regData->cusProperty;
@$propertyType = $regData->cusPropertyType;
@$projectType = $regData->cusProjectType;
@$selectedRooms = $regData->cusSelectedRooms;
@$propertyCity = $regData->cusPropertyCity;

@$propertyLocation = $regData->cusPropertyLocation;
@$budget = $regData->cusBudget;
@$utilizedAmount = $regData->utilizedBudget;
@$productClassification = $regData->productClass;
@$manufactureClassification = $regData->manufactureClass;


// Convert object items to array (if needed)
$finalArray = [];
foreach ($selectedRooms as $item) {
    if (is_array($item)) {
        $finalArray[] = $item;
    } elseif (is_object($item)) {
        $finalArray[] = (array) $item;
    }
}

// Encode as JSON
$selectedRoomsJson = json_encode($finalArray);



// Check the user self or others


if ($type == 'self') {
    $getCustomer = mysqli_query($conn, "SELECT * FROM customer WHERE customer_id='" . $customerId . "' && status=1");
    $getCusDetails = mysqli_fetch_array($getCustomer);
    $regFirstName = $getCusDetails['first_name'];
    $regLastName = $getCusDetails['last_name'];
    $regEmail = $getCusDetails['customer_email'];
    $regMbl = $getCusDetails['customer_mobile'];
    $regstate = $getCusDetails['state'];
    $regCity = $getCusDetails['place'];

    $self_query = "INSERT INTO questionnaire SET customer_id='" . $customerId . "', quote_type='" . $type . "',first_name='" . $regFirstName . "', last_name='" . $regLastName . "', email = '" . $regEmail . "', mobile='" . $regMbl . "',state='" . $regstate . "',city='" . $regCity . "',locality='" . $locality . "', street='" . $street . "',near_by='" . $nearBy . "', map_link='" . $mapLink . "', property='" . $property . "', property_type='" . $propertyType . "', project_type='" . $projectType . "',selected_rooms ='" . $selectedRoomsJson . "',property_city='" . $propertyCity . "',property_location='" . $propertyLocation . "',budget='" . $budget . "',product_classification='" . $productClassification . "',manufacturer_classification='" . $manufactureClassification . "',utilized_amount='" . $utilizedAmount . "', project_status='" . $projectStatus . "', status=1";
    // exit(json_encode($self_query));

    $Cusregister = mysqli_query($conn, $self_query);
} else {
    $Cusregister = mysqli_query($conn, "INSERT INTO questionnaire SET customer_id='" . $customerId . "',quote_type='" . $type . "', first_name='" . $firstName . "', last_name='" . $lastName . "', email = '" . $email . "', mobile='" . $mobileNo . "',state='" . $state . "',city='" . $city . "',locality='" . $locality . "', street='" . $street . "', map_link='" . $mapLink . "',near_by='" . $nearBy . "', property='" . $property . "', property_type='" . $propertyType . "',selected_rooms ='" . $selectedRoomsJson . "',property_city='" . $propertyCity . "',property_location='" . $propertyLocation . "',budget='" . $budget . "',product_classification='" . $productClassification . "',manufacturer_classification='" . $manufactureClassification . "', project_status='" . $projectStatus . "',utilized_amount='" . $utilizedAmount . "', status=1");
}


if ($Cusregister) {
    $Cusresponse = ['status' => true, 'response' => "Quote submitted successfully"];
} else {
    $Cusresponse = ['status' => false, 'response' => 'Failed To Submit'];
}

echo json_encode($Cusresponse);
