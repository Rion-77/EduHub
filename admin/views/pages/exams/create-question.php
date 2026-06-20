<?php
require_once "models/quiz.class.php";
require_once "models/question.class.php";

/* ******************************************* */
// Get quiz ID from URL, redirect if missing
if (isset($_GET['quiz-id'])) {
  $quiz_id = (int) $_GET['quiz-id'];
} else {
  header("location: exams");
  exit;
}

/* ******************************************* */
// Gets quiz details 
$quiz_details = Quiz::readById($quiz_id);


$error = '';
$success = '';

/* ******************************************* */
// Add question and options
if (isset($_POST['create_btn'])) {
  $question_text = $_POST['question'];
  $question_type_id = $_POST['question_type_id'] ?? 1;
  $options = $_POST['option_text'] ?? [];
  $correct_index = $_POST['correct_option'];

  // echo "<pre>";
  // print_r($options);
  // echo "</pre>";
  // echo "Correct index: " . $correct_index . "<br>";



  // Create the question
  $question = new Questions(null, $question_text, $quiz_id, $question_type_id);
  $result = $question->createQuestion();

  if ($result !== true) {
    $error = 'Failed to create question: ' . $result;
  } else {
    // Gets the last inserted question ID
    global $db;
    $question_id = $db->insert_id;

    // Inserts options
    $option_created = false;
    foreach ($options as $i => $option_text) {
      $option_text = trim($option_text);
      if ($option_text === '') continue;

      $is_correct = ($i === (int)$correct_index) ? 1 : 0; 
      $opt_result = $question->createOption($option_text, $question_id, $is_correct);
      if ($opt_result !== true) {
        $error = 'Option error: ' . $opt_result;
        break;
      }
      $option_created = true;
    }

    if (!$error) {
      $success = 'Question created successfully!';
      // Optional: reset form or redirect
      header("Location: questions?quiz-id=$quiz_id"); exit;
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
            Create Question for "<?= htmlspecialchars($quiz_details['quiz_name']) ?>"
          </h1>
          <h2 class="fs-base lh-base fw-medium text-muted mb-0">
            Add a new question to this quiz.
          </h2>
        </div>
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="javascript:void(0)">Exam</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              Create Question
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <!-- Alerts -->
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
        <h3 class="block-title">New Question</h3>
      </div>
      <div class="block-content block-content-full">
        <form action="" method="POST" enctype="multipart/form-data">
          <!-- Hidden quiz ID -->
          <input type="hidden" name="quiz_id" value="<?= $quiz_id ?>">

          <div class="row push">
            <div class="col-lg-8 col-xl-5">
              <!-- Question textarea -->
              <div class="mb-4">
                <label class="form-label" for="question-input">Question</label>
                <textarea class="form-control" id="question-input" name="question" rows="4" placeholder="Type your question here..." required><?= htmlspecialchars($_POST['question'] ?? '') ?></textarea>
              </div>
              <!-- Question type select -->
              <div class="mb-4">
                <label class="form-label" for="question-type-select">Question Type</label>
                <select class="form-select" id="question-type-select" name="question_type_id" required>
                    <option value="1">Mcq</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Options section -->
          <div class="row push">
            <div class="col-lg-8 col-xl-5">
              <label class="form-label">Options</label>
              <?php

              $option_count = 4;
              for ($i = 0; $i < $option_count; $i++):
                $opt_val = $_POST['option_text'][$i] ?? '';
                $checked = (isset($_POST['correct_option']) && (int)$_POST['correct_option'] === $i) ? 'checked' : '';
              ?>
                <div class="input-group mb-2">
                  <div class="input-group-text">
                    <input class="form-check-input mt-0" type="radio" name="correct_option" value="<?= $i ?>" <?= $checked ?> aria-label="Mark as correct">
                  </div>
                  <input type="text" class="form-control" name="option_text[<?= $i ?>]" placeholder="Option <?= $i + 1 ?>" value="<?= htmlspecialchars($opt_val) ?>">
                </div>
              <?php endfor; ?>
              <div class="form-text">Select the radio button next to the correct answer.</div>
            </div>
          </div>

          <!-- Submit -->
          <div class="row push">
            <div class="col-lg-8 col-xl-5">
              <div class="mb-4">
                <button type="submit" name="create_btn" class="btn btn-primary">
                  <i class="fa fa-plus opacity-50 me-1"></i> Create Question
                </button>
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