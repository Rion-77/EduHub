<?php
require_once "models/quiz.class.php";
require_once "models/question.class.php";

$quiz_id = $_GET['quiz-id'];

/* Handle delete POST */
if (isset($_POST['delete-id'])) {
    $delete_id = $_POST['delete-id'];
    Questions::deleteQuestion($delete_id);
}

$quiz_details = Quiz::readById($quiz_id);
$questions = Questions::readByQuizId($quiz_id);
$question_count = count($questions);

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
        <button type="button" class="btn btn-sm btn-primary mb-2"
            onclick="window.location.href='?page=create-question&quiz-id=<?= $quiz_id ?>'">
            Add Question
        </button>
        <a href="exam-print?quiz-id=<?=$quiz_id?>" class="btn btn-sm btn-alt-info ms-1 mb-2">
                  <i class="fa fa-fw fa-file-invoice me-1"></i> Print Question
        </a>

        <div class="row row-data-container">
            <?php foreach ($questions as $question) { ?>
                <div class="col-md-6 data-row-parent">
                    <div style="display:none" class="data-row-id"><?= $question['id'] ?></div>
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="fs-6 data-row-name"><?= ++$question_counter . ". " . htmlspecialchars($question['question'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <div class="block-options">
                                <a type="button" class="btn btn-sm btn-primary"
                                    href="edit-question?question-id=<?= $question['id'] ?>&quiz-id=<?= $quiz_id ?>">
                                    Edit
                                </a>
                                <button type="button"
                                    class="btn btn-sm btn-danger delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    Delete
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <?php
                            $options = Questions::optionsByQuestionId($question['id']);
                            foreach ($options as $option) { ?>
                                <div class="review-option">
                                    <span class="option-text">• <?= htmlspecialchars($option['option_text'], ENT_QUOTES, 'UTF-8') ?></span>
                                    <?php if ($option["id"] === $question['correct_option_id']) {
                                        echo "<span class='ro-flag' style='color:var(--green-dark)'>✓ Correct</span>";
                                    } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- END Page Content -->
</main>

<?php include_once "views/layouts/delete-modal.php" ?>