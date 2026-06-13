<?php

if(isset($_GET["page"])) {
$page = $_GET["page"];

// echo $page;
if($page == "dashboard" || $page == "dashboard.php") {
    include_once("views/pages/dashboard.php");
} elseif ($page == "users" || $page == "users.php") {
    include_once("views/pages/users/manage.php");
} else {
    include_once("views/pages/dashboard.php");
}
} else {
    include_once("views/pages/dashboard.php");
}