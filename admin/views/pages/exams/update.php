<?php
require_once "models/quiz.class.php";
require_once "models/course-category.class.php";

/* ************************************* */
// Gets exam id and data using the id
if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    header("Location: exams");
}

$row = Quiz::readById($id);


// echo "<pre>";
// print_r($row);
// echo "</pre>";

if (empty($row)) {
    header("Location: exams?message=Quiz+with+id='$id'+Do+not+Exists");
}
/* ************************************* */
// Gets all categories 
$categories = CourseCategory::readAll();

/* ************************************* */
// database Time to minute converter function
function timeToMinutes($time)
{
    $divided_time = explode(":", $time);

    $hours = (int)$divided_time[0];
    $minutes = (int)$divided_time[1];
    $seconds = isset($divided_time[2]) ? (int)$divided_time[2] : 0;

    return ($hours * 60) + $minutes + round($seconds / 60);
}



/* ************************************* */
// Gets values from form and save them to database
if (isset($_POST['submit-btn'])) {
    $quiz_name = $_POST['val-quiz-name'];
    $category_id = $_POST['val-quiz-category-id'];
    $description = $_POST['val-description'];
    $time_limit = $_POST['val-time-limit'];
    $score = $_POST['val-score'];

    // Format time limit in hh:mm:ss 
    if ($time_limit > 59) {
        $hours_in_time_limit = floor($time_limit / 60);
        $minute_in_time_limit = $time_limit - (60 * $hours_in_time_limit);

        $hours_in_time_limit = str_pad($hours_in_time_limit, 2, '0', STR_PAD_LEFT);
        $minute_in_time_limit = str_pad($minute_in_time_limit, 2, '0', STR_PAD_LEFT);

        $time_limit = "$hours_in_time_limit:$minute_in_time_limit:00";
    } else {
        $time_limit = "00:$time_limit:00";
    }



    // Update data
    $quiz = new Quiz($_GET["id"], $quiz_name, $category_id, $description, $time_limit, $score, null);
    $quiz->update();

    // Redirect to exam page
    header("Location: exams?message=Exam+'$quiz_name'+Has+been+Updated");
}
?>

<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">
                        Edit Exams
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Edit a existing exam
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Exams</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Edit Exam
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">

        <form class="js-validation" method="POST" novalidate="novalidate" enctype="multipart/form-data">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">New Exam</h3>
                </div>
                <div class="block-content block-content-full">
                    <!-- Regular -->

                    <div class="row items-push">
                        <div class="col-lg-8 col-xl-5">
                            <!-- Quiz Name -->
                            <div class="mb-4">
                                <label class="form-label" for="val-quiz-name">Quiz name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-quiz-name" name="val-quiz-name" value="<?= $row['quiz_name'] ?>">
                            </div>
                            <!-- Categories -->
                            <div class="mb-4">
                                <label class="form-label" for="val-quiz-category-id">Categories<span class="text-danger">*</span></label>
                                <select class="form-select" id="val-quiz-category-id" name="val-quiz-category-id">
                                    <option value="">Please select</option>
                                    <?php foreach ($categories as $category) :
                                        $selected = $row["quiz_category_id"] == $category['id'] ? "selected" : "";
                                    ?>
                                        <option value="<?= $category['id'] ?>" <?= $selected ?>><?= ucfirst($category['name']) ?></option>
                                    <?php endforeach ?>

                                </select>
                            </div>
                            <!-- Description -->
                            <div class="mb-4">
                                <label class="form-label" for="val-description">Description</label>
                                <textarea type="text" class="form-control" id="val-description" name="val-description" placeholder="Exam description"><?= $row['description'] ?></textarea>
                            </div>
                            <!-- Time -->
                            <div class="mb-4">
                                <label class="form-label" for="val-time-limit">Time Limit (In Minutes)</label>
                                <input type="number" class="form-control" id="val-time-limit" name="val-time-limit" value="<?= timeToMinutes($row['time_limit']) ?>">
                            </div>
                            <!-- Score -->
                            <div class="mb-4">
                                <label class="form-label" for="val-score">Score</label>
                                <input type="number" class="form-control" id="val-score" name="val-score" value="<?= $row['score'] ?>">
                            </div>
                        </div>
                    </div>
                    <!-- END Regular -->

                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7">
                            <button type="submit" class="btn btn-alt-primary" name="submit-btn">Update Exam</button>
                        </div>
                    </div>
                    <!-- END Submit -->
                </div>
            </div>
        </form>
        <!-- jQuery Validation -->
    </div>
    <!-- END Page Content -->
</main>