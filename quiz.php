<?php
require_once 'config/database-connect.php';

if(!isset($_GET['quiz-id'])){
  header("location: courses.php");
}

$quiz_id = $_GET['quiz-id'];

// Quiz Details
$details_query = "SELECT quiz_name,description,time_limit FROM quizzes WHERE id= $quiz_id
";


$details_result = $db->query($details_query);
$quiz_details = $details_result->fetch_assoc();

// echo "<pre>";
// print_r($quiz_details);
// echo "</pre>";


// Questions

$query = "SELECT questions.id, question, question_types.name as question_type FROM questions, question_types WHERE quiz_id = $quiz_id AND question_type_id = question_types.id";

$result = $db->query($query);

$questions = $result->fetch_all(MYSQLI_ASSOC);

$question_count = count($questions);

// echo "<pre>";
// print_r($questions);
// echo "</pre>";

$question_counter = 0;



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quiz – EduHub</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/quiz.css" />
  <style>
    
  </style>
</head>

<body>

  <!-- ═══ NAVBAR ═══ -->
  <!-- <?php include 'includes/navbar.php'; ?> -->
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
      <div class="nav-actions">
        <a href="profile.html" class="nav-avatar">AR</a>
      </div>
      <button class="hamburger" id="hamburger" aria-label="Menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>
  </nav>
  <div class="mobile-nav" id="mobileNav">
    <div class="mobile-nav-inner">
      <div class="mobile-nav-user">
        <div class="nav-avatar">AR</div>
        <div>
          <div class="mobile-nav-user-name">Abdullah Rashid</div>
          <div class="mobile-nav-user-email">abdullah@example.com</div>
        </div>
      </div>
      <div class="mobile-nav-section">Navigation</div>
      <a href="dashboard.html" class="mobile-nav-link"><span class="icon">🏠</span> Dashboard</a>
      <a href="courses.html" class="mobile-nav-link active"><span class="icon">📚</span> Courses</a>
      <a href="progress.html" class="mobile-nav-link"><span class="icon">📈</span> My Progress</a>
      <a href="leaderboard.html" class="mobile-nav-link"><span class="icon">🏆</span> Leaderboard</a>
      <a href="ai-generator.html" class="mobile-nav-link"><span class="icon">✨</span> AI Tools</a>
      <div class="mobile-nav-divider"></div>
      <a href="profile.html" class="mobile-nav-link"><span class="icon">👤</span> Profile</a>
      <a href="login.html" class="mobile-nav-link"><span class="icon">🚪</span> Log Out</a>
    </div>
  </div>


  <!-- ═══ STICKY TOP BAR ═══ -->
  <!-- This whole block is sticky: sits right below the navbar -->
  <div class="quiz-sticky-top">

    <!-- Row 1: back | title | timer | quit -->
    <div class="quiz-info-row">
      <a href="course-detail.html" class="quiz-back-btn" title="Back to course">←</a>
      <!-- PHP: echo $quiz->course_name . ' – ' . $quiz->title -->
      <div class="quiz-title"><?= $quiz_details['quiz_name'] ?></div>
      <!-- Timer — updated by JS countdown -->
      <div class="quiz-timer-pill" id="quizTimer">
        ⏱ <span id="timerDisplay">15:00</span>
      </div>
      <a href="quiz-results.html" class="quiz-quit-btn">Quit</a>
    </div>

    <!-- Row 2: progress bar -->
    <!-- PHP: $pct = ($answered / $total) * 100 -->
    <div class="quiz-progress-row">
      <div class="quiz-progress-count" id="progressCount">0 / <?= $question_count ?> answered</div>
      <div class="quiz-progress-track">
        <div class="quiz-progress-bar" id="progressBar" style="width: 0%"></div>
      </div>
      <div class="quiz-progress-label" id="progressPct">0%</div>
    </div>

  </div><!-- /.quiz-sticky-top -->


  <!-- ═══ QUIZ BODY ═══ -->
  <form action="quiz-results.php" method="POST"> 
    <input type="hidden" name="quiz-id" value="<?= $_GET['quiz-id'] ?>">
  <div class="quiz-body">
    <!-- PHP: foreach ($questions as $i => $q) -->
    <div class="quiz-card">

      <!-- Card header -->
      <div class="quiz-card-header">
        <div>
          <div class="quiz-card-header-title"><?= $quiz_details['quiz_name'] ?></div>
          <div class="quiz-card-header-meta">10 questions · Medium difficulty · <?= $quiz_details['time_limit'] ?> min</div>
        </div>
        <span class="badge badge-yellow" style="font-size:.75rem">🔥 In Progress</span>
      </div>

      <!-- ─── QUESTIONS ─── -->

      <?php foreach ($questions as $question): ?>
        <div class="question-block" id="qblock-<?= ++$question_counter ?>">
          <div class="q-label">Question <?= $question_counter ?></div>
          <div class="q-text"><?= $question['question'] ?></div>
          <div class="q-options" data-question="<?= $question_counter ?>">

            <?php
            $option_query = "SELECT id, option_text FROM question_options WHERE question_id = {$question['id']};";

            $option_result = $db->query($option_query);

            $options = $option_result->fetch_all(MYSQLI_ASSOC);

            // echo "<pre>";
            // print_r($options);
            // echo "</pre>";
            foreach ($options as $option) {

            ?>
              <label class="q-option">
                <input type="radio" name="<?= $question['id'] ?>" value="<?= $option['id'] ?>" />
                <span class="q-radio"></span>
                <span class="q-option-text"><?= htmlspecialchars($option['option_text'], ENT_QUOTES, 'UTF-8') ?></span>
              </label>
            <?php } ?>
          </div>
        </div>
      <?php endforeach ?>
    </div><!-- /.quiz-card -->
  </div><!-- /.quiz-body -->


  <!-- ═══ FIXED BOTTOM SUBMIT BAR ═══ -->
  <div class="quiz-bottom-bar">
    <div class="quiz-bottom-stats">
      <div class="bottom-stat">✅ Answered: <strong id="statAnswered">0</strong></div>
      <div class="bottom-stat">⬜ Unanswered: <strong id="statUnanswered">8</strong></div>
      <div class="bottom-stat">📊 <strong id="statPct">20%</strong> done</div>
    </div>
    <!-- PHP: action="submit_quiz.php" method="POST" -->
    <button type="submit" name="submit" class="quiz-submit-btn">Submit Answers →</button>
  </div>
  </form>


  <script src="assets/js/main.js"></script>
  <script>
    /* ─── QUIZ PAGE INTERACTIVITY ─── */
    (function() {

      /* ── 1. COUNTDOWN TIMER ── */
      var TOTAL_SECONDS = 15 * 60; /* PHP: echo $quiz->time_limit * 60 */
      var remaining = TOTAL_SECONDS;
      var timerDisplay = document.getElementById('timerDisplay');
      var timerPill = document.getElementById('quizTimer');

      function formatTime(s) {
        var m = Math.floor(s / 60);
        var sec = s % 60;
        return (m < 10 ? '0' : '') + m + ':' + (sec < 10 ? '0' : '') + sec;
      }

      var timerInterval = setInterval(function() {
        remaining--;
        if (remaining <= 0) {
          clearInterval(timerInterval);
          timerDisplay.textContent = '00:00';
          /* PHP will handle auto-submit; JS can trigger form submit here */
          return;
        }
        timerDisplay.textContent = formatTime(remaining);
        /* Turn red when under 2 minutes */
        if (remaining <= 120) {
          timerPill.classList.add('warning');
        }
      }, 1000);

      /* ── 2. OPTION SELECTION + PROGRESS TRACKING ── */
      var TOTAL_QUESTIONS = <?= $question_count ?>; /* PHP: echo $total_questions */
      var answered = new Set();

      /* Pre-fill already-answered questions (checked on load) */
      document.querySelectorAll('.q-options input[type="radio"]:checked').forEach(function(r) {
        var qNum = r.closest('.question-block').id.replace('qblock-', '');
        answered.add(qNum);
      });

      function updateProgress() {
        var count = answered.size;
        var pct = Math.round((count / TOTAL_QUESTIONS) * 100);

        document.getElementById('progressBar').style.width = pct + '%';
        document.getElementById('progressPct').textContent = pct + '%';
        document.getElementById('progressCount').textContent = count + ' / ' + TOTAL_QUESTIONS + ' answered';
        document.getElementById('statAnswered').textContent = count;
        document.getElementById('statUnanswered').textContent = TOTAL_QUESTIONS - count;
        document.getElementById('statPct').textContent = pct + '%';
      }

      /* Initial update */
      updateProgress();

      /* Listen to all option clicks */
      document.querySelectorAll('.q-options').forEach(function(group) {
        group.querySelectorAll('.q-option').forEach(function(option) {
          option.addEventListener('click', function() {
            /* Visual: remove selected from siblings */
            group.querySelectorAll('.q-option').forEach(function(o) {
              o.classList.remove('selected');
            });
            option.classList.add('selected');

            /* Check the hidden radio */
            var radio = option.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;

            /* Track answered */
            var qNum = group.closest('.question-block').id.replace('qblock-', '');
            answered.add(qNum);
            updateProgress();
          });
        });
      });

      /* ── 3. AI EXPLANATION BUTTON ── */
      /* Placeholder — PHP/AJAX will handle actual AI fetch */
      document.querySelectorAll('.q-ai-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
          var block = btn.closest('.question-block');
          /* PHP will render the explanation panel; this just shows a loading state */
          btn.textContent = '⏳ Loading explanation…';
          btn.style.opacity = '0.6';
          btn.style.pointerEvents = 'none';
          /* Reset after 2s (remove when PHP AJAX is wired up) */
          setTimeout(function() {
            btn.textContent = '✨ AI Explanation';
            btn.style.opacity = '';
            btn.style.pointerEvents = '';
          }, 2000);
        });
      });

    })();
  </script>

</body>

</html>