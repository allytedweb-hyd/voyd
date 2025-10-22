<?php
#################################   Importing package Information   #################################
include '../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function generateAuthToken($loginid)
{
    $key = 'Mr.Interior%123&^$#@';
    $date = new DateTimeImmutable();
    $expire_at = $date->modify('+1400 minutes')->getTimestamp();
    $payload = [
        'iat' => $date->getTimestamp(),
        'nbf' => $date->getTimestamp(),
        'exp' => $expire_at,
        'userId' => $loginid,
    ];
    $jwt = JWT::encode($payload, $key, 'HS256');
    $stat = ['status' => true, 'message' => 'user loggedin successfully', 'token' => $jwt];
    return $stat;
}


function verifyAuthToken($token)
{
    $key = 'Mr.Interior%123&^$#@';
    try {
        $jwt = JWT::decode($token, new Key($key, 'HS256'));
        $loginid = $jwt->userId;
        $status = ["status" => true, "message" => "Authorized", 'loginid' => $loginid];
    } catch (\Exception $e) {
        // $status = ["status" => false, "error" => $e, "message" => "Token has expired"];
          return ["status" => false, "error" => $e->getMessage(), "message" => "Token has expired"];
        echo json_encode($status);
        exit();
    }
    return $status;
}
