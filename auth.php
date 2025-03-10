<?php
require 'db.php';
require 'jwt.php'; // For JWT token handling

// Register User
function registerUser() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data["username"];
    $password = password_hash($data["password"], PASSWORD_BCRYPT);

    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "User registered successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Error registering user"]);
    }
}

// Login User
function loginUser() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data["username"];
    $password = $data["password"];

    $query = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($password, $result["password"])) {
        $token = generateJWT($username);
        echo json_encode(["message" => "Login successful", "token" => $token]);
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Invalid credentials"]);
    }
}
?>
