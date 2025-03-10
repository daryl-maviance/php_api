<?php
$servername = "localhost";
$username = "root";  // Change if necessary
$password = "daryl";      // Change if necessary
$dbname = "api_testing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["message" => "Database Connection Failed"]));
}
?>
