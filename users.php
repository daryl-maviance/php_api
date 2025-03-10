<?php
require 'db.php';

// Get Users
function getUsers() {
    global $conn;
    $query = "SELECT id, username FROM users";
    $result = $conn->query($query);
    $users = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($users);
}

// Create User
function createUser() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data["username"];
    $password = password_hash($data["password"], PASSWORD_BCRYPT);

    $query = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "User created successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Error creating user"]);
    }
}

// Update User
function updateUser() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data["id"];
    $username = $data["username"];

    $query = "UPDATE users SET username = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $username, $id);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "User updated successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Error updating user"]);
    }
}

// Delete User
function deleteUser() {
    global $conn;
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data["id"];

    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "User deleted successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Error deleting user"]);
    }
}
?>
