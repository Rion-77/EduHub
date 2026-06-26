<?php
require_once 'config/database-connect.php';

$result = $db->query("SELECT * FROM users");

// $jstext = file_get_contents('php://input');

$users = $result->fetch_all(MYSQLI_ASSOC);
// print_r($users);

// echo json_encode("This is " . $jstext);

print json_encode($users);

/* 
// Get raw JSON data from the request body
$jsonInput = file_get_contents('php://input');

// Decode JSON into a PHP associative array
$data = json_decode($jsonInput, true);

// Access the values sent by JavaScript
$name = $data['username'] ?? 'Guest';

// Prepare a response array
$response = [
    "status" => "success",
    "message" => "Hello " . $name . ", your data was processed on the server!"
];

// Set headers and print JSON back to JS
// header('Content-Type: application/json'); 
echo json_encode($response);
*/
?>