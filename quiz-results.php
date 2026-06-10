<?php
require_once 'config/database-connect.php';

if (!isset($_POST['quiz-id'])) {
  header("location: courses.php");
}

///////////////////////////////////
// Quiz Details
$quiz_id = $_POST['quiz-id'];
$details_query = "SELECT quiz_name,description,time_limit FROM quizzes WHERE id= $quiz_id
";


$details_result = $db->query($details_query);
$quiz_details = $details_result->fetch_assoc();

// echo "<pre>";
// print_r($quiz_details);
// echo "</pre>";


////////////////////////////////////
// Questions with correct option


// $query = "SELECT q.id, question, qt.name as question_type, qo.id as correct_option_id 
// FROM questions AS q
// JOIN question_types AS qt ON q.question_type_id = qt.id
// JOIN question_options AS qo ON qo.question_id = q.id AND qo.is_correct = 1
// WHERE q.quiz_id = $quiz_id
// GROUP BY q.id";
$query = "SELECT 
q.id, 
question, 
qt.name as question_type, 
qo.id as correct_option_id 
FROM 
questions AS q, 
question_types AS qt, 
question_options AS qo 
WHERE quiz_id = $quiz_id 
AND question_type_id = qt.id
AND qo.question_id = q.id 
AND qo.is_correct = 1";

$result = $db->query($query);

$questions = $result->fetch_all(MYSQLI_ASSOC);

$question_count = count($questions);

// echo "<pre>";
// print_r($questions);
// echo "</pre>";

///////////////////////////////////////
// User Answers
$user_answers = null;
if (isset($_POST['submit'])) {
  $user_answers =   $_POST;
  // echo "<pre>";
  // print_r($user_answers);
  // echo "</pre>";
}


/////////////////////////////////
// Counters 
$question_counter = 0;
$total_question = count($questions);
$right_answer_counter = 0;
$wrong_answer_counter = 0;
$not_answered_counter = 0;


////////////////////////////////////////
// looping through question to update question array and counters
foreach ($questions as &$question) {
  if (!isset($user_answers[$question['id']])) {
    $not_answered_counter++;
    $question['status'] = "not_answered";
  } elseif ($user_answers[$question['id']] == $question['correct_option_id']) {
    $right_answer_counter++;
    $question['status'] = "correct";
    $question['user_answer'] = $user_answers[$question['id']];
  } elseif ($user_answers[$question['id']] != $question['correct_option_id']) {
    $wrong_answer_counter++;
    $question['status'] = "wrong";
    $question['user_answer'] = $user_answers[$question['id']];
  }
}
unset($question);

$right_percentage = $right_answer_counter / $total_question * 100;


// echo "<pre>";
// print_r($questions);
// echo "</pre>";

?>
<!-- Header -->
<?php include_once "header.php" ?>

<!-- Hero -->
<div class="results-hero anim-fade-up">
  <div class="confetti">🎉</div>
  <div class="section-label">Quiz Complete</div>
  <!-- <h1 style="margin-top:10px">Great effort, Abdullah!</h1> -->
  <!-- <p style="max-width:400px;margin:9px auto 24px">You completed <strong><?= $quiz_details["quiz_name"] ?></strong>.</p> -->
  <h2 style="margin:9px auto 24px">You completed <strong><?= $quiz_details["quiz_name"] ?></strong>.</h2>
  <div class="score-circle high">
    <div class="score-pct"><?= $right_percentage ?>%</div>
    <div class="score-text"><?= $right_answer_counter ?> / <?= $total_question ?> correct</div>
  </div>
</div>

<div class="results-body">

  <!---------------------------------  -->
  <!-- XP Toast -->

  <!-- <div class="xp-toast anim-fade-up delay-1">
    <div style="font-size:1.9rem;flex-shrink:0">⭐</div>
    <div style="flex:1">
      <h4>+120 XP Earned!</h4>
      <p>You've moved up to rank #11. Just 1 more win to reach #10!</p>
    </div>
    <a href="leaderboard.html" class="btn btn-yellow btn-sm" style="flex-shrink:0">View Rank →</a>
  </div> -->

  <!-- Score breakdown -->
  <div class="score-grid anim-fade-up delay-1">
    <div class="score-box">
      <div class="val text-green"><?= $right_answer_counter ?></div>
      <div class="lbl">✅ Correct</div>
    </div>
    <div class="score-box">
      <div class="val text-coral"><?= $wrong_answer_counter ?></div>
      <div class="lbl">❌ Wrong</div>
    </div>
    <div class="score-box">
      <div class="val" style="color:var(--slate)"><?= $not_answered_counter ?></div>
      <div class="lbl">⏭ Skipped</div>
    </div>
    <div class="score-box">
      <div class="val" style="color:var(--yellow-dark)">7:26</div>
      <div class="lbl">⏱ Time</div>
    </div>
  </div>

  <!-- Action buttons -->
  <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:32px" class="anim-fade-up delay-2">
    <a href="quiz.php?quiz-id=<?= $quiz_id ?>" class="btn btn-primary">🔄 Retry Quiz</a>
    <a href="ai-generator.html" class="btn btn-outline">✨ Generate Similar</a>
    <?php if (isset($_POST['category_id'])) : ?>
      <a href="course-detail.php?category_id=<?= $_POST['category_id'] ?>" class="btn btn-ghost">← Back to Course</a>
    <?php endif ?>
  </div>

  <!-- ----------------------------------------- -->
  <!-- Question Review -->
  <!-- <div class="anim-fade-up delay-2"> -->
  <div id="questions-review">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;flex-wrap:wrap;gap:10px">
      <h2 style="font-size:1.2rem">Question Review</h2>
      <!-- JS-powered filter tabs -->
      <div class="review-tabs" data-filter-group>
        <button class="review-tab active filter-chip" data-filter="all">All (10)</button>
        <button class="review-tab filter-chip" data-filter="correct">✅ Correct (8)</button>
        <button class="review-tab filter-chip" data-filter="wrong">❌ Wrong (2)</button>
      </div>
    </div>

    <!-- PHP: foreach ($questions as $i => $q) -->



    <?php foreach ($questions as $question) { ?>

      <div class="review-q">
        <!-- Answer Status -->
        <?php
        if ($question['status'] === 'correct') {
          echo "<div class='q-status correct'>✅ Correct</div>";
        } elseif ($question['status'] === 'wrong') {
          echo "<div class='q-status wrong'>❌ Incorrect</div>";
        } elseif ($question['status'] === 'not_answered') {
          echo "<div class='q-status wrong'>🙄 Not answered</div>";
        }
        ?>
        <!-- Question Text -->
        <div class="q-text"><?= ++$question_counter . ". " . htmlspecialchars($question['question'], ENT_QUOTES, 'UTF-8') ?></div>
        <div class="review-options">

          <?php
          $option_query = "SELECT id, option_text, is_correct FROM question_options WHERE question_id = {$question['id']};";

          $option_result = $db->query($option_query);

          $options = $option_result->fetch_all(MYSQLI_ASSOC);

          //  echo "<pre>";
          //  print_r($options);
          //  echo "</pre>";

          //  var_dump($_POST[$question["id"]]);

          foreach ($options as $option) {
          ?>

            <div class="review-option <?php
                                      if ($option["id"] === $question['correct_option_id']) {
                                        echo "correct";
                                      } elseif ($question['status'] === 'wrong' && $option["id"] === $question['user_answer']) {
                                        echo "wrong";
                                      }
                                      ?>">
              <!-- <div class="ro-letter">B</div> -->
              <span class="option-text"><?= htmlspecialchars($option['option_text'], ENT_QUOTES, 'UTF-8') ?></span>
              <?php

              if ($question['status'] === 'correct' && $option["id"] === $question['correct_option_id']) {
                echo "<span class='ro-flag' style='color:var(--green-dark)'>✓ Your answer</span>";
              } elseif ($option["id"] === $question['correct_option_id']) {
                echo "<span class='ro-flag' style='color:var(--green-dark)'>✓ Correct</span>";
              } elseif ($question['status'] === 'wrong' && $option["id"] === $question['user_answer']) {
                echo "<span class='ro-flag' style='color:var(--coral)'>✗ Your answer</span>";
              }
              ?>

            </div>

          <?php } ?>

        </div>
        <div class="ai-explain">
          <button class="ai-explain-btn btn btn-sm btn-outline"><span class="ai-dot"></span> AI Explanation</button>
          <p class="ai-output"></p>
        </div>
      </div>
    <?php } ?>

  </div>

  <!-- footer -->
  <?php include_once "footer.php" ?>