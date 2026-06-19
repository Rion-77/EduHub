<?php
require_once "models/quiz.class.php";
require_once "models/course-category.class.php";

/* ************************************* */
// Gets all categories 
$categories = CourseCategory::readAll();


/* ************************************* */
// Gets values from form and save them to database
if (isset($_POST['submit-btn'])) {
    $quiz_name = $_POST['val-quiz-name'];
    $category_id = $_POST['val-quiz-category-id'];
    $description = $_POST['val-description'];
    $time_limit = $_POST['val-time-limit'];
    $score = $_POST['val-score'];

    // Format time limit in hh:mm:ss 
    if($time_limit > 59) {
        $hours_in_time_limit = floor($time_limit / 60);
        $minute_in_time_limit = $time_limit - (60 * $hours_in_time_limit);

        $hours_in_time_limit = str_pad($hours_in_time_limit, 2, '0', STR_PAD_LEFT);
        $minute_in_time_limit = str_pad($minute_in_time_limit, 2, '0', STR_PAD_LEFT);

         $time_limit = "$hours_in_time_limit:$minute_in_time_limit:00"; 
    } else {
        $time_limit = "00:$time_limit:00";
    }

    
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

   // Save data to database
    $quiz = new Quiz(null, $quiz_name, $category_id, $description, $time_limit, $score, null);
    $quiz->create();

    // Redirect to exam page
    header("Location: exams?message=Exam+'$quiz_name'+Has+been+Added");
    
}
?>

<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">
                        Add Exams
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Add a new exam
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Exams</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Add Exam
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
                            <div class="mb-4">
                                <label class="form-label" for="val-quiz-name">Quiz name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="val-quiz-name" name="val-quiz-name" placeholder="Enter quiz name">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="val-quiz-category-id">Categories<span class="text-danger">*</span></label>
                                <select class="form-select" id="val-quiz-category-id" name="val-quiz-category-id">
                                    <option value="">Please select</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category['id'] ?>"><?= ucfirst($category['name']) ?></option>
                                    <?php endforeach ?>

                                </select>
                            </div>
                            <!-- Description -->
                            <div class="mb-4">
                                <label class="form-label" for="val-description">Description</label>
                                <textarea type="text" class="form-control" id="val-description" name="val-description" placeholder="Exam description"></textarea>
                            </div>
                            <!-- Time -->
                            <div class="mb-4">
                                <label class="form-label" for="val-time-limit">Time Limit (In Minutes)</label>
                                <input type="number" class="form-control" id="val-time-limit" name="val-time-limit" placeholder="Enter exam time limit in minute">
                            </div>
                            <!-- Score -->
                            <div class="mb-4">
                                <label class="form-label" for="val-score">Score</label>
                                <input type="number" class="form-control" id="val-score" name="val-score" placeholder="Enter exam time limit in minute">
                            </div>
                        </div>
                    </div>
                    <!-- END Regular -->

                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7">
                            <button type="submit" class="btn btn-alt-primary" name="submit-btn">Add Exam</button>
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