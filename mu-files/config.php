<?php
// Database Connect
$db = new mysqli("localhost", "root", "", "eduhub");

if ($db->connect_error) {
    die("Connection error: $db->connect_error");
} else {
    echo "Database Conncected Successfully<br>";
}
