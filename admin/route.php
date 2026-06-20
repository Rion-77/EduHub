<?php

if (isset($_GET["page"])) {
    $page = $_GET["page"];

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
    } elseif ($page == "user-profile" || $page == "user-profile.php") {
        include_once("views/pages/users/profile.php");
    } elseif ($page == "user-report" || $page == "user-report.php") {
        include_once("views/pages/users/report.php");
    }
    // Student Route
    elseif ($page == "students" || $page == "students.php") {
        include_once("views/pages/students/manage.php");
    } elseif ($page == "create-student" || $page == "create-student.php") {
        include_once("views/pages/students/create.php");
    } elseif ($page == "edit-student" || $page == "edit-student.php") {
        include_once("views/pages/students/update.php");
    } 
    // Roles Route
    elseif ($page == "roles" || $page == "roles.php") {
        include_once("views/pages/roles/manage.php");
    } elseif ($page == "create-role" || $page == "create-role.php") {
        include_once("views/pages/roles/create.php");
    } elseif ($page == "edit-role" || $page == "edit-role.php") {
        include_once("views/pages/roles/update.php");
    }
    // Exams Route
    elseif ($page == "exams" || $page == "exams.php") {
        include_once("views/pages/exams/manage.php");
    } elseif ($page == "create-exam" || $page == "create-exam.php") {
        include_once("views/pages/exams/create.php");
    } elseif ($page == "edit-exam" || $page == "edit-exam.php") {
        include_once("views/pages/exams/update.php");
    } elseif ($page == "questions" || $page == "questions.php") {
        include_once("views/pages/exams/questions.php");
    } elseif ($page == "create-question" || $page == "create-question.php") {
        include_once("views/pages/exams/create-question.php");
    } elseif ($page == "edit-question" || $page == "edit-question.php") {
        include_once("views/pages/exams/edit-question.php");
    }
    // Course Categoris Route
    elseif ($page == "course-categories" || $page == "course-categories.php") {
        include_once("views/pages/course-categories/manage.php");
    } elseif ($page == "create-course-category" || $page == "create-course-category.php") {
        include_once("views/pages/course-categories/create.php");
    } elseif ($page == "edit-course-category" || $page == "edit-course-category.php") {
        include_once("views/pages/course-categories/update.php");
    }   
    else {
        include_once("views/pages/dashboard.php");
    }
} else {
    include_once("views/pages/dashboard.php");
}
