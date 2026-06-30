<?php
require_once "models/quiz.class.php";
require_once "models/question.class.php";

/* ************************************ */
// Get quiz id and its data
$quiz_id = $_GET['quiz-id'];
$quiz_details = Quiz::readById($quiz_id);
$questions    = Questions::readByQuizId($quiz_id);

$total_questions   = count($questions);
$marks_per_question = 1; 
$full_marks          = $total_questions * $marks_per_question;

$letters = ['a', 'b', 'c', 'd', 'e', 'f'];
?>

<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light d-print-none">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">Exam Paper</h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        <?= htmlspecialchars($quiz_details['quiz_name'], ENT_QUOTES, 'UTF-8') ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <div class="block block-rounded">
            <div class="block-header block-header-default d-print-none">
                <div class="block-options">
                    <button type="button" class="btn-block-option" onclick="One.helpers('one-print');">
                        <i class="si si-printer me-1"></i> Print Exam Paper
                    </button>
                </div>
            </div>

            <div class="block-content">
                <div id="exam-paper" class="p-sm-4 p-xl-5">

                    <!-- Exam Header -->
                    <div class="exam-header mb-4">
                        <div class="row gy-2">
                            <div class="col-sm-8">
                                Trainee Name: <span class="fill-line"></span>
                            </div>
                            <div class="col-sm-8">
                                Trainee ID: <span class="fill-line"></span>
                            </div>
                            <div class="col-sm-8">
                                Time: <?= ceil($total_questions * 0.375) ?> Min
                            </div>
                            <div class="col-sm-8">
                                Full Marks: <?= $full_marks ?> = <?= $total_questions ?>x<?= $marks_per_question ?>
                            </div>
                        </div>
                        <hr class="my-3">
                        <h2 class="text-center fs-5 fw-bold mb-0">
                            <?= htmlspecialchars($quiz_details['quiz_name'], ENT_QUOTES, 'UTF-8') ?>
                        </h2>
                        <?php if (!empty($quiz_details['description'])) { ?>
                            <p class="text-center text-muted fs-sm mb-0">
                                <?= htmlspecialchars($quiz_details['description'], ENT_QUOTES, 'UTF-8') ?>
                            </p>
                        <?php } ?>
                    </div>
                    <!-- END Exam Header -->

                    <!-- Questions, two-column layout like the printed paper -->
                    <div class="exam-questions">
                        <?php
                        $question_counter = 0;
                        foreach ($questions as $question) {
                            $question_counter++;
                            $options = Questions::optionsByQuestionId($question['id']);
                        ?>
                            <div class="exam-question">
                                <p class="q-text">
                                    <?= $question_counter ?>.
                                    <?= htmlspecialchars($question['question'], ENT_QUOTES, 'UTF-8') ?>
                                </p>
                                <?php foreach ($options as $i => $option) { ?>
                                    <p class="q-option">
                                        <?= $letters[$i] ?? chr(97 + $i) ?>) <?= htmlspecialchars($option['option_text'], ENT_QUOTES, 'UTF-8') ?>
                                    </p>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- END Questions -->

                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</main>

<style>
    /* Blank line for Name / ID fields */
    .fill-line {
        display: inline-block;
        min-width: 160px;
        border-bottom: 1px solid #555;
    }

    /* Two-column layout for the question list, like the printed paper */
    .exam-questions {
        column-count: 2;
        column-gap: 2.5rem;
    }

    .exam-question {
        break-inside: avoid;
        -webkit-column-break-inside: avoid;
        margin-bottom: 1rem;
    }

    .q-text {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .q-option {
        margin: 0 0 0.15rem 1rem;
    }

    /* Print-specific tightening */
    @media print {
        .exam-questions {
            column-count: 2;
        }

        #exam-paper {
            font-size: 12px;
        }

        .q-option {
            margin-left: 0.9rem;
        }
    }
</style>