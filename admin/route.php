<?php

if (isset($_GET["page"])) {
    $page = $_GET["page"];

    // echo $page;
    if ($page == "dashboard" || $page == "dashboard.php") {
        include_once("views/pages/dashboard.php");
    } 
    // Users Route
    elseif ($page == "users" || $page == "users.php") {
        include_once("views/pages/users/manage.php");
    } elseif ($page == "create-user" || $page == "create-user.php") {
        include_once("views/pages/users/create.php");
    } elseif ($page == "edit-user" || $page == "edit-user.php") {
        include_once("views/pages/users/update.php");
    } 
    // Roles Route
    elseif ($page == "roles" || $page == "roles.php") {
        include_once("views/pages/roles/manage.php");
    } elseif ($page == "create-role" || $page == "create-role.php") {
        include_once("views/pages/roles/create.php");
    } elseif ($page == "edit-role" || $page == "edit-role.php") {
        include_once("views/pages/roles/update.php");
    } 
    else {
        include_once("views/pages/dashboard.php");
    }
} else {
    include_once("views/pages/dashboard.php");
}
