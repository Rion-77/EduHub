<?php
require_once "models/quiz.class.php";
require_once "models/question.class.php";

/* ***************************************** */
// Get quiz ID
if (isset($_GET['quiz-id'])) {
    $quiz_id = (int) $_GET['quiz-id'];
} else {
    header("location: exams");
    exit;
}

/* ***************************************** */
// Get question ID 
if (isset($_GET['question-id'])) {
    $question_id = (int) $_GET['question-id'];
} else {
    header("location: questions?quiz-id=$quiz_id");
    exit;
}

/* ***************************************** */
// Get quiz details
$quiz_details = Quiz::readById($quiz_id);

/* ***************************************** */
// Fetch question & existing options
$question_data = Questions::questionById($question_id);

// Redirect if question not found
if (!$question_data) {
    header("location: questions?quiz-id=$quiz_id");
    exit;
}


$existing_options = Questions::optionsByQuestionId($question_id);

$error = '';
$success = '';

// ── Handle update ──────────────────────────
if (isset($_POST['update_btn'])) {
    $question_text = $_POST['question'];
    $question_type_id = $_POST['question_type_id'] ?? 1;
    $options = $_POST['option_text'] ?? [];
    $correct_index = (int) ($_POST['correct_option'] ?? -1);
    $option_ids = $_POST['option_id'] ?? [];  // Hidden inputs for existing option IDs

    // Update the question itself using the class method
    $question = new Questions($question_id, $question_text, $quiz_id, $question_type_id);
    $result = $question->updateQuestion();

    if ($result !== true) {
        $error = 'Failed to update question: ' . $result;
    } else {
        // Process each option
        foreach ($options as $i => $option_text) {
            $option_text = trim($option_text);
            if ($option_text === '') continue;

            $is_correct = ($i === $correct_index) ? 1 : 0;
            $option_id = isset($option_ids[$i]) ? (int) $option_ids[$i] : 0;

            if ($option_id > 0) {
                // Update existing option
                $opt_result = $question->updateOption($option_id, $option_text, $is_correct);
            } else {
                // Create new option (if field was empty before and now filled)
                $opt_result = $question->createOption($option_text, $question_id, $is_correct);
            }

            if ($opt_result !== true) {
                $error = 'Option error: ' . $opt_result;
                break;
            }
        }

        if (!$error) {
            $success = 'Question updated successfully!';
            // Refresh to show updated data
            header("Location: edit-question.php?quiz-id=$quiz_id&question-id=$question_id");
            exit;
        }
    }
}
?>
<main id="main-container">
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-1">
            Edit Question for "<?= htmlspecialchars($quiz_details['quiz_name']) ?>"
          </h1>
          <h2 class="fs-base lh-base fw-medium text-muted mb-0">
            Modify the question and its options.
          </h2>
        </div>
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="javascript:void(0)">Exam</a>
            </li>
            <li class="breadcrumb-item">
              <a class="link-fx" href="questions?quiz-id=<?= $quiz_id ?>">Questions</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              Edit Question
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <?php if ($error): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($error) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($success) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <!-- Basic -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">Edit Question</h3>
      </div>
      <div class="block-content block-content-full">
        <form action="" method="POST" enctype="multipart/form-data">
          <!-- Hidden quiz ID and question ID -->
          <input type="hidden" name="quiz_id" value="<?= $quiz_id ?>">
          <input type="hidden" name="question_id" value="<?= $question_id ?>">

          <div class="row push">
            <div class="col-lg-8 col-xl-5">
              <!-- Question textarea -->
              <div class="mb-4">
                <label class="form-label" for="question-input">Question</label>
                <textarea class="form-control" id="question-input" name="question" rows="4" placeholder="Type your question here..." required><?= htmlspecialchars($question_data['question']) ?></textarea>
              </div>
              <!-- Question type select -->
              <div class="mb-4">
                <label class="form-label" for="question-type-select">Question Type</label>
                <select class="form-select" id="question-type-select" name="question_type_id" required>
                    <option value="1" <?= $question_data['question_type_id'] == 1 ? 'selected' : '' ?>>Mcq</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Options section -->
          <div class="row push">
            <div class="col-lg-8 col-xl-5">
              <label class="form-label">Options</label>
              <?php
              // Ensure we show exactly 4 option fields
              $display_options = $existing_options;
              if (count($display_options) < 4) {
                  for ($i = count($display_options); $i < 4; $i++) {
                      $display_options[] = ['id' => 0, 'option_text' => '', 'is_correct' => 0];
                  }
              }
              foreach ($display_options as $i => $opt):
                  $opt_id = $opt['id'];
                  $opt_val = htmlspecialchars($opt['option_text']);
                  $checked = ($opt['is_correct'] == 1) ? 'checked' : '';
              ?>
                <div class="input-group mb-2">
                  <div class="input-group-text">
                    <input class="form-check-input mt-0" type="radio" name="correct_option" value="<?= $i ?>" <?= $checked ?> aria-label="Mark as correct">
                  </div>
                  <input type="text" class="form-control" name="option_text[<?= $i ?>]" placeholder="Option <?= $i + 1 ?>" value="<?= $opt_val ?>">
                  <!-- Hidden field to carry the option ID for existing options -->
                  <input type="hidden" name="option_id[<?= $i ?>]" value="<?= $opt_id ?>">
                </div>
              <?php endforeach; ?>
              <div class="form-text">Select the radio button next to the correct answer.</div>
            </div>
          </div>

          <!-- Submit -->
          <div class="row push">
            <div class="col-lg-8 col-xl-5">
              <div class="mb-4">
                <button type="submit" name="update_btn" class="btn btn-primary">
                  <i class="fa fa-check opacity-50 me-1"></i> Update Question
                </button>
                <a href="questions?quiz-id=<?= $quiz_id ?>" class="btn btn-secondary ms-2">Cancel</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- END Basic -->
  </div>
  <!-- END Page Content -->
</main>