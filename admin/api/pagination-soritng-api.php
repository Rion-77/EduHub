<?php
require_once "../config/db.php";
require_once "../models/quiz.class.php";

$page_no = $_POST['pagination-no'];
$display_item = $_POST['dislay-item'];
echo json_encode(Quiz::readAll($page_no, $display_item));

?>