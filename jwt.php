<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require 'vendor/autoload.php';

$secret_key = "your_secret_key";

function generateJWT($username) {
    global $secret_key;
    $payload = [
        "iss" => "localhost",
        "iat" => time(),
        "exp" => time() + (60 * 60), // 1 hour expiry
        "username" => $username
    ];
    return JWT::encode($payload, $secret_key, 'HS256');
}

function verifyJWT($token) {
    global $secret_key;
    try {
        return JWT::decode($token, new Key($secret_key, 'HS256'));
    } catch (Exception $e) {
        return false;
    }
}
?>
