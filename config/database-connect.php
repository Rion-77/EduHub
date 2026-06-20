<?php

//localhost
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "eduhub");

//online-hosting
// define("DB_HOST", "localhost");
// define("DB_USER", "rioncrea_eduhub");
// define("DB_PASS", "eduhub12345@");
// define("DB_NAME", "rioncrea_eduhub");

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if ($db->connect_error) {
    die("Connection error: $db->connect_error");
} /* else {
    echo "Database Conncected Successfully<br>";
} */
