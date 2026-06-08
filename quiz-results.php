<?php 
require_once 'config/database-connect.php';

if(!isset($_POST['quiz-id'])){
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


$query = "SELECT q.id, question, qt.name as question_type, qo.id as correct_option_id 
FROM questions AS q
JOIN question_types AS qt ON q.question_type_id = qt.id
JOIN question_options AS qo ON qo.question_id = q.id AND qo.is_correct = 1
WHERE q.quiz_id = $quiz_id
GROUP BY q.id";
// $query = "SELECT 
// q.id, 
// question, 
// qt.name as question_type, 
// qo.id as correct_option_id 
// FROM 
// questions AS q, 
// question_types AS qt, 
// question_options AS qo 
// WHERE quiz_id = $quiz_id 
// AND question_type_id = qt.id
// AND qo.question_id = q.id 
// AND qo.is_correct = 1";

$result = $db->query($query);

$questions = $result->fetch_all(MYSQLI_ASSOC);

$question_count = count($questions);

// echo "<pre>";
// print_r($questions);
// echo "</pre>";

///////////////////////////////////////
// User Answers
$user_answers = null;
if(isset($_POST['submit'])) {
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
  if( !isset($user_answers[$question['id']])) {
     $not_answered_counter++;
     $question['status'] = "not_answered";
  } elseif($user_answers[$question['id']] == $question['correct_option_id']) {
    $right_answer_counter++;
    $question['status'] = "correct";
    $question['user_answer'] = $user_answers[$question['id']];
  } elseif($user_answers[$question['id']] != $question['correct_option_id']) {
    $wrong_answer_counter++;
    $question['status'] = "wrong";
    $question['user_answer'] = $user_answers[$question['id']];
  }
}

$right_percentage = $right_answer_counter/$total_question*100;


// echo "<pre>";
// print_r($questions);
// echo "</pre>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Quiz Results – EduHub</title>
  <link rel="stylesheet" href="assets/css/style.css"/>
  <style>
    body { background:linear-gradient(135deg,#f6f2ff 0%,#fffbec 100%); }
    .results-hero { text-align:center; padding:52px 24px 36px; }
    .confetti { font-size:2.8rem; margin-bottom:16px; animation:bounce .8s ease-in-out; }
    @keyframes bounce { 0%,100%{transform:translateY(0)} 40%{transform:translateY(-18px)} 60%{transform:translateY(-8px)} }
    .results-body { max-width:760px; margin:0 auto; padding:0 16px 80px; }
    .score-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:12px; margin:28px 0; }
    .score-box { background:var(--surface); border:1.5px solid var(--border); border-radius:var(--radius-md); padding:16px; text-align:center; }
    .score-box .val { font-family:var(--font-mono); font-size:1.5rem; font-weight:700; color:var(--navy); }
    .score-box .lbl { font-size:.76rem; color:var(--slate); margin-top:3px; }
    .xp-toast { background:linear-gradient(135deg,var(--primary),var(--primary-light)); color:#fff; border-radius:var(--radius-lg); padding:18px 24px; display:flex; align-items:center; gap:14px; margin-bottom:24px; flex-wrap:wrap; }
    .xp-toast h4 { color:#fff; font-size:.97rem; }
    .xp-toast p  { color:rgba(255,255,255,.8); font-size:.83rem; margin-top:2px; }
    /* Review questions */
    .review-q { background:var(--surface); border:1.5px solid var(--border); border-radius:var(--radius-lg); padding:20px 22px; margin-bottom:14px; }
    .q-status  { display:inline-flex; align-items:center; gap:5px; font-family:var(--font-display); font-weight:700; font-size:.78rem; padding:3px 11px; border-radius:var(--radius-pill); margin-bottom:10px; }
    .q-status.correct { background:var(--green-faint);  color:var(--green-dark); }
    .q-status.wrong   { background:var(--coral-faint);  color:#b02020; }
    .q-status.skipped { background:rgba(107,114,128,.1); color:var(--slate); }
    .review-q .q-text { font-family:var(--font-display); font-weight:700; font-size:.93rem; color:var(--navy); margin-bottom:12px; line-height:1.45; }
    .review-options { display:flex; flex-direction:column; gap:7px; }
    .review-option { display:flex; align-items:center; gap:11px; padding:9px 14px; border-radius:var(--radius-md); border:1.5px solid var(--border); font-size:.86rem; border-color: #7f8c8d; background: #f9f9f9;}
    .review-option.correct { border-color:var(--green); background:var(--green-faint); }
    .review-option.wrong   { border-color:var(--coral); background:var(--coral-faint); }
    .ro-letter { width:26px; height:26px; border-radius:50%; flex-shrink:0; display:flex; align-items:center; justify-content:center; font-family:var(--font-display); font-weight:800; font-size:.76rem; background:var(--border); color:var(--slate); }
    .review-option.correct .ro-letter { background:var(--green); color:#fff; }
    .review-option.wrong   .ro-letter { background:var(--coral); color:#fff; }
    .ro-flag { margin-left:auto; font-size:.76rem; font-weight:700; white-space:nowrap; }
    .ai-explain { margin-top:12px; background:linear-gradient(135deg,rgba(92,51,246,.05),rgba(92,51,246,.02)); border:1.5px solid rgba(92,51,246,.15); border-radius:var(--radius-md); padding:14px 16px; }
    .ai-explain p { font-size:.86rem; color:var(--navy); line-height:1.6; margin-top:8px; }
    /* Review filter tabs */
    .review-tabs { display:flex; gap:3px; margin-bottom:18px; flex-wrap:wrap; }
    .review-tab { padding:7px 16px; border-radius:var(--radius-pill); border:1.5px solid var(--border); background:var(--surface); font-family:var(--font-display); font-weight:700; font-size:.8rem; color:var(--slate); cursor:pointer; transition:all var(--transition); }
    .review-tab:hover  { border-color:var(--primary); color:var(--primary); }
    .review-tab.active { background:var(--primary); border-color:var(--primary); color:#fff; }
    @media(max-width:560px) {
      .score-grid { grid-template-columns:repeat(2,1fr); }
      .xp-toast   { flex-direction:column; align-items:flex-start; }
    }
  </style>
</head>
<body>

<nav class="navbar">
  <div class="container">
    <a href="index.html" class="nav-logo">Edu<span class="logo-hub">Hub</span><span class="logo-dot"></span></a>
    <div class="nav-links">
      <a href="dashboard.html">Dashboard</a>
      <a href="courses.html" class="active">Courses</a>
      <a href="progress.html">My Progress</a>
      <a href="leaderboard.html">Leaderboard</a>
      <a href="ai-generator.html">AI Tools</a>
    </div>
    <div class="nav-actions"><a href="profile.html" class="nav-avatar">AR</a></div>
    <button class="hamburger" id="hamburger" aria-label="Menu" aria-expanded="false"><span></span><span></span><span></span></button>
  </div>
</nav>
<div class="mobile-nav" id="mobileNav"><div class="mobile-nav-inner">
  <div class="mobile-nav-user"><div class="nav-avatar">AR</div><div><div class="mobile-nav-user-name">Abdullah Rashid</div><div class="mobile-nav-user-email">abdullah@example.com</div></div></div>
  <div class="mobile-nav-section">Navigation</div>
  <a href="dashboard.html"    class="mobile-nav-link"><span class="icon">🏠</span> Dashboard</a>
  <a href="courses.html"      class="mobile-nav-link active"><span class="icon">📚</span> Courses</a>
  <a href="progress.html"     class="mobile-nav-link"><span class="icon">📈</span> My Progress</a>
  <a href="leaderboard.html"  class="mobile-nav-link"><span class="icon">🏆</span> Leaderboard</a>
  <a href="ai-generator.html" class="mobile-nav-link"><span class="icon">✨</span> AI Tools</a>
  <div class="mobile-nav-divider"></div>
  <a href="profile.html" class="mobile-nav-link"><span class="icon">👤</span> Profile</a>
  <a href="login.html"   class="mobile-nav-link"><span class="icon">🚪</span> Log Out</a>
</div></div>

<!-- Hero -->
<div class="results-hero anim-fade-up">
  <div class="confetti">🎉</div>
  <div class="section-label">Quiz Complete</div>
  <!-- <h1 style="margin-top:10px">Great effort, Abdullah!</h1> -->
  <!-- <p style="max-width:400px;margin:9px auto 24px">You completed <strong><?= $quiz_details["quiz_name"] ?></strong>.</p> -->
  <h2 style="margin:9px auto 24px">You completed <strong><?= $quiz_details["quiz_name"] ?></strong>.</h2>
  <div class="score-circle high"><div class="score-pct"><?= $right_percentage ?>%</div><div class="score-text"><?= $right_answer_counter ?> / <?= $total_question ?> correct</div></div>
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
    <div class="score-box"><div class="val text-green"><?= $right_answer_counter ?></div><div class="lbl">✅ Correct</div></div>
    <div class="score-box"><div class="val text-coral"><?= $wrong_answer_counter ?></div><div class="lbl">❌ Wrong</div></div>
    <div class="score-box"><div class="val" style="color:var(--slate)"><?= $not_answered_counter ?></div><div class="lbl">⏭ Skipped</div></div>
    <div class="score-box"><div class="val" style="color:var(--yellow-dark)">7:26</div><div class="lbl">⏱ Time</div></div>
  </div>

  <!-- Action buttons -->
  <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:32px" class="anim-fade-up delay-2">
    <a href="quiz.html" class="btn btn-primary">🔄 Retry Quiz</a>
    <a href="ai-generator.html" class="btn btn-outline">✨ Generate Similar</a>
    <a href="course-detail.html"class="btn btn-ghost">← Back to Course</a>
  </div>

  <!-- ----------------------------------------- -->
  <!-- Question Review -->
  <!-- <div class="anim-fade-up delay-2"> -->
  <div>
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

    <?php foreach ($questions as $question) { 
      $option_query = "SELECT id, option_text, is_correct FROM question_options WHERE question_id = {$question['id']};";

            $option_result = $db->query($option_query);

            $options = $option_result->fetch_all(MYSQLI_ASSOC);

        //  echo "<pre>";
        //  print_r($options);
        //  echo "</pre>";
      
        //  var_dump($_POST[$question["id"]]);
      ?>

    <div class="review-q">
      <!-- Status -->
       <?php 
       if($question['status'] === 'correct') {
        echo "<div class='q-status correct'>✅ Correct</div>";
       } elseif($question['status'] === 'wrong') {
        echo "<div class='q-status wrong'>❌ Incorrect</div>";   
       } elseif($question['status'] === 'not_answered') {
        echo "<div class='q-status wrong'>🙄 Not answered</div>"; 
       }
       ?>
      <!-- Title -->
      <div class="q-text"><?= htmlspecialchars($question['question'], ENT_QUOTES, 'UTF-8') ?></div>
      <div class="review-options">

      <?php

            foreach ($options as $option) {
            ?>

        <div class="review-option <?php 
        if ($option["id"] === $question['correct_option_id']) {
          echo "correct";
        } elseif($question['status'] === 'wrong' && $option["id"] === $question['user_answer']) {
          echo "wrong";
        }
        ?>">
          <!-- <div class="ro-letter">B</div> -->
          <span><?= htmlspecialchars($option['option_text'], ENT_QUOTES, 'UTF-8') ?></span>
        <?php 

        if ($question['status'] === 'correct' && $option["id"] === $question['correct_option_id']) {
         echo "<span class='ro-flag' style='color:var(--green-dark)'>✓ Your answer</span>";
        }
         elseif ($option["id"] === $question['correct_option_id']) {
         echo "<span class='ro-flag' style='color:var(--green-dark)'>✓ Correct</span>";
        } elseif($question['status'] === 'wrong' && $option["id"] === $question['user_answer']) {
          echo "<span class='ro-flag' style='color:var(--coral)'>✗ Your answer</span>";
        }
        ?>
          
        </div>

        <?php } ?>

      </div>
    </div>
    <?php } ?>

</div>

<script src="assets/js/main.js"></script>
</body>
</html>
