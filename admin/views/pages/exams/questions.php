<?php
require_once "models/quiz.class.php";
require_once "models/question.class.php";

// if (!isset($_GET['quiz-id'])) {
//     header("location: courses.php");
// }

/* ************************************** */
// Quiz Details
$quiz_id = $_GET['quiz-id'];

$quiz_details = Quiz::readById($quiz_id);

echo "<pre>";
print_r($quiz_details);
echo "</pre>";


/* ************************************** */
// Questions with correct option

$questions = Questions::readByQuizId($quiz_id);

$question_count = count($questions);

// echo "<pre>";
// print_r($questions);
// echo "</pre>";




/* ************************************** */
// Counters 
$question_counter = 0;
$total_question = count($questions);



?>


<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">
                        <?= $quiz_details['quiz_name'] ?>
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        <?= $quiz_details['description'] ?>
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Exams</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                           <?= $quiz_details['quiz_name'] ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">

        <!-- Bootstrap Buttons in Options -->
        <div class="row">
            <?php foreach ($questions as $question) { ?>
                <div class="col-md-6">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="fs-6"><?= ++$question_counter . ". " . htmlspecialchars($question['question'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <div class="block-options">
                                <button type="button" class="btn btn-sm btn-primary">Edit</button>
                                <button type="button" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </div>
                        <div class="block-content">
                            <?php

                            $options = Questions::optionsByQuestionId($question['id']);


                            foreach ($options as $option) {
                            ?>

                                <div class="review-option">
                                    <!-- <div class="ro-letter">B</div> -->
                                    <span class="option-text"><?= htmlspecialchars($option['option_text'], ENT_QUOTES, 'UTF-8') ?></span>
                                    <?php

                                    if ($option["id"] === $question['correct_option_id']) {
                                        echo "<span class='ro-flag' style='color:var(--green-dark)'>✓ Correct</span>";
                                    }
                                    ?>

                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- END Bootstrap Buttons in Options -->


    </div>
    <!-- END Page Content -->
</main>