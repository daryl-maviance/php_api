<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header("Content-Type: application/json");
require 'db.php';  // Database connection
require 'auth.php'; // Authentication
require 'users.php'; // User CRUD operations

$request_method = $_SERVER["REQUEST_METHOD"];
$endpoint = $_GET["endpoint"] ?? '';

switch ($endpoint) {
    case 'register':
        if ($request_method == 'POST') registerUser();
        break;
    case 'login':
        if ($request_method == 'POST') loginUser();
        break;
    case 'users':
        if ($request_method == 'GET') getUsers();
        if ($request_method == 'POST') createUser();
        if ($request_method == 'PUT') updateUser();
        if ($request_method == 'DELETE') deleteUser();
        break;
    default:
        http_response_code(404);
        echo json_encode(["message" => "Endpoint not found"]);
}
?>
