<?php

if (isset($_GET["page"])) {
    $page = $_GET["page"];

    // echo $page;
    if ($page == "dashboard" || $page == "dashboard.php") {
        include_once("views/pages/dashboard.php");
    } elseif ($page == "users" || $page == "users.php") {
        include_once("views/pages/users/manage.php");
    } elseif ($page == "create-user" || $page == "create-user.php") {
        include_once("views/pages/users/create.php");
    } elseif ($page == "edit-user" || $page == "edit-user.php") {
        include_once("views/pages/users/update.php");
    } else {
        include_once("views/pages/dashboard.php");
    }
} else {
    include_once("views/pages/dashboard.php");
}
