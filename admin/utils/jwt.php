<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Authorization');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json, charset=utf-8');

include "../Authentication/vendor/autoload.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function createJWT($userId)
{
    $key = "Mr.Interior%123&^$#@";
    $issuedAt = new DateTimeImmutable();
    $expire = $issuedAt->modify('+1440 minutes')->getTimestamp();
    $payload = array(
        "userId" => $userId,
        'iat' => $issuedAt->getTimestamp(),
        'nbf' => $issuedAt->getTimestamp(),
        'exp' => $expire,
    );
    $jwt = JWT::encode($payload, $key, 'HS256');
    $status = ["status" => true, "token" => $jwt];
    return $status;
}

function verifyJWT($token)
{
    $key = "Mr.Interior%123&^$#@";
    try {
        $jwt = JWT::decode($token, new Key($key, 'HS256'));
        $customer_id = $jwt->customer_id;
        $status = ["status" => true, "message" => "Authorized", 'customer_id' => $customer_id];
    } catch (\Exception $e) {
        $status = ["status" => false, "error" => $e, "message" => "Token has expired"];
    }
    return $status;
}
