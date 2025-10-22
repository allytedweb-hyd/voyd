<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

// Always set your timezone!
date_default_timezone_set('Asia/Kolkata');

// Get current date & time
$today = date('Y-m-d');
$currentTime = date('H:i:s');

// Prepare query for any sale today
$query = mysqli_query(
    $conn,
    "SELECT * FROM super_sale 
     WHERE start_date = '$today'
     AND status = 1"
);

$count = mysqli_num_rows($query);
$salesData = [];

if ($count > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $saleStartDateTime = strtotime($row['start_date'] . ' ' . $row['start_time']);
        $saleEndDateTime = strtotime($row['end_date'] . ' ' . $row['end_time']);
        $now = time();

        if ($now >= $saleStartDateTime && $now <= $saleEndDateTime) {
            // Sale is running
            $secondsRemaining = $saleEndDateTime - $now;
            $timeRemaining = formatSeconds($secondsRemaining);

            $salesData[] = [
                "sale" => $row,
                "ends_in" => $timeRemaining
            ];
        } elseif ($now < $saleStartDateTime) {
            // Sale exists but hasn't started yet
            $secondsUntilStart = $saleStartDateTime - $now;
            $timeUntilStart = formatSeconds($secondsUntilStart);

            $result = [
                "status" => false,
                "response" => [
                    "message" => "Sale exists today, but has not started yet.",
                    "starts_in" => $timeUntilStart
                ]
            ];
            echo json_encode($result);
            exit;
        }
    }

    if (!empty($salesData)) {
        $result = [
            "status" => true,
            "response" => $salesData
        ];
    } else {
        $result = [
            "status" => false,
            "response" => "No ongoing sale right now."
        ];
    }
} else {
    $result = [
        "status" => false,
        "response" => "No sale today."
    ];
}

echo json_encode($result);


// Helper function to format seconds as "1d: 4h: 30m: 44s"
function formatSeconds($seconds)
{
    $days = floor($seconds / (24 * 60 * 60));
    $hours = floor(($seconds % (24 * 60 * 60)) / (60 * 60));
    $minutes = floor(($seconds % (60 * 60)) / 60);
    $secs = $seconds % 60;

    return sprintf(
        "%02dd: %02dh: %02dm: %02ds",
        $days,
        $hours,
        $minutes,
        $secs
    );
}
